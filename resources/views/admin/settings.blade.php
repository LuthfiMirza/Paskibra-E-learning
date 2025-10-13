@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')
@section('subtitle', 'Konfigurasi utama dan kebijakan keamanan platform')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf

        <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Panel Pengaturan</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Pengaturan Sistem</h1>
                <p class="text-sm text-slate-500">Perbarui identitas platform, kebijakan pengguna, dan konfigurasi keamanan.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <button type="button" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600 hover:border-rose-200 hover:text-rose-600">
                    Reset Default
                </button>
                <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[260px_minmax(0,1fr)]">
            <aside class="rounded-3xl border border-slate-200 bg-white p-4 shadow-[0_20px_40px_-35px_rgba(15,23,42,0.35)]">
                <nav class="space-y-1 text-sm" id="settings-nav">
                    <a href="#general" class="flex items-center gap-3 rounded-2xl px-3 py-2 font-medium text-indigo-600 bg-indigo-50/60 hover:bg-slate-50 active">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-500">
                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zm0 0v13m6-6.5C18 18.985 15.313 22 12 22s-6-3.015-6-7.5"/></svg>
                        </span>
                        <span>Umum</span>
                    </a>
                    <a href="#users" class="flex items-center gap-3 rounded-2xl px-3 py-2 font-medium text-slate-600 hover:bg-slate-50">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-50 text-sky-500">
                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11a4 4 0 118 0 4 4 0 01-8 0z"/></svg>
                        </span>
                        <span>Pengguna</span>
                    </a>
                    <a href="#security" class="flex items-center gap-3 rounded-2xl px-3 py-2 font-medium text-slate-600 hover:bg-slate-50">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-rose-50 text-rose-500">
                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11h14a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a1 1 0 011-1z"/></svg>
                        </span>
                        <span>Keamanan</span>
                    </a>
                </nav>
            </aside>

            <div class="space-y-8" id="settings-content">
                <!-- General -->
                <section id="general-section" class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-lg font-semibold text-slate-900">Pengaturan Umum</h2>
                        <p class="text-sm text-slate-500">Identitas dan konfigurasi dasar platform.</p>
                    </div>
                    <div class="px-6 py-6 space-y-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="site_name" class="text-sm font-medium text-slate-600">Nama Situs</label>
                                <input id="site_name" name="site_name" type="text" value="{{ $settings['site_name'] ?? '' }}" class="mt-2 h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-700 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                            </div>
                            <div>
                                <label for="admin_email" class="text-sm font-medium text-slate-600">Email Admin</label>
                                <input id="admin_email" name="admin_email" type="email" value="{{ $settings['admin_email'] ?? '' }}" class="mt-2 h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-700 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                            </div>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-700">Mode Pemeliharaan</h3>
                                <p class="text-xs text-slate-500">Aktifkan untuk menutup akses sementara.</p>
                            </div>
                            <label class="inline-flex items-center">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input type="checkbox" name="maintenance_mode" value="1" class="h-5 w-5 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200" @checked($settings['maintenance_mode'] ?? false)>
                            </label>
                        </div>
                    </div>
                </section>

                <!-- Users -->
                <section id="users-section" class="hidden rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-lg font-semibold text-slate-900">Pengaturan Pengguna</h2>
                        <p class="text-sm text-slate-500">Atur kebijakan registrasi dan peran default.</p>
                    </div>
                    <div class="px-6 py-6 space-y-6">
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-700">Izinkan Pendaftaran Mandiri</h3>
                                <p class="text-xs text-slate-500">Pengguna dapat membuat akun tanpa undangan.</p>
                            </div>
                            <label class="inline-flex items-center">
                                <input type="hidden" name="allow_registration" value="0">
                                <input type="checkbox" name="allow_registration" value="1" class="h-5 w-5 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200" @checked($settings['allow_registration'] ?? false)>
                            </label>
                        </div>
                        <div>
                            <label for="default_role" class="text-sm font-medium text-slate-600">Peran default pengguna baru</label>
                            <select id="default_role" name="default_role" class="mt-2 h-11 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                <option value="student" @selected(($settings['default_role'] ?? 'student') === 'student')>Siswa</option>
                                <option value="instructor" @selected(($settings['default_role'] ?? '') === 'instructor')>Instruktur</option>
                                <option value="member" @selected(($settings['default_role'] ?? '') === 'member')>Member</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Security -->
                <section id="security-section" class="hidden rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-lg font-semibold text-slate-900">Keamanan Akun</h2>
                        <p class="text-sm text-slate-500">Tetapkan kebijakan kata sandi dan persyaratan keamanan.</p>
                    </div>
                    <div class="px-6 py-6 space-y-6">
                        <div>
                            <label for="password_min_length" class="text-sm font-medium text-slate-600">Panjang minimal kata sandi</label>
                            <input id="password_min_length" name="password_min_length" type="number" min="6" value="{{ $settings['password_min_length'] ?? 8 }}" class="mt-2 h-11 w-32 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm text-slate-700 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                        </div>
                        <div class="grid gap-4 md:grid-cols-3">
                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                <input type="hidden" name="require_uppercase" value="0">
                                <input type="checkbox" name="require_uppercase" value="1" class="h-5 w-5 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200" @checked($settings['require_uppercase'] ?? false)>
                                Huruf kapital
                            </label>
                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                <input type="hidden" name="require_number" value="0">
                                <input type="checkbox" name="require_number" value="1" class="h-5 w-5 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200" @checked($settings['require_number'] ?? false)>
                                Angka
                            </label>
                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                <input type="hidden" name="require_special" value="0">
                                <input type="checkbox" name="require_special" value="1" class="h-5 w-5 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200" @checked($settings['require_special'] ?? false)>
                                Karakter khusus
                            </label>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = Array.from(document.querySelectorAll('#settings-nav a'));
        const sections = {
            general: document.getElementById('general-section'),
            users: document.getElementById('users-section'),
            security: document.getElementById('security-section')
        };

        const setActiveSection = (target) => {
            navLinks.forEach(link => link.classList.remove('active', 'bg-indigo-50/60', 'text-indigo-600'));
            sections.general.classList.add('hidden');
            sections.users.classList.add('hidden');
            sections.security.classList.add('hidden');

            if (sections[target]) {
                sections[target].classList.remove('hidden');
            }
        };

        navLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const target = link.getAttribute('href').substring(1);
                setActiveSection(target);
                link.classList.add('active', 'bg-indigo-50/60', 'text-indigo-600');
            });
        });

        // initialise default view
        setActiveSection('general');
        navLinks[0]?.classList.add('active', 'bg-indigo-50/60', 'text-indigo-600');
    });
</script>
@endpush
