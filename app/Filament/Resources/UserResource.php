<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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
                        ->label('Nama')
                        ->disabled(),
                    TextInput::make('birthinfo')
                        ->label('Tempat Lahir')
                        ->disabled(),
                    DatePicker::make('birthdate')
                        ->label('Tanggal Lahir')
                        ->disabled(),
                    TextInput::make('address')
                        ->label('Alamat')
                        ->disabled(),
                    TextInput::make('phone')
                        ->label('Telp')
                        ->disabled(),
                    TextInput::make('email')
                        ->label('Email')
                        ->disabled(),
                    TextInput::make('math')
                        ->label('Nilai Matematika')
                        ->disabled(),
                    TextInput::make('indonesian')
                        ->label('Nilai Bahasa Indonesia')
                        ->disabled(),
                    TextInput::make('english')
                        ->label('Nilai Bahasa Inggris')
                        ->disabled(),
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->required()
                        ->enableDownload()
                        ->disabled(),
                    FileUpload::make('report_attachment')
                        ->label('Laporan')
                        ->required()
                        ->acceptedFileTypes(['application/pdf'])
                        ->enableDownload()
                        ->disabled(),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama'),
                BadgeColumn::make('math')
                    ->label('Matematika')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('indonesian')
                    ->label('Bahasa Indonesia')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('english')
                    ->label('Bahasa Inggris')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ]),
                BadgeColumn::make('total_gpa')
                    ->label('Rata-rata')
                    ->colors([
                        'danger',
                        'warning' => fn($state): bool => $state >= 70,
                        'success' => fn($state): bool => $state >= 80,
                    ])
                    ->sortable(),
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
