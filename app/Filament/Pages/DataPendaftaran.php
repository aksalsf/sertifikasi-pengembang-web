<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
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
                    ->required()
                    ->default($this->user->name),
                TextInput::make('birthinfo')
                    ->label('Tempat Lahir')
                    ->required()
                    ->default($this->user->birthinfo),
                DatePicker::make('birthdate')
                    ->label('Tanggal Lahir')
                    ->required()
                    ->default($this->user->birthdate),
                TextInput::make('address')
                    ->label('Alamat')
                    ->required()
                    ->default($this->user->address),
                TextInput::make('phone')
                    ->label('Telp')
                    ->required()
                    ->default($this->user->phone),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->default($this->user->email)
                    ->disabled(),
                TextInput::make('math')
                    ->label('Nilai Matematika')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->required()
                    ->default($this->user->math),
                TextInput::make('indonesian')
                    ->label('Nilai Bahasa Indonesia')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->required()
                    ->default($this->user->indonesian),
                TextInput::make('english')
                    ->label('Nilai Bahasa Inggris')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->required()
                    ->default($this->user->english),
                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->required()
                    ->default($this->user->photo)
                    ->enableDownload(),
                FileUpload::make('report_attachment')
                    ->label('Lampiran Rapor')
                    ->required()
                    ->acceptedFileTypes(['application/pdf'])
                    ->default($this->user->report_attachment)
                    ->enableDownload(),
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

    protected function uploadFile($file)
    {
        $filepath = '';
        $file = head($file);
        if (is_string($file)) {
            $filepath = $file;
        } else if (!$file) {
            $filepath = '';
        } else {
            $this->filename = $file->getClientOriginalName();
            $path = $file->store('public/');
            $filepath = str_replace('public/', '', $path);
        }
        return $filepath;
    }

    public function save(): void
    {
        $this->validate();

        $photo = $this->uploadFile($this->photo);
        $report_attachment = $this->uploadFile($this->report_attachment);
        $rata_rata = round(($this->math + $this->indonesian + $this->english) / 3, 2);

        User::find(auth()->user()->id)->update([
            'name' => $this->name,
            'birthinfo' => $this->birthinfo,
            'birthdate' => $this->birthdate,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'math' => $this->math,
            'indonesian' => $this->indonesian,
            'english' => $this->english,
            'total_gpa' => $rata_rata,
            'photo' => $photo,
            'report_attachment' => $report_attachment,
        ]);

        $this->notify('success', 'Berhasil mengubah data!');
    }
}
