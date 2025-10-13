<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PASKIBRA WiraPurusa E-Learning') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&family=montserrat:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Enhanced PASKIBRA Design System */
        .sidebar-gradient {
            background: linear-gradient(180deg, #1B365D 0%, #0F172A 100%);
            position: relative;
        }

        .sidebar-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(220, 38, 38, 0.1) 0%, transparent 50%, rgba(245, 158, 11, 0.1) 100%);
            pointer-events: none;
        }

        /* Sidebar Fixed Positioning */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 18rem;
            z-index: 50;
            overflow-y: auto;
        }

        /* Main content with proper margin for sidebar */
        .main-content {
            margin-left: 18rem;
            min-height: 100vh;
        }

        /* Mobile responsive */
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

        /* Enhanced Navigation Items */
        .nav-item {
            position: relative;
            overflow: hidden;
            margin: 0.25rem 0;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, #F59E0B 0%, #FCD34D 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 2px 2px 0;
        }

        .nav-item.active::before,
        .nav-item:hover::before {
            transform: scaleY(1);
        }

        .nav-item.active {
            background: rgba(245, 158, 11, 0.15) !important;
            border-left: 4px solid #F59E0B;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(2px);
        }

        /* Enhanced Badges */
        .nav-badge {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .nav-badge.success {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
        }

        .nav-badge.warning {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
        }

        /* Enhanced Header */
        .header-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(249, 250, 251, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(27, 54, 93, 0.1);
        }

        /* Enhanced Search */
        .search-input {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(27, 54, 93, 0.1);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 1);
            border-color: #1B365D;
            box-shadow: 0 0 0 3px rgba(27, 54, 93, 0.1), 0 4px 12px rgba(27, 54, 93, 0.15);
        }

        /* Enhanced Notifications */
        .notification-badge {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            animation: pulse-notification 2s infinite;
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }

        @keyframes pulse-notification {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* Enhanced Dropdowns */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(27, 54, 93, 0.1);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Enhanced User Level Progress */
        .level-progress {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(252, 211, 77, 0.2) 100%);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .level-progress-bar {
            background: linear-gradient(135deg, #F59E0B 0%, #FCD34D 100%);
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
        }

        /* Scrollbar styling for sidebar */
        .sidebar.dark-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar.dark-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar.dark-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(245, 158, 11, 0.5);
            border-radius: 3px;
        }

        .sidebar.dark-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(245, 158, 11, 0.7);
        }

        /* Mobile Menu Overlay */
        .mobile-menu-overlay {
            background: rgba(27, 54, 93, 0.5);
            backdrop-filter: blur(8px);
        }

        /* Enhanced Logo Section */
        .logo-section {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(27, 54, 93, 0.2) 100%);
            border-bottom: 1px solid rgba(245, 158, 11, 0.2);
        }

        /* Patriotic Accent Lines */
        .patriotic-accent {
            background: linear-gradient(90deg, #DC2626 0%, #1B365D 50%, #F59E0B 100%);
            height: 3px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 z-40 mobile-menu-overlay hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar sidebar-gradient">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 bg-black bg-opacity-20 px-6">
            <div class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('images/logopaskib.jpg') }}" alt="PASKIBRA Logo" onerror="this.src='{{ asset('images/paskibra/new_logo.jpg') }}'">
                <div>
                    <div class="text-white font-bold text-lg font-display">PASKIBRA</div>
                    <div class="text-blue-200 text-xs">WiraPurusa E-Learning</div>
                </div>
            </div>
            <button id="close-sidebar" class="lg:hidden text-white hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-8 px-4 space-y-2 pb-20">
            <!-- Main Section -->
            <div class="space-y-1">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
                
                <!-- Dashboard Home -->
                <a href="{{ route('dashboard') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'active bg-white bg-opacity-10 border-l-4 border-yellow-400' : 'hover:bg-white hover:bg-opacity-10' }}">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Pengumuman -->
                <a href="{{ route('announcements.index') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg transition-all {{ request()->routeIs('announcements.*') ? 'active bg-white bg-opacity-10 border-l-4 border-yellow-400' : 'hover:bg-white hover:bg-opacity-10' }}">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    <span class="font-medium">Pengumuman</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium">3</span>
                </a>
            </div>

            <!-- Pembelajaran Section -->
            <div class="pt-4 border-t border-white border-opacity-20">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Pembelajaran</p>
                
                <a href="{{ url('/courses') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="font-medium">Materi Pembelajaran</span>
                </a>

                <a href="{{ route('quizzes.index') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg transition-all {{ request()->routeIs('quizzes.*') ? 'active bg-white bg-opacity-10 border-l-4 border-yellow-400' : 'hover:bg-white hover:bg-opacity-10' }}">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">Quiz Interaktif</span>
                </a>

                <a href="{{ url('/grades') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">Laporan Nilai</span>
                </a>
            </div>

            <!-- Aktivitas Section -->
            <div class="pt-4 border-t border-white border-opacity-20">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas</p>
                
                <a href="{{ url('/rankings') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="font-medium">Ranking Kelas</span>
                    <span class="ml-auto text-green-400 text-xs">
                        <i class="fas fa-arrow-up"></i>
                    </span>
                </a>

                <a href="{{ url('/achievements') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="font-medium">Pencapaian</span>
                    <span class="ml-auto bg-yellow-500 text-yellow-900 text-xs px-2 py-1 rounded-full font-medium">🏆</span>
                </a>
            </div>

            @if(auth()->user()->isInstructor() || auth()->user()->isAdmin())
                <!-- Management Section -->
                <div class="pt-4 border-t border-white border-opacity-20">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Management</p>
                    
                    <a href="#" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="font-medium">Kelola Kursus</span>
                    </a>
                    
                    <a href="#" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Kelola Quiz</span>
                    </a>
                </div>
            @endif

            @if(auth()->user()->isAdmin())
                <div class="pt-4 border-t border-white border-opacity-20">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Admin</p>
                    
                    <a href="#" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span class="font-medium">Kelola Pengguna</span>
                    </a>
                </div>
            @endif

            <!-- Profile Section -->
            <div class="pt-4 border-t border-white border-opacity-20">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Profil</p>
                
                <a href="{{ route('profile.edit') }}" class="nav-item group flex items-center px-4 py-3 text-white rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Profil Saya</span>
                </a>
            </div>
        </nav>

        <!-- Bottom Section - User Level -->
        <div class="absolute bottom-0 w-full p-4">
            <div class="bg-white bg-opacity-10 rounded-lg p-4 text-center backdrop-blur-sm">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-white text-sm font-medium">🏆 Level: {{ ucfirst(auth()->user()->getRoleNames()->first()) }}</p>
                    <span class="text-yellow-400 text-xs font-bold">65%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2 mb-2">
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-2 rounded-full transition-all duration-500" style="width: 65%"></div>
                </div>
                <p class="text-xs text-gray-300">650/1000 XP</p>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Left Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- Page Title -->
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 font-display">@yield('title', 'Dashboard')</h1>
                            <p class="text-sm text-gray-600 hidden sm:block">@yield('subtitle', 'Selamat datang di PASKIBRA WiraPurusa E-Learning')</p>
                        </div>
                    </div>

                    <!-- Search Bar (Desktop) -->
                    <div class="hidden md:flex flex-1 max-w-lg mx-8">
                        <div class="relative w-full">
                            <input type="text" 
                                   placeholder="Cari materi, quiz, pengumuman..." 
                                   class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button id="notifications-dropdown-button" class="relative p-2 text-gray-400 hover:text-gray-600 transition-all duration-200 hover-lift group">
                                <!-- Enhanced Bell Icon -->
                                <div class="relative">
                                    <svg class="h-6 w-6 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V9a9 9 0 10-18 0v3l-5 5h5a9 9 0 0018 0z" />
                                    </svg>
                                    <!-- Notification Badge -->
                                    <span id="notification-badge" class="absolute -top-2 -right-2 h-5 w-5 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs rounded-full flex items-center justify-center font-bold shadow-lg badge-pulse">
                                        4
                                    </span>
                                    <!-- Pulse Ring -->
                                    <span class="absolute -top-2 -right-2 h-5 w-5 bg-red-400 rounded-full animate-ping opacity-75"></span>
                                </div>
                            </button>

                            <!-- Notifications Dropdown Menu -->
                            <div id="notifications-dropdown-menu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                <!-- Header -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                        <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            Tandai Semua Dibaca
                                        </button>
                                    </div>
                                </div>

                                <!-- Notifications List -->
                                <div class="max-h-96 overflow-y-auto">
                                    <!-- Notification Item 1 -->
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">
                                                    Pengumuman Baru: Latihan Rutin Minggu Ini
                                                </p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Latihan rutin akan dilaksanakan pada hari Sabtu, 4 Januari 2025 pukul 07:00 WIB.
                                                </p>
                                                <p class="text-xs text-gray-400 mt-2">2 jam yang lalu</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notification Item 2 -->
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">
                                                    Quiz "Sejarah PASKIBRA" Selesai
                                                </p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Selamat! Anda telah menyelesaikan quiz dengan nilai 85%. 
                                                </p>
                                                <p class="text-xs text-gray-400 mt-2">5 jam yang lalu</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notification Item 3 -->
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">
                                                    Reminder: Deadline Tugas Besok
                                                </p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Jangan lupa untuk mengumpulkan tugas "Analisis Gerakan PBB" sebelum pukul 23:59.
                                                </p>
                                                <p class="text-xs text-gray-400 mt-2">1 hari yang lalu</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notification Item 4 (Read) -->
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors opacity-60">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-700">
                                                    Materi Baru: "Teknik Dasar PBB"
                                                </p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Materi pembelajaran baru telah ditambahkan ke kursus Anda.
                                                </p>
                                                <p class="text-xs text-gray-400 mt-2">3 hari yang lalu</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                                    <a href="#" class="block text-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Lihat Semua Notifikasi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button id="profile-dropdown-button" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all hover-lift">
                                <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1B365D&color=fff" alt="Profile">
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->getRoleNames()->first()) }}</p>
                                </div>
                                <svg id="profile-dropdown-arrow" class="hidden md:block w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <!-- User Info Header -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1B365D&color=fff" alt="Profile">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                {{ ucfirst(auth()->user()->getRoleNames()->first()) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profil Saya
                                    </a>

                                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        </svg>
                                        Dashboard
                                    </a>

                                    <a href="{{ route('quizzes.history') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Riwayat Quiz
                                    </a>

                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Pengaturan
                                    </a>
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-gray-100 my-1"></div>

                                <!-- Logout Button -->
                                <div class="py-1">
                                    <button onclick="document.getElementById('logout-form').submit();" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Keluar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript for Mobile Menu, Notifications, and Profile Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeSidebarButton = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileMenuButton?.addEventListener('click', openSidebar);
            closeSidebarButton?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });

            // Notifications Dropdown
            const notificationsDropdownButton = document.getElementById('notifications-dropdown-button');
            const notificationsDropdownMenu = document.getElementById('notifications-dropdown-menu');

            function toggleNotificationsDropdown() {
                const isHidden = notificationsDropdownMenu.classList.contains('hidden');
                
                // Close profile dropdown if open
                closeProfileDropdown();
                
                if (isHidden) {
                    notificationsDropdownMenu.classList.remove('hidden');
                } else {
                    notificationsDropdownMenu.classList.add('hidden');
                }
            }

            function closeNotificationsDropdown() {
                notificationsDropdownMenu.classList.add('hidden');
            }

            notificationsDropdownButton?.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleNotificationsDropdown();
            });

            // Profile Dropdown
            const profileDropdownButton = document.getElementById('profile-dropdown-button');
            const profileDropdownMenu = document.getElementById('profile-dropdown-menu');
            const profileDropdownArrow = document.getElementById('profile-dropdown-arrow');

            function toggleProfileDropdown() {
                const isHidden = profileDropdownMenu.classList.contains('hidden');
                
                // Close notifications dropdown if open
                closeNotificationsDropdown();
                
                if (isHidden) {
                    profileDropdownMenu.classList.remove('hidden');
                    profileDropdownArrow.style.transform = 'rotate(180deg)';
                } else {
                    profileDropdownMenu.classList.add('hidden');
                    profileDropdownArrow.style.transform = 'rotate(0deg)';
                }
            }

            function closeProfileDropdown() {
                profileDropdownMenu.classList.add('hidden');
                profileDropdownArrow.style.transform = 'rotate(0deg)';
            }

            profileDropdownButton?.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleProfileDropdown();
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationsDropdownButton.contains(e.target) && !notificationsDropdownMenu.contains(e.target)) {
                    closeNotificationsDropdown();
                }
                if (!profileDropdownButton.contains(e.target) && !profileDropdownMenu.contains(e.target)) {
                    closeProfileDropdown();
                }
            });

            // Close dropdowns when pressing Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeNotificationsDropdown();
                    closeProfileDropdown();
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