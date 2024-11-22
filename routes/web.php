<?php

use App\Livewire\CreateUserReport;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/UserReport', CreateUserReport::class)->name('user.report');
