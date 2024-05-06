<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @include('layouts.favicon')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased overflow-hidden bg-dark">
    <!-- Page Content -->
    <div class="flex h-screen overflow-hidden">
        @include('navigation/admin-navigation')
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
                <div class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 2xl:px-11">
                    <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                        <!-- Hamburger Toggle BTN -->
                        <button
                            class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
                            @click.stop="sidebarToggle = !sidebarToggle">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="relative block h-5.5 w-5.5 cursor-pointer">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.82251 5.20374C3.82251 4.93852 3.92787 4.68417 4.1154 4.49663C4.30294 4.30909 4.55729 4.20374 4.82251 4.20374H16.8225C17.0877 4.20374 17.3421 4.30909 17.5296 4.49663C17.7172 4.68417 17.8225 4.93852 17.8225 5.20374C17.8225 5.46895 17.7172 5.72331 17.5296 5.91084C17.3421 6.09838 17.0877 6.20374 16.8225 6.20374H4.82251C4.55729 6.20374 4.30294 6.09838 4.1154 5.91084C3.92787 5.72331 3.82251 5.46895 3.82251 5.20374ZM3.82251 10.2037C3.82251 9.93852 3.92787 9.68417 4.1154 9.49663C4.30294 9.30909 4.55729 9.20374 4.82251 9.20374H16.8225C17.0877 9.20374 17.3421 9.30909 17.5296 9.49663C17.7172 9.68417 17.8225 9.93852 17.8225 10.2037C17.8225 10.469 17.7172 10.7233 17.5296 10.9108C17.3421 11.0984 17.0877 11.2037 16.8225 11.2037H4.82251C4.55729 11.2037 4.30294 11.0984 4.1154 10.9108C3.92787 10.7233 3.82251 10.469 3.82251 10.2037ZM3.82251 15.2037C3.82251 14.9385 3.92787 14.6842 4.1154 14.4966C4.30294 14.3091 4.55729 14.2037 4.82251 14.2037H16.8225C17.0877 14.2037 17.3421 14.3091 17.5296 14.4966C17.7172 14.6842 17.8225 14.9385 17.8225 15.2037C17.8225 15.469 17.7172 15.7233 17.5296 15.9108C17.3421 16.0984 17.0877 16.2037 16.8225 16.2037H4.82251C4.55729 16.2037 4.30294 16.0984 4.1154 15.9108C3.92787 15.7233 3.82251 15.469 3.82251 15.2037Z"
                                    fill="black" />
                            </svg>
                        </button>
                        <!-- Hamburger Toggle BTN -->
                        <a class="block flex-shrink-0 lg:hidden" href="{{ route('admin.index') }}">
                            <img src="{{ asset('brand.svg') }}" class="h-8" alt="The 1%">
                        </a>
                    </div>
                </div>
            </header>

            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div class="mx-auto max-w-270">
                        <!-- Breadcrumb Start -->
                        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                                Settings Page
                            </h2>
                            <nav>
                                <ol class="flex items-center gap-2 text-black dark:text-white">
                                    <li>
                                        <a class="font-medium" href="{{ route('admin.index') }}">Dashboard /</a>
                                    </li>
                                    <li class="font-medium">Settings</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Breadcrumb End -->

                        <!-- Section Start -->
                        @yield('content')
                        <!-- Section End -->
                    </div>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
</body>
@stack('scripts')

</html>
