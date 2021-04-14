@extends('layouts.print-qrcode')

@section('title')
    Print QR Code - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="h-screen flex flex-col items-center justify-center space-y-16">
    <h3 class="text-5xl font-medium text-center">QR Code {{ $ruangan->nama_ruangan }}</h3>

    <div class="visible-print text-center">
        {!! QrCode::size(300)->generate('http://192.168.100.59:8888/si-sarpras-v1/public/scan-qrcode/'.$ruangan->id); !!}
    </div>

    <h6 class="text-center text-base text-gray-600">Scan QR Code untuk melihat barang apa saja yang ada di dalam kelas.</h6>
</div>
@endsection

@push('after-script')
    <script>
        window.print();
    </script>
@endpush