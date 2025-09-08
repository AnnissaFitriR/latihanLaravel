<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nama', function () {
    return "Hallo, nama saya Annissa!";
});
