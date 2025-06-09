@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Kiri: gambar -->
    <div class="left-section">
        <img src="{{ asset('assets/login.png') }}" alt="beach">
    </div>

    <!-- Kanan: form login -->
    <div class="right-section">
        <h2 style="font-size:2rem;">Hello! Welcome back to <br> MBOLANG, buddy!</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter the email" value="{{ old('email') }}">
                @error('email') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimum 8 digits">
                    <img src="{{ asset('assets/mata.png') }}" alt="icon-mata" class="eye-icon">
                </div>
                @error('password') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="login-btn">Login</button>

            <p class="signup-text">
                Don't have an account yet?
                <a href="{{ route('register') }}"><u>Sign Up</u></a>
            </p>

            <!-- <div class="social-login">
                <span class="or-text">Or with</span>
            </div>

            <div class="social-icons">
                <img src="{{ asset('assets/google.png') }}" alt="Google">
                <img src="{{ asset('assets/facebook.png') }}" alt="Facebook">
            </div> -->
        </form>
    </div>
</div>
@endsection
