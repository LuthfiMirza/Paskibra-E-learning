@extends('template-modern')

@section('title', 'Profil Saya - PASKIBRA E-Learning')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-blue-600">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-transparent to-purple-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Profil Saya</h1>
                    <p class="text-lg text-white/90">Kelola informasi akun dan pengaturan keamanan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Overview -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center space-x-6">
        <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-2xl">{{ substr(auth()->user()->name ?? 'SA', 0, 2) }}</span>
        </div>
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name ?? 'Super Admin' }}</h2>
            <p class="text-gray-600">{{ auth()->user()->email ?? 'admin@paskibra.com' }}</p>
            <div class="flex items-center space-x-4 mt-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ auth()->user()->role ?? 'Administrator' }}
                </span>
                <span class="text-sm text-gray-500">Bergabung {{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'Nov 2024' }}</span>
            </div>
        </div>
        <div class="text-right">
            <div class="text-sm text-gray-500 mb-1">Level PASKIBRA</div>
            <div class="text-2xl font-bold text-blue-600">7</div>
            <div class="text-xs text-gray-500">Anggota Terampil</div>
        </div>
    </div>
</div>

<!-- Profile Sections -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Update Profile Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                    <p class="text-sm text-gray-600">Update informasi profil dan alamat email Anda</p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Keamanan Password</h3>
                    <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang kuat</p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>

<!-- Account Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Materi Selesai</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">18</div>
        <div class="flex items-center text-sm text-green-600">
            <span>dari 24 materi</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Quiz Lulus</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">8</div>
        <div class="flex items-center text-sm text-green-600">
            <span>dari 12 quiz</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Rata-rata Nilai</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">85.2</div>
        <div class="flex items-center text-sm text-green-600">
            <span>Sangat Baik</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Lencana Diraih</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">6</div>
        <div class="flex items-center text-sm text-green-600">
            <span>dari 15 lencana</span>
        </div>
    </div>
</div>

<!-- Delete Account Section -->
<div class="bg-white rounded-xl shadow-sm border border-red-200">
    <div class="p-6 border-b border-red-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-red-900">Zona Berbahaya</h3>
                <p class="text-sm text-red-600">Tindakan ini tidak dapat dibatalkan. Harap berhati-hati.</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection