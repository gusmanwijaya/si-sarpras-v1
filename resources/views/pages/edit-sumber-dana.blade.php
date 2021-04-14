@extends('layouts.app')

@section('title')
    Edit Sumber Dana - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <div class="container mx-auto py-8 px-20">
        <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Edit Sumber Dana</h3>
        <h6 class="mt-1 mb-8 text-center text-xs text-gray-600">Kelola sumber dana dengan sebaik mungkin.</h6>
    
        <hr class="my-4 border-gray-600"/>

        <form action="{{ route('store-edit-sumber-dana', $sumberDana->id) }}" method="POST" class="space-y-3">
            @csrf
            <div class="flex justify-center mx-auto flex-1">
                <div class='w-full md:w-full px-3'>
                    <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='sumber_dana'>Sumber Dana</label>
                    <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('sumber_dana') is-invalid @enderror' id='sumber_dana' name="sumber_dana" type='text' value="{{ $sumberDana->sumber_dana }}" placeholder="Masukkan sumber dana">
                    @error('sumber_dana')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
    
            <div class="flex justify-start ml-3">
                <button
                type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-400 border border-transparent rounded-lg active:bg-yellow-500 hover:bg-yellow-500 focus:outline-none"
                >
                    <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <span>Ubah</span>
                </button>
              </div>
        </form>
    
        <hr class="my-4 border-gray-600"/>

    </div>
@endsection