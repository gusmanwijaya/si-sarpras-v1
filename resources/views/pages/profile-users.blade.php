@extends('layouts.app')

@section('title')
    Profile - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Profile</h3>
    <h6 class="mt-1 mb-10 text-center text-xs text-gray-600">Kelola profile anda sebaik mungkin.</h6>
    <form action="{{ route('store-profile', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
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
                        @if($users->image_url != null) 
                            @if($users->role == 0)
                                {{ asset('storage/unggah/Profile/Admin/' . $users->image_url) }}
                            @else
                                {{ asset('storage/unggah/Profile/Operator/' . $users->image_url) }} 
                            @endif
                        @else
                            {{ asset('img/user-profile.png') }}
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

                @if($users->image_url != null)
                <a href="#" users-id="{{ $users->id }}" class="deleteProfile inline-flex items-center px-4 py-2 bg-white border border-red-300 rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest shadow-sm hover:text-red-500 focus:outline-none focus:border-red-400 focus:shadow-outline-blue active:text-red-800 active:bg-red-50 transition ease-in-out duration-150 mt-2 ml-3">
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

        <div class="px-4 py-3 mb-6 mt-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm mb-4">
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
            >
                <input
                name="name"
                id="name"
                type="text"
                class="block w-full pl-10 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input @error('name') is-invalid @enderror"
                placeholder="Name"
                value="{{ $users->name }}"
                />
                <div
                class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                >
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            @error('name')
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
            <a href="#" class="ubahEmail" users-id="{{ $users->id }}">
                <input
                name="email"
                id="email"
                type="email"
                class="block w-full pl-10 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray cursor-pointer form-input @error('email') is-invalid @enderror"
                placeholder="Email"
                value="{{ $users->email }}"
                readonly
                />

            </a>
                <div
                class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
            </div>
            @error('email')
            <span class="text-xs text-red-600 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror
            </label>

            <label class="block text-sm">
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                <a href="#" class="gantiPassword" users-id="{{ $users->id }}">
                    <input
                    name="password"
                    id="password"
                    type="password"
                    class="block w-full pl-10 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray cursor-pointer form-input @error('password') is-invalid @enderror"
                    placeholder="Password"
                    value="{{ $users->password }}"
                    readonly
                    />
    
                </a>
                    <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                </div>
                @error('password')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
                @enderror
                </label>

        </div>

        <div class="flex justify-start mt-4">
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
{{-- START: Ubah Email --}}
<script>
    $('.ubahEmail').click(function(){
      var usersId = $(this).attr('users-id');
      swal({
        title: "Ubah Email",
        text: "Apakah anda ingin mengubah email anda? Anda harus melakukan verifikasi email kembali.",
        icon: "warning",
        buttons: ["Jangan Ubah", "Ubah"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/ubah-email/"+usersId+"";
        } else {
          swal("Email anda tidak jadi diubah.");
        }
      });
    });
  </script>
{{-- END: Ubah Email --}}

{{-- START: Delete --}}
<script>
    $('.deleteProfile').click(function(){
      var usersId = $(this).attr('users-id');
      swal({
        title: "Hapus Foto Profile",
        text: "Apakah anda yakin ingin menghapus foto profile anda?",
        icon: "warning",
        buttons: ["Jangan Hapus", "Hapus"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/destroy-foto-profile/"+usersId+"";
        } else {
          swal("Foto profile anda tidak jadi dihapus.");
        }
      });
    });
  </script>
{{-- END: Delete --}}

{{-- START: Ganti Password --}}
<script>
    $('.gantiPassword').click(function(){
      var usersId = $(this).attr('users-id');
      swal({
        title: "Ganti Password",
        text: "Apakah anda yakin ingin mengganti password ?",
        icon: "warning",
        buttons: ["Jangan Ganti", "Ganti"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          window.location = "/ganti-password/"+usersId+"";
        } else {
          swal("Password tidak jadi diganti.");
        }
      });
    });
  </script>
  {{-- END: Ganti Password --}}
@endpush
