<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectLocationResource\Pages;
use App\Filament\Resources\ObjectLocationResource\RelationManagers;
use App\Models\Customer;
use App\Models\ObjectLocation;
use App\Models\ObjectManagementCompany;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUp;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

//Models


//Filters

//Form

//Services

//Table


class ObjectLocationResource extends Resource
{
    protected static ?string $model = ObjectLocation::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = "Locaties";
    protected static ?string $navigationGroup = "Hoofdmenu";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([


                    Grid::make(4)->schema([
                        Forms\Components\TextInput::make("name")->label("Naam"),
                        Forms\Components\TextInput::make("Complexnumber")->label("complexnumber"),

                        Select::make('management_id')
                            ->searchable()
                            ->label('Beheerder')
                            ->options(ObjectManagementCompany::all()
                                ->pluck('name', 'id')),

                        Select::make('customer_id')
                            ->searchable()
                            ->label('Relatie')
                            ->options(Customer::all()
                                ->pluck('name', 'id')),


                    ]),


                    // ...
                ]),

                Forms\Components\Section::make("Locatie gegevens")
                    ->schema([
                        Grid::make(4)->schema([
                            Forms\Components\TextInput::make("zipcode")
                                ->label("Postcode")
                                ->maxLength(255)
                                ->suffixAction(
                                    Action::make("searchAddressByZipcode")
                                        ->icon("heroicon-m-magnifying-glass")
                                        ->action(function (Get $get, Set $set) {

                                            $set("place", $data?->settlement);
                                            $data = (new AddressService())->GetAddress(
                                                $get("zipcode"),
                                                $get("number")
                                            );
                                            $data = json_decode($data);

                                            if (isset($data->error_id)) {
                                                Notification::make()
                                                    ->warning()
                                                    ->title("Geen resultaten")
                                                    ->body(
                                                        "Helaas er zijn geen gegevens gevonden bij de postcode <b>" .
                                                        $get("zipcode") .
                                                        "</b> Controleer de postcode en probeer opnieuw."
                                                    )
                                                    ->send();
                                            } else {
                                                //dd($data);
                                                $set("place", $data?->municipality);
                                                $set("gps_lat", $data?->lat);
                                                $set("gps_lon", $data?->lng);
                                                $set("address", $data?->street);
                                                $set("municipality", $data?->municipality);
                                                $set("province", $data?->province);
                                                $set("place", $data?->settlement);
                                                $set("building_type", $data?->purposes[0]);
                                                $set("construction_year", $data?->constructionYear);
                                                $set("surface", $data?->surfaceArea);
                                            }
                                        })
                                ),


                            Forms\Components\TextInput::make("address")
                                ->label("Straatnaam")
                                ->columnSpan(2),

                            Forms\Components\TextInput::make(
                                "housenumber"
                            )->label("Huisnummer"),

                            Forms\Components\TextInput::make("place")->label(
                                "Plaats"
                            ),

                            Forms\Components\TextInput::make("province")->label(
                                "Provincie"
                            ),

                            Forms\Components\TextInput::make("gps_lat")
                                ->label("GPS latitude")
                                ->columnSpan(1),

                            Forms\Components\TextInput::make("gps_lon")
                                ->label("GPS longitude")
                                ->columnSpan(1),

                            // ...
                        ]),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Forms\Components\Section::make("Gebouwgegevens")
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make(
                                "construction_year"
                            )->label("Bouwjaar"),

                            Forms\Components\TextInput::make("levels")->label(
                                "Verdiepingen"
                            ),

                            Forms\Components\TextInput::make("surface")->label(
                                "Aantal m2"
                            ),

                            Forms\Components\TextInput::make("building_type")
                                ->label("Gebouwtype")
                                ->columnSpan(3),
                        ]),
                    ])
                    ->columnSpan(["lg" => 1]),
            ])
            ->columns(3);


        Section::make()
            ->schema([


                Textarea::make("remark")
                    ->rows(7)
                    ->label("Opmerking")
                    ->columnSpan(3)
                    ->autosize(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ///   ->groups([

//            Group::make('name')
//            ->label('Naam'),
//
//            Group::make('managementcompany.name')
//            ->label('Beheerder'),
//
//            Group::make('building_type',)
//            ->label('Gebouwtype'),
//
//            Group::make('place',)
//            ->label('Plaats'),
//
//
//
//
//        ])
//        ->defaultGroup('place')


            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->getStateUsing(function (ObjectLocation $record): ?string {


                        if ($record?->name) {
                            return $record?->name;
                        } else {
                            return $record->address . " - " . $record->zipcode . " dd" . $record->place;
                        }
                    })
                    ->searchable()
                    ->label('Adres')
                    ->description(function (ObjectLocation $record) {

                        if (!$record?->name) {
                            return $record?->name;
                        } else {
                            return $record->address . " - " . $record->zipcode . "  " . $record->place;
                        }


                    }
                    ),


                Tables\Columns\TextColumn::make('zipcode')
                    ->label('Postcode')->searchable()->hidden(true),

                Tables\Columns\TextColumn::make('place')
                    ->label('Plaats')->searchable()->hidden(true),


                TextColumn::make('objects_count')->counts('objects')->label('Aantal liften')->sortable()->badge()->alignment(Alignment::Center),

                // Tables\Columns\TextColumn::make("complex_number") ->sortable()
                // ->label("Complexnummer") ->placeholder('Geen complexnummer')   ->toggleable()
                // ->searchable(),


                // Tables\Columns\TextColumn::make("levels")
                // ->label("Verdiepingen") ->placeholder('Verdiepingen onbekend')   ->suffix(' verdieping')   ->toggleable(isToggledHiddenByDefault: true),


                // Tables\Columns\TextColumn::make("construction_year") ->sortable()
                // ->label("Bouwjaar") ->placeholder('Onbekend bouwjaar')
                // ->toggleable(isToggledHiddenByDefault: true)
                // ->prefix('Gebouw in ')   ->searchable(),


                Tables\Columns\TextColumn::make("customer.name")->sortable()
                    ->label("Relatie")->placeholder('Geen relatie gekoppeld')
                    ->searchable(),

                Tables\Columns\TextColumn::make("managementcompany.name")->sortable()
                    ->label("Beheerder")->placeholder('Geen beheer gekoppeld')
                    ->searchable(),

                Tables\Columns\TextColumn::make("building_type")->sortable()
                    ->label("Gebouwtype")
                    ->badge()
                    ->searchable()
                    ->placeholder('Onbekend'),
                // Tables\Columns\TextColumn::make('phonenumber')
                // ->label('Telefoonnummer')
                // ->searchable()
                // ->sortable(),


            ])
            ->filters(array(

                SelectFilter::make('customer_id')
                    ->options(Customer::all()->pluck('name', 'id'))->label('Relatie')
                    ->Searchable(),

                SelectFilter::make('building_type')
                    ->options(ObjectLocation::pluck('building_type', 'id')->groupby('building_type'))->label('Gebouwtype')
                    ->Searchable(),


                SelectFilter::make('management_id')->label('Beheerder')
                    ->relationship('managementcompany', 'name'),

                SelectFilter::make('place')
                    ->label('Plaats')
                    ->options(ObjectLocation::all()->pluck('place', 'place')->groupby('place'))
                    ->searchable()
            ,

//  SelectFilter::make('building_type')
//  ->label('Gebouwtype')
//  ->options(ObjectLocation::all()->pluck('building_type','building_type')->groupby('building_type'))
//  ->searchable(),


                Tables\Filters\TrashedFilter::make(),
            ))->filtersFormColumns(3)


            // layout: FiltersLayout::AboveContent
            ->actions([


                Tables\Actions\EditAction::make()
                    ->modalHeading("Wijzigen")
                    ->modalWidth(MaxWidth::SevenExtraLarge)
                    ->label('Wijzigen')


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    ExportBulkAction::make(),


                    //      Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\ObjectsRelationManager::class,
            RelationManagers\NotesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectLocations::route('/'),
            'edit' => Pages\EditObjectLocation::route('/{record}'),

        ];
    }


    public static function getModelLabel(): string
    {
        return "Locatie";
    }


    public static function getNavigationGroup(): ?string
    {
        return "Hoofdmenu";
    }
}
