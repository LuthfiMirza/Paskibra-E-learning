@php
    $navLink = 'group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40';
@endphp

<nav class="flex flex-col gap-8 pb-24">
    <div>
        <p class="px-4 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-white/60">Menu Utama</p>
        <div class="mt-3 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="{{ $navLink }} {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white shadow-inner shadow-white/10' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"/></svg>
                <span>Dashboard</span>
            </a>
        </div>
    </div>

    <div>
        <p class="px-4 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-white/60">Pembelajaran</p>
        <div class="mt-3 space-y-2">
            <a href="{{ route('courses.index') }}"
               class="{{ $navLink }} {{ request()->routeIs('courses.*') ? 'bg-white/15 text-white shadow-inner shadow-white/10' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Materi Pembelajaran</span>
            </a>
            <a href="{{ route('quizzes.index') }}"
               class="{{ $navLink }} {{ request()->routeIs('quizzes.*') ? 'bg-white/15 text-white shadow-inner shadow-white/10' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Quiz Interaktif</span>
            </a>
            <a href="{{ route('grades.index') }}"
               class="{{ $navLink }} {{ request()->routeIs('grades.*') ? 'bg-white/15 text-white shadow-inner shadow-white/10' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span>Laporan Nilai</span>
            </a>
        </div>
    </div>

    <div>
        <p class="px-4 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-white/60">Aktivitas</p>
        <div class="mt-3 space-y-2">
            <a href="{{ route('achievements.index') }}"
               class="{{ $navLink }} {{ request()->routeIs('achievements.*') ? 'bg-white/15 text-white shadow-inner shadow-white/10' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Pencapaian</span>
                <span class="ml-auto inline-flex items-center rounded-full bg-[rgba(252,211,77,0.25)] px-2 py-0.5 text-xs font-semibold text-white">🏆</span>
            </a>
        </div>
    </div>

    @if(auth()->user()->isInstructor() || auth()->user()->isAdmin())
        <div>
            <p class="px-4 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-white/60">Management</p>
            <div class="mt-3 space-y-2">
                <a href="#"
                   class="{{ $navLink }} text-white/70 hover:bg-white/10 hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Kelola Kursus</span>
                </a>
                <a href="#"
                   class="{{ $navLink }} text-white/70 hover:bg-white/10 hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Kelola Quiz</span>
                </a>
            </div>
        </div>
    @endif
</nav>
