@extends('layouts.app')

@section('content')

<div class="px-12 pt-6 mt-[96px] flex justify-between items-center">
    <a href="{{ route('home') }}"
       class="bg-[#376FB7] text-white p-3 rounded-full shadow hover:bg-[#799fcf] transition inline-flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rotate-180" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <h1 class="text-5xl font-bold text-black text-center flex-1" style="font-family: 'SF Pro Display';">
        Edit Profile
    </h1>

    {{-- Spacer biar tombol di kiri & title tetap center --}}
    <div class="w-12"></div>
</div>


<section class="px-12 pt-8 pb-5 bg-white">
    <div class="max-w-2xl mx-auto shadow-xl p-10 rounded-xl bg-white border border-gray-270">
        <h2 class="text-3xl font-semibold text-[#799fcf] mb-2 text-center" style="font-family: 'SF Pro Display';">
            Profile Information
        </h2>
        <p class="text-gray-600 mb-6 text-center" style="font-family: 'Plus Jakarta Sans';">
            Update your account's profile information and email address.
        </p>

<div class="flex justify-center w-full">
    <form method="POST" action="{{ route('profile.update') }}" class="w-full max-w-lg space-y-4">
                @csrf
                @method('patch')

                <!-- Name -->
                <div class="w-full">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1 w-full">Name</label>
                    <input id="name" name="name" type="text"
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-[#376FB7] focus:border-[#376FB7] text-gray-800 shadow-sm"
                           required autocomplete="name">
                    @error('name') <p class="text-sm text-red-600 mt-1 w-full">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="w-full">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1 w-full">Email</label>
                    <input id="email" name="email" type="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-[#376FB7] focus:border-[#376FB7] text-gray-800 shadow-sm"
                           required autocomplete="email">
                    @error('email') <p class="text-sm text-red-600 mt-1 w-full">{{ $message }}</p> @enderror
                </div>

                <!-- Save Button -->
                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                            class="bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition">
                        Save
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition
                           x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-gray-600">
                            Saved.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Update Password -->
<section class="px-12 pt-0 pb-5 bg-white">
    <div class="max-w-2xl mx-auto shadow-xl p-10 rounded-xl bg-white border border-gray-270">
        <h2 class="text-3xl font-semibold text-[#799fcf] mb-0 text-center" style="font-family: 'SF Pro Display';">
            Password
        </h2>
        <p class="text-gray-600 mb-6 text-center" style="font-family: 'Plus Jakarta Sans';">
            Update your account's password securely.
        </p>

        <div class="flex justify-center w-full">
<form method="POST" action="{{ route('user-password.update') }}" class="w-full max-w-lg space-y-4">
    @csrf
    @method('PUT')

                <!-- Current Password -->
                <div class="w-full">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1 w-full">Current Password</label>
                    <input id="current_password" name="current_password" type="password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-[#376FB7] focus:border-[#376FB7] text-gray-800 shadow-sm"
                           required autocomplete="current-password">
                    @error('current_password') <p class="text-sm text-red-600 mt-1 w-full">{{ $message }}</p> @enderror
                </div>

                <!-- New Password -->
                <div class="w-full">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 w-full">New Password</label>
                    <input id="password" name="password" type="password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-[#376FB7] focus:border-[#376FB7] text-gray-800 shadow-sm"
                           required autocomplete="new-password">
                    @error('password') <p class="text-sm text-red-600 mt-1 w-full">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="w-full">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1 w-full">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-[#376FB7] focus:border-[#376FB7] text-gray-800 shadow-sm"
                           required autocomplete="new-password">
                </div>

                <!-- Save Button -->
                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                            class="bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition
                           x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-gray-600">
                            Password updated.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Delete Account -->
<section class="px-12 pt-0 pb-8 bg-white">
    <div class="max-w-2xl mx-auto shadow-xl p-10 rounded-xl bg-white border border-gray-270">
        <p class="text-gray-600 mb-6 text-center" style="font-family: 'Plus Jakarta Sans';">
            Permanently delete your account. This action is irreversible.
        </p>

        <div class="flex justify-center w-full">
            <form method="POST" action="{{ route('profile.destroy') }}" class="w-full max-w-lg space-y-4">
                @csrf
                @method('delete')

                <!-- Confirm Password -->
                <div class="w-full">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1 w-full">Confirm Password</label>
                    <input id="password" name="password" type="password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-red-600 focus:border-red-600 text-gray-800 shadow-sm"
                           required autocomplete="current-password">
                    @error('password') <p class="text-sm text-red-600 mt-1 w-full">{{ $message }}</p> @enderror
                </div>

                <!-- Delete Button -->
                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                            class="bg-red-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-red-700 transition">
                        Delete Account
                    </button>

                    @if (session('status') === 'account-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition
                           x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-gray-600">
                            Account deleted.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
