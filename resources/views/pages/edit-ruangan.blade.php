@extends('layouts.app')

@section('title')
    Edit Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Ubah Ruangan</h3>
    <h6 class="mt-1 mb-10 text-center text-xs text-gray-600">Kelola ruangan dengan sebaik mungkin.</h6>
    <form action="{{ route('store-edit-ruangan', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
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
                    <img src="
                        @if($ruangan->image_url != null)
                            {{ asset('storage/unggah/Ruangan/' . $ruangan->image_url) }}
                        @else
                            {{ asset('img/404.png') }}
                        @endif
                    " class="w-40 h-40 m-auto rounded-full shadow object-cover">
                </div>
                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                    </span>
                </div>
                <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                    Pilih Gambar
                </button>

                @if($ruangan->image_url != null)
                <a href="#" ruangan-id="{{ $ruangan->id }}" class="deleteFoto inline-flex items-center px-4 py-2 bg-white border border-red-300 rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest shadow-sm hover:text-red-500 focus:outline-none focus:border-red-400 focus:shadow-outline-blue active:text-red-800 active:bg-red-50 transition ease-in-out duration-150 mt-2 ml-3">
                    Hapus Gambar
                </a>
                @endif
            </div>
            @error('image_url')
                <p class="text-xs text-red-600 dark:text-red-400 text-center mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="px-4 py-3 mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
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
                value="{{ $ruangan->nama_ruangan }}"
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
                    value="{{ $ruangan->kode_ruangan }}"
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
                <a href="#" class="ubahPenanggungJawab" ruangan-id="{{ $ruangan->id }}">
                    <select class="block appearance-none text-gray-600 w-full bg-white dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 px-4 py-2 pr-8 rounded focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray cursor-pointer @error('guru_id') is-invalid @enderror" name="guru_id" id="guru_id" disabled>
                        <option value="">Pilih Penanggung Jawab</option>
                        @foreach (guru() as $guru)
                            <option value="{{ $guru->id }}" {{ $ruangan->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </a>
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

        <div class="flex space-x-4 mt-4">
            <a
            href="{{ route('kelola-ruangan') }}"
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
{{-- START: Ubah Penanggung Jawab --}}
<script>
    $('.ubahPenanggungJawab').click(function(){
      var ruanganId = $(this).attr('ruangan-id');
      swal({
        title: "Ubah Penanggung Jawab",
        text: "Apakah anda yakin ingin mengubah penanggung jawab ruangan ini?",
        icon: "warning",
        buttons: ["Jangan Ubah", "Ubah"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/ubah-penanggung-jawab-ruangan/"+ruanganId+"";
        } else {
          swal("Penanggung Jawab tidak jadi diubah.");
        }
      });
    });
  </script>
{{-- END: Ubah Penanggung Jawab --}}

{{-- START: Delete --}}
<script>
    $('.deleteFoto').click(function(){
      var ruanganId = $(this).attr('ruangan-id');
      swal({
        title: "Hapus Foto",
        text: "Apakah anda yakin ingin menghapus foto?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-foto-ruangan/"+ruanganId+"";
        } else {
          swal("Foto tidak jadi dihapus.");
        }
      });
    });
  </script>
{{-- END: Delete --}}
@endpush