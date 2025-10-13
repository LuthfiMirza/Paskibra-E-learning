<footer class="bg-slate-900 text-slate-200 mt-16 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/paskibra/logo.jpg') }}" alt="Logo" class="w-10 h-10 rounded-lg object-cover hidden md:block">
                    <div>
                        <p class="text-lg font-semibold tracking-tight">PASKIBRA WiraPurusa</p>
                        <p class="text-xs text-slate-400">E‑Learning Platform</p>
                    </div>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Platform pembelajaran modern untuk mendukung latihan, teori, dan evaluasi PASKIBRA.
                    Fokus pada disiplin, kepemimpinan, dan ketepatan.
                </p>
            </div>

            <!-- Navigasi -->
            <div>
                <p class="text-sm font-semibold text-slate-300 mb-3">Navigasi</p>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white hover:underline">Beranda</a></li>
                    <li><a href="{{ route('courses.index') }}" class="hover:text-white hover:underline">Kursus</a></li>
                    <li><a href="{{ route('quizzes.index') }}" class="hover:text-white hover:underline">Quiz</a></li>
                    <li><a href="{{ route('announcements.index') }}" class="hover:text-white hover:underline">Pengumuman</a></li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div>
                <p class="text-sm font-semibold text-slate-300 mb-3">Bantuan</p>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white hover:underline">Panduan Pengguna</a></li>
                    <li><a href="#" class="hover:text-white hover:underline">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white hover:underline">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white hover:underline">FAQ</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <p class="text-sm font-semibold text-slate-300 mb-3">Kontak</p>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18"/></svg>
                        <span>ppwp.provdkijakarta@gmail.com</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.105 3.316A2 2 0 0012.246 8H17a2 2 0 012 2v9a2 2 0 01-2 2h-2"/></svg>
                        <span>Denpasar, Bali</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>WIB (UTC+7)</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>
                © {{ now()->year }} PASKIBRA WiraPurusa E‑Learning. Semua hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                <span class="opacity-50">•</span>
                <a href="#" class="hover:text-white">Syarat Layanan</a>
            </div>
        </div>
    </div>
</footer>
