@extends('layouts.auth')

@section('title')
    Login - Sistem Informasi Sarana dan Prasarana
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
  Sistem Informasi Sarana dan Prasarana
</h1>
<form action="{{ route('store-login') }}" method="POST">
  @csrf
  <label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">Username</span>
    <input
      name="username" id="username"
      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input @error('username') is-invalid @enderror" type="text" value="{{ old('username') }}"
    />
    @error('username')
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
      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input @error('password') is-invalid @enderror" type="password" value="{{ old('password') }}"
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
@endsection