@extends('layouts.scan-qrcode')

@section('title')
    Scan QR Code {{ $ruangan->nama_ruangan }} - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
{{-- START: Content --}}
<div class="container mx-auto px-6 my-8">
  <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Barang {{ $ruangan->nama_ruangan }}</h3>
  <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>

  <hr class="my-4 border-gray-600"/>

  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
    @foreach ($barang as $item)
      <div class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden bg-white dark:bg-gray-800">
        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: 
          @if($item->image_url != null) 
            url('{{ asset('storage/unggah/Barang/' . $ruangan->nama_ruangan . '/' . $item->image_url) }}') 
          @else
            url('{{ asset('img/404.png') }}')
          @endif
        ">
        </div>
        <div class="px-5 py-3">
          <h3 class="text-gray-700 dark:text-white uppercase">{{ $item->nama_barang }}</h3>
          <span class="text-gray-500 mt-2">{{ $item->merek }} <br/> {{ $item->jumlah }} {{ $item->satuan }} - 
            @if($item->kondisi == "Baik")
                <span
                class="px-2 py-1 leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                >
                    {{ $item->kondisi }}
                </span>
                @elseif($item->kondisi == "Rusak Ringan")
                <span
                class="px-2 py-1 leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100"
                >
                    {{ $item->kondisi }}
                </span>
                @elseif($item->kondisi == "Rusak Berat")
                <span
                class="px-2 py-1 leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"
                >
                    {{ $item->kondisi }}
                </span>
              @endif
          </span>
        </div>
      </div>
    @endforeach
  </div>

  @if($barang == null)
  <div class="flex flex-col items-center justify-center">
    <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-96 h-96">
    <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
  </div>
  @endif

</div>
{{-- END: Content --}}
@endsection
