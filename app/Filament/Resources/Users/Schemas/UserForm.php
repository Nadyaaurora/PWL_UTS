<?php

namespace App\Filament\Resources\Users\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('level_id')
                    ->label('Level')
                    ->relationship('level', 'level_nama')
                    ->required(),
                TextInput::make('username')
                    ->label('Username')
                    ->maxLength(20)
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama')
                    ->maxLength(100)
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->maxLength(255)
                    ->password()
                    ->required(),
            ]);
    }
}
