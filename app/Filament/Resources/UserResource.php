<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                    ->label('Nama'),
                    TextInput::make('birthinfo')
                        ->label('TTL'),
                    TextInput::make('address')
                        ->label('Alamat'),
                    TextInput::make('phone')
                        ->label('Telp'),
                    TextInput::make('email')
                        ->label('Email'),
                    TextInput::make('math')
                        ->label('Nilai Matematika'),
                    TextInput::make('indonesian')
                        ->label('Nilai Bahasa Indonesia'),
                    TextInput::make('english')
                        ->label('Nilai Bahasa Inggris'),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama'),
                TextColumn::make('birthinfo')
                    ->label('TTL'),
                TextColumn::make('address')
                    ->label('Alamat'),
                TextColumn::make('phone')
                    ->label('Telp'),
                TextColumn::make('email')
                    ->label('Email'),
                BadgeColumn::make('math')
                    ->label('Nilai Matematika')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('indonesian')
                    ->label('Nilai Bahasa Indonesia')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('english')
                    ->label('Nilai Bahasa Inggris')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('total_gpa')
                    ->label('Total Nilai')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('registration_status')
                    ->label('Status Pendaftaran')
                    ->colors([
                        'primary',
                        'warning' => 'backup',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(function ($state) {
                        switch ($state) {
                            case 'approved':
                                return 'Diterima';
                            case 'backup':
                                return 'Cadangan';
                            case 'rejected':
                                return 'Ditolak';
                            default:
                                return 'Menunggu';
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Lihat')
                    ->icon(''),
                Tables\Actions\Action::make('Proses')
                    ->modalWidth('sm')
                    ->modalHeading('Proses Pendaftaran')
                    ->modalSubheading(null)
                    ->modalButton('Simpan')
                    ->form([
                        Hidden::make('id')
                            ->default(fn ($record) => $record->id),
                        Select::make('registration_status')
                            ->label('Ganti Status Pendaftaran')
                            ->options([
                                'approved' => 'Terima',
                                'backup' => 'Cadangkan',
                                'rejected' => 'Tolak',
                                'pending' => 'Menunggu',
                            ])
                            ->searchable()
                            ->default(fn ($record) => $record->registration_status),
                    ])
                    ->action('proceedRegistration'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit')
        ];
    }
}
