<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StatusPendaftaran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.status-pendaftaran';

    public function mount(): void
    {
        abort_unless(!auth()->user()->isAdmin(), 403);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return !auth()->user()->isAdmin();
    }
}
