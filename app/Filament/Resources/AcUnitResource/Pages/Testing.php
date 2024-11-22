<?php

namespace App\Filament\Resources\ACUnitResource\Pages;

use App\Filament\Resources\ACUnitResource;
use Filament\Resources\Pages\Page;

class Testing extends Page
{
    protected static string $resource = ACUnitResource::class;

    protected static string $view = 'filament.resources.a-c-unit-resource.pages.testing';
}
