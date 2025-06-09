@extends('layouts.app')

@section('content')

<!-- Spacer to prevent content from being hidden under the fixed navbar -->
<div class="h-24"></div>


<!-- Hero -->
<section class="relative min-h-[600px] flex items-center px-12 pt-24 pb-[120px] bg-white overflow-visible z-10">
    
    <!-- Decore -->
    <img src="/assets/decore.png"
         class="absolute top-0 left-0 w-[1600px] h-full object-cover pointer-events-none select-none z-0"
         alt="Background Decore">

    <!-- Text -->
<div class="w-full z-10 max-w-[750px] flex flex-col justify-center min-h-[400px] -translate-y-6">
        <p class="text-[#376FB7] text-2xl md:text-3xl font-bold mb-4">EXPLORE THE BEST OF MALANG</p>
        <h1 class="text-7xl font-extrabold leading-tight mb-4 text-gray-900" style="font-family: 'SF Pro Display'; max-width: 900px;">
            Travel, enjoy and live a new and full life.
        </h1>
        <p class="text-gray-600 text-base" style="font-family: 'Plus Jakarta Sans', sans-serif;">
            Temukan destinasi wisata terbaik, kuliner khas, dan pengalaman seru di setiap sudut Malang. Semua yang kamu butuhkan untuk menjelajah Malang ada di sini — cepat, lengkap, dan terpercaya.
        </p>
    </div>

    <!-- Hero image -->
    <div class="absolute inset-y-0 right-12 flex items-center justify-center z-10 hidden md:flex">
        <img src="/assets/hero4.png"
             alt="Traveler Hero"
             class="w-[370px] max-w-none object-contain mt-[-40px]">
    </div>
</section>




<!-- Most Visited -->
<section class="relative z-0 px-12 pt-12 bg-white">
    <div class="mb-8 text-center">
        <p class="text-xl text-[#376FB7] font-semibold mb-2">Explore Malang’s Hidden Gems</p>
        <h2 class="text-5xl font-bold mb-8">Most Visited Destinations</h2>
    </div>

    <div class="relative max-w-[1080px] mx-auto min-h-[520px]"> <!-- agar muat bayangan bawah -->
        <div id="scrollMostVisit"
            class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide pb-10">
            @foreach ($mostVisit as $destination)
            <a href="{{ route('destination.show', $destination->id) }}"
            class="bg-white rounded-xl overflow-hidden flex-shrink-0 snap-start w-[330px] h-[484px] 
                shadow-[0_20px_35px_-8px_rgba(0,0,0,0.25)] hover:shadow-[0_32px_48px_-8px_rgba(0,0,0,0.25)] hover:-translate-y-1 transition-all duration-200 my-3">
            <img src="{{ asset('storage/destinasi/' . $destination->image) }}"
                class="object-cover w-full h-[332px]"
                alt="{{ $destination->name }}">
            <div class="p-4">
                <h3 class="font-bold">{{ $destination->name }}</h3>
                <div class="flex gap-2 text-sm text-gray-500 mt-0.5 leading-tight">
                    <img src="/assets/location-icon.png" alt="Location Icon" class="w-4 h-4">
                    <span>{{ $destination->location }}</span>
                </div>
            </div>
            </a>
            @endforeach
        </div>

        <!-- Scroll Arrows (biarkan seperti sebelumnya) -->
        <div class="absolute -left-6 top-1/2 -translate-y-1/2 z-10">
            <button onclick="document.getElementById('scrollMostVisit').scrollBy({ left: -340, behavior: 'smooth' })"
                    class="bg-[#376FB7] text-white p-3 rounded-full shadow hover:bg-[#799fcf] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rotate-180" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <div class="absolute -right-6 top-1/2 -translate-y-1/2 z-10">
            <button onclick="document.getElementById('scrollMostVisit').scrollBy({ left: 340, behavior: 'smooth' })"
                    class="bg-[#376FB7] text-white p-3 rounded-full shadow hover:bg-[#799fcf] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- Perfect Destination -->
<section class="px-12 py-16 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
        
        <!-- Kiri: Teks dan tombol -->
        <div>
            <p class="text-xl text-[#376FB7] font-semibold mb-2">The Place</p>
            <h2 class="text-5xl font-bold mb-4 leading-tight text-left">Find The Perfect Destination</h2>

            <p class="text-gray-700 mb-6 max-w-md" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                Jelajahi daftar destinasi pilihan di Malang, mulai dari gunung, pantai, hingga coban, untuk liburan yang tak terlupakan!
            </p>
            <a href="{{ route('destination.index') }}">
                <button class="bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition">
                    Find More
                </button>
            </a>
        </div>

<!-- Kanan: Grid destinasi, responsive horizontal scroll on small screens -->
<div class="w-full">
    <div class="flex md:justify-end gap-3 overflow-x-auto md:overflow-visible">
        @foreach ($randomDestinations as $dest)
        <div class="relative rounded-xl overflow-hidden shadow-lg w-[153px] h-[285px] flex-shrink-0">
            <img src="{{ asset('storage/destinasi/' . $dest->image) }}"
                alt="{{ $dest->name }}"
                class="w-full h-full object-cover">
            <div class="absolute top-3 left-3 right-3 text-white text-base font-semibold drop-shadow-lg break-words leading-tight">
                {{ $dest->name }}
            </div>
        </div>
        @endforeach
    </div>
</div>
    </div>
</section>
@endsection
