@extends('layouts.app')

@section('title')
    Laporan Barang Berdasarkan Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <section class="py-8">
        <div class="container mx-auto px-4">

            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Laporan Barang Berdasarkan Ruangan</h3>
            <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola data barang dengan sebaik mungkin.</h6>

            <div class="flex flex-wrap justify-center">

                @foreach ($ruangan as $item)
                    <div class="md:w-1/2 lg:w-1/3 py-4 px-4" >
                        <div>
                            <a href="{{ route('cetak-laporan-barang-peruangan', $item->id) }}">
                                <div class="bg-white relative shadow p-2 rounded-lg text-gray-800 hover:shadow-lg">
                                    @if($item->image_url != null)
                                        <img src="{{ asset('storage/unggah/Ruangan/'.$item->image_url) }}" class="h-56 rounded-lg w-full object-cover">
                                    @else
                                        <img src="{{ asset('img/404.png') }}" class="h-56 rounded-lg w-full object-cover">
                                    @endif
                                    <div class="py-2 px-2">
                                        <div class=" font-bold font-title text-center">{{ $item->nama_ruangan }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
    
            </div>

            {{ $ruangan->links() }}

            @if($ruangan->count() < 1)
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-96 h-96">
                    <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
                </div>
            @endif

        </div>
    </section>
@endsection