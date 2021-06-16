@extends('layouts.app')

@section('title')
    QR Code - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container px-6 mx-auto py-8">
    <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">QR Code {{ $ruangan->nama_ruangan }}</h3>
    <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Scan QR Code untuk melihat barang apa saja yang ada di dalam kelas.</h6>

    <div class="flex flex-col justify-center items-center mt-16 space-y-10">
        <div class="visible-print text-center">
            {!! QrCode::size(300)->generate('http://192.168.0.5:8888/si-sarpras-v1/public/scan-qrcode/'.$ruangan->id); !!}
        </div>

        <a
            href="{{ route('print-qrcode', $ruangan->id) }}"
            target="_blank"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-400 border border-transparent rounded-lg active:bg-indigo-500 hover:bg-indigo-500 focus:outline-none"
            >
                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak</span>
        </a>
    </div>
</div>
@endsection