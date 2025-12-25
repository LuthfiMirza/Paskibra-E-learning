@extends('template-modern')

@section('title', 'Materi Pembelajaran - PASKIBRA E-Learning')

@section('content')
@php

    $categoryLabels = [
        'kepaskibraan' => 'Dasar Kepaskibraan',
        'baris_berbaris' => 'Baris Berbaris',
        'wawasan' => 'Wawasan Kebangsaan',
        'kepemimpinan' => 'Kepemimpinan',
        'protokoler' => 'Protokoler',
    ];
@endphp

<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 via-indigo-700 to-red-600 px-8 py-10 text-white">
            <div class="max-w-3xl">
                <p class="text-sm uppercase tracking-[0.35em] text-white/70 mb-4">Pusat Materi Resmi</p>
                <h1 class="text-3xl font-bold mb-3">Materi Pembelajaran PASKIBRA Wira Purusa</h1>
                <p class="text-base text-white/80">Akses materi terbaru yang dikurasi langsung oleh instruktur PASKIBRA. Pelajari kapan saja dan di mana saja dengan kurikulum yang terstruktur.</p>
            </div>
        </div>
        <div class="p-6 lg:p-8 space-y-6">
            <form method="GET" class="bg-gray-50 border border-gray-200 rounded-xl p-4 lg:p-5">
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-6">
                    <div class="xl:col-span-3">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Materi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ $activeFilters['search'] }}"
                                placeholder="Cari judul, deskripsi, atau instruktur"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select
                            id="category"
                            name="category"
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="all">Semua kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" @selected($activeFilters['category'] === $category)>
                                    {{ $categoryLabels[$category] ?? ucfirst(str_replace('_', ' ', $category)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">Tingkatan</label>
                        <select
                            id="difficulty"
                            name="difficulty"
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            @if(empty($restrictedLevelLabel))
                                <option value="all">Semua tingkat</option>
                            @endif
                            @foreach($difficulties as $key => $label)
                                <option value="{{ $key }}" @selected($activeFilters['difficulty'] === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4h13M8 8h13M8 12h9M3 4h.01M3 8h.01M3 12h.01M3 16h.01" />
                            </svg>
                            Terapkan Filter
                        </button>
                        @if($activeFilters['search'] || ($activeFilters['category'] && $activeFilters['category'] !== 'all') || ($activeFilters['difficulty'] && $activeFilters['difficulty'] !== 'all'))
                            <a href="{{ route('courses.index') }}" class="ml-3 text-sm text-gray-600 hover:text-gray-800">Reset</a>
                        @endif
                    </div>
                </div>
            </form>
            @if(!empty($restrictedLevelLabel))
                <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-3 text-sm text-blue-700">
                    <p class="font-semibold">Menampilkan materi untuk tingkatan {{ $restrictedLevelLabel }}.</p>
                    <p class="text-blue-600/80">Hubungi admin bila ingin membuka akses tingkatan lain.</p>
                </div>
            @endif

            @if($featuredCourse)
                <div class="grid gap-6 lg:grid-cols-3 items-stretch">
                    <div class="lg:col-span-2 bg-gradient-to-br from-yellow-500 via-orange-500 to-red-500 text-white rounded-2xl p-8 relative overflow-hidden shadow-md">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative z-10">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wider bg-white/10 border border-white/20 rounded-full">Rekomendasi Utama</span>
                            <h2 class="text-2xl font-bold mt-4 mb-3">{{ $featuredCourse->title }}</h2>
                            <p class="text-white/85 max-w-2xl">{{ \Illuminate\Support\Str::limit($featuredCourse->description, 180) }}</p>
                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/20">📚</span>
                                    <div>
                                        <p class="text-white/60 text-xs">Jumlah Materi</p>
                                        <p class="font-semibold">{{ $featuredCourse->lessons_count }} modul</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/20">⏱️</span>
                                    <div>
                                        <p class="text-white/60 text-xs">Durasi Total</p>
                                        <p class="font-semibold">{{ $featuredCourse->duration_minutes }} menit</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/20">🎯</span>
                                    <div>
                                        <p class="text-white/60 text-xs">Tingkat</p>
                                        <p class="font-semibold">{{ $featuredCourse->difficulty_display ?? ucfirst($featuredCourse->difficulty) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('courses.show', $featuredCourse) }}" class="inline-flex items-center bg-white text-blue-900 font-semibold px-5 py-2 rounded-lg shadow-sm hover:-translate-y-[1px] transition-transform">
                                    Mulai kelas sekarang
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col justify-between shadow-sm">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pembelajaran Anda</h3>
                            <dl class="space-y-3 text-sm">
                                <div class="flex items-center justify-between">
                                    <dt class="text-gray-600">Kursus diikuti</dt>
                                    <dd class="text-gray-900 font-semibold">{{ $courses->total() }}</dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-gray-600">Filter aktif</dt>
                                    <dd class="text-gray-900 font-semibold">
                                        {{ $activeFilters['category'] && $activeFilters['category'] !== 'all' ? ($categoryLabels[$activeFilters['category']] ?? ucfirst(str_replace('_', ' ', $activeFilters['category']))) : 'Semua' }}
                                    </dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-gray-600">Tingkatan</dt>
                                    <dd class="text-gray-900 font-semibold">
                                        {{ $activeFilters['difficulty'] && $activeFilters['difficulty'] !== 'all' ? ($difficulties[$activeFilters['difficulty']] ?? ucfirst($activeFilters['difficulty'])) : 'Semua' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="mt-6">
                            <p class="text-sm text-gray-500 mb-2">Tidak menemukan materi yang Anda cari?</p>
                            <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700">
                                Lihat pengumuman pembaruan materi
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Semua Kursus</h2>
            <span class="text-sm text-gray-500">{{ $courses->total() }} kursus tersedia</span>
        </div>

        @if($courses->count())
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($courses as $course)
                    @php

                        $thumbnail = $course->thumbnail ? asset('storage/' . $course->thumbnail) : null;
                        $duration = $course->duration_minutes ?? 0;
                        $hours = intdiv($duration, 60);
                        $minutes = $duration % 60;
                    @endphp
                    <article class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                        <div class="relative h-40 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600">
                            @if($thumbnail)
                                <img src="{{ $thumbnail }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-white/80 text-5xl font-semibold">
                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($course->title, 0, 1)) }}
                                </div>
                            @endif
                            <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-blue-900">
                                {{ $categoryLabels[$course->category] ?? ucfirst(str_replace('_', ' ', $course->category)) }}
                            </span>
                        </div>
                        <div class="flex-1 p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-xs uppercase tracking-wide text-gray-500">
                                    <span>{{ ucfirst($course->difficulty_display ?? $course->difficulty) }}</span>
                                    <span>•</span>
                                    <span>{{ optional($course->creator)->name ?? 'Instruktur PASKIBRA' }}</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                                    <a href="{{ route('courses.show', $course) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $course->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($course->description, 140) }}
                                </p>
                            </div>
                            <dl class="grid grid-cols-2 gap-4 text-xs text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>
                                    <div>
                                        <dt>Modul</dt>
                                        <dd class="text-gray-900 font-semibold">{{ $course->lessons_count ?? $course->lessons()->count() }}</dd>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <dt>Durasi</dt>
                                        <dd class="text-gray-900 font-semibold">
                                            {{ $hours > 0 ? $hours.' jam ' : '' }}{{ $minutes }} menit
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </div>
                        <div class="px-6 pb-6">
                            <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center justify-center w-full px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition-colors">
                                Lihat Materi
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div>
                {{ $courses->links() }}
            </div>
        @else
            <div class="bg-white border border-dashed border-gray-300 rounded-2xl p-12 text-center">
                <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121A3 3 0 019 9m9 12H6a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v10a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada materi yang sesuai</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    @if(!empty($restrictedLevelLabel))
                        Materi untuk tingkatan {{ $restrictedLevelLabel }} sedang disiapkan. Silakan cek kembali nanti atau hubungi instruktur jika membutuhkan akses tambahan.
                    @else
                        Coba ubah kata kunci pencarian atau pilih kategori lain untuk menemukan materi yang Anda butuhkan.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
