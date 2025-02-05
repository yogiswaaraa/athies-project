<?php

use App\Livewire\CreateUserReport;
use Illuminate\Support\Facades\Route;
use App\Livewire\PublicFormRiwayatPerawatan;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form-riwayat', PublicFormRiwayatPerawatan::class)->name('form.riwayat.public');
Route::get('/UserReport', CreateUserReport::class);
