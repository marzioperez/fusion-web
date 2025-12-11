<?php

namespace App\Classes;

use App\Filament\Forms\Components\MediaPicker;
use App\Models\Form;
use App\Models\Media;
use App\Models\Slider;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;

class Blocks {

    public string $model;

    public function __construct(string $model) {
        $this->model = $model;
    }

    public function block_default_settings(array $default_values = [
        'top_desktop' => 7,
        'bottom_desktop' => 7,
        'top_mobile' => 6,
        'bottom_mobile' => 6,
    ]): array {
        return [
            Grid::make([
                'default' => 1,
                'sm' => 3,
                'xl' => 12,
                '2xl' => 12
            ])->schema([
                Section::make('Visualización')->schema([
                    Toggle::make('visible')->label('Mostrar')->default(true)->columnSpanFull(),
                    Select::make('bg_type')->label('Tipo de fondo')->options([
                        'image' => 'Imagen',
                        'color' => 'Color'
                    ])->live(),
                    ColorPicker::make('bg_color')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull()->visible(fn(Get $get) => $get('bg_type') === 'color'),
                    MediaPicker::make('bg_image_id')->label('Imagen de fondo')->columnSpanFull()->visible(fn(Get $get) => $get('bg_type') === 'image'),
                    TextInput::make('id')->label('Identificador')->columnSpanFull(),
                ])->columnSpanFull(),
                Section::make('Espaciado interno Desktop')->schema([
                Select::make('padding_top_desktop')->label('Arriba')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['top_desktop'])->native(false)->searchable(),
                Select::make('padding_bottom_desktop')->label('Abajo')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['bottom_desktop'])->native(false)->searchable(),
            ])->columns()->columnSpan(6),
                Section::make('Espaciado interno Mobile')->schema([
                Select::make('padding_top_mobile')->label('Arriba')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['top_mobile'])->native(false)->searchable(),
                Select::make('padding_bottom_mobile')->label('Abajo')->options([
                    '0' => '0px',
                    '1' => '4px',
                    '2' => '8px',
                    '3' => '12px',
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                    '20' => '80px',
                    '24' => '96px'
                ])->default($default_values['bottom_mobile'])->native(false)->searchable()
            ])->columns()->columnSpan(6)
            ])->columnSpanFull()
        ];
    }

    public function init(): array {
        $elements = collect([
            Block::make('slider')->label('Slider')->schema([
                Select::make('slider')->label('Slider')->options(Slider::all()->pluck('name', 'id'))->columnSpanFull(),
                Toggle::make('arrows')->label('Mostrar flechas')->default(false)->columnSpanFull(),
                Toggle::make('pagination')->label('Mostrar paginación')->default(false)->columnSpanFull(),
            ]),
            Block::make('card-list')->label('Lista de tarjetas')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('title')->label('Título')->columnSpanFull(),
                            RichEditor::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                        ])
                    ]),
                    Tab::make('Tarjetas')->schema([
                        Repeater::make('cards')->label('Tarjetas')->schema([
                            TextInput::make('title')->label('Título')->columnSpanFull(),
                            TextInput::make('sub_title')->label('Título')->columnSpanFull(),
                            ColorPicker::make('bg_color')->label('Color de fondo'),
                            ColorPicker::make('text_color')->label('Color de texto'),
                            MediaPicker::make('icon_id')->label('Icono')->columnSpanFull(),
                        ])->columns()
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('image-text-and-metrics')->label('Imagen y métricas')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                            RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                            TextInput::make('button_text')->label('Texto en botón')->columnSpan(4),
                            TextInput::make('button_url')->label('URL en botón')->columnSpan(8),
                            Toggle::make('open_in_new_tab')->label('Abrir en una nueva pestaña')->columnSpanFull()
                        ])
                    ]),
                    Tab::make('Métricas')->schema([
                        Repeater::make('metrics')->label('Métricas')->schema([
                            TextInput::make('value')->label('Valor')->columnSpanFull(),
                            TextInput::make('title')->label('Título')->columnSpanFull(),
                            ColorPicker::make('color')->label('Color')
                        ])->columns()->collapsible()->collapsed()->cloneable()->columnSpanFull(),
                    ]),
                    Tab::make('Imagen')->schema([
                        MediaPicker::make('image_id')->label('Imagen')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('school-carousel')->label('Carrusel de colegios')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                            TextInput::make('button_text')->label('Texto en botón')->columnSpan(4),
                            TextInput::make('button_url')->label('URL en botón')->columnSpan(8),
                            Toggle::make('open_in_new_tab')->label('Abrir en una nueva pestaña')->columnSpanFull()
                        ])
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('text-and-video')->label('Texto y video')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                            RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                            Repeater::make('lists')->label('Listas')->schema([
                                RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                            ])->columnSpanFull()->collapsible()->collapsed()->cloneable(),
                        ])
                    ]),
                    Tab::make('Video')->schema([
                        TextInput::make('video_title')->label('Título')->columnSpanFull(),
                        Textarea::make('video_iframe')->label('Iframe')->columnSpanFull()->hint('Ingresa el iframe del video, cambia el parámetro width al 100%'),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('logos-carousel')->label('Carrusel de logos')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull()
                        ])
                    ]),
                    Tab::make('Logos')->schema([
                        Repeater::make('logos')->label('Logos')->schema([
                            MediaPicker::make('logo')->label('Logo')->columnSpanFull(),
                        ])->grid()->collapsible()->collapsed()->cloneable()
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('text-with-bg-image')->label('Texto en imagen de fondo')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                            RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                            TextInput::make('button_text')->label('Texto en botón')->columnSpan(4),
                            TextInput::make('button_url')->label('URL en botón')->columnSpan(8),
                            Toggle::make('open_in_new_tab')->label('Abrir en una nueva pestaña')->columnSpanFull()
                        ])
                    ]),
                    Tab::make('Imagen de fondo')->schema([
                        MediaPicker::make('image_id')->label('Imagen de fondo')->columnSpanFull(),
                        MediaPicker::make('inner_image_id')->label('Imagen por encima')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('section-title')->label('Título principal')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('title')->label('Título')->columnSpanFull()
                        ])
                    ]),
                    Tab::make('Imagen de fondo')->schema([
                        MediaPicker::make('inner_image_id')->label('Imagen de fondo')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('time-line')->label('Línea de tiempo')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('before_title')->label('Título inicial')->columnSpan(4),
                            TextInput::make('title')->label('Título')->columnSpan(8),
                            TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                            RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                        ])
                    ]),
                    Tab::make('Línea de tiempo')->schema([
                        TextInput::make('time_line_title')->label('Título')->columnSpanFull(),
                        Repeater::make('items')->label('Ítems')->schema([
                            TextInput::make('year')->label('Año')->columnSpanFull(),
                            Textarea::make('content')->label('Contenido')->columnSpanFull(),
                        ])->columns()->collapsible()->collapsed()->cloneable()->columnSpanFull(),
                    ]),
                    Tab::make('Imagen')->schema([
                        MediaPicker::make('image_id')->label('Imagen')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('text-content')->label('Contenido de texto')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        RichEditor::make('content')->label('Contenido')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('form-with-map')->label('Formulario con mapa')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        Select::make('form_id')->label('Formulario')->options(Form::all()->pluck('name', 'id'))->columnSpanFull(),
                        Textarea::make('map')->label('Mapa')->hint('Ingresa el iframe del mapa, cambia el parámetro width al 100%')->columnSpanFull(),
                    ]),
                    Tab::make('Ajustes')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema($this->block_default_settings([
                            'top_desktop' => 14,
                            'bottom_desktop' => 14,
                            'top_mobile' => 9,
                            'bottom_mobile' => 9,
                        ]))
                    ])
                ])
            ]),
            Block::make('register')->label('Registro')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        TextInput::make('title')->label('Título')->columnSpanFull(),
                        TextInput::make('login_url')->label('URL de login')->columnSpanFull(),
                        MediaPicker::make('bg_image_id')->label('Imagen')->columnSpanFull(),
                    ]),
                ])
            ]),
            Block::make('login')->label('Login')->schema([
                Tabs::make()->tabs([
                    Tab::make('Contenido')->schema([
                        TextInput::make('reset_password_url')->label('URL de recuperación de contraseña')->columnSpanFull(),
                        TextInput::make('register_url')->label('URL de registro')->columnSpanFull(),
                        MediaPicker::make('bg_image_id')->label('Imagen')->columnSpanFull(),
                    ]),
                ])
            ]),
        ]);

        return $elements->sortBy(fn($block) => $block->getLabel())->values()->all();
    }
}
