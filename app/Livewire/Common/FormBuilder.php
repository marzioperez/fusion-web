<?php

namespace App\Livewire\Common;

use App\Enums\FormFields;
use App\Models\Form;
use App\Models\Lead;
use Livewire\Component;

class FormBuilder extends Component {

    public $form_id;
    public Form $form;
    public array $fields = [];
    public array $form_data = [];
    public array $form_rules = [];
    public bool $show_labels = false;

    protected $messages = [
        '*.*.required' => 'Campo obligatorio',
        '*.*.email' => 'Correo electrónico incorrecto',
        '*.*.regex' => 'Correo electrónico incorrecto',
        '*.*.accepted' => 'Debes marcar este campo',
        '*.*.digits' => 'Campo incorrecto',
        '*.*.numeric' => 'Formato incorrecto',
        '*.*.starts_with' => 'Formato incorrecto',
        '*.*.min' => 'Formato incorrecto',
    ];

    public function mount(): void {
        $this->load_fields();
    }

    public function load_fields(): void {
        if ($this->form_id) {
            $form = Form::find($this->form_id);
            if ($form) {
                $this->form = $form;
                $this->fields = $form->fields()->ordered()->get()->toArray();
                $this->form_rules = [];

                foreach ($this->fields as $field) {
                    if ($field['show']) {
                        $slug = $field['slug'];
                        $ruleKey = 'form_data.' . $slug;

                        if (!array_key_exists($slug, $this->form_data)) {
                            $this->form_data[$slug] = $field['default_value'];

                            if ($field['type'] === FormFields::CHECKBOX->value) {
                                $this->form_data[$slug] = (bool) $this->form_data[$slug];
                            }
                        }

                        $this->form_rules[$ruleKey] = $field['required'] ? 'required' : 'nullable';

                        if ($field['type'] === FormFields::EMAIL->value) {
                            $this->form_rules[$ruleKey] .= '|email';
                        }
                        if ($field['type'] === FormFields::CHECKBOX->value) {
                            $this->form_rules[$ruleKey] .= '|accepted';
                        }
                        if ($field['type'] === FormFields::DNI->value) {
                            $this->form_rules[$ruleKey] .= '|digits:8';
                        }
                        if ($field['type'] === FormFields::DOCUMENT_NUMBER->value) {
                            $this->form_rules[$ruleKey] .= '|min:8';
                        }
                        if ($field['type'] === FormFields::RUC->value) {
                            $this->form_rules[$ruleKey] .= '|numeric|digits:11';
                        }
                        if ($field['type'] === FormFields::CELLPHONE->value) {
                            $this->form_rules[$ruleKey] .= '|numeric';
                        }
                    }
                }
            }
        }
    }

    public function process(): void {
        $this->validate($this->form_rules);
        $data = [];
        foreach ($this->fields as $field) {
            foreach ($this->form_data as $key => $value) {
                if ($field['slug'] === $key) {
                    $data[] = [
                        'name' => $field['name'],
                        'value' => $value
                    ];
                }
            }
        }

        Lead::create([
            'form_id' => $this->form_id,
            'data' => $this->form_data
        ]);

        $this->reset(['form_data', 'form_rules', 'provinces', 'districts']);
        $this->resetErrorBag();
        $this->resetValidation();

        $this->load_fields();
        $this->toast('Form submitted successfully', 'Form submitted', 'success');
    }

    public function render() {
        return view('livewire.common.form-builder');
    }
}
