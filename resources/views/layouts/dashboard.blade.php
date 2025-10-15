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
</head>
<body class="min-h-screen bg-[var(--gray-50)] font-sans antialiased text-[var(--gray-900)]">
@php
    use Illuminate\Support\Str;

    $announcementNotifications = $headerAnnouncements ?? collect();
    $announcementCount = $headerAnnouncementCount ?? $announcementNotifications->count();
    $announcementTypeStyles = [
        'urgent' => [
            'icon_bg' => 'bg-red-100',
            'icon_text' => 'text-red-600',
            'dot' => 'bg-red-500',
            'chip_bg' => 'bg-red-100',
            'chip_text' => 'text-red-600',
        ],
        'important' => [
            'icon_bg' => 'bg-yellow-100',
            'icon_text' => 'text-yellow-600',
            'dot' => 'bg-yellow-500',
            'chip_bg' => 'bg-yellow-100',
            'chip_text' => 'text-yellow-700',
        ],
        'event' => [
            'icon_bg' => 'bg-green-100',
            'icon_text' => 'text-green-600',
            'dot' => 'bg-green-500',
            'chip_bg' => 'bg-green-100',
            'chip_text' => 'text-green-700',
        ],
        'general' => [
            'icon_bg' => 'bg-blue-100',
            'icon_text' => 'text-blue-600',
            'dot' => 'bg-blue-500',
            'chip_bg' => 'bg-blue-100',
            'chip_text' => 'text-blue-700',
        ],
        'default' => [
            'icon_bg' => 'bg-gray-100',
            'icon_text' => 'text-gray-600',
            'dot' => 'bg-gray-400',
            'chip_bg' => 'bg-gray-100',
            'chip_text' => 'text-gray-600',
        ],
    ];
@endphp

<div class="min-h-screen">
    <header class="sticky top-0 z-40 border-b border-[var(--gray-200)] bg-white/90 backdrop-blur">
        <div class="px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-3">
                    <button id="btn-open-nav" aria-label="Buka navigasi" aria-controls="mobile-nav" aria-expanded="false" class="lg:hidden inline-flex h-11 w-11 items-center justify-center rounded-xl border border-[var(--gray-200)] bg-white text-[var(--paskibra-navy)] shadow-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--paskibra-navy-light)]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--paskibra-navy)] to-[var(--paskibra-navy-dark)] text-white font-semibold">PW</span>
                        <div class="hidden sm:block leading-tight">
                            <p class="text-[0.65rem] uppercase tracking-[0.25em] text-[var(--gray-500)]">Paskibra</p>
                            <p class="text-sm font-semibold text-[var(--paskibra-navy)]">WiraPurusa E-Learning</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 lg:order-3">
                    <div class="relative">
                        <button id="notifications-dropdown-button" class="relative inline-flex h-11 w-11 items-center justify-center rounded-xl border border-transparent bg-white text-[var(--gray-500)] shadow-sm transition hover:text-[var(--paskibra-navy)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--paskibra-navy-light)]">
                            <div class="relative">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V9a9 9 0 10-18 0v3l-5 5h5a9 9 0 0018 0z"/></svg>
                                @if($announcementCount > 0)
                                    <span id="notification-badge" class="absolute -top-1.5 -right-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-gradient-to-r from-[var(--paskibra-red-light)] to-[var(--paskibra-red)] text-xs font-bold text-white shadow-lg">{{ $announcementCount }}</span>
                                @endif
                            </div>
                        </button>

                        <div id="notifications-dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 w-80 rounded-2xl border border-[var(--gray-200)] bg-white shadow-xl">
                            <div class="flex items-center justify-between border-b border-[var(--gray-200)] px-4 py-3">
                                <h3 class="text-base font-semibold text-[var(--gray-900)]">Notifikasi</h3>
                                <button class="text-sm font-medium text-[var(--paskibra-navy)] hover:text-[var(--paskibra-navy-light)]">Tandai Semua Dibaca</button>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @forelse($announcementNotifications as $announcement)
                                    @php $style = $announcementTypeStyles[$announcement->type] ?? $announcementTypeStyles['default']; @endphp
                                    <div class="flex items-start gap-3 border-b border-[var(--gray-200)] px-4 py-3 text-sm hover:bg-[var(--gray-100)]">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full {{ $style['icon_bg'] }}">
                                            <svg class="h-4 w-4 {{ $style['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 13V7"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-medium text-[var(--gray-900)]">{{ $announcement->title }}</p>
                                            <p class="mt-1 text-[var(--gray-500)]">{{ Str::limit(strip_tags($announcement->content ?? ''), 140) }}</p>
                                            <p class="mt-2 flex items-center gap-2 text-xs text-[var(--gray-500)]">
                                                <span class="inline-flex items-center rounded-full px-2 py-0.5 {{ $style['chip_bg'] }} {{ $style['chip_text'] }} font-medium">{{ $announcement->type_display }}</span>
                                                <span>{{ optional($announcement->published_at)->diffForHumans() ?? 'Baru saja' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="px-4 py-6 text-center text-sm text-[var(--gray-500)]">Belum ada pengumuman terbaru.</p>
                                @endforelse
                            </div>
                            <div class="border-t border-[var(--gray-200)] bg-[var(--gray-100)] px-4 py-3 text-center">
                                <a href="{{ route('announcements.index') }}" class="text-sm font-medium text-[var(--paskibra-navy)] hover:text-[var(--paskibra-navy-light)]">Lihat Semua Notifikasi</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <button id="profile-dropdown-button" class="inline-flex items-center gap-2 rounded-xl border border-[var(--gray-200)] bg-white px-3 py-2 text-sm font-medium text-[var(--gray-700)] shadow-sm transition hover:text-[var(--paskibra-navy)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--paskibra-navy-light)]">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1B365D&color=fff" alt="Avatar" class="h-8 w-8 rounded-full object-cover" loading="lazy">
                            <span class="hidden sm:block text-left">
                                <span class="block text-sm font-semibold text-[var(--gray-900)]">{{ auth()->user()->name }}</span>
                                <span class="block text-xs capitalize text-[var(--gray-500)]">{{ auth()->user()->role ?? 'pengguna' }}</span>
                            </span>
                            <svg id="profile-dropdown-arrow" class="h-4 w-4 text-[var(--gray-500)] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div id="profile-dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 w-60 rounded-2xl border border-[var(--gray-200)] bg-white shadow-xl">
                            <div class="flex items-center gap-3 border-b border-[var(--gray-200)] px-4 py-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1B365D&color=fff" alt="Avatar" class="h-10 w-10 rounded-full object-cover" loading="lazy">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-[var(--gray-900)]">{{ auth()->user()->name }}</p>
                                    <p class="truncate text-xs text-[var(--gray-500)]">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <div class="space-y-1 px-3 py-3 text-sm">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-[var(--gray-700)] hover:bg-[var(--gray-100)]">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('announcements.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-[var(--gray-700)] hover:bg-[var(--gray-100)]">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"/></svg>
                                    Notifikasi
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-[var(--danger-500)] hover:bg-[var(--danger-50)]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 lg:order-2 lg:flex lg:flex-1 lg:flex-col lg:items-start lg:gap-2">
                    <div>
                        <h1 class="font-semibold text-[clamp(1.75rem,2.5vw+1rem,2.25rem)] text-[var(--gray-900)]">@yield('title', 'Dashboard')</h1>
                        <p class="text-sm text-[var(--gray-500)]">@yield('subtitle', 'Selamat datang di PASKIBRA WiraPurusa E-Learning')</p>
                    </div>
                    <div class="w-full lg:max-w-xl">
                        <label for="global-search" class="sr-only">Cari</label>
                        <div class="relative flex items-center">
                            <svg class="pointer-events-none absolute left-3 h-5 w-5 text-[var(--gray-500)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input id="global-search" type="search" placeholder="Cari materi, quiz, pengumuman..." class="form-input pl-10 pr-4 bg-white/80 focus:bg-white" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="lg:flex lg:pl-72">
        <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:flex lg:w-72 lg:flex-col lg:bg-gradient-to-b lg:from-[var(--paskibra-navy)] lg:to-[var(--paskibra-navy-dark)] lg:text-white lg:shadow-xl">
            <div class="flex h-full flex-col overflow-y-auto px-4 py-6">
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-white/10 px-3 py-3 text-sm text-white/80">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=FCD34D&color=1B365D" alt="Avatar" class="h-12 w-12 rounded-full object-cover" loading="lazy">
                    <div class="leading-tight">
                        <p class="font-semibold text-white">{{ auth()->user()->name }}</p>
                        <p class="capitalize text-white/70">{{ auth()->user()->role ?? 'pengguna' }}</p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @include('layouts.partials.sidebar-nav')
                </div>
            </div>
        </aside>

        <div id="mobile-nav" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="mobile-nav-title">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close-nav></div>
            <aside class="absolute left-0 top-0 flex h-full w-72 flex-col bg-gradient-to-b from-[var(--paskibra-navy)] to-[var(--paskibra-navy-dark)] text-white shadow-2xl">
                <div class="flex items-center justify-between px-4 py-4">
                    <span id="mobile-nav-title" class="text-xs font-semibold uppercase tracking-[0.25em] text-white/60">Navigasi</span>
                    <button id="btn-close-nav" aria-label="Tutup navigasi" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-white/30 text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/70">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto px-2 pb-6">
                    @include('layouts.partials.sidebar-nav')
                </div>
                <div class="border-t border-white/20 px-4 py-4 text-sm text-white/80">
                    <p class="font-semibold text-white">{{ auth()->user()->name }}</p>
                    <p class="capitalize text-white/70">{{ auth()->user()->role ?? 'pengguna' }}</p>
                </div>
            </aside>
        </div>

        <main class="flex-1">
            <div class="mx-auto max-w-[1200px] px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
