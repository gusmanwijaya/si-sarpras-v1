<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Not Found</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="shortcut icon" href="{{ asset('img/logo-mtsn1.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo-mtsn1.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-mtsn1.png') }}">
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
  </head>
  <body class="antialiased">
    <div class="h-screen w-screen bg-gray-50 dark:bg-gray-900 flex items-center">
      <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
        <div class="max-w-md">
          <div class="text-5xl font-dark font-bold text-indigo-400 dark:text-indigo-600">404</div>
            <p
              class="text-2xl md:text-3xl font-light leading-normal text-black dark:text-white"
            >Maaf kami tidak bisa menemukan halaman ini. </p>
            <p class="mb-8 text-gray-400 dark:text-gray-600">Tapi jangan khawatir, kamu bisa kembali ke halaman sebelumnya.</p>
          
            <a href="{{ url()->previous() }}" class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-indigo bg-indigo-400 dark:bg-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-800">
              Kembali
            </a>
        </div>
        <div class="max-w-lg">
          <img src="{{ asset('img/404.png') }}" alt="404 - Not Found" class="dark:hidden">
          <img src="{{ asset('img/404-dark.png') }}" alt="404 - Not Found" class="hidden dark:block">
        </div>
        
      </div>
    </div>
  </body>
</html>
