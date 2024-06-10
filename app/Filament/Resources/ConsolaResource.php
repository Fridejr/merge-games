<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsolaResource\Pages;
use App\Filament\Resources\ConsolaResource\RelationManagers;
use App\Models\Consola;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsolaResource extends Resource
{
    protected static ?string $model = Consola::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
                Forms\Components\TextInput::make('descripcion')
                    ->label('Descripción')
                    ->required(),     
                Forms\Components\TextInput::make('ruta_imagen')
                    ->label('Ruta de la imagen')
                    ->required(),
                
                Forms\Components\TextInput::make('money')
                    ->label('Dinero generado por 3s')
                    ->required(),                                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('descripcion'),
                Tables\Columns\TextColumn::make('ruta_imagen'),
                Tables\Columns\TextColumn::make('money'),
                Tables\Columns\TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListConsolas::route('/'),
            'create' => Pages\CreateConsola::route('/create'),
            'edit' => Pages\EditConsola::route('/{record}/edit'),
        ];
    }
}
