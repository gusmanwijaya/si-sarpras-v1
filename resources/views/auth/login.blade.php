@extends('layouts.auth')

@section('title')
    Login - Sistem Informasi Sarana dan Prasarana
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
  Sistem Informasi Sarana dan Prasarana
</h1>
<form action="{{ route('store-login') }}" method="POST">
  @csrf
  <label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">Email</span>
    <input
      name="email" id="email"
      class="block w-full mt-1 text-sm border border-purple-300 border-opacity-30 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray  form-input @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}"
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
      class="block w-full mt-1 text-sm border border-purple-300 border-opacity-30 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray  form-input @error('password') is-invalid @enderror" type="password" value="{{ old('password') }}"
    />
    @error('password')
      <span class="text-xs text-red-600 dark:text-red-400">
          {{ $message }}
      </span>
    @enderror
  </label>

  <!-- You should use a button here, as the anchor is only used for the example  -->
  <button
  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  type="submit"
  >
  Log in
  </button>
</form>

<hr class="my-8">

<p class="mt-4 text-center">
  <a
    class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
    href="{{ route('password.request') }}"
  >
    Lupa Password
  </a>
</p>
@endsection