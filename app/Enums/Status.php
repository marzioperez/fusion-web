<?php

namespace App\Enums;

enum Status: string {

    case PUBLISHED = 'Published';
    case DRAFT = 'Draft';
    case PENDING = 'Pending';
    case SCHEDULED = 'Scheduled';
    case FINISHED = 'Finished';
    case ERROR = 'Error';
    case CONFIRMED = 'Confirmed';
    case CANCELED = 'Canceled';
    case QUEUED = 'Queued';

}
