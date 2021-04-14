<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- START: Style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
    {{-- END: Style --}}
</head>
<body class="antialiased">
    {{-- START: Content --}}
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900" data-aos="fade-in">
        <div
          class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
        >
          <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="hidden md:block h-32 md:h-auto md:w-1/2">
              @yield('content-img')
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
              <div class="w-full">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
    {{-- END: Content --}}

    {{-- START: Script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
    {{-- END: Script --}}
</body>
</html>