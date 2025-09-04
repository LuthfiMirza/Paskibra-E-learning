@extends('layouts.dashboard')

@section('title', $announcement->title)
@section('subtitle', 'Pengumuman ' . $announcement->type_display)

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($announcement->title, 50) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Article Content -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $announcement->type_color }}-100 text-{{ $announcement->type_color }}-800">
                            @if($announcement->type == 'urgent')
                                🚨 {{ $announcement->type_display }}
                            @elseif($announcement->type == 'important')
                                ⚠️ {{ $announcement->type_display }}
                            @elseif($announcement->type == 'event')
                                📅 {{ $announcement->type_display }}
                            @else
                                📢 {{ $announcement->type_display }}
                            @endif
                        </span>
                        @if($announcement->is_pinned)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                📌 Disematkan
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $announcement->title }}</h1>

                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center space-x-2">
                            <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($announcement->creator->name) }}&background=1B365D&color=fff" alt="{{ $announcement->creator->name }}">
                            <div>
                                <p class="font-medium text-gray-900">{{ $announcement->creator->name }}</p>
                                <p class="text-xs">{{ $announcement->creator->getRoleNames()->first() ?? 'Admin' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $announcement->published_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ $announcement->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($announcement->content)) !!}
                    </div>

                    <!-- Attachment -->
                    @if($announcement->attachment)
                        <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">Lampiran</h4>
                                    <p class="text-sm text-gray-500">Klik untuk mengunduh file lampiran</p>
                                </div>
                                <a href="{{ $announcement->attachment_url }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Unduh
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button onclick="shareAnnouncement()" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                </svg>
                                Bagikan
                            </button>
                            <button onclick="printAnnouncement()" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak
                            </button>
                        </div>
                        <a href="{{ route('announcements.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Related Announcements -->
            @if($relatedAnnouncements->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengumuman Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedAnnouncements as $related)
                            <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-lg bg-{{ $related->type_color }}-100 flex items-center justify-center">
                                            @if($related->type == 'urgent')
                                                <span class="text-sm">🚨</span>
                                            @elseif($related->type == 'important')
                                                <span class="text-sm">⚠️</span>
                                            @elseif($related->type == 'event')
                                                <span class="text-sm">📅</span>
                                            @else
                                                <span class="text-sm">📢</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors">
                                            <a href="{{ route('announcements.show', $related) }}">{{ Str::limit($related->title, 60) }}</a>
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $related->published_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('announcements.type', 'urgent') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center group-hover:bg-red-200">
                            <span class="text-sm">🚨</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pengumuman Mendesak</p>
                            <p class="text-xs text-gray-500">Lihat semua pengumuman mendesak</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('announcements.type', 'event') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center group-hover:bg-green-200">
                            <span class="text-sm">📅</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Kegiatan</p>
                            <p class="text-xs text-gray-500">Lihat agenda dan acara</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Dashboard</p>
                            <p class="text-xs text-gray-500">Kembali ke dashboard utama</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-900 mb-2">💡 Tips</h4>
                        <p class="text-sm text-blue-800">
                            Pastikan untuk selalu membaca pengumuman terbaru agar tidak ketinggalan informasi penting dari PASKIBRA WiraPurusa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function shareAnnouncement() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $announcement->title }}',
            text: '{{ Str::limit(strip_tags($announcement->content), 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link pengumuman telah disalin ke clipboard!');
        });
    }
}

function printAnnouncement() {
    window.print();
}
</script>

<style>
@media print {
    .sidebar, .breadcrumb, .actions {
        display: none !important;
    }
    
    .lg\\:col-span-2 {
        grid-column: span 3 !important;
    }
}
</style>
@endsection