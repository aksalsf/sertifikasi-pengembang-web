<form wire:submit.prevent="authenticate" class="space-y-8">
    {{ $this->form }}

    <x-filament::button type="submit" form="authenticate" class="w-full">
        {{ __('filament::login.buttons.submit.label') }}
    </x-filament::button>
    <a href="{{ route('register') }}" rel="noopener noreferrer" style="display:block; margin-top: 24px; font-weight: bold;text-align: center">
        Buat Akun
    </a>
</form>
