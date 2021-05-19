@extends('layouts.app')

@section('title')
    Laporan Barang Berdasarkan Angkatan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <section class="py-8">
        <div class="container mx-auto px-4">

            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Laporan Barang Berdasarkan Angkatan</h3>
            <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola data barang dengan sebaik mungkin.</h6>

            <div class="py-4 flex flex-wrap items-center justify-center">
    
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg">
                    <a href="{{ route('cetak-laporan-barang-angkatan-vii') }}">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                          <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                          <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                        </svg>
                        <div class="relative pt-10 px-10 flex items-center justify-center">
                          <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                          <p class="relative w-40 text-white text-center text-6xl">VII</p>
                        </div>
                        <div class="relative text-white px-6 pb-6 mt-6"></div>
                    </a>
                </div>

                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-teal-500 rounded-lg max-w-xs shadow-lg">
                    <a href="{{ route('cetak-laporan-barang-angkatan-viii') }}">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                          <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                          <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                        </svg>
                        <div class="relative pt-10 px-10 flex items-center justify-center">
                          <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                          <p class="relative w-40 text-white text-center text-6xl">VIII</p>
                        </div>
                        <div class="relative text-white px-6 pb-6 mt-6"></div>
                    </a>
                </div>

                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-purple-500 rounded-lg max-w-xs shadow-lg">
                    <a href="{{ route('cetak-laporan-barang-angkatan-ix') }}">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                          <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                          <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                        </svg>
                        <div class="relative pt-10 px-10 flex items-center justify-center">
                          <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                          <p class="relative w-40 text-white text-center text-6xl">IX</p>
                        </div>
                        <div class="relative text-white px-6 pb-6 mt-6"></div>
                    </a>
                </div>
                
              </div>

        </div>
    </section>
@endsection