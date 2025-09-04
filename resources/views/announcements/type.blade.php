@extends('layouts.dashboard')

@section('title', $title)
@section('subtitle', 'Daftar ' . strtolower($title) . ' PASKIBRA WiraPurusa')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Pengumuman
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-50 to-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-100 rounded-xl border border-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-200 p-8">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full bg-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-200 flex items-center justify-center">
                @if($type == 'urgent')
                    <span class="text-3xl">🚨</span>
                @elseif($type == 'important')
                    <span class="text-3xl">⚠️</span>
                @elseif($type == 'event')
                    <span class="text-3xl">📅</span>
                @else
                    <span class="text-3xl">📢</span>
                @endif
            </div>
            <div>
                <h1 class="text-3xl font-bold text-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-900">{{ $title }}</h1>
                <p class="text-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-700 mt-2">
                    @if($type == 'urgent')
                        Pengumuman yang memerlukan perhatian segera dan tindakan cepat.
                    @elseif($type == 'important')
                        Informasi penting yang perlu diketahui oleh semua anggota.
                    @elseif($type == 'event')
                        Agenda kegiatan, acara, dan jadwal penting PASKIBRA.
                    @else
                        Informasi umum dan berita terkini untuk anggota PASKIBRA.
                    @endif
                </p>
                <div class="mt-4 flex items-center space-x-4 text-sm text-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-600">
                    <span class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>{{ $announcements->total() }} pengumuman</span>
                    </span>
                    <span class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Diperbarui {{ $announcements->first()?->published_at?->diffForHumans() ?? 'belum ada' }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('announcements.type', 'urgent') }}" class="bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg p-4 text-center transition-colors group {{ $type == 'urgent' ? 'ring-2 ring-red-500' : '' }}">
            <div class="text-2xl mb-2">🚨</div>
            <h3 class="font-semibold text-red-800 group-hover:text-red-900">Mendesak</h3>
            <p class="text-sm text-red-600">Perlu perhatian segera</p>
        </a>
        
        <a href="{{ route('announcements.type', 'important') }}" class="bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-lg p-4 text-center transition-colors group {{ $type == 'important' ? 'ring-2 ring-yellow-500' : '' }}">
            <div class="text-2xl mb-2">⚠️</div>
            <h3 class="font-semibold text-yellow-800 group-hover:text-yellow-900">Penting</h3>
            <p class="text-sm text-yellow-600">Informasi penting</p>
        </a>
        
        <a href="{{ route('announcements.type', 'event') }}" class="bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg p-4 text-center transition-colors group {{ $type == 'event' ? 'ring-2 ring-green-500' : '' }}">
            <div class="text-2xl mb-2">📅</div>
            <h3 class="font-semibold text-green-800 group-hover:text-green-900">Kegiatan</h3>
            <p class="text-sm text-green-600">Agenda dan acara</p>
        </a>
        
        <a href="{{ route('announcements.type', 'general') }}" class="bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg p-4 text-center transition-colors group {{ $type == 'general' ? 'ring-2 ring-blue-500' : '' }}">
            <div class="text-2xl mb-2">📢</div>
            <h3 class="font-semibold text-blue-800 group-hover:text-blue-900">Umum</h3>
            <p class="text-sm text-blue-600">Informasi umum</p>
        </a>
    </div>

    <!-- Announcements List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Daftar {{ $title }}</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ $announcements->total() }} pengumuman</span>
                    <a href="{{ route('announcements.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua Pengumuman
                    </a>
                </div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($announcements as $announcement)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start space-x-4">
                        <!-- Type Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-{{ $announcement->type_color }}-100 flex items-center justify-center">
                                @if($announcement->type == 'urgent')
                                    <span class="text-xl">🚨</span>
                                @elseif($announcement->type == 'important')
                                    <span class="text-xl">⚠️</span>
                                @elseif($announcement->type == 'event')
                                    <span class="text-xl">📅</span>
                                @else
                                    <span class="text-xl">📢</span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                @if($announcement->is_pinned)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        📌 Disematkan
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500">{{ $announcement->published_at->format('d M Y, H:i') }}</span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                <a href="{{ route('announcements.show', $announcement) }}">{{ $announcement->title }}</a>
                            </h3>

                            <p class="text-gray-600 mb-3 line-clamp-3">{{ Str::limit(strip_tags($announcement->content), 200) }}</p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3 text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <img class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($announcement->creator->name) }}&background=1B365D&color=fff" alt="{{ $announcement->creator->name }}">
                                        <span>{{ $announcement->creator->name }}</span>
                                    </div>
                                    @if($announcement->attachment)
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                            <span>Lampiran</span>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('announcements.show', $announcement) }}" class="inline-flex items-center space-x-1 text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-{{ $type == 'urgent' ? 'red' : ($type == 'important' ? 'yellow' : ($type == 'event' ? 'green' : 'blue')) }}-100 flex items-center justify-center">
                        @if($type == 'urgent')
                            <span class="text-2xl">🚨</span>
                        @elseif($type == 'important')
                            <span class="text-2xl">⚠️</span>
                        @elseif($type == 'event')
                            <span class="text-2xl">📅</span>
                        @else
                            <span class="text-2xl">📢</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada {{ strtolower($title) }}</h3>
                    <p class="text-gray-500 mb-6">
                        @if($type == 'urgent')
                            Tidak ada pengumuman mendesak saat ini.
                        @elseif($type == 'important')
                            Tidak ada pengumuman penting saat ini.
                        @elseif($type == 'event')
                            Tidak ada agenda kegiatan saat ini.
                        @else
                            Tidak ada pengumuman umum saat ini.
                        @endif
                    </p>
                    <a href="{{ route('announcements.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Lihat Semua Pengumuman
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($announcements->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection