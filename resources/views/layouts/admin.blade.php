<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PASKIBRA Admin') }} - @yield('title', 'Admin Panel')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    <style>
        :root {
            --ta-bg: #f8fafc;
            --ta-surface: #ffffff;
            --ta-border: #e2e8f0;
            --ta-border-strong: #d0d7e3;
            --ta-primary: #4f46e5;
            --ta-primary-soft: #eef2ff;
            --ta-text: #0f172a;
            --ta-text-muted: #64748b;
            --admin-sidebar-width: 18.5rem;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--ta-bg);
            color: var(--ta-text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        input[type='search']::-webkit-search-decoration,
        input[type='search']::-webkit-search-cancel-button,
        input[type='search']::-webkit-search-results-button,
        input[type='search']::-webkit-search-results-decoration {
            -webkit-appearance: none;
        }

        .ta-shadow {
            box-shadow: 0 30px 60px -35px rgba(15, 23, 42, 0.25);
        }

        .ta-shadow-soft {
            box-shadow: 0 20px 40px -30px rgba(15, 23, 42, 0.2);
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: var(--ta-surface);
            border-right: 1px solid var(--ta-border);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 2.1rem 1.5rem 2.6rem;
            display: flex;
            flex-direction: column;
            gap: 2.3rem;
            overflow-y: auto;
            z-index: 50;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.45);
            border-radius: 999px;
        }

        .admin-sidebar__brand,
        .admin-sidebar__footer {
            padding: 0 1.2rem;
        }

        .admin-sidebar__brand {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-sidebar__brand h1 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ta-text);
        }

        .admin-sidebar__brand p {
            font-size: 0.75rem;
            color: var(--ta-text-muted);
        }

        .admin-sidebar__brand button {
            margin-left: auto;
            flex-shrink: 0;
        }

        .admin-nav {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 0;
            margin: 0;
        }

        .admin-nav__item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem 1.2rem;
            width: 100%;
            border-radius: 1.1rem;
            color: var(--ta-text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            border: 1px solid transparent;
            overflow: hidden;
            transition: color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .admin-nav__item::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: rgba(79, 70, 229, 0.08);
            opacity: 0;
            transition: opacity 0.25s ease, background 0.25s ease;
            z-index: -1;
        }

        .admin-nav__item:hover {
            color: var(--ta-primary);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .admin-nav__item:hover::before {
            opacity: 1;
        }

        .admin-nav__item.active {
            color: var(--ta-primary);
            border-color: rgba(79, 70, 229, 0.28);
            box-shadow: 0 20px 52px -28px rgba(79, 70, 229, 0.55);
        }

        .admin-nav__item.active::before {
            opacity: 1;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.28), rgba(129, 140, 248, 0.2));
        }

        .admin-nav__item > * {
            position: relative;
            z-index: 1;
        }

        .admin-nav__item .nav-icon {
            display: grid;
            place-items: center;
            width: 2.4rem;
            height: 2.4rem;
            border-radius: 0.85rem;
            background: rgba(15, 23, 42, 0.06);
            color: rgba(79, 70, 229, 0.75);
            transition: background 0.25s ease, color 0.25s ease;
            flex-shrink: 0;
        }

        .admin-nav__item:hover .nav-icon {
            background: rgba(79, 70, 229, 0.14);
            color: var(--ta-primary);
        }

        .admin-nav__item.active .nav-icon {
            background: rgba(79, 70, 229, 0.2);
            color: var(--ta-primary);
        }

        .admin-nav__item .nav-label {
            line-height: 1.2;
        }

        .admin-sidebar__footer {
            margin-top: auto;
            padding-top: 1.75rem;
            border-top: 1px dashed var(--ta-border);
            font-size: 0.75rem;
            color: var(--ta-text-muted);
            line-height: 1.5;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background: var(--ta-surface);
            border-bottom: 1px solid var(--ta-border);
        }

        @media (max-width: 1280px) {
            .admin-sidebar {
                width: min(90vw, var(--admin-sidebar-width));
            }
        }

        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.open {
                transform: translateX(0);
                box-shadow: 0 25px 60px -20px rgba(15, 23, 42, 0.3);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="admin-mobile-overlay" class="fixed inset-0 z-40 bg-slate-900/40 hidden lg:hidden"></div>

    @php
        $navItems = [
            [
                'label' => 'Dashboard',
                'route' => route('admin.index'),
                'active' => ['admin.index'],
                'icon' => 'chart',
            ],
            [
                'label' => 'Pengguna',
                'route' => route('admin.users.index'),
                'active' => ['admin.users.*'],
                'icon' => 'users',
            ],
            [
                'label' => 'Kursus',
                'route' => route('admin.courses.index'),
                'active' => ['admin.courses.*'],
                'icon' => 'courses',
            ],
            [
                'label' => 'Kuis',
                'route' => route('admin.quizzes.index'),
                'active' => ['admin.quizzes.*'],
                'icon' => 'quiz',
            ],
            [
                'label' => 'Pengumuman',
                'route' => route('admin.reports.index'),
                'active' => ['admin.reports.*', 'admin.analytics'],
                'icon' => 'reports',
            ],
            [
                'label' => 'Pengaturan',
                'route' => route('admin.settings'),
                'active' => ['admin.settings', 'admin.settings.*'],
                'icon' => 'settings',
            ],
        ];
    @endphp

    <div class="admin-shell">
        <!-- Sidebar -->
        <aside id="admin-sidebar" class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <div class="h-11 w-11 rounded-2xl overflow-hidden shadow-[0_12px_24px_-18px_rgba(79,70,229,0.55)] border border-slate-200">
                    <img src="{{ asset('images/paskibra/new_logo.jpg') }}" alt="Logo PASKIBRA" class="h-full w-full object-cover">
                </div>
                <div>
                    <h1>PASKIBRA Admin</h1>
                    <p>WiraPurusa Dashboard</p>
                </div>
                <button id="admin-sidebar-close" class="lg:hidden ml-auto rounded-xl border border-slate-200 p-2 text-slate-500 hover:text-slate-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <nav class="admin-nav" aria-label="Navigasi utama admin">
                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs(...$item['active']); @endphp
                    <a href="{{ $item['route'] }}" class="admin-nav__item {{ $isActive ? 'active' : '' }}" aria-current="{{ $isActive ? 'page' : 'false' }}">
                        <span class="nav-icon">
                            @switch($item['icon'])
                                @case('chart')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V9m6 10V5m-9 9v5m12 0V9" /></svg>
                                    @break
                                @case('users')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2m13-10a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    @break
                                @case('courses')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7h4a2 2 0 012 2v11" /></svg>
                                    @break
                                @case('quiz')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h3" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11a3 3 0 116 0c0 1.657-1.343 3-3 3v2" /></svg>
                                    @break
                                @case('reports')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3H5a2 2 0 00-2 2v12a2 2 0 002 2h6" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 17l2-2-2-2m0 4l-2-2 2-2m-6 4h8a2 2 0 002-2V7a2 2 0 00-2-2h-8" /></svg>
                                    @break
                                @case('settings')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.867 2.658a1 1 0 00.95.69h2.801c.969 0 1.371 1.24.588 1.81l-2.267 1.646a1 1 0 00-.364 1.118l.867 2.658c.3.921-.755 1.688-1.54 1.118l-2.267-1.646a1 1 0 00-1.176 0l-2.267 1.646c-.784.57-1.838-.197-1.539-1.118l.867-2.658a1 1 0 00-.364-1.118L4.64 8.085c-.783-.57-.38-1.81.588-1.81h2.801a1 1 0 00.95-.69l.867-2.658z" /></svg>
                                    @break
                            @endswitch
                        </span>
                        <span class="nav-label">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="admin-sidebar__footer">
                <p class="font-semibold text-slate-400 mb-1">PASKIBRA ADMIN</p>
                <p>Kelola seluruh aktivitas platform e-learning melalui panel modern ini.</p>
            </div>
        </aside>

        <!-- Main -->
        <div class="admin-main">
            <header class="admin-topbar">
                <div class="px-4 sm:px-6 lg:px-10">
                    <div class="flex h-20 items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <button id="admin-sidebar-open" class="lg:hidden p-2 rounded-xl border border-slate-200 text-slate-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                            </button>
                            <div class="hidden lg:block">
                                <h2 class="text-lg font-semibold text-slate-800">@yield('title', 'Admin Panel')</h2>
                                @hasSection('subtitle')
                                    <p class="text-sm text-slate-500">@yield('subtitle')</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 flex justify-end items-center gap-4">
                            <div class="relative w-full max-w-lg">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </span>
                                <input type="search" placeholder="Cari sesuatu..." class="h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm text-slate-600 placeholder:text-slate-400 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                            </div>

                            <div class="relative">
                                @php
                                    $adminNotificationUnread = $adminNotificationUnread ?? 0;
                                    $adminNotifications = $adminNotifications ?? collect();
                                @endphp
                                <button id="admin-notification-trigger" type="button" class="relative h-10 w-10 rounded-2xl border border-slate-200 bg-white text-slate-500 hover:text-indigo-600 hover:border-indigo-200">
                                    <svg class="mx-auto h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" /></svg>
                                    @if($adminNotificationUnread > 0)
                                        <span class="absolute -top-1 -right-1 flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-rose-500 px-1 text-[11px] font-semibold text-white">
                                            {{ $adminNotificationUnread > 9 ? '9+' : $adminNotificationUnread }}
                                        </span>
                                    @endif
                                </button>
                                <div id="admin-notification-menu" class="hidden absolute right-0 mt-3 w-[23rem] rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-800/10">
                                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">Aktivitas Terbaru</p>
                                            <p class="text-xs text-slate-500">Monitor progres siswa dan event terbaru</p>
                                        </div>
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-600">
                                            {{ $adminNotificationUnread }} baru
                                        </span>
                                    </div>
                                    <div class="max-h-96 divide-y divide-slate-100 overflow-y-auto">
                                        @forelse($adminNotifications as $activity)
                                            <div class="flex items-start gap-3 px-5 py-4">
                                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl {{ $activity['icon_background'] ?? 'bg-slate-100' }}">
                                                    @php
                                                        $icon = $activity['icon'] ?? 'bell';
                                                    @endphp
                                                    <svg class="h-5 w-5 {{ $activity['icon_color'] ?? 'text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        @switch($icon)
                                                            @case('quiz')
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m2-2a2 2 0 012 2v8a2 2 0 01-2 2H9l-4 4V6a2 2 0 012-2h10z" />
                                                                @break
                                                            @case('trophy')
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4 0v-4m6-12h2a2 2 0 01-2 2 4 4 0 01-4 4H10a4 4 0 01-4-4 2 2 0 01-2-2h2m12 0V5a2 2 0 00-2-2H8a2 2 0 00-2 2v2" />
                                                                @break
                                                            @case('user')
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                @break
                                                            @default
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" />
                                                        @endswitch
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-semibold text-slate-900">{{ $activity['title'] }}</p>
                                                        <span class="text-xs text-slate-400">{{ $activity['time_ago'] ?? '' }}</span>
                                                    </div>
                                                    <p class="text-sm text-slate-500">{{ $activity['description'] }}</p>
                                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                                        @if(!empty($activity['badge']))
                                                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">{{ $activity['badge'] }}</span>
                                                        @endif
                                                        @if(!empty($activity['link']))
                                                            <a href="{{ $activity['link'] }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">Lihat detail</a>
                                                        @endif
                                                        @if(($activity['is_new'] ?? false))
                                                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="px-5 py-8 text-center text-sm text-slate-500">
                                                Belum ada aktivitas terbaru.
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="border-t border-slate-100 px-5 py-3 text-center">
                                        <a href="{{ route('notifications.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat pusat notifikasi</a>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <button id="admin-profile-trigger" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-2.5 py-1.5 text-sm text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                                    <img class="h-8 w-8 rounded-xl object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=4f46e5&color=fff" alt="Avatar">
                                    <span class="hidden sm:inline font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                                <div id="admin-profile-menu" class="hidden absolute right-0 mt-3 w-56 rounded-2xl border border-slate-200 bg-white py-2 text-sm shadow-xl">
                                    <p class="px-4 pb-2 text-xs font-semibold text-slate-400">AKUN</p>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-50">Profil Saya</a>
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-slate-600 hover:bg-slate-50">Portal Siswa</a>
                                    <div class="my-2 border-t border-slate-100"></div>
                                    <button type="button" onclick="document.getElementById('admin-logout-form').submit();" class="block w-full px-4 py-2 text-left font-medium text-rose-600 hover:bg-rose-50/60">Keluar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-10">
                @yield('content')
            </main>

            @include('components.footer')
        </div>
    </div>

    <form id="admin-logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('admin-mobile-overlay');
            const openBtn = document.getElementById('admin-sidebar-open');
            const closeBtn = document.getElementById('admin-sidebar-close');

            if (openBtn && sidebar && overlay) {
                openBtn.addEventListener('click', () => {
                    sidebar.classList.add('open');
                    overlay.classList.remove('hidden');
                });
            }

            if (closeBtn && sidebar && overlay) {
                closeBtn.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.add('hidden');
                });
            }

            if (overlay && sidebar) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.add('hidden');
                });
            }

            const profileTrigger = document.getElementById('admin-profile-trigger');
            const profileMenu = document.getElementById('admin-profile-menu');

            if (profileTrigger && profileMenu) {
                profileTrigger.addEventListener('click', (event) => {
                    event.stopPropagation();
                    profileMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', (event) => {
                    if (!profileMenu.contains(event.target) && !profileTrigger.contains(event.target)) {
                        profileMenu.classList.add('hidden');
                    }
                });
            }

            const notificationTrigger = document.getElementById('admin-notification-trigger');
            const notificationMenu = document.getElementById('admin-notification-menu');

            if (notificationTrigger && notificationMenu) {
                notificationTrigger.addEventListener('click', (event) => {
                    event.stopPropagation();
                    notificationMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', (event) => {
                    if (!notificationMenu.contains(event.target) && !notificationTrigger.contains(event.target)) {
                        notificationMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>


    <div id="admin-confirm-overlay" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl shadow-slate-900/20">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Konfirmasi Penghapusan</h3>
                        <p id="admin-confirm-message" class="text-sm text-slate-500">Anda yakin ingin menghapus data ini?</p>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" id="admin-confirm-no" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Batal</button>
                    <button type="button" id="admin-confirm-yes" class="inline-flex items-center gap-2 rounded-2xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 hover:bg-rose-700">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const overlay = document.getElementById('admin-confirm-overlay');
            const messageEl = document.getElementById('admin-confirm-message');
            const confirmBtn = document.getElementById('admin-confirm-yes');
            const cancelBtn = document.getElementById('admin-confirm-no');
            let pendingForm = null;

            const closeModal = () => {
                overlay?.classList.add('hidden');
                overlay?.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                if (messageEl) {
                    messageEl.textContent = 'Anda yakin ingin menghapus data ini?';
                }
                pendingForm = null;
            };

            const openModal = (form) => {
                pendingForm = form;
                if (messageEl && form.dataset.confirm) {
                    messageEl.textContent = form.dataset.confirm;
                }
                overlay?.classList.remove('hidden');
                overlay?.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            };

            overlay?.addEventListener('click', (event) => {
                if (event.target === overlay) {
                    closeModal();
                }
            });

            confirmBtn?.addEventListener('click', () => {
                if (pendingForm) {
                    const formToSubmit = pendingForm;
                    formToSubmit.dataset.confirmed = 'true';
                    closeModal();
                    formToSubmit.submit();
                }
            });

            cancelBtn?.addEventListener('click', closeModal);

            document.querySelectorAll('form[data-confirm]').forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.dataset.confirmed) {
                        event.preventDefault();
                        openModal(form);
                    } else {
                        delete form.dataset.confirmed;
                    }
                });
            });

        });
    </script>
    @stack('scripts')
</body>
</html>
