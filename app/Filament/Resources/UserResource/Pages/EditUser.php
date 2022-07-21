<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Detail Pendaftar';

    public function mount($record): void
    {
        abort_unless(auth()->user()->isAdmin(), 403);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(function () {
                    return auth()->user()->isAdmin();
                }),
        ];
    }
}
