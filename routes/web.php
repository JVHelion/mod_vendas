<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/mod_vendas/home');
});
