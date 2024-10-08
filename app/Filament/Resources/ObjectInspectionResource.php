<?php

namespace App\Filament\Resources;

use App\Enums\InspectionStatus;
use App\Filament\Resources\ObjectInspectionResource\Pages;
use App\Filament\Resources\ObjectInspectionResource\RelationManagers;
use App\Models\ObjectInspection;
use App\Models\ObjectLocation;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Actions\Exports\ExportColumn;
use Illuminate\Contracts\View\View;
class ObjectInspectionResource extends Resource
{
    protected static ?string $model = ObjectInspection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table


            ->groups([
                Group::make('status_id')
                    ->label('Status'),

                Group::make('elevator.location_id')
                    ->label('Locatie'),

                Group::make('elevator.location.customer.id')
                    ->label('Relatie'),

                Group::make('elevator.maintenance_company_id')
                    ->label('Onderhoudspartij'),

            ])

            ->columns([




                    Tables\Columns\TextColumn::make("elevator.nobo_no")
                        ->label("Object")
                        ->sortable()->wrap(),


                    Tables\Columns\TextColumn::make('elevator.location')
                    ->label('Adres')
                    ->searchable()
                    ->sortable()->wrap()

                    ->getStateUsing(function (ObjectInspection $record): ?string {

                        return $record->elevator->location->address;
                    })

                    ->description(function (ObjectInspection $record): ?string {


                            return $record->elevator->location->zipcode . " - " . $record->elevator->location->place;


                    })
                ,


                Tables\Columns\TextColumn::make("executed_datetime")
                    ->dateTime("d-m-Y")
                    ->label("Begindatum")
                 ,

                Tables\Columns\TextColumn::make("end_date")
                    ->dateTime("d-m-Y")
                    ->label("Einddatum")
                    ->sortable(),

                Tables\Columns\TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),



                    Tables\Columns\TextColumn::make('itemdata_count')->counts('itemdata')
                        ->label("Aantal punten")  ->alignment('center')->badge(),

                Tables\Columns\TextColumn::make("inspectioncompany.name")
                    ->label("Onderhoudspartij")

                    ->sortable(),

//                Tables\Columns\TextColumn::make("remark")
//                    ->label("Opmerking")
//                    ->sortable(),

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->badge()
                    ->sortable(),


//                Panel::make([
//                    Split::make([
//                        Tables\Columns\TextColumn::make('itemdata.zin_code')
//                            ->label('Code') ,
//
//                        Tables\Columns\TextColumn::make('itemdata.comment')
//                            ->label("Opmerking"),
//
//                        Tables\Columns\TextColumn::make('itemdata.Type')
//                            ->label("Type")->badge(),
//
//                        Tables\Columns\TextColumn::make('itemdata.status')
//                            ->label("Status")->badge(),
//                    ])
//                ])->collapsible()


            ])


            ->filters([

//                SelectFilter::make('inspection_company_id')
//                    ->relationship('InspectionCompany', 'name')
//                    ->label("Onderhoudspartij"),

                SelectFilter::make('status_id')
                    ->options(InspectionStatus::class)
                    ->label("Status"),

//                SelectFilter::make('elevator.location.customer_id')
//                    ->label('Relatie')
//                    ->options(Customer::pluck("name", "id")),
//
//                SelectFilter::make('elevator.location.management_id')
//                    ->label('Beheerder')
//                    ->options(Customer::pluck("name", "id")),
//
//                SelectFilter::make('status_id')
//                    ->options(InspectionStatus::class)
//                    ->label("Status"),
//
//
//                SelectFilter::make('status_id')
//                    ->options(InspectionStatus::class)
//                    ->label("Status"),


            ])->filtersFormColumns(2)
            ->actions([

                Tables\Actions\Action::make('itemdata')
                   ->action(fn (ObjectInspection $record) => $record->itemdata())
                    ->label('Bekijk acties')

                    ->modalContent(fn (ObjectInspection $record): View => view(
                        'components.modals.inspection-data-modal',
                        ['record' => $record->itemdata]
                    ))
     ->hidden(fn (ObjectInspection $record): bool => count($record->itemdata) <= 1),

               // Tables\Actions\EditAction::make()->label("Bekijk punten")
               ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                  //  ExportBulkAction::make(),
                ]),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectInspections::route('/'),
            'create' => Pages\CreateObjectInspection::route('/create'),
            'edit' => Pages\EditObjectInspection::route('/{record}/edit'),
        ];
    }
}
