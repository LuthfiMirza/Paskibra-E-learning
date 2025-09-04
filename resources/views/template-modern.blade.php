<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PASKIBRA E-Learning')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'paskibra-navy': '#1e3a8a',
                        'paskibra-red': '#dc2626',
                        'paskibra-gold': '#f59e0b'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        .progress-bar {
            background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-40">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Logo & Title -->
            <div class="flex items-center space-x-4">
                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 rounded-md hover:bg-gray-100" onclick="toggleSidebar()" aria-label="Toggle menu">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-red-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">P</span>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-gray-900">PASKIBRA</h1>
                        <p class="text-sm text-gray-600">WiraPurusa E-Learning</p>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input type="text" 
                           placeholder="Cari materi, quiz, pengumuman..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Notifications & User Profile -->
            <div class="flex items-center space-x-3">
                <!-- Notifications -->
                <div class="relative">
                    <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors relative" onclick="toggleNotifications()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                        </svg>
                        <!-- Notification Badge -->
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-600 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>
                    
                    <!-- Notifications Dropdown -->
                    <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                <button class="text-sm text-blue-600 hover:text-blue-800">Tandai semua dibaca</button>
                            </div>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <!-- Notification Item 1 -->
                            <div class="p-4 hover:bg-gray-50 border-b border-gray-100">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Materi baru tersedia</p>
                                        <p class="text-sm text-gray-600">Materi "Kepemimpinan PASKIBRA" telah ditambahkan</p>
                                        <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                                    </div>
                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                </div>
                            </div>
                            
                            <!-- Notification Item 2 -->
                            <div class="p-4 hover:bg-gray-50 border-b border-gray-100">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Quiz berhasil diselesaikan</p>
                                        <p class="text-sm text-gray-600">Anda mendapat nilai 85 pada Quiz Dasar Kepaskibraan</p>
                                        <p class="text-xs text-gray-500 mt-1">1 hari yang lalu</p>
                                    </div>
                                    <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                                </div>
                            </div>
                            
                            <!-- Notification Item 3 -->
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Pencapaian baru!</p>
                                        <p class="text-sm text-gray-600">Anda meraih lencana "Pembelajar Aktif"</p>
                                        <p class="text-xs text-gray-500 mt-1">2 hari yang lalu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border-t border-gray-200">
                            <a href="{{ route('notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="toggleUserMenu()">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->role ?? 'Administrator' }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name ?? 'SA', 0, 2) }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- User Dropdown Menu -->
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <!-- User Info -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ substr(auth()->user()->name ?? 'SA', 0, 2) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email ?? 'admin@paskibra.com' }}</p>
                                    <p class="text-xs text-gray-400">{{ auth()->user()->role ?? 'Administrator' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            
                            <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                                </svg>
                                Notifikasi
                                <span class="ml-auto bg-red-600 text-white text-xs px-2 py-1 rounded-full">3</span>
                            </a>
                            
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan
                            </a>
                            
                            <div class="border-t border-gray-200 my-2"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-16 bottom-0 w-64 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 sidebar-transition z-30">
        <div class="flex flex-col h-full">
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <!-- Menu Utama -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</h3>
                    
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('dashboard')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Pengumuman -->
                    <a href="{{ route('announcements.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('announcements.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                        </svg>
                        <span>Pengumuman</span>
                        <span class="ml-auto bg-red-600 text-white text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                </div>

                <!-- Pembelajaran -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Pembelajaran</h3>
                    
                    <a href="{{ route('courses.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('courses.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Materi Pembelajaran</span>
                    </a>
                    
                    <a href="{{ route('quizzes.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('quizzes.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Quiz Interaktif</span>
                    </a>
                    
                    <a href="{{ route('grades.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('grades.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Laporan Nilai</span>
                    </a>
                </div>

                <!-- Aktivitas -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas</h3>
                    
                    <a href="{{ route('rankings.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('rankings.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span>Ranking Kelas</span>
                    </a>
                    
                    <a href="{{ route('achievements.index') }}" class="flex items-center px-3 py-2 rounded-lg @if(request()->routeIs('achievements.*')) bg-blue-600 text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Pencapaian</span>
                        <span class="ml-auto bg-yellow-600 text-white text-xs px-2 py-1 rounded-full">6</span>
                    </a>
                </div>

                @if(auth()->user() && auth()->user()->role === 'admin')
                <!-- Management -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Management</h3>
                    
                    <a href="{{ route('admin.courses') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span>Kelola Kursus</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Kelola Quiz</span>
                    </a>
                </div>

                <!-- Admin -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Admin</h3>
                    
                    <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span>Kelola Pengguna</span>
                    </a>
                </div>
                @endif
            </nav>

            <!-- Profile Section -->
            <div class="p-4 border-t border-gray-700">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">{{ substr(auth()->user()->name ?? 'SA', 0, 2) }}</span>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                            <p class="text-blue-200 text-xs">Level 65%</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs text-blue-200">
                            <span>XP Progress</span>
                            <span>650/1000</span>
                        </div>
                        <div class="w-full bg-white/20 rounded-full h-2">
                            <div class="progress-bar h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 lg:hidden hidden z-20" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16 min-h-screen">
        <div class="p-6">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleNotifications() {
            const dropdown = document.getElementById('notifications-dropdown');
            const userDropdown = document.getElementById('user-dropdown');
            
            // Close user dropdown if open
            userDropdown.classList.add('hidden');
            
            // Toggle notifications dropdown
            dropdown.classList.toggle('hidden');
        }

        function toggleUserMenu() {
            const dropdown = document.getElementById('user-dropdown');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            
            // Close notifications dropdown if open
            notificationsDropdown.classList.add('hidden');
            
            // Toggle user dropdown
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            const userDropdown = document.getElementById('user-dropdown');
            
            const menuButton = event.target.closest('button[onclick="toggleSidebar()"]');
            const notificationButton = event.target.closest('button[onclick="toggleNotifications()"]');
            const userButton = event.target.closest('button[onclick="toggleUserMenu()"]');
            
            // Close sidebar when clicking outside on mobile
            if (!sidebar.contains(event.target) && !menuButton && !overlay.classList.contains('hidden')) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
            
            // Close notifications dropdown when clicking outside
            if (!notificationsDropdown.contains(event.target) && !notificationButton) {
                notificationsDropdown.classList.add('hidden');
            }
            
            // Close user dropdown when clicking outside
            if (!userDropdown.contains(event.target) && !userButton) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>