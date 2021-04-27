@extends('layouts.auth')

@section('title')
    Verify Email - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content-img')
<img
    aria-hidden="true"
    class="object-cover w-full h-full dark:hidden"
    src="{{ asset('img/login.png') }}"
    alt="Office"
/>
<img
    aria-hidden="true"
    class="hidden object-cover w-full h-full dark:block"
    src="{{ asset('img/login-dark.png') }}"
    alt="Office"
/>
@endsection

@section('content')
<h1 class="text-center mb-10 text-xl font-semibold text-gray-700 dark:text-gray-200">
  Verifikasi Email
</h1>
<form action="{{ route('verification.resend') }}" method="POST">
  @csrf
  <p class="text-sm text-center font-medium text-purple-600 dark:text-purple-400">{{ auth()->user()->email }}</p>

  <p class="my-4 text-xs font-extralight text-red-600 dark:text-red-400 text-center">
    Email anda belum diverifikasi, untuk dapat mengakses sistem, anda harus melakukan verifikasi terlebih dahulu!
  </p>

  <button
  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  type="submit"
  >
  Kirim verifikasi
  </button>

  <a
  class="block w-full px-4 py-2 mt-3 text-sm font-medium leading-5 text-center text-purple-600 transition-colors duration-150 bg-transparent border-2 bg-opacity-25 hover:border-purple-400 rounded-lg focus:outline-none focus:shadow-outline-purple"
  href="{{ route('logout') }}"
  >
  Logout
  </a>
</form>
@endsection