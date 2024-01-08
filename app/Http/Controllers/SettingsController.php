<?php

namespace App\Http\Controllers;

use App\Models\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    final public function index(): View
    {
        return view('settings.index');
    }

    /**
     * @param GeneralSettings $settings
     * @param Request $request
     * @return RedirectResponse
     */
    final public function store(GeneralSettings $settings, Request $request): RedirectResponse
    {
        $settings->login_status = $request->boolean('login_status');
        $settings->login_close_message = $request->get('login_close_message');
        $settings->register_status = $request->boolean('register_status');
        $settings->register_close_message = $request->get('register_close_message');
        $settings->register_close_message = $request->get('register_close_message');
        $settings->title = $request->get('title');
        $settings->email = $request->get('email');

        $settings->who_us_description = $request->get('who_us_description');
        $settings->haokmny_advantages_description = $request->get('haokmny_advantages_description');
        $settings->partners_description = $request->get('partners_description');
        $settings->how_subscribe_description = $request->get('how_subscribe_description');
        $settings->contact_us_description = $request->get('contact_us_description');
        $settings->social_description = $request->get('social_description');
        $settings->site_phone = $request->get('site_phone');
        $settings->site_email = $request->get('site_email');
        $settings->site_location = $request->get('site_location');
        $settings->facebook_link = $request->get('facebook_link');
        $settings->tweeter_link = $request->get('tweeter_link');
        $settings->instagram_link = $request->get('instagram_link');
        $settings->linkedin_link = $request->get('linkedin_link');
        $settings->associations_title = $request->get('associations_title');
        $settings->associations_description = $request->get('associations_description');

        $settings->save();
        return back()->with(['flash' => 'تم حفظ تعديلات النظام بنجاح']);
    }
}
