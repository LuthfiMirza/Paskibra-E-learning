@extends('template-modern')

@section('title', $title ?? 'Pengumuman')

@section('content')
@php
@endphp

<div class="space-y-8">
    <nav class="text-sm text-gray-500">
        <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li>/</li>
            <li><a href="{{ route('announcements.index') }}" class="hover:text-blue-600">Pengumuman</a></li>
            <li>/</li>
            <li class="text-gray-700">{{ $title }}</li>
        </ol>
    </nav>

    <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <header class="px-6 py-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white">
            <h1 class="text-2xl font-bold leading-tight">{{ $title }}</h1>
            <p class="text-white/80 text-sm mt-1">Menampilkan pengumuman dengan kategori {{ \Illuminate\Support\Str::lower($title) }}</p>
        </header>
        <div class="divide-y divide-gray-100">
            @forelse($announcements as $announcement)
                <article class="px-6 py-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex-1 space-y-2">
                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 uppercase tracking-wide">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold">{{ \Illuminate\Support\Str::title($announcement->type) }}</span>
                            <span>{{ optional($announcement->published_at)->format('d M Y • H:i') }}</span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $announcement->title }}</h2>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 180) }}</p>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.866-3.582 7-8 7 2.418 1.427 5.418 2 8 2s5.582-.573 8-2c-4.418 0-8-3.134-8-7z" />
                                </svg>
                                <span>{{ optional($announcement->creator)->name ?? 'Admin PASKIBRA' }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700">Baca Pengumuman
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </article>
            @empty
                <div class="px-6 py-10 text-center text-sm text-gray-500">
                    Tidak ada pengumuman pada kategori ini.
                </div>
            @endforelse
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $announcements->links() }}
        </div>
    </section>
</div>
@endsection
