<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="font-sans antialiased">
    @if (session('success') || session('error'))
        <div class="fixed inset-x-0 bottom-0 z-50 flex justify-center">
            <div class="bg-green-500 text-white py-3 px-6 rounded-t-md shadow-md relative flex items-center gap-3">
                {{ session('success') ?? '' }}

                @if (session('error'))
                    @foreach (session('error') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

                <span class="cursor-pointer" id="closeNotification">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.293 5.293a1 1 0 011.414 1.414L11.414 11l4.293 4.293a1 1 0 01-1.414 1.414L10 12.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 11 4.293 6.707a1 1 0 111.414-1.414L10 9.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
        </div>
        <script>
            document.getElementById('closeNotification').addEventListener('click', function() {
                var notification = this.parentElement;
                notification.style.display = 'none';
            });
        </script>
    @endif



    <div class="flex min-h-screen bg-gray-200">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#FF1F00] text-white p-4 transform transition-transform duration-300 ease-in-out">
            <ul class="flex flex-col justify-center gap-2">

                <li>
                    <button id="toggleSidebar" class="focus:outline-none flex gap-3 items-center w-full justify-around">
                        <span class="sidebar-text font-bold">

                            <i class="fa fa-shopping-bag"></i> SIMS Web App
                        </span>
                        <i class="text-[22px] fa fa-bars aspect-square w-[40px] flex items-center justify-center"></i>

                    </button>
                </li>

                <li>
                    <hr class=" opacity-10 border-black">
                </li>
                <!-- Tambahkan tautan untuk rute dengan ikon dan nama menu -->
                <li>
                    <a href="{{ route('dashboard') }}" class="flex gap-3 items-center">
                        <i class="text-[22px] fa fa-home aspect-square w-[40px] flex items-center justify-center"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('produk') }}" class="flex gap-3 items-center">
                        <i
                            class="text-[22px] fa fa-archive aspect-square w-[40px] flex items-center justify-center"></i>
                        <span class="sidebar-text">Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profil') }}" class="flex gap-3 items-center">
                        <i class="text-[22px] fa fa-user aspect-square w-[40px] flex items-center justify-center"></i>
                        <span class="sidebar-text">Profil</span>
                    </a>
                </li>


                <li>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex gap-3 items-center">
                            <i
                                class="text-[22px] fa fa-sign-out aspect-square w-[40px] flex items-center justify-center"></i>
                            <span class="sidebar-text">Log Out</span>
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 transition-transform duration-300 ease-in-out">
            <!-- Page Heading -->
            <header class="bg-white shadow p-4">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-2xl font-semibold">{{ $header }}</h1>
                </div>
            </header>

            <!-- Page Content -->
            <div class="bg-white rounded-lg shadow p-4 mt-4 m-4">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- JavaScript untuk toggle sidebar -->
    <!-- JavaScript untuk toggle sidebar -->
    <script>
        const sidebar = document.querySelector('aside');
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebarText = document.querySelectorAll('.sidebar-text');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('w-64');
            // sidebar.classList.toggle('-translate-x-40'); // Sesuaikan lebar sidebar dengan kebutuhan Anda
            sidebarText.forEach(item => {
                item.classList.toggle('hidden'); // Menyembunyikan atau menampilkan teks menu
            });
        });
    </script>




    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
