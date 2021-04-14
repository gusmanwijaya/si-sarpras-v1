@extends('layouts.app')

@section('title')
    Tong Sampah Ruangan - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto py-8 md:px-20 px-5">
    <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Tong Sampah Ruangan</h3>
    <h6 class="mt-1 mb-8 text-center text-xs text-gray-600">Tong sampah berisi data yang dihapus sementara, anda bisa memulihkan atau menghapusnya secara permanen.</h6>

    <hr class="my-4 border-gray-600"/>

    <div class="flex flex-row justify-between items-center mb-4">
        <a href="#" class="pulihkanSemuaRuangan flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg hover:bg-blue-500 focus:outline-none">
            <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span>Pulihkan Semua</span>
        </a>

        <a href="#" class="hapusPermanenSemuaRuangan flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg hover:bg-red-500 focus:outline-none">
            <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            <span>Hapus Permanen Semua</span>
        </a>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap table-auto">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Ruangan</th>
                        <th class="px-4 py-3">Dihapus Pada</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @foreach ($ruanganTrashed as $ruangan)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $ruangan->nama_ruangan }}</td>
                    <td class="px-4 py-3 text-sm">{{ $ruangan->getDeletedAtAttribute() }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <a
                            href="#"
                            class="pulihkanRuangan flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            ruangan-id="{{ $ruangan->id }}" ruangan-img-url="{{ $ruangan->image_url }}"
                            aria-label="Pulihkan"
                            >
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </a>

                            <a
                            href="#"
                            class="hapusPermanenRuangan flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            ruangan-id="{{ $ruangan->id }}" ruangan-img-url="{{ $ruangan->image_url }}"
                            aria-label="Hapus"
                            >
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if($ruanganTrashed->count() < 1)
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-auto h-auto md:w-96 md:h-96">
                <p class="text-base md:text-xl text-gray-500 font-medium">Oopss.. Nampaknya data masih kosong nih.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('after-script')
    <script>
        $('.pulihkanSemuaRuangan').click(function(){
            swal({
                title: "Pulihkan Semua Ruangan",
                text: "Apakah anda yakin ingin memulihkan semua ruangan ?",
                icon: "warning",
                buttons: ["Jangan Pulihkan", "Pulihkan"],
                dangerMode: true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                window.location = "/pulihkan-ruangan";
                } else {
                swal("Semua ruangan tidak jadi dipulihkan.");
                }
            });
        });

        $('.pulihkanRuangan').click(function(){
            var ruanganId = $(this).attr('ruangan-id');
            var ruanganImgUrl = $(this).attr('ruangan-img-url');
            swal({
                title: "Pulihkan Ruangan",
                text: "Apakah anda yakin ingin memulihkan ruangan ?",
                icon: "warning",
                buttons: ["Jangan Pulihkan", "Pulihkan"],
                dangerMode: true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                window.location = "/pulihkan-ruangan/"+ruanganId+"/"+ruanganImgUrl;
                } else {
                swal("Ruangan tidak jadi dipulihkan.");
                }
            });
        });

        $('.hapusPermanenSemuaRuangan').click(function(){
            swal({
                title: "Hapus Permanen Semua Ruangan",
                text: "Apakah anda yakin ingin menghapus permanen semua ruangan ?",
                icon: "warning",
                buttons: ["Jangan Hapus", "Hapus"],
                dangerMode: true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                window.location = "/hapus-permanen-ruangan";
                } else {
                swal("Semua ruangan tidak jadi dihapus.");
                }
            });
        });

        $('.hapusPermanenRuangan').click(function(){
            var ruanganId = $(this).attr('ruangan-id');
            var ruanganImgUrl = $(this).attr('ruangan-img-url');
            swal({
                title: "Hapus Permanen Ruangan",
                text: "Apakah anda yakin ingin menghapus permanen ruangan ?",
                icon: "warning",
                buttons: ["Jangan Hapus", "Hapus"],
                dangerMode: true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                window.location = "/hapus-permanen-ruangan/"+ruanganId+"/"+ruanganImgUrl;
                } else {
                swal("Ruangan tidak jadi dihapus.");
                }
            });
        });
    </script>
@endpush