@extends('template-modern')

@section('title', $announcement->title . ' - Pengumuman PASKIBRA')

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
            <li class="text-gray-700">{{ \Illuminate\Support\Str::limit($announcement->title, 60) }}</li>
        </ol>
    </nav>

    <article class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <header class="px-8 py-10 bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-700 text-white space-y-4">
            <div class="flex flex-wrap items-center gap-3 text-xs uppercase tracking-wide text-white/70">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/15 text-white font-semibold">{{ \Illuminate\Support\Str::title($announcement->type) }}</span>
                <span>{{ optional($announcement->published_at)->format('d M Y • H:i') }}</span>
            </div>
            <h1 class="text-3xl font-bold leading-tight">{{ $announcement->title }}</h1>
            <div class="flex items-center gap-3 text-sm text-white/70">
                <div class="w-10 h-10 rounded-full bg-white/15 text-white font-semibold flex items-center justify-center">
                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(optional($announcement->creator)->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-white">{{ optional($announcement->creator)->name ?? 'Admin PASKIBRA' }}</p>
                    <p>{{ optional($announcement->published_at)->diffForHumans() }}</p>
                </div>
            </div>
        </header>
        <div class="p-6 lg:p-10 space-y-6 text-gray-700 leading-relaxed">
            {!! $announcement->content !!}
        </div>
    </article>

    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Pengumuman terkait</h2>
        <div class="grid gap-6 md:grid-cols-3">
            @forelse($relatedAnnouncements as $related)
                <a href="{{ route('announcements.show', $related) }}" class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow p-6 space-y-2">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700">{{ \Illuminate\Support\Str::title($related->type) }}</span>
                    <h3 class="text-base font-semibold text-gray-900 line-clamp-2">{{ $related->title }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($related->content), 120) }}</p>
                    <p class="text-xs text-gray-500">{{ optional($related->published_at)->format('d M Y') }}</p>
                </a>
            @empty
                <p class="text-sm text-gray-500">Belum ada pengumuman terkait.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
