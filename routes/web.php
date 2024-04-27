<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

