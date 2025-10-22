<?php

namespace App\Enums;

enum SlideTypes: string {

    case IMAGE = 'Imagen';
    case IMAGE_WITH_VIDEO = 'Imagen con video';
    case BG_IMAGE_AND_TEXT = 'Imagen de fondo y texto';

    case PARAGRAPH = 'Párrafo';
    case SUB_PARAGRAPH = 'Sub párrafo';
    case BUTTON = 'Botón';
    case BOTTOM_BOX = 'Bloque en pie';

}
