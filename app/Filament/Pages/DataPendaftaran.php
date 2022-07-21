<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;

class DataPendaftaran extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.data-pendaftaran';

    protected static function shouldRegisterNavigation(): bool
    {
        return !auth()->user()->isAdmin();
    }

    public function mount(): void
    {
        $this->user = User::find(auth()->user()->id);
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make([
                TextInput::make('name')
                    ->label('Nama')
                    ->default($this->user->name),
                TextInput::make('birthinfo')
                    ->label('TTL')
                    ->default($this->user->birthinfo),
                TextInput::make('address')
                    ->label('Alamat')
                    ->default($this->user->address),
                TextInput::make('phone')
                    ->label('Telp')
                    ->default($this->user->phone),
                TextInput::make('email')
                    ->label('Email')
                    ->default($this->user->email),
                TextInput::make('math')
                    ->label('Nilai Matematika')
                    ->default($this->user->math),
                TextInput::make('indonesian')
                    ->label('Nilai Bahasa Indonesia')
                    ->default($this->user->indonesian),
                TextInput::make('english')
                    ->label('Nilai Bahasa Inggris')
                    ->default($this->user->english),
                FileUpload::make('photo')
                    ->label('Foto')
                    ->default($this->user->photo)
                    ->directory('applications/pendaftaran'),

            ])
        ];
    }

    protected function getActions(): array
    {
        return [
            Action::make('Simpan')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $filepath = '';
        $file = head($this->photo);
        if (is_string($file)) {
            $filepath = $file;
        } else if (!$file) {
            $filepath = '';
        } else {
            $this->filename = $file->getClientOriginalName();
            $path = $file->store('public/pendaftaran');
            $filepath = str_replace('public/', '', $path);
        }

        User::find(auth()->user()->id)->update([
            'name' => $this->name,
            'birthinfo' => $this->birthinfo,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'math' => $this->math,
            'indonesian' => $this->indonesian,
            'english' => $this->english,
            'photo' => $filepath,
        ]);

        $this->notify('success', 'Berhasil mengubah data!');
    }
}
