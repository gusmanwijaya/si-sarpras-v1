@extends('layouts.app')

@section('title')
    Tambah Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Tambah Ruangan</h3>
    <h6 class="mt-1 mb-10 text-center text-xs text-gray-600">Kelola ruangan dengan sebaik mungkin.</h6>
    <form action="{{ route('store-ruangan') }}" method="POST" enctype="multipart/form-data">
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

        <div class="px-4 py-3 mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm mb-4">
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
            >
                <input
                name="nama_ruangan"
                id="nama_ruangan"
                type="text"
                class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input @error('nama_ruangan') is-invalid @enderror"
                placeholder="Nama Ruangan"
                value="{{ old('nama_ruangan') }}"
                />
                <div
                class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
            @error('nama_ruangan')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
            </label>

            <label class="block text-sm mb-4">
            <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                    <input
                    name="kode_ruangan"
                    id="kode_ruangan"
                    type="text"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Kode Ruangan"
                    value="{{ old('kode_ruangan') }}"
                    />
                    <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                </div>
            @error('kode_ruangan')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
            </label>

            <label class="block text-sm mb-1">
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                    <select class="block appearance-none text-gray-600 w-full bg-white dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 px-4 py-2 pr-8 rounded focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray @error('guru_id') is-invalid @enderror" name="guru_id" id="guru_id">
                        <option value="">Pilih Penanggung Jawab</option>
                        @foreach (guru() as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                @error('guru_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
            </label>

        </div>

        <div class="flex justify-start mt-4">
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
    </form>
</div>
@endsection
