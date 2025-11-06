<?php

namespace App\Enums;

enum FormFields: string {

    case TEXT = 'Texto simple';
    case TEXTAREA = 'Área de texto';
    case CHECKBOX = 'Checkbox';
    case SELECT = 'Selector';
    case EMAIL = 'Email';
    case CELLPHONE = 'Celular';
    case COUNTRY = 'País';
    case FILE = 'Archivo';
    case DNI = 'DNI';
    case RUC = 'RUC';
    case DATE = 'Fecha';
    case SEPARATOR_TITLE = 'Título separador';
    case PARAGRAPH = 'Párrafo';
    case DOCUMENT_NUMBER = 'Número de documento';
    case DOCUMENT_TYPE = 'Tipo de documento';
    case RADIO_EMAIL_SEND = 'Radio para envío de correos';
    case HIDDEN = 'Oculto';
    case DEPARTMENT = 'Departamento';
    case PROVINCE = 'Provincia';
    case DISTRICT = 'Distrito';
    case RADIO = 'Opciones de radio';

}
