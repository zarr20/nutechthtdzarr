<!-- resources/views/layouts/sidebar.blade.php -->

<div
    class="fixed inset-y-0 left-0 w-[300px] bg-gray-900 text-white p-4 transition-transform duration-300 ease-in-out transform -translate-x-0">
    <!-- Sidebar content -->
    <ul>
        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('profil') }}"><i class="fas fa-user"></i> User</a></li>
        <li><a href="{{ route('produk') }}"><i class="fas fa-user"></i> Produk</a></li>

        <li>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                    <i class="fas fa-user"></i> {{ __('Log Out') }}
                </a>
            </form>
        </li>

    </ul>
    <div class="absolute bottom-4 left-4">
        <button id="toggleSidebar" class="bg-gray-700 p-2 rounded-full focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
        </button>
    </div>
</div>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.querySelector('.fixed');
        sidebar.classList.toggle('-translate-x-0'); // Perubahan di sini
        sidebar.classList.toggle('-translate-x-[300px]'); // Perubahan di sini
    });
</script>
