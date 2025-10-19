@extends('template-modern')

@section('title', 'Notifikasi - PASKIBRA E-Learning')

@section('content')
@php
    use Illuminate\Support\Str;

    $typeLabels = [
        'announcement' => 'Pengumuman',
        'quiz' => 'Quiz',
        'achievement' => 'Pencapaian',
    ];

    $typeStyles = [
        'announcement' => [
            'border' => 'border-l-blue-600',
            'icon_bg' => 'bg-blue-100',
            'icon_text' => 'text-blue-600',
            'type_badge_bg' => 'bg-blue-100',
            'type_badge_text' => 'text-blue-800',
            'action_class' => 'bg-blue-600 hover:bg-blue-700 text-white',
        ],
        'quiz' => [
            'border' => 'border-l-green-600',
            'icon_bg' => 'bg-green-100',
            'icon_text' => 'text-green-600',
            'type_badge_bg' => 'bg-green-100',
            'type_badge_text' => 'text-green-800',
            'action_class' => 'bg-green-600 hover:bg-green-700 text-white',
        ],
        'achievement' => [
            'border' => 'border-l-yellow-600',
            'icon_bg' => 'bg-yellow-100',
            'icon_text' => 'text-yellow-600',
            'type_badge_bg' => 'bg-yellow-100',
            'type_badge_text' => 'text-yellow-800',
            'action_class' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        ],
        'default' => [
            'border' => 'border-l-slate-500',
            'icon_bg' => 'bg-slate-100',
            'icon_text' => 'text-slate-600',
            'type_badge_bg' => 'bg-slate-100',
            'type_badge_text' => 'text-slate-600',
            'action_class' => 'bg-slate-600 hover:bg-slate-700 text-white',
        ],
    ];
@endphp

<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-orange-600">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-600/10 via-transparent to-red-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Notifikasi</h1>
                        <p class="text-lg text-white/90">Kelola semua pemberitahuan dan update terbaru</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button id="mark-all-read" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Tandai Semua Dibaca</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Total Notifikasi</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6a2 2 0 01-2-2V7a2 2 0 012-2h5m5 0v5"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['total']) }}</div>
        <div class="flex items-center text-sm text-blue-600">
            <span>Semua notifikasi</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Belum Dibaca</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['unread']) }}</div>
        <div class="flex items-center text-sm text-red-600">
            <span>Perlu perhatian</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Hari Ini</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['today']) }}</div>
        <div class="flex items-center text-sm text-green-600">
            <span>Notifikasi baru</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Pengumuman Aktif</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-indigo-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['announcements']) }}</div>
        <div class="flex items-center text-sm text-indigo-600">
            <span>Pengumuman terbaru</span>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex flex-wrap gap-2">
        <button class="filter-tab active px-4 py-2 rounded-lg transition-colors duration-200 bg-blue-600 text-white" data-filter="all">
            Semua
            <span class="ml-2 bg-white bg-opacity-20 text-xs px-2 py-1 rounded-full">{{ number_format($stats['total']) }}</span>
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="unread">
            Belum Dibaca
            <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ number_format($stats['unread']) }}</span>
        </button>
        @foreach($filters as $type)
            <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="{{ $type }}">
                {{ $typeLabels[$type] ?? Str::title(str_replace('_', ' ', $type)) }}
                <span class="ml-2 bg-slate-100 text-slate-700 text-xs px-2 py-1 rounded-full">{{ number_format($typeCounts->get($type, 0)) }}</span>
            </button>
        @endforeach
    </div>
</div>

<!-- Notifications List -->
<div class="space-y-4 {{ $notifications->isEmpty() ? 'hidden' : '' }}" id="notifications-container">
    @foreach($notifications as $notification)
        @php
            $type = $notification['type'];
            $style = $typeStyles[$type] ?? $typeStyles['default'];
            $isUnread = !($notification['is_read'] ?? false);
            $borderClass = $isUnread ? 'border-l-4 ' . $style['border'] : '';
        @endphp
        <div class="notification-item bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-300 {{ $borderClass }}" data-type="{{ $type }}" data-read="{{ $isUnread ? 'false' : 'true' }}">
            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $style['icon_bg'] }}">
                            @switch($notification['icon'])
                                @case('megaphone')
                                    <svg class="w-6 h-6 {{ $style['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l11-6v16l-11-6zm11 0l4.553-2.276A2 2 0 0121 9.618v4.764a2 2 0 01-2.447 1.894L14 14"></path>
                                    </svg>
                                    @break
                                @case('check-circle')
                                    <svg class="w-6 h-6 {{ $style['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @break
                                @case('trophy')
                                    <svg class="w-6 h-6 {{ $style['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m0-4a7 7 0 007-7V5H5v5a7 7 0 007 7z"></path>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-6 h-6 {{ $style['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                            @endswitch
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $notification['title'] }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $notification['message'] }}</p>
                                <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500">
                                    <span>{{ optional($notification['created_at'])->diffForHumans() ?? 'Waktu tidak diketahui' }}</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full {{ $style['type_badge_bg'] }} {{ $style['type_badge_text'] }}">
                                        {{ $typeLabels[$type] ?? Str::title(str_replace('_', ' ', $type)) }}
                                    </span>
                                    @if(!empty($notification['badge']))
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-slate-100 text-slate-700">{{ $notification['badge'] }}</span>
                                    @endif
                                    @if($isUnread)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800">Baru</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 md:ml-4">
                                @if($isUnread)
                                    <button class="mark-read-btn text-blue-600 hover:text-blue-800 text-sm font-medium">Tandai Dibaca</button>
                                @endif
                                @if(!empty($notification['action_url']) && !empty($notification['action_text']))
                                    <a href="{{ $notification['action_url'] }}" class="{{ $style['action_class'] }} text-sm px-3 py-1 rounded-lg transition-colors duration-200">
                                        {{ $notification['action_text'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Empty State -->
<div id="empty-state" class="{{ $notifications->isEmpty() ? '' : 'hidden' }} text-center py-12">
    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V9a9 9 0 10-18 0v3l-5 5h5a9 9 0 0018 0z"></path>
        </svg>
    </div>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada notifikasi</h3>
    <p class="text-gray-500">Semua notifikasi sudah Anda baca atau belum ada notifikasi baru.</p>
</div>

@if($notifications->count() > 10)
    <div class="text-center mt-8">
        <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition-colors duration-200">
            Muat Lebih Banyak
        </button>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const notificationItems = document.querySelectorAll('.notification-item');
    const emptyState = document.getElementById('empty-state');
    const notificationsContainer = document.getElementById('notifications-container');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            filterTabs.forEach(t => {
                t.classList.remove('active', 'bg-blue-600', 'text-white');
                t.classList.add('bg-gray-100', 'text-gray-700');
            });
            this.classList.add('active', 'bg-blue-600', 'text-white');
            this.classList.remove('bg-gray-100', 'text-gray-700');

            let visibleCount = 0;
            notificationItems.forEach(item => {
                const shouldShow = filter === 'all' || 
                                 (filter === 'unread' && item.dataset.read === 'false') ||
                                 item.dataset.type === filter;
                
                if (shouldShow) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                notificationsContainer.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                notificationsContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        });
    });

    const markReadButtons = document.querySelectorAll('.mark-read-btn');
    markReadButtons.forEach(button => {
        button.addEventListener('click', function() {
            const notificationItem = this.closest('.notification-item');
            notificationItem.classList.remove('border-l-4', 'border-l-blue-600', 'border-l-green-600', 'border-l-yellow-600', 'border-l-slate-500');
            notificationItem.dataset.read = 'true';
            this.remove();

            const newBadge = notificationItem.querySelector('.bg-red-100');
            if (newBadge && newBadge.textContent.trim() === 'Baru') {
                newBadge.remove();
            }
        });
    });

    const markAllReadButton = document.getElementById('mark-all-read');
    markAllReadButton.addEventListener('click', function() {
        notificationItems.forEach(item => {
            item.classList.remove('border-l-4', 'border-l-blue-600', 'border-l-green-600', 'border-l-yellow-600', 'border-l-slate-500');
            item.dataset.read = 'true';
            
            const markReadBtn = item.querySelector('.mark-read-btn');
            if (markReadBtn) {
                markReadBtn.remove();
            }
            
            const newBadge = item.querySelector('.bg-red-100');
            if (newBadge && newBadge.textContent.trim() === 'Baru') {
                newBadge.remove();
            }
        });

        const unreadTab = document.querySelector('[data-filter="unread"] span');
        if (unreadTab) {
            unreadTab.textContent = '0';
        }
    });
});
</script>
@endsection
