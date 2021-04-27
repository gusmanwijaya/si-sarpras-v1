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
            <label class="block text-sm">
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

        </div>

        <div class="flex justify-start mt-4">
            <button
            type="submit"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-400 border border-transparent rounded-lg active:bg-yellow-500 hover:bg-yellow-500 focus:outline-none"
            >
                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <span>Ubah</span>
            </button>

            <a
                href="#"
                class="gantiPassword flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none ml-4" users-id="{{ $users->id }}"
                >
                <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <span>Ganti Password</span>
            </a>
        </div>
    </form>
</div>
@endsection

@push('after-script')
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

<script src="https://unpkg.com/create-file-list"></script>
<script>
function dataFileDnD() {
    return {
        files: [],
        fileDragging: null,
        fileDropping: null,
        humanFileSize(size) {
            const i = Math.floor(Math.log(size) / Math.log(1024));
            return (
                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                " " +
                ["B", "kB", "MB", "GB", "TB"][i]
            );
        },
        remove(index) {
            let files = [...this.files];
            files.splice(index, 1);

            this.files = createFileList(files);
        },
        drop(e) {
            let removed, add;
            let files = [...this.files];

            removed = files.splice(this.fileDragging, 1);
            files.splice(this.fileDropping, 0, ...removed);

            this.files = createFileList(files);

            this.fileDropping = null;
            this.fileDragging = null;
        },
        dragenter(e) {
            let targetElem = e.target.closest("[draggable]");

            this.fileDropping = targetElem.getAttribute("data-index");
        },
        dragstart(e) {
            this.fileDragging = e.target
                .closest("[draggable]")
                .getAttribute("data-index");
            e.dataTransfer.effectAllowed = "move";
        },
        loadFile(file) {
            const preview = document.querySelectorAll(".preview");
            const blobUrl = URL.createObjectURL(file);

            preview.forEach(elem => {
                elem.onload = () => {
                    URL.revokeObjectURL(elem.src); // free memory
                };
            });

            return blobUrl;
        },
        addFiles(e) {
            const files = createFileList([...this.files], [...e.target.files]);
            this.files = files;
            this.form.formData.files = [...files];
        }
    };
}
</script>
@endpush
