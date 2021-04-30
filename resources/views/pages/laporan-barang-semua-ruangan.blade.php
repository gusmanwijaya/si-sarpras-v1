@extends('layouts.app')

@section('title')
    Laporan Barang Semua Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <section class="py-8">
        <div class="container mx-auto px-4">

            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Laporan Barang Semua Ruangan</h3>
            <h6 class="mt-1 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>

            <div class="flex flex-col container mx-auto mt-4">

                <form action="{{ route('print-laporan-barang-semua-ruangan') }}" target="_blank" method="GET">
                    
                    <div class='w-full md:w-1/2 px-14 mb-2'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="cetak">Cetak :</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('cetak') is-invalid @enderror" name="cetak" id="cetak">
                                <option value="">Semua barang</option>
                                <option value="Baik">Kondisi barang yang baik saja</option>
                                <option value="Rusak">Kondisi barang yang rusak saja</option>
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('cetak')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="flex pl-14">
                        <button
                        type="submit"
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-400 border border-transparent rounded-lg active:bg-indigo-500 hover:bg-indigo-500 focus:outline-none"
                        >
                            <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            <span>Cetak</span>
                        </button>
                    </div>

                </form>

            </div>

            
        </div>

        <div class="container mx-auto px-10 mt-4">

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table-auto mb-2">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                            >
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Barang</th>
                                <th class="px-4 py-3">Merek</th>
                                <th class="px-4 py-3">No Reg</th>
                                <th class="px-4 py-3">Tahun</th>
                                <th class="px-4 py-3">Unit</th>
                                <th class="px-4 py-3">Kondisi</th>
                                <th class="px-4 py-3">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($dataBarang as $barang)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->nama_barang }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->merek }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->no_reg }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->tahun }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->unit }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->kondisi }}</td>
                            <td class="px-4 py-3 text-sm">{{ $barang->Ruangan->nama_ruangan }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
        
                    {{ $dataBarang->links() }}
        
                    @if($dataBarang->count() < 1)
                    <div class="flex flex-col items-center justify-center">
                        <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-auto h-auto md:w-96 md:h-96">
                        <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </section>
@endsection