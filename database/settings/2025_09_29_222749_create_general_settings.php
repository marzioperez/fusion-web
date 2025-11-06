<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void {
        $this->migrator->add('general.logo', null);
        $this->migrator->add('general.logo_mail', null);
        $this->migrator->add('general.logo_footer', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.instagram', 'https://www.instagram.com/fusionschoollunches/');
        $this->migrator->add('general.youtube', 'https://www.youtube.com/');
        $this->migrator->add('general.linkedin', 'https://www.linkedin.com/');
        $this->migrator->add('general.tiktok', 'https://www.tiktok.com/');
        $this->migrator->add('general.facebook', 'https://www.facebook.com/');
        $this->migrator->add('general.twitter_x', 'https://www.x.com/');
        $this->migrator->add('general.whatsapp', null);

        $this->migrator->add('general.address', '458 SE 185th Ave Portland OR 97233');
        $this->migrator->add('general.phone', '(833) 415-8326');
        $this->migrator->add('general.email', 'contact@fusionportland.com');
        $this->migrator->add('general.avatars', null);

        $this->migrator->add('general.units', [
            'miligramos', 'gramos', 'kilogramos', 'mililitros', 'litros', 'libras', 'onzas', 'unidades', 'docenas'
        ]);
    }
};
