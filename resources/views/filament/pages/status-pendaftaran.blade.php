<x-filament::page>
    @php
        $user_id = auth()->user()->id;
        $status = DB::table('users')->where('id', $user_id)->value('registration_status');
        function getStatus($status) {
            switch ($status) {
                case 'approved':
                    return 'Diterima';
                case 'backup':
                    return 'Cadangan';
                case 'rejected':
                    return 'Ditolak';
                default:
                    return 'Sedang Diproses';
            }
        }
    @endphp
    <div>
        Status Pendaftaran Anda: <strong>{{ getStatus($status) }}</strong>
    </div>
</x-filament::page>
