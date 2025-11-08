<div class="w-full">
    <form wire:submit.defer="process" class="space-y-6 relative" autocomplete="off">
        <div class="md:grid grid-cols-12 gap-x-6 gap-y-5 sm:space-y-0 space-y-6">
            @foreach($fields as $f => $field)
                @php
                    $field_idx = 'form_data.' . $field['slug'];
                @endphp
                @if($field['show'])
                    @if($field['type'] !== \App\Enums\FormFields::HIDDEN->value)
                        <div wire:key="field-{{$field['slug']}}" class="w-full col-span-{{$field['size']}} @error($field_idx) is-invalid @enderror">
                            @if($field['type'] === \App\Enums\FormFields::RADIO_EMAIL_SEND->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div class="md:grid grid-cols-2 gap-6">
                                    @foreach($field['options'] as $option)
                                        <div>
                                            <label for="{{$option['label']}}">
                                                <input wire:model.defer="{{'form_data.' . $field['slug']}}" name="{{$field['slug']}}" id="{{$option['label']}}" type="radio" value="{{$option['label']}}" />
                                                <span>{{$option['label']}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::RADIO->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div class="flex items-center space-x-6">
                                    <p class="text-secondary">{{$field['name']}}</p>
                                    <div class="flex items-center space-x-4">
                                        @foreach($field['options'] as $option)
                                            <div>
                                                <label for="{{$option['label']}}">
                                                    <input wire:model.defer="{{'form_data.' . $field['slug']}}" name="{{$field['slug']}}" id="{{$option['label']}}" type="radio" value="{{$option['label']}}" />
                                                    <span>{{$option['label']}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::TEXT->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input wire:key="{{$field['slug']}}" autocomplete="new-password" type="text" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::EMAIL->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input autocomplete="new-password" type="text" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::CELLPHONE->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input autocomplete="new-password" type="text" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::DNI->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input autocomplete="new-password" type="text" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::RUC->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input autocomplete="new-password" type="text" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::DATE->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <x-inputs.date wire:model.defer="{{'form_data.' . $field['slug']}}" id="{{$field['slug']}}" name="{{$field['slug']}}" autocomplete="off" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::TEXTAREA->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <textarea class="form-textarea" wire:model.defer="{{'form_data.' . $field['slug']}}" id="{{$field['slug']}}" name="{{$field['slug']}}" @if(!$show_labels) placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" @endif ></textarea>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::CHECKBOX->value)
                                <div class="form-check flex items-center space-x-2">
                                    <input type="checkbox" name="{{$field['slug']}}" class="form-check-input" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}">
                                    @php
                                        $check_label = $field['name'];
                                        if (count($field['link']) > 0) {
                                            if (isset($field['link'][0]['initial_text'])) {
                                                $check_label = $field['link'][0]['initial_text'];
                                            }
                                            if (isset($field['link'][0]['text'])) {
                                                $check_label .= ' <a href="' . $field['link'][0]['url'] . '" target="_blank" class="text-primary underline">' . $field['link'][0]['text'] . '</a>';
                                            }
                                        }
                                    @endphp
                                    <label for="{{$field['slug']}}">{!! $check_label !!}{{($field['required'] ? '*' : '')}}</label>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::FILE->value)
                                <div class="flex justify-center border border-dashed border-gray bg-white px-6 py-4">
                                    <div class="text-center">
                                        <div class="flex text-sm leading-6">
                                            <label for="{{$field['slug']}}" class="relative cursor-pointer rounded-md font-semibold text-gray focus-within:outline-none focus-within:ring-none focus-within:ring-offset-2">
                                                <span>Cargar archivo</span>
                                                <input id="{{$field['slug']}}" name="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                            </label>
                                            <p class="pl-1 text-secondary">o arrástralo y suéltalo</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::SELECT->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <select wire:model.defer="{{'form_data.' . $field['slug']}}" name="{{$field['slug']}}" id="{{$field['slug']}}">
                                        <option value="">{{$field['name']}}{{($field['required'] ? '*' : '')}}</option>
                                        @foreach($field['options'] as $option)
                                            <option value="{{$option['value']}}" >{{$option['label']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::DOCUMENT_TYPE->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <select wire:model.defer="{{'form_data.' . $field['slug']}}" name="{{$field['slug']}}" id="{{$field['slug']}}">
                                        <option value="">{{$field['name']}}{{($field['required'] ? '*' : '')}}</option>
                                        <option value="{{\App\Enums\DocumentTypes::DNI->value}}">{{\App\Enums\DocumentTypes::DNI->value}}</option>
                                        <option value="{{\App\Enums\DocumentTypes::PASSPORT->value}}">{{\App\Enums\DocumentTypes::PASSPORT->value}}</option>
                                        <option value="{{\App\Enums\DocumentTypes::CE->value}}">{{\App\Enums\DocumentTypes::CE->value}}</option>
                                    </select>
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::DOCUMENT_NUMBER->value)
                                @if($show_labels)
                                    <label for="{{$field['slug']}}">{{$field['name']}}</label>
                                @endif
                                <div>
                                    <input autocomplete="new-password" type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="{{$field['slug']}}" id="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" class="form-input" />
                                </div>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::SEPARATOR_TITLE->value)
                                <h6 class="font-semibold text-third{{$f > 0 ? ' mt-3' : ''}} ">{{$field['name']}}</h6>
                            @endif
                            @if($field['type'] === \App\Enums\FormFields::PARAGRAPH->value)
                                <div class="html-content text-secondary">{!! $field['content'] !!}</div>
                            @endif
                            @error($field_idx) <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div wire:key="field-{{$field['slug']}}">
                            <input type="hidden" name="{{$field['slug']}}" wire:model.defer="{{'form_data.' . $field['slug']}}" />
                        </div>
                    @endif
                @endif
            @endforeach

            <div class="col-span-full flex justify-center">
                <button type="submit" class="btn btn-lg btn-primary md:!px-12" wire:loading.attr="disabled">{{$form['text_button']}}</button>
            </div>
        </div>
    </form>
</div>
