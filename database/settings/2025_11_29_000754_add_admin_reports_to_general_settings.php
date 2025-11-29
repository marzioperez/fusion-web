<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration  {

    public function up(): void {
        $this->migrator->add('general.send_admin_reports', ['contact@fusionportland.com']);
    }
};
