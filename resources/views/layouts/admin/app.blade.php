<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
    <div class=" relative">

     <div>
        <!-- sidebar desktop -->
        <x-admin.sideBar/>
     
     </div>
    <div class="flex-1 lg:ml-72 overflow-y-auto">
        @yield('content')
    </div>
    <!-- <footer class="fixed bottom-0 left-0 w-full bg-white p-4 text-center">
        <p>Footer</p>
    </footer> -->
    </div>
</body>
</html>
