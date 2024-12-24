<?php

use BinaryTorch\LaRecipe\LaRecipe;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route("filament.admin.auth.login"));
});

Route::get('/customers/{id}/anamnese')
