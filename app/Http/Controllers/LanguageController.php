<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;

class LanguageController extends Controller
{
    public function setLocale($locale = 'nl')
    {
        if (!in_array($locale, ['nl', 'en'])) {
            $locale = 'nl';
        }
        Session::put('locale', $locale);
        return redirect(url(URL::previous()));
    }
}
