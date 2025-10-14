<x-guest-layout>
    <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">Daftar Akun Baru</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" class="form-input w-full" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input w-full" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- NRA -->
        <div class="mb-4">
            <label for="nis" class="form-label">NRA (Nomor Registrasi Anggota)</label>
            <input id="nis" class="form-input w-full" type="text" name="nis" value="{{ old('nis') }}" placeholder="Contoh: NRA0001" />
            @error('nis')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tingkatan -->
        <div class="mb-4">
            <label for="angkatan" class="form-label">Tingkatan</label>
            <input id="angkatan" class="form-input w-full" type="text" name="angkatan" value="{{ old('angkatan') }}" placeholder="Contoh: 1" />
            @error('angkatan')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-input w-full" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full mb-4">
            Daftar
        </button>

        <div class="text-center">
            Sudah punya akun? <a href="{{ route('login') }}" class="link-primary">Login di sini</a>
        </div>
    </form>
</x-guest-layout>
