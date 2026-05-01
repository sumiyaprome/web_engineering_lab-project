<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - Food Ordering System</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0ea5e9',
                        dark: '#1f2937',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            @apply antialiased;
        }

        .btn-primary {
            @apply bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors;
        }

        .btn-secondary {
            @apply bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors;
        }

        .card-gradient {
            @apply bg-gradient-to-br rounded-xl shadow-md hover:shadow-lg transition-shadow;
        }

        .nav-link {
            @apply text-gray-600 hover:text-sky-500 transition-colors font-medium;
        }

        .nav-link.active {
            @apply text-sky-500 border-b-2 border-sky-500;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-sky-500 flex items-center gap-2">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        FoodHub
                    </a>
                </div>

                <!-- Navigation Links -->
                @if(auth()->check())
                    <div class="hidden md:flex items-center gap-8">
                        <span class="text-sm text-gray-600">Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span></span>
                        
                        <div class="flex items-center gap-6">
                            @if(auth()->user()->role === 'Administrator')
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                                <a href="{{ route('admin.orders.index') }}" class="nav-link">Orders</a>
                                <a href="{{ route('admin.items.index') }}" class="nav-link">Items</a>
                                <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                                <a href="{{ route('admin.tickets.index') }}" class="nav-link">Tickets</a>
                            @else
                                <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                                <a href="{{ route('menu.index') }}" class="nav-link">Menu</a>
                                <a href="{{ route('orders.index') }}" class="nav-link">Orders</a>
                                <a href="{{ route('wallet.show') }}" class="nav-link">Wallet</a>
                                <a href="{{ route('tickets.index') }}" class="nav-link">Support</a>
                            @endif
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600 font-semibold transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-green-800">Success</p>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-red-800">Error</p>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-bold text-sky-400 mb-4">FoodHub</h3>
                    <p class="text-gray-400 text-sm">Your favorite food ordering system, now in Laravel.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">About</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-sky-400 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Feedback</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-sky-400 transition">Privacy</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Terms</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <p class="text-center text-gray-400 text-sm">&copy; 2026 FoodHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
