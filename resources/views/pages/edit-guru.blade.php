@extends('layouts.app')

@section('title')
    Edit Data Guru - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Edit Data Guru</h3>
    <h6 class="mt-1 mb-6 text-center text-xs text-gray-600">Kelola data guru dengan sebaik mungkin.</h6>
    
    <form action="{{ route('store-edit-guru', $guru->id) }}" method="POST" class="space-y-3">
        @csrf
        <div class="flex justify-center mx-auto flex-1">
            <div class='w-full md:w-full px-3 space-y-3'>
                <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='nama'>Nama Guru</label>
                <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('nama') is-invalid @enderror' id='nama' name="nama" type='text' value="{{ $guru->nama }}" placeholder="Masukkan nama guru">
                @error('nama')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror

                <div class="flex-shrink w-full inline-block relative">
                    <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='golongan'>Golongan</label>
                    <select class="block appearance-none text-gray-800 dark:text-gray-50 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('golongan') is-invalid @enderror" name="golongan" id="golongan">
                        <option value="" hidden></option>
                        <option value="Honor" {{ $guru->golongan == "Honor" ? 'selected' : '' }}>Honor</option>

                        <option value="I/a" {{ $guru->golongan == "I/a" ? 'selected' : '' }}>I/a</option>
                        <option value="I/b" {{ $guru->golongan == "I/b" ? 'selected' : '' }}>I/b</option>
                        <option value="I/c" {{ $guru->golongan == "I/c" ? 'selected' : '' }}>I/c</option>
                        <option value="I/d" {{ $guru->golongan == "I/d" ? 'selected' : '' }}>I/d</option>

                        <option value="II/a" {{ $guru->golongan == "II/a" ? 'selected' : '' }}>II/a</option>
                        <option value="II/b" {{ $guru->golongan == "II/b" ? 'selected' : '' }}>II/b</option>
                        <option value="II/c" {{ $guru->golongan == "II/c" ? 'selected' : '' }}>II/c</option>
                        <option value="II/d" {{ $guru->golongan == "II/d" ? 'selected' : '' }}>II/d</option>

                        <option value="III/a" {{ $guru->golongan == "III/a" ? 'selected' : '' }}>III/a</option>
                        <option value="III/b" {{ $guru->golongan == "III/b" ? 'selected' : '' }}>III/b</option>
                        <option value="III/c" {{ $guru->golongan == "III/c" ? 'selected' : '' }}>III/c</option>
                        <option value="III/d" {{ $guru->golongan == "III/d" ? 'selected' : '' }}>III/d</option>

                        <option value="IV/a" {{ $guru->golongan == "IV/a" ? 'selected' : '' }}>IV/a</option>
                        <option value="IV/b" {{ $guru->golongan == "IV/b" ? 'selected' : '' }}>IV/b</option>
                        <option value="IV/c" {{ $guru->golongan == "IV/c" ? 'selected' : '' }}>IV/c</option>
                        <option value="IV/d" {{ $guru->golongan == "IV/d" ? 'selected' : '' }}>IV/d</option>
                        <option value="IV/e" {{ $guru->golongan == "IV/e" ? 'selected' : '' }}>IV/e</option>
                    </select>
                    <div class="pointer-events-none absolute top-6 mt-3 right-0 flex items-center px-2 text-gray-600">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                @error('golongan')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror

                <div id="divnip">
                    <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='nip'>NIP</label>
                    <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('nip') is-invalid @enderror' id='nip' name="nip" type='text' value="{{ $guru->nip }}" placeholder="Masukkan NIP guru">
                    @error('nip')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='keterangan'>Keterangan</label>
                <textarea class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('keterangan') is-invalid @enderror' id='keterangan' name="keterangan" type='text' placeholder="Masukkan keterangan guru">{{ $guru->keterangan }}</textarea>
                @error('keterangan')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror

            </div>
        </div>

        <div class="flex space-x-3 ml-3">
            <a
            href="{{ route('kelola-guru') }}"
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

@push('after-script')
    <script>
        $(document).ready(function() {
            var getGolongan = $("#golongan").val();
            var divnip = $("#divnip");
            if(getGolongan == "Honor"){
                divnip.slideUp();
            }else{
                divnip.slideDown();
            }
        });

        $("#golongan").on("change", function() {
            var getGolongan = $("#golongan").val();
            var divnip = $("#divnip");
            if(getGolongan == "Honor"){
                $("#nip").val(null);
                divnip.slideUp();
            }else{
                divnip.slideDown();
            }
        });
    </script>
@endpush