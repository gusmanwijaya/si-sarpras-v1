@extends('layouts.auth')

@section('title')
    Lupa Password - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content-img')
<img
    aria-hidden="true"
    class="object-cover w-full h-full dark:hidden"
    src="{{ asset('img/sekolah.jpg') }}"
    alt="Office"
/>
<img
    aria-hidden="true"
    class="hidden object-cover w-full h-full dark:block"
    src="{{ asset('img/sekolah.jpg') }}"
    alt="Office"
/>
@endsection

@section('content')
<h1 class="text-center mb-10 text-xl font-semibold text-gray-700 dark:text-gray-200">
  Lupa Password
</h1>

<form action="{{ route('password.update') }}" method="POST">
  @csrf

  <input type="hidden" name="token" value="{{ $token }}">

  <label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">Email</span>
    <input
      name="email" id="email"
      class="block w-full mt-1 text-sm border border-purple-300 border-opacity-30 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray  form-input @error('email') is-invalid @enderror" type="email" value="{{ $email ?? old('email') }}" required
    />
    @error('email')
      <span class="text-xs text-red-600 dark:text-red-400">
          {{ $message }}
      </span>
    @enderror
  </label>

  <label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">Password</span>
    <input
      name="password"
      id="password"
      class="block w-full mt-1 text-sm border border-purple-300 border-opacity-30 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray  form-input @error('password') is-invalid @enderror" type="password" required
    />
    @error('password')
      <span class="text-xs text-red-600 dark:text-red-400">
          {{ $message }}
      </span>
    @enderror
  </label>

  <label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">Konfirmasi Password</span>
    <input
      name="password_confirmation"
      id="password_confirmation"
      class="block w-full mt-1 text-sm border border-purple-300 border-opacity-30 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray  form-input @error('password_confirmation') is-invalid @enderror" type="password" required
    />
    @error('password_confirmation')
      <span class="text-xs text-red-600 dark:text-red-400">
          {{ $message }}
      </span>
    @enderror
  </label>

  <button
  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  type="submit"
  >
  Reset Password
  </button>

  <a
  class="block w-full px-4 py-2 mt-3 text-sm font-medium leading-5 text-center text-purple-600 dark:text-white transition-colors duration-150 bg-transparent border-2 bg-opacity-25 hover:border-purple-400 rounded-lg focus:outline-none focus:shadow-outline-purple"
  href="{{ route('login') }}"
  >
  Kembali
  </a>
</form>
@endsection