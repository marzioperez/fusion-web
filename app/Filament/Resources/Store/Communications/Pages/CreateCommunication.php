<?php

namespace App\Filament\Resources\Store\Communications\Pages;

use App\Filament\Resources\Store\Communications\CommunicationResource;
use App\Jobs\ProcessCommunication;
use Filament\Resources\Pages\CreateRecord;

class CreateCommunication extends CreateRecord {

    protected static string $resource = CommunicationResource::class;

    protected function afterCreate():void {
        ProcessCommunication::dispatch($this->record->id);
    }

}
