<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// SWITCH LANG

Route::get('lang/{locale}', function (string $locale) {
    $supported = array_keys(config('app.available_locales', []));

    if (!in_array($locale, $supported, true)) {
        $locale = config('app.locale');
    }

    App::setLocale($locale);
    Session::put('locale', $locale);

    return redirect()->back();
})->name('lang.switch');
