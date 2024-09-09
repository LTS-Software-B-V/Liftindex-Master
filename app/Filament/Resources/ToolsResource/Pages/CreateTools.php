<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTools extends CreateRecord
{

    protected static ?string $title = 'Gereedschap - Toevoegen';
    protected static string $resource = ToolsResource::class;

    protected function getRedirectUrl(): string


    


    
{
return $this->getResource()::getUrl('index');
}

}


