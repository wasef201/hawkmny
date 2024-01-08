<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $logo;
    public ?string $nav_logo;
    public string $title;
    public ?string $email;
    public bool $login_status;
    public ?string $login_close_message;
    public bool $register_status;
    public ?string $register_close_message;

    public ?string $who_us_description;
    public ?string $haokmny_advantages_description;


    public ?string $partners_description;
    public ?string $how_subscribe_description;
    public ?string $contact_us_description;
    public ?string $social_description;
    public ?string $site_phone;
    public ?string $site_email;
    public ?string $site_location;
    public ?string $facebook_link;
    public ?string $tweeter_link;
    public ?string $instagram_link;
    public ?string $linkedin_link;
    public ?string $associations_description;
    public ?string $associations_title;


    public static function group(): string
    {
       return 'general';
    }
}
