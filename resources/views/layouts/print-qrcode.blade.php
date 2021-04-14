<!DOCTYPE html>
<html lang="en">
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
    <div
      class="flex h-screen"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                @yield('content')
            </main>
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