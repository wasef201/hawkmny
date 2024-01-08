<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.logo', null);
        $this->migrator->add('general.nav_logo', null);
        $this->migrator->add('general.title', 'حوكمني');
        $this->migrator->add('general.email', null);
        $this->migrator->add('general.login_status', true);
        $this->migrator->add('general.login_close_message', 'عفوا عملية تسجيل الدخلو غير متاحة حاليا برجاء المحاولة في وقت لاحق');
        $this->migrator->add('general.register_status', true);
        $this->migrator->add('general.register_close_message', 'عفوا عملية تسجيل الدخلو غير متاحة حاليا برجاء المحاولة في وقت لاحق');
    }
}
