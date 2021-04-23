@extends('layouts.app')

@section('title')
    Laporan Barang - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <section class="py-8">
        <div class="container mx-auto px-4">
            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Laporan Barang {{ $ruangan->nama_ruangan }}</h3>
            <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>
            <label class="text-gray-800 dark:text-gray-50 text-sm ml-3">Cetak laporan berdasarkan</label>
            
            <hr class="mt-2 border-gray-600"/>

            <form action="{{ route('print', $ruangan->id) }}" target="_blank" method="GET">
            <div class="flex flex-row items-center justify-between mt-2">
              <div class='w-full md:w-1/2 px-3'>
                  <label class='block tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="nama_barang">Nama Barang</label>
                  <div class="flex-shrink w-full inline-block relative">
                      <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-400 dark:border-gray-800 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none" name="nama_barang" id="nama_barang">
                          <option value=""></option>
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
                        <option value=""></option>
                        @foreach (sumberDana() as $item)
                            <option value="{{ $item->id }}">{{ $item->sumber_dana }}</option>
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
                        <option value=""></option>
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

            <div class="flex flex-row ml-4 mt-1">
                <p class="text-xs text-center text-blue-400 dark:text-gray-600">*kosongkan semua field jika ingin mencetak seluruh data.</p>
            </div>

            <hr class="mt-2 border-gray-600"/>

            {{-- <div class="flex flex-row items-center justify-start w-full mt-2">
                <div class='w-full md:w-1/2 px-3'>
                  <label class='block tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="tahun_laporan">Tahun Laporan</label>
                  <div class="flex-shrink w-full inline-block relative">
                      <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-400 dark:border-gray-800 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none" name="tahun_laporan" id="tahun_laporan">
                            <option value="">-Pilih-</option>
                            <option value="{{ $date }}">{{ $date }}</option>
                            @for ($i = 1; $i < 51; $i++)
                                <option value="{{ $date + $i }}">{{ $date + $i }}</option>
                            @endfor
                      </select>
                      <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                  </div>
                </div>
            </div>

            <hr class="mt-4 border-gray-600"/> --}}

          <div class="flex justify-end mt-4 mr-3">
            <button
            type="submit"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-400 border border-transparent rounded-lg active:bg-indigo-500 hover:bg-indigo-500 focus:outline-none"
            >
                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak</span>
            </button>

            <button
            type="reset"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-cool-gray-400 border border-transparent rounded-lg active:bg-cool-gray-500 hover:bg-cool-gray-500 focus:outline-none ml-4"
            >
                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Reset</span>
            </button>
          </div>
        </form>
        </div>
      </section>
@endsection