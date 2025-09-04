@extends('template-modern')

@section('title', 'Notifikasi - PASKIBRA E-Learning')

@section('content')
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
        <div class="text-3xl font-bold text-gray-900 mb-2">12</div>
        <div class="flex items-center text-sm text-green-600">
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
        <div class="text-3xl font-bold text-gray-900 mb-2">3</div>
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
        <div class="text-3xl font-bold text-gray-900 mb-2">5</div>
        <div class="flex items-center text-sm text-green-600">
            <span>Notifikasi baru</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Pencapaian</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">2</div>
        <div class="flex items-center text-sm text-yellow-600">
            <span>Lencana baru</span>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex flex-wrap gap-2">
        <button class="filter-tab active px-4 py-2 rounded-lg transition-colors duration-200 bg-blue-600 text-white" data-filter="all">
            Semua
            <span class="ml-2 bg-white bg-opacity-20 text-xs px-2 py-1 rounded-full">12</span>
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="unread">
            Belum Dibaca
            <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="announcement">
            Pengumuman
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="quiz">
            Quiz
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="achievement">
            Pencapaian
        </button>
        <button class="filter-tab px-4 py-2 rounded-lg transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200" data-filter="course">
            Materi
        </button>
    </div>
</div>

<!-- Notifications List -->
<div class="space-y-4" id="notifications-container">
    <!-- Notification Item 1 - Unread -->
    <div class="notification-item bg-white rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-600 hover:shadow-md transition-shadow duration-300" data-type="course" data-read="false">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Materi baru tersedia</h3>
                            <p class="text-gray-600 text-sm mb-3">Materi "Kepemimpinan PASKIBRA" telah ditambahkan ke dalam sistem pembelajaran</p>
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span>2 jam yang lalu</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Materi</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Baru</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="mark-read-btn text-blue-600 hover:text-blue-800 text-sm font-medium">Tandai Dibaca</button>
                            <a href="{{ route('courses.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-lg transition-colors duration-200">Lihat Materi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Item 2 - Unread -->
    <div class="notification-item bg-white rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-600 hover:shadow-md transition-shadow duration-300" data-type="quiz" data-read="false">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Quiz berhasil diselesaikan</h3>
                            <p class="text-gray-600 text-sm mb-3">Selamat! Anda mendapat nilai 85 pada Quiz Dasar Kepaskibraan</p>
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span>1 hari yang lalu</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Quiz</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Baru</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="mark-read-btn text-blue-600 hover:text-blue-800 text-sm font-medium">Tandai Dibaca</button>
                            <a href="{{ route('grades.index') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded-lg transition-colors duration-200">Lihat Nilai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Item 3 - Unread -->
    <div class="notification-item bg-white rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-600 hover:shadow-md transition-shadow duration-300" data-type="achievement" data-read="false">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Pencapaian baru!</h3>
                            <p class="text-gray-600 text-sm mb-3">Anda meraih lencana "Pembelajar Aktif" karena menyelesaikan 10 materi</p>
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span>2 hari yang lalu</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pencapaian</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Baru</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="mark-read-btn text-blue-600 hover:text-blue-800 text-sm font-medium">Tandai Dibaca</button>
                            <a href="{{ route('achievements.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-3 py-1 rounded-lg transition-colors duration-200">Lihat Lencana</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Item 4 - Read -->
    <div class="notification-item bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-300" data-type="announcement" data-read="true">
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Pengumuman penting</h3>
                            <p class="text-gray-600 text-sm mb-3">Jadwal latihan rutin PASKIBRA akan dimulai minggu depan</p>
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span>3 hari yang lalu</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Pengumuman</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <a href="{{ route('announcements.index') }}" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded-lg transition-colors duration-200">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div id="empty-state" class="hidden text-center py-12">
    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V9a9 9 0 10-18 0v3l-5 5h5a9 9 0 0018 0z"></path>
        </svg>
    </div>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada notifikasi</h3>
    <p class="text-gray-500">Semua notifikasi sudah Anda baca atau belum ada notifikasi baru.</p>
</div>

<!-- Load More Button -->
<div class="text-center mt-8">
    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition-colors duration-200">
        Muat Lebih Banyak
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const notificationItems = document.querySelectorAll('.notification-item');
    const emptyState = document.getElementById('empty-state');
    const notificationsContainer = document.getElementById('notifications-container');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active tab
            filterTabs.forEach(t => {
                t.classList.remove('active', 'bg-blue-600', 'text-white');
                t.classList.add('bg-gray-100', 'text-gray-700');
            });
            this.classList.add('active', 'bg-blue-600', 'text-white');
            this.classList.remove('bg-gray-100', 'text-gray-700');

            // Filter notifications
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

            // Show/hide empty state
            if (visibleCount === 0) {
                notificationsContainer.style.display = 'none';
                emptyState.classList.remove('hidden');
            } else {
                notificationsContainer.style.display = 'block';
                emptyState.classList.add('hidden');
            }
        });
    });

    // Mark as read functionality
    const markReadButtons = document.querySelectorAll('.mark-read-btn');
    markReadButtons.forEach(button => {
        button.addEventListener('click', function() {
            const notificationItem = this.closest('.notification-item');
            
            // Update UI
            notificationItem.classList.remove('border-l-4', 'border-l-blue-600', 'border-l-green-600', 'border-l-yellow-600');
            notificationItem.dataset.read = 'true';
            this.remove();
            
            // Remove "Baru" badge
            const newBadge = notificationItem.querySelector('.bg-red-100');
            if (newBadge && newBadge.textContent.trim() === 'Baru') {
                newBadge.remove();
            }
        });
    });

    // Mark all as read functionality
    const markAllReadButton = document.getElementById('mark-all-read');
    markAllReadButton.addEventListener('click', function() {
        // Update all notifications
        notificationItems.forEach(item => {
            item.classList.remove('border-l-4', 'border-l-blue-600', 'border-l-green-600', 'border-l-yellow-600');
            item.dataset.read = 'true';
            
            // Remove mark as read buttons
            const markReadBtn = item.querySelector('.mark-read-btn');
            if (markReadBtn) {
                markReadBtn.remove();
            }
            
            // Remove "Baru" badges
            const newBadge = item.querySelector('.bg-red-100');
            if (newBadge && newBadge.textContent.trim() === 'Baru') {
                newBadge.remove();
            }
        });

        // Update unread count in filter tab
        const unreadTab = document.querySelector('[data-filter="unread"] span');
        if (unreadTab) {
            unreadTab.textContent = '0';
        }
    });
});
</script>
@endsection