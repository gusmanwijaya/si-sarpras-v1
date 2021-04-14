@extends('layouts.app')

@section('title')
    Pengguna - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
    <!-- START: Cart -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <h3 class="text-gray-800 text-2xl font-medium text-center dark:text-gray-50">Pengguna</h3>
            <h6 class="mt-1 mb-2 text-center text-xs text-gray-600">Kelola pengguna dengan sebaik mungkin.</h6>
            
            <div class="mt-4 md:ml-11">
              {{-- START: Tombol medium screen --}}
              <div class="hidden md:flex flex-row items-center justify-between">
                <div class="flex flex-row justify-between space-x-2">
                  <a
                  href="{{ route('tambah-pengguna') }}"
                  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg active:bg-blue-500 hover:bg-blue-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Tambah</span>
                  </a>
  
                  <a
                  href="#"
                  class="deleteSemuaPengguna flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus Semua</span>
                  </a>
                </div>

                <div class="flex flex-row justify-end mr-11">
                  <a
                  href="{{ route('tong-sampah-pengguna') }}"
                  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Tong Sampah</span>
                  </a>
                </div>
              </div>
              {{-- END: Tombol medium screen --}}

              {{-- START:Tombol mobile screen --}}
              <div class="flex md:hidden flex-row items-end justify-between">
                <div class="flex flex-col space-y-2">
                  <a
                  href="{{ route('tambah-pengguna') }}"
                  class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-400 border border-transparent rounded-lg active:bg-blue-500 hover:bg-blue-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Tambah</span>
                  </a>
                  
                  <a
                  href="#"
                  class="deleteSemuaPengguna flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                  >
                    <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus Semua</span>
                  </a>
                </div>

                <div class="flex flex-row">
                  <a
                    href="{{ route('tong-sampah-pengguna') }}"
                    class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
                    >
                      <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      <span>Tong Sampah</span>
                    </a>
                </div>
              </div>
              {{-- END:Tombol mobile screen --}}
            </div>
          <div class="flex -mx-4 justify-center mt-6 mb-2">
            <!-- START: Shipping Cart -->
            <div class="w-full px-4 mb-4 md:w-11/12 md:mb-0">
              <!-- START: Table title -->
              <div class="border-b border-gray-200 dark:border-gray-600 mb-4 hidden md:block">
                <div class="flex items-center pb-2 -mx-4 text-gray-800 dark:text-gray-50">
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px">
                      <h6>Photo</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Nama Pengguna</h6>
                    </div>
                  </div>
                  <div class="px-4 w-5/12">
                    <div class="">
                      <h6>Username</h6>
                    </div>
                  </div>
                  <div class="px-4 w-2/12">
                    <div class="text-center">
                      <h6>Aksi</h6>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Table title -->
  
              @forelse ($users as $item)
                <!-- START: Table item 1 -->
                <div
                  class="flex flex-wrap items-center mb-4 -mx-4"
                  data-row="1"
                >
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px; height: 90px">
                      <img
                        src="
                        @if($item->image_url != null)
                          {{ asset('storage/unggah/Profile/Operator/'.$item->image_url) }}
                        @else
                          {{ asset('img/user-profile.png') }}
                        @endif
                        "
                        alt="Users"
                        class="object-cover rounded-xl w-full h-full"
                      />
                    </div>
                  </div>
                  <div class="px-4 w-auto md:w-5/12 flex-1">
                    <div class="space-y-2 md:space-y-1">
                      <h6 class="font-semibold text-md md:text-xl leading-8 text-gray-800 dark:text-gray-50">
                        {{ $item->name }}
                      </h6>
                      <h6
                        class="font-semibold text-gray-600 text-xs md:text-md block md:hidden"
                      >
                      {{ $item->username }}
                      </h6>
                    </div>
                  </div>
                  <div
                    class="w-auto md:w-5/12 flex-none md:flex-nowrap md:block hidden"
                  >
                    <div class="ml-2">
                      <h6 class="font-semibold text-gray-600 text-sm">
                          {{ $item->username }}
                      </h6>
                    </div>
                  </div>
                  <div class="px-6 md:px-11 w-1/12">
                      <div class="text-center flex flex-row justify-end">
                          <a
                              href="#"
                              class="usersDelete text-red-400 dark:text-red-500 border-none focus:outline-none px-3 py-1" users-id="{{ $item->id }}" users-name="{{ $item->name }}"
                          >
                          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                          </a>
                      </div>
                  </div>
                </div>
                <!-- END: Table item 1 -->
              @empty
                <div class="flex flex-col items-center justify-center">
                  <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="w-96 h-96">
                  <p class="text-base md:text-xl text-gray-500 font-medium text-center">Oopss.. Nampaknya data masih kosong nih.</p>
                </div>
              @endforelse
            </div>
            <!-- END: Shipping Cart -->
          </div>
          {{ $users->links() }}
        </div>
      </section>
      <!-- END: Cart -->
@endsection

@push('after-script')
  {{-- START: Delete --}}
  <script>
    $('.usersDelete').click(function(){
      var usersId = $(this).attr('users-id');
      var usersName = $(this).attr('users-name');
      swal({
        title: "Hapus Pengguna",
        text: "Apakah anda yakin ingin menghapus "+usersName+" ?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-pengguna/"+usersId+"";
        } else {
          swal(""+usersName+" tidak jadi dihapus.");
        }
      });
    });

    $('.deleteSemuaPengguna').click(function(){
      swal({
        title: "Hapus Semua Pengguna",
        text: "Apakah anda yakin ingin menghapus semua pengguna ?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-semua-pengguna";
        } else {
          swal("Semua pengguna tidak jadi dihapus.");
        }
      });
    });
  </script>
  {{-- END: Delete --}}
@endpush