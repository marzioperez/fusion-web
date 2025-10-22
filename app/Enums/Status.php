<?php

namespace App\Enums;

enum Status: string {

    case PUBLISHED = 'Publicado';
    case DRAFT = 'Borrador';
    case PENDING = 'Pendiente';
    case SCHEDULED = 'Programado';

}
