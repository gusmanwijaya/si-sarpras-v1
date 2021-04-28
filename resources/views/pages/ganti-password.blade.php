@extends('layouts.app')

@section('title')
    Ganti Password - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container mx-auto px-6 my-8">
    <h3 class="text-black text-2xl font-medium text-center dark:text-white">Ganti Password</h3>
    <h6 class="mt-1 mb-10 text-center text-xs text-gray-600">Jangan pernah berikan password anda ke siapapun.</h6>
    <form action="{{ route('store-ganti-password', $users->id) }}" method="POST">
        @csrf
        <div class="px-4 py-3 mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm mb-4">
            <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                    <input
                    name="password_lama"
                    id="password_lama"
                    type="password"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="Password lama"
                    />
                    <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                </div>
                @error('password_lama')
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
                    name="password_baru"
                    id="password_baru"
                    type="password"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input @error('password_baru') is-invalid @enderror"
                    placeholder="Password baru"
                    />
                    <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                      </svg>
                    </div>
                </div>
                @error('password_baru')
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
                        name="password_konfirmasi"
                        id="password_konfirmasi"
                        type="password"
                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input @error('password_konfirmasi') is-invalid @enderror"
                        placeholder="Konfirmasi password"
                        />
                        <div
                        class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                        >
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                          </svg>
                        </div>
                    </div>
                    @error('password_konfirmasi')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror
                    </label>
        </div>

        <div class="flex space-x-4 mt-4">
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
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-400 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none"
            >
                <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <span>Ganti Password</span>
            </button>
        </div>
    </form>
</div>
@endsection