@extends('layouts.app')

@section('title')
    Ubah Email - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <div class="container mx-auto py-8 px-8 md:px-20">
        <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Ubah Email</h3>
        <h6 class="mt-1 mb-8 text-center text-xs text-gray-600">Gunakan email yang aktif karena sistem akan mengirimkan email verifikasi.</h6>

        <form action="{{ route('store-ubah-email', $users->id) }}" method="POST" class="space-y-3">
            @csrf
            <div class="flex justify-center mx-auto flex-1">
                <div class='w-full md:w-full px-3'>
                    <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='email'>Email</label>
                    <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('email') is-invalid @enderror' id='email' name="email" type='email' value="{{ $users->email }}" placeholder="Masukkan email">
                    @error('email')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="flex justify-start ml-3 space-x-2">
                <a
                href="{{ route('profile', $users->id) }}"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-cool-gray-400 transition-colors duration-150 bg-transparent border border-cool-gray-400 rounded-lg hover:border-cool-gray-500 hover:text-cool-gray-500 focus:outline-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <span>Kembali</span>
                </a>

                <button
                type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-400 border border-transparent rounded-lg active:bg-green-500 hover:bg-green-500 focus:outline-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span>Simpan</span>
                </button>
              </div>
        </form>

    </div>
@endsection