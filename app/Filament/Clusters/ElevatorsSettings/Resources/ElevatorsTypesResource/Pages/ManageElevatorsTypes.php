<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageElevatorsTypes extends ManageRecords
{
    protected static string $resource = ElevatorsTypesResource::class;
    protected static ?string $title = 'Objecten - Types';

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
    
            Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
