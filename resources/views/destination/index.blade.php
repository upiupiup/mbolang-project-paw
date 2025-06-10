@extends('layouts.app')

@section('title', 'Kategori Destinasi - MBOLANG')

@section('content')
<div class="destinasi-container" style="margin: 40px auto; padding: 24px; max-width: 1200px;">

    {{-- Search bar besar --}}
    <div class="search-wrapper" style="margin-bottom: 24px; margin-top: 80px;">
        <input type="text" placeholder="Mau liburan ke mana?" class="search-input">
        <img src="{{ asset('assets/search.png') }}" alt="Cari" class="search-icon">
    </div>

    {{-- Filter dropdown --}}
    <div class="kategori-wrapper" style="margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
        <select id="filterKategori" class="kategori-dropdown">
            <option value="" disabled selected hidden>Masukkan kategori destinasi</option>
            <option value="">Semua</option>
            <option value="pantai">Pantai</option>
            <option value="gunung">Gunung</option>
            <option value="coban">Coban</option>
            <option value="bukit">Bukit</option>
        </select>
        <img src="{{ asset('assets/downarrow.png') }}" class="kategori-icon" alt="Dropdown Arrow" style="width: 20px;">
    </div>

    {{-- Grid destinasi --}} 
    <div class="destinasi-grid">
        @foreach ($destinations as $destination)
            <a href="{{ route('destination.show', $destination->id) }}"
                class="destinasi-box"
                data-kategori="{{ strtolower($destination->category ?? 'lainnya') }}">
                <img src="{{ asset('storage/destinasi/' . $destination->image) }}" class="destinasi-image">
                <div class="destinasi-info">
                    <h3 class="destinasi-nama">{{ $destination->name }}</h3>
                    <div class="location-row">
                        <img src="{{ asset('assets/location-icon.png') }}" class="location-icon">
                        <span class="location-text">{{ $destination->location }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Pesan jika tidak ditemukan --}}
    <p id="notFoundMessage" style="text-align: center; margin-top: 20px; color: #888; font-size: 16px; display: none;">
        Destinasi yang Anda cari tidak dapat ditemukan.
    </p>

</div>

{{-- Script filter --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.getElementById('filterKategori');
        const searchInput = document.querySelector('.search-input');
        const boxes = document.querySelectorAll('.destinasi-box');
        const notFoundMessage = document.getElementById('notFoundMessage');

        function filterDestinasi() {
            const selectedKategori = dropdown.value.toLowerCase();
            const keyword = searchInput.value.toLowerCase().trim();
            let ditemukan = false;

            boxes.forEach(box => {
                const nama = box.querySelector('.destinasi-nama').textContent.toLowerCase();
                const kategori = box.getAttribute('data-kategori');
                const cocokNama = nama.includes(keyword);
                const cocokKategori = selectedKategori === "" || kategori === selectedKategori;

                const tampil = cocokNama && cocokKategori;
                box.style.display = tampil ? 'block' : 'none';
                if (tampil) ditemukan = true;
            });

            notFoundMessage.style.display = ditemukan ? 'none' : 'block';
        }

        dropdown.addEventListener('change', filterDestinasi);
        searchInput.addEventListener('input', filterDestinasi);
    });
</script>
@endsection
