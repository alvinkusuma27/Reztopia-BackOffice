<?php

use Illuminate\Support\Facades\Facade;

return [
    'providers' => [
        RealRashid\SweetAlert\SweetAlertServiceProvider::class,
        \Torann\GeoIP\GeoIPServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,

    ],

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
        'Alert' => RealRashid\SweetAlert\Facades\Alert::class,
        'GeoIP' => \Torann\GeoIP\Facades\GeoIP::class,
        'PDF' => Barryvdh\DomPDF\Facade::class,
    ])->toArray(),
];
