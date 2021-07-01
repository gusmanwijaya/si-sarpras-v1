@extends('layouts.app')

@section('title')
    Edit Barang - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Edit Barang</h3>
        <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola barang dengan sebaik mungkin.</h6>
        
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

            <form action="{{ route('store-edit-barang', [$ruangan->id, $barang->id]) }}" method="POST" class="mt-6 border-t border-gray-600 pt-4" enctype="multipart/form-data">
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
                                @if($barang->image_url != null) 
                                    {{ asset('storage/unggah/Barang/' . $ruangan->nama_ruangan . '/' . $barang->image_url) }}
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
        
                        @if($barang->image_url != null)
                        <a href="#" barang-id="{{ $barang->id }}" ruangan-id="{{ $ruangan->id }}" class="deleteFoto inline-flex items-center px-4 py-2 bg-white border border-red-300 rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest shadow-sm hover:text-red-500 focus:outline-none focus:border-red-400 focus:shadow-outline-blue active:text-red-800 active:bg-red-50 transition ease-in-out duration-150 mt-2 ml-3">
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

                <div class='flex flex-wrap -mx-3 mb-6'>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='nama_barang'>Nama Barang</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('nama_barang') is-invalid @enderror' id='nama_barang' name="nama_barang" type='text' value="{{ $barang->nama_barang }}">
                        @error('nama_barang')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='merek'>Merek</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('merek') is-invalid @enderror' id='merek' name="merek" type='text' value="{{ $barang->merek }}">
                        @error('merek')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2' for="kategori_id">Kategori</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori_id">
                                <option value=""></option>
                                @foreach (kategoriBarang() as $item)
                                    <option value="{{ $item->id }}" {{ $barang->kategori_id == $item->id ? 'selected' : '' }}>{{ $item->kategori }}</option>
                                @endforeach
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

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-800 dark:text-gray-50 text-xs font-bold mb-2' for='no_reg'>No Reg</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('no_reg') is-invalid @enderror' id='no_reg' name="no_reg" type='text' value="{{ $barang->no_reg }}">
                        @error('no_reg')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2' for="tahun">Tahun</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('tahun') is-invalid @enderror" name="tahun" id="tahun">
                                <option value=""></option>
                                @for ($i = 1995; $i <= $tahunNow; $i++)
                                    <option value="{{ $i }}" @if($barang->tahun == $i) selected @endif>{{ $i }}</option>
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
                        <label class='block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2' for="unit">Unit</label>
                        <input class='appearance-none block w-full bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-50 border border-gray-300 dark:border-gray-600 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-700 @error('unit') is-invalid @enderror' type='number' name="unit" id="unit" value="{{ $barang->unit }}" min="1">
                        @error('unit')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <div class='w-full md:w-full px-3 mb-6'>
                        <label class='block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2' for="kondisi">Kondisi</label>
                        <div class="flex-shrink w-full inline-block relative">
                            <select class="block appearance-none text-gray-600 w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 dark:text-gray-50 shadow-inner px-4 py-2 pr-8 rounded focus:outline-none @error('kondisi') is-invalid @enderror" name="kondisi" id="kondisi">
                                <option value=""></option>
                                <option value="Baik" @if($barang->kondisi == "Baik") selected @endif>Baik</option>
                                <option value="Rusak" @if($barang->kondisi == "Rusak") selected @endif>Rusak</option>
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
                        <div class="flex justify-end mt-4">
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
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('after-script')
{{-- START: Delete --}}
<script>
    $('.deleteFoto').click(function(){
      var barangId = $(this).attr('barang-id');
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
          window.location = "/destroy-foto-barang/"+ruanganId+"/"+barangId+"";
        } else {
          swal("Foto tidak jadi dihapus.");
        }
      });
    });
  </script>
{{-- END: Delete --}}
@endpush