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
    {{-- START: Loader --}}
    @include('includes.loader-dots')
    {{-- END: Loader --}}

    {{-- START: Content --}}
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        @include('includes.sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('includes.header')
            <main class="h-full overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    {{-- END: Content --}}

    @yield('add-modal')

    @include('includes.footer')

    {{-- START: Script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
    {{-- END: Script --}}
</body>
</html>