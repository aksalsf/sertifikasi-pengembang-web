<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Daftar Pendaftar';

    public function mount(): void
    {
        abort_unless(auth()->user()->isAdmin(), 403);
    }

    protected function getActions(): array
    {
        return [];
    }

    public function isTableSelectionEnabled(): bool
    {
        return false;
    }

    public function proceedRegistration($data)
    {
        $payload = collect($data);

        $user = User::find($payload->get('id'));
        $user->registration_status = $payload->get('registration_status');

        $user->save();

        return $this->notify('success', 'Berhasil mengubah status registrasi!');
    }
}
