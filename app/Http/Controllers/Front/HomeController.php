<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SiteDynamicSettings;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $advantages=SiteDynamicSettings::where('type', SiteDynamicSettings::HOKMNY_ADVANTAGES)->active()->get();
        $mainSliders=SiteDynamicSettings::where('type', SiteDynamicSettings::SLIDER1)->active()->get();
        $partners=SiteDynamicSettings::where('type', SiteDynamicSettings::PARTNERS)->active()->get();
        $associations=User::approved()->featured()
            ->whereNotNull('logo')
            ->select('logo')
            ->get();

        return view('front.home', compact('associations','advantages', 'partners','mainSliders'));
    }
}
