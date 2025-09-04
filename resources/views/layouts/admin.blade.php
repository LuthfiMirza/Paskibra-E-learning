<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PASKIBRA Admin') }} - @yield('title', 'Admin Panel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js for dashboard graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-bg: #f3f4f6; /* Light Gray */
            --admin-panel-bg: #ffffff; /* White */
            --admin-sidebar-bg: #ffffff; /* White */
            --admin-text-primary: #1f2937; /* Dark Gray */
            --admin-text-secondary: #6b7280; /* Medium Gray */
            --admin-primary: #3b82f6; /* Blue */
            --admin-border: #e5e7eb; /* Light Gray Border */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text-primary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .font-display {
            font-family: 'Poppins', 'Inter', sans-serif;
        }

        /* New Light Sidebar */
        .admin-sidebar {
            background: var(--admin-sidebar-bg);
            border-right: 1px solid var(--admin-border);
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
            color: var(--admin-text-secondary);
            font-weight: 500;
        }

        .admin-nav-item:hover {
            background-color: #f3f4f6; /* Light gray hover */
            color: var(--admin-text-primary);
        }

        .admin-nav-item.active {
            background-color: #e0e7ff; /* Light blue background */
            color: var(--admin-primary);
        }

        .admin-nav-item .nav-icon {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
        }

        /* New Light Header */
        .admin-header {
            background: var(--admin-panel-bg);
            border-bottom: 1px solid var(--admin-border);
        }

        /* New Card Style */
        .admin-card {
            background: var(--admin-panel-bg);
            border-radius: 0.75rem;
            border: 1px solid var(--admin-border);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        /* General Layout */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 16rem; /* 256px */
            z-index: 50;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 16rem;
            min-height: 100vh;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-admin-bg font-sans antialiased">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-25 hidden lg:hidden"></div>

    <!-- Admin Sidebar -->
    <aside id="sidebar" class="sidebar admin-sidebar">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-admin-border">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                         <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-xl font-semibold text-gray-800 font-display">Admin Panel</span>
            </div>
        </div>

        <!-- Admin Navigation -->
        <nav class="mt-6 px-4 space-y-1">
            <a href="{{ route('admin.index') }}" class="admin-nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="admin-nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-4.5A2.5 2.5 0 019 3.5V1m0 18v-2.5a2.5 2.5 0 015 0V21m-5-18a2.5 2.5 0 00-5 0V3.5"></path></svg>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.courses.index') }}" class="admin-nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span>Courses</span>
            </a>
            <a href="{{ route('admin.quizzes.index') }}" class="admin-nav-item {{ request()->routeIs('admin.quizzes.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Quizzes</span>
            </a>
             <a href="{{ route('admin.reports') }}" class="admin-nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span>Reports</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="admin-nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Settings</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Admin Header -->
        <header class="admin-header sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>

                    <!-- Search Bar -->
                    <div class="flex-1 ml-4 lg:ml-0">
                        <div class="relative w-full max-w-xs">
                             <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                             <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-500 hover:text-gray-800 rounded-full hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Admin Profile Dropdown -->
                        <div class="relative">
                            <button id="admin-profile-dropdown" class="flex items-center space-x-2">
                                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'A') }}&background=3b82f6&color=fff" alt="User avatar">
                                <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                                <svg class="hidden md:inline w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="admin-profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Student Portal</a>
                                <div class="border-t border-gray-100"></div>
                                <button onclick="document.getElementById('logout-form').submit();" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const setupDropdown = (triggerId, menuId) => {
                const trigger = document.getElementById(triggerId);
                const menu = document.getElementById(menuId);
                if (trigger && menu) {
                    trigger.addEventListener('click', (e) => {
                        e.stopPropagation();
                        menu.classList.toggle('hidden');
                    });
                }
            };

            setupDropdown('admin-profile-dropdown', 'admin-profile-menu');

            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            if (mobileMenuButton && sidebar && overlay) {
                mobileMenuButton.addEventListener('click', () => {
                    sidebar.classList.add('open');
                    overlay.classList.remove('hidden');
                });
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.add('hidden');
                });
            }

            document.addEventListener('click', (e) => {
                const menu = document.getElementById('admin-profile-menu');
                const trigger = document.getElementById('admin-profile-dropdown');
                if (menu && trigger && !menu.contains(e.target) && !trigger.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
        @csrf
    </form>
</body>
</html>