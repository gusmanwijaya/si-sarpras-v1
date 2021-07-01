@extends('layouts.app')

@section('title')
    Data Kategori Barang - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto py-8 md:px-14 px-5">
    <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Data Kategori Barang</h3>
    <h6 class="mt-1 mb-8 text-center text-xs text-gray-600">Kelola data kategori barang dengan sebaik mungkin.</h6>
    
    <hr class="my-4 border-gray-600"/>

    <form action="{{ route('kelola-kategori-barang') }}" method="GET">
        <div class="flex justify-center mx-auto flex-1">
            <div class="relative w-full max-w-xl focus-within:text-purple-500">
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                      ></path>
                  </svg>
                </div>
                  <input name="cari" id="cari" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Cari berdasarkan kategori" aria-label="Cari"/>
            </div>

            <div class="flex justify-start ml-3">
                <a
                href="{{ route('kelola-kategori-barang') }}"
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

    <hr class="my-4 border-gray-600"/>

    <div class="my-4">
        @if(auth()->user()->role == 1)
        {{-- START: Tombol medium screen --}}
        <div class="hidden md:flex flex-row items-center justify-between">
          <div class="flex flex-row space-x-2">
            <a
              href="{{ route('tambah-kategori-barang') }}"
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg hover:bg-blue-500 focus:outline-none"
              >
                <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Tambah</span>
            </a>
      
            <a href="#" class="deleteSemuaKategoriBarang flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
              <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
              <span>Hapus Semua</span>
            </a>
          </div>
    
          <div class="flex flex-row justify-end">
            <a href="{{ route('tong-sampah-kategori-barang') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
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
              href="{{ route('tambah-kategori-barang') }}"
              class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg hover:bg-blue-500 focus:outline-none"
              >
                <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Tambah</span>
            </a>
        
            <a href="#" class="deleteSemuaKategoriBarang flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
              <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
              <span>Hapus Semua</span>
            </a>
          </div>
    
          <div class="flex flex-row">
            <a href="{{ route('tong-sampah-kategori-barang') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
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

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap table-auto mb-2">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($dataKategori as $kategori)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $kategori->kategori }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <a
                            href="{{ route('edit-kategori-barang', $kategori->id) }}"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                            >
                                <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                >
                                    <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                    ></path>
                                </svg>
                            </a>

                            <a
                            href="#"
                            class="deleteKategoriBarang flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" kategori-id="{{ $kategori->id }}" kategori-nama="{{ $kategori->kategori }}"
                            aria-label="Delete"
                            >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                                ></path>
                            </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            @if (!request()->has('cari'))
              {{ $dataKategori->links() }}
            @endif

            @if($dataKategori->count() < 1)
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-auto h-auto md:w-96 md:h-96">
                <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
            </div>
            @endif
        </div>
    </div>
    
</div>
@endsection

@push('after-script')
<script>
  $('.deleteKategoriBarang').click(function(){
    var kategoriId = $(this).attr('kategori-id');
    var kategoriNama = $(this).attr('kategori-nama');
    swal({
      title: "Hapus Kategori Barang",
      text: "Apakah anda yakin ingin menghapus "+kategoriNama+" ?",
      icon: "warning",
      buttons: ["Jangan Hapus", "Hapus"],
      dangerMode: true,
      closeOnClickOutside: false,
    }).then((willDelete) => {
      if (willDelete) {
        window.location = "/destroy-kategori-barang/"+kategoriId+"";
      } else {
        swal(""+kategoriNama+" tidak jadi dihapus.");
      }
    });
  });

  $('.deleteSemuaKategoriBarang').click(function(){
    swal({
      title: "Hapus Semua Kategori Barang",
      text: "Apakah anda yakin ingin menghapus semua kategori barang?",
      icon: "warning",
      buttons: ["Jangan Hapus", "Hapus"],
      dangerMode: true,
      closeOnClickOutside: false,
    }).then((willDelete) => {
      if (willDelete) {
        window.location = "/destroy-semua-kategori-barang";
      } else {
        swal("Semua kategori barang tidak jadi dihapus.");
      }
    });
  });
</script>
@endpush