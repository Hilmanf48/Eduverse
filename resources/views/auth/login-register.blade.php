<x-guest-layout>
    <div class="auth-container" id="auth-container">
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="font-bold text-2xl">Buat Akun</h1>
                <div class="social-container">
                    {{-- Bisa ditambahkan ikon social media di sini --}}
                </div>
                <span>atau gunakan email untuk registrasi</span>
                <input type="text" name="name" placeholder="Nama" :value="old('name')" required autofocus />
                <input type="email" name="email" placeholder="Email" :value="old('email')" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required />
                <button type="submit" class="mt-4">Register</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="font-bold text-2xl">Sign in</h1>
                <div class="social-container">
                    {{-- Bisa ditambahkan ikon social media di sini --}}
                </div>
                <span>atau gunakan akun Anda</span>
                <input type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                <input type="password" name="password" placeholder="Password" required />
                <a href="{{ route('password.request') }}" class="text-xs mt-2">Lupa password?</a>
                <button type="submit" class="mt-2">Sign In</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="font-bold text-3xl">Selamat Datang Kembali!</h1>
                    <p>Untuk tetap terhubung dengan kami, silakan login dengan akun Anda</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="font-bold text-3xl">Halo, Kawan!</h1>
                    <p>Masukkan data diri Anda dan mulailah perjalanan belajar bersama kami</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>