<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - PASKIBRA E-Learning</title>
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
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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

            <!-- User Profile -->
            <div class="flex items-center space-x-3">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->role ?? 'Administrator' }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name ?? 'SA', 0, 2) }}</span>
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
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Pengumuman - Active -->
                    <a href="{{ route('announcements.index') }}" class="flex items-center px-3 py-2 rounded-lg bg-blue-600 text-white">
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
                    
                    <a href="{{ route('courses.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Materi Pembelajaran</span>
                    </a>
                    
                    <a href="{{ route('quizzes.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Quiz Interaktif</span>
                    </a>
                    
                    <a href="{{ route('grades.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Laporan Nilai</span>
                    </a>
                </div>

                <!-- Aktivitas -->
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Aktivitas</h3>
                    
                    <a href="{{ route('rankings.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span>Ranking Kelas</span>
                    </a>
                    
                    <a href="{{ route('achievements.index') }}" class="flex items-center px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
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
            <!-- Page Header -->
            <div class="mb-8">
                <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-red-600">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600/10 via-transparent to-yellow-500/10"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold">Pengumuman</h1>
                                <p class="text-lg text-white/90">Informasi terbaru dan penting untuk anggota PASKIBRA WiraPurusa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <form method="GET" action="{{ route('announcements.index') }}" class="space-y-4 md:space-y-0 md:flex md:items-center md:space-x-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari pengumuman..." 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div class="md:w-48">
                        <select name="type" class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            @if(isset($types))
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}" {{ request('type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            @else
                                <option value="all">Semua Jenis</option>
                                <option value="urgent">Mendesak</option>
                                <option value="important">Penting</option>
                                <option value="event">Kegiatan</option>
                                <option value="general">Umum</option>
                            @endif
                        </select>
                    </div>

                    <!-- Search Button -->
                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Cari</span>
                    </button>

                    @if(request('search') || request('type') != 'all')
                        <a href="{{ route('announcements.index') }}" class="w-full md:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>Reset</span>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Quick Type Filters -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('announcements.type', 'urgent') }}" class="bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg p-4 text-center transition-colors group">
                    <div class="text-2xl mb-2">🚨</div>
                    <h3 class="font-semibold text-red-800 group-hover:text-red-900">Mendesak</h3>
                    <p class="text-sm text-red-600">Perlu perhatian segera</p>
                </a>
                
                <a href="{{ route('announcements.type', 'important') }}" class="bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-lg p-4 text-center transition-colors group">
                    <div class="text-2xl mb-2">⚠️</div>
                    <h3 class="font-semibold text-yellow-800 group-hover:text-yellow-900">Penting</h3>
                    <p class="text-sm text-yellow-600">Informasi penting</p>
                </a>
                
                <a href="{{ route('announcements.type', 'event') }}" class="bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg p-4 text-center transition-colors group">
                    <div class="text-2xl mb-2">📅</div>
                    <h3 class="font-semibold text-green-800 group-hover:text-green-900">Kegiatan</h3>
                    <p class="text-sm text-green-600">Agenda dan acara</p>
                </a>
                
                <a href="{{ route('announcements.type', 'general') }}" class="bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg p-4 text-center transition-colors group">
                    <div class="text-2xl mb-2">📢</div>
                    <h3 class="font-semibold text-blue-800 group-hover:text-blue-900">Umum</h3>
                    <p class="text-sm text-blue-600">Informasi umum</p>
                </a>
            </div>

            <!-- Announcements List -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">
                            @if(request('search'))
                                Hasil Pencarian: "{{ request('search') }}"
                            @elseif(request('type') && request('type') != 'all')
                                Pengumuman {{ ucfirst(request('type')) }}
                            @else
                                Semua Pengumuman
                            @endif
                        </h2>
                        <span class="text-sm text-gray-500">
                            @if(isset($announcements))
                                {{ $announcements->total() }} pengumuman
                            @else
                                Memuat...
                            @endif
                        </span>
                    </div>
                </div>

                <div class="divide-y divide-gray-200">
                    @if(isset($announcements) && $announcements->count() > 0)
                        @foreach($announcements as $announcement)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start space-x-4">
                                    <!-- Type Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <span class="text-xl">📢</span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Pengumuman
                                            </span>
                                            <span class="text-sm text-gray-500">{{ now()->format('d M Y, H:i') }}</span>
                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                            <a href="#">Contoh Pengumuman PASKIBRA</a>
                                        </h3>

                                        <p class="text-gray-600 mb-3 line-clamp-3">Ini adalah contoh pengumuman untuk anggota PASKIBRA WiraPurusa. Silakan ikuti kegiatan pembelajaran dengan disiplin dan semangat tinggi.</p>

                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3 text-sm text-gray-500">
                                                <div class="flex items-center space-x-2">
                                                    <img class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=1B365D&color=fff" alt="Admin">
                                                    <span>Admin PASKIBRA</span>
                                                </div>
                                            </div>

                                            <a href="#" class="inline-flex items-center space-x-1 text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                                <span>Baca Selengkapnya</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pengumuman</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if(request('search'))
                                    Tidak ditemukan pengumuman dengan kata kunci "{{ request('search') }}".
                                @else
                                    Belum ada pengumuman yang dipublikasikan.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if(isset($announcements) && $announcements->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $announcements->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuButton = event.target.closest('button[onclick="toggleSidebar()"]');
            
            if (!sidebar.contains(event.target) && !menuButton && !overlay.classList.contains('hidden')) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>