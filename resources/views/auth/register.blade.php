@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Kiri: Gambar -->
    <div class="left-section">
        <img src="{{ asset('assets/login.png') }}" alt="beach">
    </div>

    <!-- Kanan: Form Sign Up -->
    <div class="right-section">
        <h2 style="font-size:2rem;">Hello! Ready to start your journey with <br>MBOLANG, buddy?</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter the name" value="{{ old('name') }}">
                @error('name') 
                    <small style="color:red;">{{ $message }}</small> 
                @enderror
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter the email" value="{{ old('email') }}">
                @error('email') 
                    <small style="color:red;">{{ $message }}</small> 
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimum 8 digits">
                    <img src="{{ asset('assets/mata.png') }}" alt="icon-mata" class="eye-icon">
                </div>
                @error('password') 
                    <small style="color:red;">{{ $message }}</small> 
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="The password must match">
                    <img src="{{ asset('assets/mata.png') }}" alt="icon-mata" class="eye-icon">
                </div>
            </div>

            <div class="terms">
                <input type="checkbox" id="agree" name="agree" {{ old('agree') ? 'checked' : '' }}>
                <label for="agree">
                    You have read, understood, and agree to our 
                    <a href="#">Terms & Privacy Policy.</a>
                </label>
                @error('agree') 
                    <small style="color:red;">{{ $message }}</small> 
                @enderror
            </div>

            <button type="submit" class="signup-btn">Sign Up</button>

            <p class="signup-text">
                Already have an account? <a href="{{ route('login') }}"><u>Login</u></a>
            </p>

            <!-- 
            <div class="social-login">
                <span class="or-text">Or with</span>
            </div>

            <div class="social-icons">
                <img src="{{ asset('assets/google.png') }}" alt="Google">
                <img src="{{ asset('assets/facebook.png') }}" alt="Facebook">
            </div> 
            -->
        </form>
        <script>
            document.querySelectorAll('.password-wrapper').forEach(wrapper => {
                const input = wrapper.querySelector('input[type="password"]');
                const icon = wrapper.querySelector('.eye-icon');

                icon.style.cursor = 'pointer';
                icon.addEventListener('click', () => {
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.src = "{{ asset('assets/mata-melek.png') }}"; // ganti dengan ikon mata terbuka
                    } else {
                        input.type = 'password';
                        icon.src = "{{ asset('assets/mata.png') }}"; // kembali ke ikon tertutup
                    }
                });
            });
        </script>
    </div>
</div>
@endsection
