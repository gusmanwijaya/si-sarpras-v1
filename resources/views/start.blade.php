<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gusman Wijaya</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="antialiased">
    <div class="flex item-center justify-center min-h-screen bg-gray-200 dark:bg-gray-700">
        <div class="w-5/12 my-auto">
            <div class="bg-white dark:bg-gray-800 shadow p-4 rounded-lg mb-6 flex items-center justify-between">
                <div class="font-semibold text-lg text-gray-800 dark:text-white">Switcher</div>
                <div>
                    <button onclick="setDarkMode(false)" class="w-4 h-4 bg-gray-200 rounded-full mr-2 focus:outline-none"></button>
                    <button onclick="setDarkMode(true)" class="w-4 h-4 bg-black rounded-full focus:outline-none"></button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="px-10 py-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 dark:text-white">Lorem ipsum dolor sit amet consectetur.</h1>
                    <div class="leading-relaxed text-gray-500 dark:text-gray-300 text-lg">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis id molestiae omnis eaque, quo dignissimos nihil reiciendis. Facere adipisci culpa eius. Voluptatibus nam odio accusantium error, architecto dignissimos nostrum praesentium!
                    </div>
                </div>
                <div class="px-10 py-6 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-900 dark:text-gray-200">
                    Lorem ipsum dolor sit amet.
                </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        if(localStorage.getItem('theme') == 'dark')
            setDarkMode(true)
        
        function setDarkMode(isDark) {
            if(isDark) {
                document.documentElement.classList.add('dark')
                localStorage.setItem('theme', 'dark')
            } else {
                document.documentElement.classList.remove('dark')
                localStorage.removeItem('theme')
            }
        }
    </script>
</body>
</html>