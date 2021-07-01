@extends('layouts.app')

@section('title')
    Tambah Barang - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Tambah Barang</h3>
        <h6 class="mt-1 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>
        
        <div class="w-full max-w-2xl p-6 mx-auto">
            <div class="flex flex-row items-center">
                <a
                    href="{{ route('kelola-barang', $ruangan->id) }}"
                    class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-cool-gray-400 transition-colors duration-150 bg-transparent rounded-lg hover:text-cool-gray-500 focus:outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                </a>
                <h2 class="text-2xl text-gray-800 dark:text-gray-50">{{ $ruangan->nama_ruangan }}</h2>
            </div>

            <form action="{{ route('store-barang', $ruangan->id) }}" method="POST" class="mt-6 border-t border-gray-600 pt-4" enctype="multipart/form-data">
                @csrf

                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3 mb-4">
                    <!-- Photo File Input -->
                    <input type="file" name="image_url" id="image_url" accept="image/*" class="hidden @error('image_url') is-invalid @enderror" x-ref="photo" x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                    ">
                    
                    <div class="text-center">
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ asset('img/404.png') }}" class="w-40 h-40 m-auto rounded-full shadow object-cover">
                        </div>
                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                            </span>
                        </div>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                            Pilih Gambar
                        </button>
                    </div>
                    @error('image_url')
                        <p class="text-xs text-red-600 dark:text-red-400 text-center mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class='flex flex-wrap -mx-3 mb-6'>
                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='nama_barang'>Nama Barang</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('nama_barang') is-invalid @enderror' id='nama_barang' name="nama_barang" type='text' value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='merek'>Merek</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('merek') is-invalid @enderror' id='merek' name="merek" type='text' value="{{ old('merek') }}">
                        @error('merek')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="kategori_id">Kategori</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori_id">
                                <option value=""></option>
                                @foreach (kategoriBarang() as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('kategori_id')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='no_reg'>No Reg</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('no_reg') is-invalid @enderror' id='no_reg' name="no_reg" type='text' value="{{ old('no_reg') }}">
                        @error('no_reg')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="tahun">Tahun</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('tahun') is-invalid @enderror" name="tahun" id="tahun">
                                <option value=""></option>
                                @for ($i = 1995; $i <= $tahunNow; $i++)
                                    <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('tahun')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="unit">Unit</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('unit') is-invalid @enderror' type='number' name="unit" id="unit" value="{{ old('unit') }}" min="1">
                        @error('unit')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for="kondisi">Kondisi</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('kondisi') is-invalid @enderror" name="kondisi" id="kondisi">
                                <option value=""></option>
                                <option value="Baik" {{ old('kondisi') == "Baik" ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ old('kondisi') == "Rusak" ? 'selected' : '' }}>Rusak</option>
                            </select>
                            <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('kondisi')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="w-full border-t border-gray-600 mt-4">
                        <div class="flex justify-end mt-4 space-x-3">
                            <a
                            href="{{ route('kelola-barang', $ruangan->id) }}"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-cool-gray-400 transition-colors duration-150 bg-transparent border border-cool-gray-400 rounded-lg hover:border-cool-gray-500 hover:text-cool-gray-500 focus:outline-none"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                                <span>Kembali</span>
                            </a>

                            <button
                            type="submit"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg active:bg-blue-500 hover:bg-blue-500 focus:outline-none"
                            >
                                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Tambah</span>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection
