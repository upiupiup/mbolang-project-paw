<!-- Alpine.js for dropdown functionality -->
<script src="//unpkg.com/alpinejs" defer></script>
<nav class="bg-white fixed top-0 left-0 w-full z-50 shadow">
  <div class="max-w-screen-2xl mx-auto px-12 flex justify-between items-center py-6">
    <!-- kiri: logo -->
    <div>
      <a href="/">
        <img src="/assets/logo.png" alt="Logo Mbolang" class="h-10 md:h-12">
      </a>
    </div>

    <!-- kanan: menu -->
    <ul class="flex gap-16 items-center font-normal text-sm" style="font-family: 'Plus Jakarta Sans', sans-serif;">
      <li>
        <a href="/"
           class="{{ request()->is('/') ? 'text-[#376FB7]' : 'text-gray-700 hover:text-[#799fcf]' }}">
          Home
        </a>
      </li>
      <li>
        <a href="/about"
           class="{{ request()->is('about') ? 'text-[#376FB7]' : 'text-gray-700 hover:text-[#799fcf]' }}">
          About Us
        </a>
      </li>
      @auth
        <!-- Dropdown Profile Toggle -->
        <li class="relative" x-data="{ open: false }">
          <button @click="open = !open"
            class="flex items-center gap-2 px-5 py-1 border border-gray-800 rounded-full hover:border-[#799fcf] hover:text-[#799fcf] transition group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black-100 group-hover:text-[#799fcf] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            {{ Auth::user()->name }}
          </button>

          <!-- Dropdown Menu -->
          <div x-show="open" x-cloak @click.away="open = false" x-transition
               class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border text-sm z-50">
            <div class="p-4 text-center border-b">
              @php
                $photo = Auth::user()->profile_photo
                    ? asset('storage/' . Auth::user()->profile_photo)
                    : asset('images/default.jpeg'); // fallback ke default
              @endphp

              <img src="{{ $photo }}"
                  alt="Profile Photo"
                  class="w-12 h-12 mx-auto rounded-full object-cover border border-gray-300 shadow" />

              <p class="mt-2 font-semibold">{{ Auth::user()->name }}</p>
            </div>
            <ul class="divide-y">
  <li>
    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-[#799fcf]/20 hover:text-black">
      <img src="{{ asset('assets/edit-profile.png') }}" class="w-5 h-5" alt="Edit Profile">
      Edit Profile
    </a>
  </li>
  <!-- <li>
    <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-[#799fcf]/20 hover:text-black">
      <img src="{{ asset('assets/account-settings.png') }}" class="w-5 h-5" alt="Account Settings">
      Account Settings
    </a>
  </li> -->
<li>
  <a href="{{ route('wishlist') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-[#799fcf]/20 hover:text-black">
    <img src="{{ asset('assets/my-wishlist.png') }}" class="w-5 h-5" alt="My Wishlist">
    My Wishlist
  </a>
</li>

  <li class="rounded-b-xl overflow-hidden">
    <form method="POST" action="{{ route('logout') }}" class="w-full">
      @csrf
      <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 transition">
        <img src="{{ asset('assets/keluar.png') }}" class="w-5 h-5" alt="Logout">
        Keluar
      </button>
    </form>
  </li>
</ul>
          </div>
        </li>
      @else
        <!-- Tombol Login kalau belum login -->
        <li>
          <a href="{{ route('login') }}"
             class="px-5 py-1 border border-gray-800 rounded-full transition 
                    {{ request()->is('login') ? 'text-[#376FB7] border-[#376FB7]' : 'text-gray-800 hover:border-[#799fcf] hover:text-[#799fcf]' }}">
            Login
          </a>
        </li>
      @endauth
    </ul>
  </div>
</nav>