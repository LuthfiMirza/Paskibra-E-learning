<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="success-message">
            {{ session('status') }}
        </div>
    @endif

    <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Akun</h3>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-input w-full" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="btn-primary w-full mb-4">
            Login
        </button>

        <div class="text-center space-y-2">
            <div>
                Belum punya akun? <a href="{{ route('register') }}" class="link-primary">Daftar di sini</a>
            </div>
            @if (Route::has('password.request'))
                <div>
                    <a href="{{ route('password.request') }}" class="link-primary text-sm">Lupa Password?</a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
