<?php

namespace App\Filament\Clusters\ToolsSettings\Resources;

use App\Filament\Clusters\ToolsSettings;
use App\Filament\Clusters\ToolsSettings\Resources\ToolsTypesResource\Pages;
use App\Filament\Clusters\ToolsSettings\Resources\ToolsTypesResource\RelationManagers;
use App\Models\toolsType;
use App\Models\toolsBrand;
use App\Models\toolsCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\MaxWidth;






class ToolsTypesResource extends Resource
{
    protected static ?string $model = toolsType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Types';


    protected static ?string $cluster = ToolsSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                      Forms\Components\TextInput::make('name')
                ->label('Modelnaam')
                ->columnSpan('full') 
                ->required(),



                Select::make('brand_id')
                ->label('Merk')
              
                ->loadingMessage('Merken laden...')
                ->relationship(name: 'brand', titleAttribute: 'name')
               // ->searchable()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required(),
             
                ]),
                
 

Select::make('category_id')
->label('Categorie')
                
->relationship(name: 'category', titleAttribute: 'name')
->loadingMessage('Categorieën laden...')
->createOptionForm([
    Forms\Components\TextInput::make('name')
        ->required(),

]),


 
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                
                ImageColumn::make('brand.image')->label('')  
                ->width(100),



                TextColumn::make('name')  ->sortable()
                ->label('Modelnaam')         ->searchable(),

                TextColumn::make('category.name')  ->sortable()
                ->label('Categorie')         ->searchable(),


   

                
                TextColumn::make('brand.name')  ->sortable()
                ->label('Merk')         ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Wijzigen')->modalWidth(MaxWidth::FiveExtraLarge),
                Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen'),
      
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
               //     Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijder geselecteerde rijen')
         
                ]),
            ])  ->emptyState(view('partials.empty-state')) ;
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageToolsTypes::route('/'),
        ];
    }
}
