@extends('layouts.app')

@section('title')
    Data Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
{{-- START: Content --}}
<div class="container mx-auto px-6 my-8">
  <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Data Ruangan</h3>
  <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola data ruangan dengan sebaik mungkin.</h6>

  <hr class="my-4 border-gray-600"/>

  <form action="{{ route('kelola-ruangan') }}" method="GET">
    <div class="flex justify-center mx-auto flex-1">
        <div
            class="relative w-full max-w-xl focus-within:text-purple-500"
        >
            <div class="absolute inset-y-0 flex items-center pl-2">
            <svg
                class="w-4 h-4"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"
                ></path>
            </svg>
            </div>
            <input
            name="cari" id="cari"
            class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            type="text"
            placeholder="Cari berdasarkan nama atau kode ruangan"
            aria-label="Cari"
            />
        </div>

        <div class="flex justify-start ml-3">
            <a
            href="{{ route('kelola-ruangan') }}"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-cool-gray-400 transition-colors duration-150 bg-transparent border border-cool-gray-400 rounded-lg hover:border-cool-gray-500 hover:text-cool-gray-500 focus:outline-none"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Refresh</span>
            </a>
        </div>
    </div>
  </form>

  <hr class="mt-4 border-gray-600"/>

  <div class="mt-4">
    @if(auth()->user()->role == 1)
    {{-- START: Tombol medium screen --}}
    <div class="hidden md:flex flex-row items-center justify-between">
      <div class="flex flex-row space-x-2">
        <a
          href="{{ route('tambah-ruangan') }}"
          class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg hover:bg-blue-500 focus:outline-none"
          >
            <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Tambah</span>
        </a>
  
        <a href="#" class="semuaRuanganDelete flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
          <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          <span>Hapus Semua</span>
        </a>
      </div>

      <div class="flex flex-row justify-end">
        <a href="{{ route('tong-sampah-ruangan') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
          <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          <span>Sampah</span>
        </a>
      </div>
    </div>
    {{-- END: Tombol medium screen --}}

    {{-- START: Tombol mobile screen --}}
    <div class="flex md:hidden flex-row items-end justify-between">
      <div class="flex flex-col space-y-2">
        <a
          href="{{ route('tambah-ruangan') }}"
          class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg hover:bg-blue-500 focus:outline-none"
          >
            <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Tambah</span>
        </a>
    
        <a href="#" class="semuaRuanganDelete flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
          <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          <span>Hapus Semua</span>
        </a>
      </div>

      <div class="flex flex-row">
        <a href="{{ route('tong-sampah-ruangan') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
          <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          <span>Sampah</span>
        </a>
      </div>
    </div>
    {{-- END: Tombol mobile screen --}}
    @endif
  </div>

  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6 mb-2">
    @foreach ($ruangan as $item)
      <div class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden bg-white dark:bg-gray-800">
        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: 
          @if($item->image_url != null) 
            url('{{ asset('storage/unggah/Ruangan/' . $item->image_url) }}') 
          @else
            url('{{ asset('img/404.png') }}')
          @endif
        ">
          @if(auth()->user()->role == 1)
          <button class="ruanganDelete p-2 rounded-full mx-5 -mb-4 focus:outline-none text-red-500 bg-red-100 dark:text-red-100 dark:bg-red-500" ruangan-id="{{ $item->id }}" ruangan-nama="{{ $item->nama_ruangan }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
          @endif
        </div>
        @if(auth()->user()->role == 1)
        <a href="{{ route('edit-ruangan', $item->id) }}">
          <div class="px-5 py-3">
            <h3 class="text-gray-700 dark:text-white">{{ $item->nama_ruangan }}</h3>
            <span class="text-gray-500 mt-2">{{ $item->kode_ruangan }}</span>
          </div>
        </a>
        @elseif(auth()->user()->role == 0)
        <div class="px-5 py-3">
          <h3 class="text-gray-700 dark:text-white">{{ $item->nama_ruangan }}</h3>
          <span class="text-gray-500 mt-2">{{ $item->kode_ruangan }}</span>
        </div>
        @endif
      </div>
    @endforeach
  </div>

  @if(!request()->has('cari'))
    {{ $ruangan->links() }}
  @endif

  @if($ruangan->count() < 1)
  <div class="flex flex-col items-center justify-center">
    <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-96 h-96">
    <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
  </div>
  @endif
  
</div>
{{-- END: Content --}}
@endsection

@push('after-script')
  {{-- START: Delete --}}
  <script>
    $('.ruanganDelete').click(function(){
      var ruanganId = $(this).attr('ruangan-id');
      var ruanganNama = $(this).attr('ruangan-nama');
      swal({
        title: "Hapus Ruangan",
        text: "Apakah anda yakin ingin menghapus "+ruanganNama+" ?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-ruangan/"+ruanganId+"";
        } else {
          swal(""+ruanganNama+" tidak jadi dihapus.");
        }
      });
    });

    $('.semuaRuanganDelete').click(function(){
      swal({
        title: "Hapus Semua Ruangan",
        text: "Apakah anda yakin ingin menghapus semua ruangan ?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-semua-ruangan";
        } else {
          swal("Semua ruangan tidak jadi dihapus.");
        }
      });
    });
  </script>
  {{-- END: Delete --}}
@endpush