@extends('template-modern')

@section('title', 'Pengumuman - PASKIBRA Wira Purusa')

@section('content')
@php
@endphp

<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 via-slate-900 to-blue-700 px-8 py-10 text-white">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/10 border border-white/20 rounded-full">Pusat Informasi</span>
                <h1 class="text-3xl font-bold leading-tight">Pengumuman Resmi PASKIBRA Wira Purusa</h1>
                <p class="text-white/80 text-base">Dapatkan update kegiatan, jadwal latihan, dan informasi penting lainnya secara real-time.</p>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <form method="GET" class="grid gap-4 lg:grid-cols-[2fr,1fr,auto]">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari pengumuman</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Cari judul atau isi pengumuman">
                    </div>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Filter kategori</label>
                    <select id="type" name="type" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" @selected(request('type', 'all') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm">Terapkan</button>
                </div>
            </form>
        </div>
    </div>

    @if($pinnedAnnouncements->count())
        <section class="space-y-4">
            <header class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Pengumuman Teratas</h2>
                <span class="text-xs text-blue-600">Diprioritaskan oleh admin</span>
            </header>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($pinnedAnnouncements as $announcement)
                    <article class="bg-white border border-yellow-200 rounded-3xl shadow-[0_20px_45px_-15px_rgba(245,158,11,0.45)] overflow-hidden">
                        <div class="bg-gradient-to-br from-yellow-500 via-orange-500 to-red-500 p-6 text-white">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wide bg-white/20 rounded-full">Pinned</span>
                            <h3 class="text-xl font-semibold mt-4 leading-snug">{{ $announcement->title }}</h3>
                            <p class="text-sm text-white/90 mt-2 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 120) }}</p>
                        </div>
                        <div class="p-6 space-y-4 text-sm text-gray-600">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 font-semibold flex items-center justify-center">
                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(optional($announcement->creator)->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ optional($announcement->creator)->name ?? 'Admin PASKIBRA' }}</p>
                                    <p class="text-xs text-gray-500">{{ optional($announcement->published_at)->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">Baca selengkapnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <header class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Pengumuman</h2>
            <span class="text-xs text-gray-500">{{ $announcements->total() }} pengumuman ditemukan</span>
        </header>
        <div class="divide-y divide-gray-100">
            @forelse($announcements as $announcement)
                <article class="px-6 py-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex-1 space-y-2">
                        <div class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-wide text-gray-500">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold">{{ \Illuminate\Support\Str::title($announcement->type) }}</span>
                            <span>{{ optional($announcement->published_at)->format('d M Y • H:i') }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $announcement->title }}</h3>
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
                    Tidak ada pengumuman yang cocok dengan filter saat ini.
                </div>
            @endforelse
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $announcements->appends(request()->query())->links() }}
        </div>
    </section>
</div>
@endsection
