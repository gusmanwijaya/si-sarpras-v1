@extends('layouts.app')

@section('title')
    Ubah Penanggung Jawab Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Ubah Penanggung Jawab Ruangan</h3>
    <h6 class="mt-1 mb-10 text-center text-xs text-gray-600">Kelola ruangan dengan sebaik mungkin.</h6>
    <form action="{{ route('store-ubah-penanggung-jawab-ruangan', $ruangan->id) }}" method="POST">
        @csrf

        <div class="px-4 py-3 mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <label class="block text-sm mb-1">
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                    <select class="block appearance-none text-gray-600 w-full bg-white dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 px-4 py-2 pr-8 rounded focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray cursor-pointer @error('guru_id') is-invalid @enderror" name="guru_id" id="guru_id">
                        <option value="">Pilih Penanggung Jawab</option>
                        @foreach (guru() as $guru)
                            <option value="{{ $guru->id }}" {{ $ruangan->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
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

        <div class="flex space-x-4 mt-4">
            <a
            href="{{ route('edit-ruangan', $ruangan->id) }}"
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