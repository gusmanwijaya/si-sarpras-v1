@extends('layouts.app')

@section('title')
    Kelola Barang - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <!-- START: Cart -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Barang {{ $ruangan->nama_ruangan }}</h3>
            <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>
            <hr class="my-4 border-gray-600"/>
            <form action="{{ route('kelola-barang', $ruangan->id) }}" method="GET">
            <label class="text-gray-800 dark:text-gray-50 text-sm ml-3">Filter berdasarkan</label>
            <div class="flex flex-row items-center justify-between mt-2">
              <div class='w-full md:w-1/2 px-3'>
                  <label class='block tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="nama_barang">Nama Barang</label>
                  <div class="flex-shrink w-full inline-block relative">
                      <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-400 dark:border-gray-800 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none" name="nama_barang" id="nama_barang">
                          <option value="">-Pilih-</option>
                          @foreach(filterBarang($ruangan->id) as $data)
                          <option value="{{ $data->nama_barang }}">{{ $data->nama_barang }}</option>
                          @endforeach
                      </select>
                      <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                  </div>
              </div>
              <div class='w-full md:w-1/2 px-3'>
                <label class='block tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="sumber_dana_id">Sumber Dana</label>
                <div class="flex-shrink w-full inline-block relative">
                    <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-400 dark:border-gray-800 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none" name="sumber_dana_id" id="sumber_dana_id">
                        <option value="">-Pilih-</option>
                        @foreach (sumberDana() as $sumberDana)
                          <option value="{{ $sumberDana->id }}">{{ $sumberDana->sumber_dana }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
              </div>
              <div class='w-full md:w-1/2 px-3'>
                <label class='block tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="kondisi">Kondisi</label>
                <div class="flex-shrink w-full inline-block relative">
                    <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-400 dark:border-gray-800 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none" name="kondisi" id="kondisi">
                        <option value="">-Pilih-</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                    <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
              </div>
          </div>

          <div class="flex justify-end mt-4 mr-3">
            <button
            type="submit"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-400 border border-transparent rounded-lg active:bg-indigo-500 hover:bg-indigo-500 focus:outline-none mr-2"
            >
              <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
              </svg>
                <span>Filter</span>
            </button>

            <a
            href="{{ route('kelola-barang', $ruangan->id) }}"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-cool-gray-400 border border-transparent rounded-lg active:bg-cool-gray-500 hover:bg-cool-gray-500 focus:outline-none"
            >
              <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              <span>Refresh</span>
            </a>
          </div>
        </form>

          <hr class="mt-4 border-gray-600"/>
            
          @if(auth()->user()->role == 1)
          {{-- START: Tombol medium screen --}}
            <div class="md:flex hidden flex-row items-center justify-between">
              <div class="mt-4 md:ml-11 flex flex-wrap md:flex-row space-x-2 space-y-1 md:space-y-0">
                <a
                href="{{ route('tambah-barang', $ruangan->id) }}"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg active:bg-blue-500 hover:bg-blue-500 focus:outline-none"
                >
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>Tambah</span>
                </a>

                <a
                href="{{ route('export-barang-excel', $ruangan->id) }}"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-400 border border-transparent rounded-lg active:bg-green-500 hover:bg-green-500 focus:outline-none"
                >
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <span>Ekspor (.xlsx)</span>
                </a>

                <a
                href="#"
                ruangan-id="{{ $ruangan->id }}"
                class="deleteSemuaBarang flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                >
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  <span>Hapus Semua</span>
                </a>
              </div>
              
              <div class="flex flex-row items-center justify-center mt-4 mr-11">
                <a href="{{ route('tong-sampah-barang', $ruangan->id) }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  <span>Tong Sampah</span>
                </a>
              </div>
            </div>
            {{-- END: Tombol medium screen --}}

            {{-- START: Tombol mobile screen --}}
            <div class="flex md:hidden flex-row items-center justify-between mt-4">
              <div class="flex flex-col justify-between space-y-2">
                <a
                  href="{{ route('tambah-barang', $ruangan->id) }}"
                  class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-tight text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg active:bg-blue-500 hover:bg-blue-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Tambah</span>
                </a>
  
                <a
                href="#"
                ruangan-id="{{ $ruangan->id }}"
                class="deleteSemuaBarang flex items-center justify-between px-4 py-2 text-sm font-medium leading-tight text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                >
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  <span>Hapus Semua</span>
                </a>
              </div>

              <div class="flex flex-col justify-between space-y-2">
                <a
                  href="{{ route('export-barang-excel', $ruangan->id) }}"
                  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-tight text-white transition-colors duration-150 bg-green-400 border border-transparent rounded-lg active:bg-green-500 hover:bg-green-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Ekspor (.xlsx)</span>
                </a>

                <a href="{{ route('tong-sampah-barang', $ruangan->id) }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-tight text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
                  <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  <span>Tong Sampah</span>
                </a>
              </div>

            </div>
            {{-- END: Tombol mobile screen --}}
          @endif
          <div class="flex -mx-4 justify-center mt-6 mb-2">
            <!-- START: Shipping Cart -->
            <div class="w-full px-4 mb-4 md:w-11/12 md:mb-0">
              <!-- START: Table title -->
              <div class="border-b border-gray-200 dark:border-gray-600 mb-4 hidden md:block">
                <div class="flex items-center pb-2 -mx-4 text-gray-800 dark:text-gray-50">
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px">
                      <h6>Photo</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Nama Barang</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Kondisi</h6>
                    </div>
                  </div>
                  <div class="px-4 w-2/12">
                    <div class="text-center">
                      @if(auth()->user()->role == 1)
                      <h6>Aksi</h6>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Table title -->
  
              @forelse ($barang as $item)
              <!-- START: Table item 1 -->
              <div
              class="flex flex-wrap items-center mb-4 -mx-4"
              data-row="1"
              >
                <div class="px-4 flex-none">
                  <div class="" style="width: 90px; height: 90px">
                    <img
                      src="
                      @if($item->image_url != null)
                      {{ asset('storage/unggah/Barang/'.$ruangan->nama_ruangan.'/'.$item->image_url) }}
                      @else
                      {{ asset('img/404.png') }}
                      @endif
                      "
                      alt="Barang"
                      class="object-cover rounded-xl w-full h-full"
                    />
                  </div>
                </div>
                <div class="px-4 w-auto md:w-5/12 flex-1">
                  <div class="space-y-2 md:space-y-1">
                    <h6 class="font-semibold text-md md:text-xl leading-8 text-gray-800 dark:text-gray-50">
                      {{ $item->nama_barang }}
                    </h6>
                    <span class="block text-sm md:text-md text-gray-800 dark:text-gray-50">{{ $item->jumlah }} {{ $item->satuan }}</span>
                    <h6
                      class="font-semibold text-xs md:text-md block md:hidden"
                    >
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
                    </h6>
                  </div>
                </div>
                <div
                  class="w-auto md:w-5/12 flex-none md:flex-nowrap md:block hidden"
                >
                  <div class="ml-2">
                    <h6 class="font-semibold text-sm">
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
                    </h6>
                  </div>
                </div>
                <div class="px-6 w-1/12">
                  <div class="text-center flex flex-row justify-end">
                      @if(auth()->user()->role == 1)
                        <a
                            href="{{ route('edit-barang', [$ruangan->id, $item->id]) }}"
                            class="text-yellow-400 dark:text-yellow-500 border-none focus:outline-none px-3 py-1"
                        >
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                          </svg>
                        </a>
    
                        <a
                            href="#"
                            class="deleteBarang text-red-400 dark:text-red-500 border-none focus:outline-none px-3 py-1" ruangan-id="{{ $ruangan->id }}" barang-id="{{ $item->id }}" barang-nama="{{ $item->nama_barang }}"
                        >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </a>
                      @endif
                    </div>
                </div>
              </div>
              <!-- END: Table item 1 -->
              @empty
                <div class="flex flex-col items-center justify-center">
                  <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-96 h-96">
                  <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
                </div>
              @endforelse
            </div>
            <!-- END: Shipping Cart -->
          </div>
          {{ $barang->links() }}
        </div>
      </section>
      <!-- END: Cart -->
@endsection

@push('after-script')
    {{-- START: Delete --}}
    <script>
      $('.deleteBarang').click(function(){
        var barangId = $(this).attr('barang-id');
        var barangNama = $(this).attr('barang-nama');
        var ruanganId = $(this).attr('ruangan-id');
        swal({
          title: "Hapus Barang",
          text: "Apakah anda yakin ingin menghapus "+barangNama+" ?",
          icon: "warning",
          buttons: ["Jangan Hapus", "Hapus"],
          dangerMode: true,
          closeOnClickOutside: false,
        }).then((willDelete) => {
          if (willDelete) {
            window.location = "/destroy-barang/" +ruanganId+ "/" +barangId+"";
          } else {
            swal(""+barangNama+" tidak jadi dihapus.");
          }
        });
      });

      $('.deleteSemuaBarang').click(function(){
        var ruanganId = $(this).attr('ruangan-id');
        swal({
          title: "Hapus Semua Barang",
          text: "Apakah anda yakin ingin menghapus semua barang ?",
          icon: "warning",
          buttons: ["Jangan Hapus", "Hapus"],
          dangerMode: true,
          closeOnClickOutside: false,
        }).then((willDelete) => {
          if (willDelete) {
            window.location = "/destroy-semua-barang/" +ruanganId;
          } else {
            swal("Semua barang tidak jadi dihapus.");
          }
        });
      });
    </script>
    {{-- END: Delete --}}
@endpush