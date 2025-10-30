<?php

namespace App\Enums;

enum MenuItemTypes: string {

    case PAGE = 'Página';
    case CUSTOM = 'Personalizado';
    case CATEGORY = 'Categoría';
    case PROGRAM = 'Programa o Maestría';
    case MEGA_MENU = 'Sub menú con columnas';
    case GROUP_MENU = 'Grupo de rutas';
    case TEXT = 'Texto simple';

}
