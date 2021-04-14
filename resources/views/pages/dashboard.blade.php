@extends('layouts.app')

@section('title')
    Dashboard - Sistem Informasi Sarana dan Prasarana
@endsection

@section('content')
<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 text-center">
    Dashboard
  </h2>

  <!-- Alert Info -->
  <div class="bg-blue-200 px-6 py-4 mb-6 rounded-md text-lg flex items-center mx-auto w-full">
    <svg
        viewBox="0 0 24 24"
        class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"
        >
    <path
          fill="currentColor"
          d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"
          ></path>
    </svg>
    <span class="text-blue-800"> Hai, selamat datang <b>{{ auth()->user()->name }}</b>. </span>
  </div>
  <!-- End Alert Info -->

  <!-- Cards -->
  <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div
      class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
      <div
        class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
      >
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
      </div>
      <div>
        <p
          class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
          Ruangan
        </p>
        <p
          class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
          {{ totalRuangan() }}
        </p>
      </div>
    </div>
    <!-- Card -->
    <div
      class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
      <div
        class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
      >
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
      </div>
      <div>
        <p
          class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
          Barang Baik
        </p>
        <p
          class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
          {{ totalBarangBaik() }}
        </p>
      </div>
    </div>
    <!-- Card -->
    <div
      class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
      <div
        class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
      >
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
        </svg>
      </div>
      <div>
        <p
          class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
          Barang Rusak Ringan
        </p>
        <p
          class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
          {{ totalBarangRusakRingan() }}
        </p>
      </div>
    </div>
    <!-- Card -->
    <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
  >
    <div
      class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
    >
      <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
      </svg>
    </div>
    <div>
      <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
      >
        Barang Rusak Berat
      </p>
      <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
      >
        {{ totalBarangRusakBerat() }}
      </p>
    </div>
  </div>
  </div>
</div>
@endsection