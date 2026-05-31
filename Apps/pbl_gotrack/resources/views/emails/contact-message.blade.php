@component('mail::message')
# Halo Deenhag,

Ada pesan baru dari halaman kontak website Anda. Berikut adalah rinciannya:

**Nama Pengirim:** {{ $data['nama'] }}  
**Email Pengirim:** {{ $data['email'] }}

**Pesan:**  
{{ $data['pesan'] }}

@component('mail::button', ['url' => 'mailto:' . $data['email']])
Balas Email
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
