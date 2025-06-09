@extends('layouts.app')

@section('title', 'About Us - MBOLANG')

@section('content')
<div class="about-container" style="font-family: 'Inter', sans-serif; padding: 60px 5%; background-color: #fff; color: #222;">

    <!-- Hero Section -->
    <!-- Section: Hero -->
    <section style="text-align: center; padding: 80px 0 40px;">
        <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 10px;">Looking for adventure?</h1>
        <p style="font-size: 18px; color: #555;">You're in the right place!</p>

        <!-- Logo MBOLANG -->
        <div style="margin: 0px 0; display: flex; justify-content: center;">
            <img src="{{ asset('assets/logo.png') }}" alt="MBOLANG Logo" style="margin-top: 10px;margin-bottom: 10px; width: 500px; height: auto; align-items:center;">
        </div>
    </section>

    <!-- What is MBOLANG -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 20px;">What is MBOLANG?</h2>
        <div style="max-width: 700px; margin: 0 auto; background: #f9f9f9; padding: 24px; border-radius: 12px; box-shadow: 0 6px 16px rgba(0,0,0,0.05);">
            <p style="font-size: 16px; color: #444;">
                MBOLANG adalah sahabat setia petualanganmu dalam menjelajahi keindahan alam Malang. Kami hadir untuk membantumu menemukan destinasi wisata alam terbaik, mulai dari pantai berpasir putih yang tersembunyi, air terjun menakjubkan di balik perbukitan, hingga jalur pendakian yang menawarkan pemandangan luar biasa. 

                Dengan semangat eksplorasi dan kecintaan terhadap alam, MBOLANG mengajakmu untuk keluar dari rutinitas dan menyatu dengan alam. Temukan sudut-sudut Malang yang belum banyak diketahui orang, nikmati keasrian alamnya, dan rasakan sensasi liburan yang otentik dan membebaskan bersama MBOLANG.            </p>
        </div>
    </div>

    <!-- Our Missions Section -->
    <section style="padding: 60px 5%;">
        <h2 style="text-align: left; font-size: 28px; font-weight: 700; margin-bottom: 30px; color: #111;">
            Our Missions
        </h2>

        <div style="display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 40px;">
            <!-- Misi Kiri -->
            <div style="flex: 1 1 320px; min-width: 280px; max-width: 480px; margin-left: 0;">
            <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 28px;">
                <img src="{{ asset('assets/Group 13.png') }}" style="width: 40px; height: 40px;">
                <div>
                <h4 style="font-weight: 600;">Empower Local</h4>
                <p style="color: #555;">Membantu UMKM lokal memperluas jangkauan pariwisata.</p>
                </div>
            </div>

            <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 28px;">
                <img src="{{ asset('assets/Group 7.png') }}" style="width: 40px; height: 40px;">
                <div>
                <h4 style="font-weight: 600;">Connected Convenience</h4>
                <p style="color: #555;">Hubungkan langsung dengan kontak penyedia wisata lokal.</p>
                </div>
            </div>

            <div style="display: flex; align-items: flex-start; gap: 12px;">
                <img src="{{ asset('assets/Group 37063.png') }}" style="width: 40px; height: 40px;">
                <div>
                <h4 style="font-weight: 600;">Youth Exploration</h4>
                <p style="color: #555;">Dorong generasi muda mengeksplorasi keindahan Indonesia.</p>
                </div>
            </div>
            </div>

            <!-- Bagian kanan: gambar -->
            <div style="flex: 1 1 320px; min-width: 260px; max-width: 400px; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: -10px;">
                <img src="{{ asset('storage/destinasi/PANTAI TANJUNG PENYU.jpg') }}" style="max-width: 95%; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
                <p style="margin-top: 10px; color: #777; font-size: 15px;">Pantai Tanjung Penyu – Kec. Sumbermanjing Wetan</p>
            </div>
        </div>
    </section>

    <!-- Our Services -->
    <div style="text-align: center;">
        <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 50px;margin-top: 50px;">Our Services</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;">
            <div style="width: 240px; background: #fff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/map.png') }}" alt="Map" style="width: 80px; margin-bottom: 12px;">
                </div>
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Hastle-free</h4>
                <p style="font-size: 14px; color: #555;">Semua jadi gampang! Mulai cari tempat wisata alam yang menarik, rencanakan perjalanan seru, dan eksplorasi destinasi favorit dalam satu platform yang simpel dan mudah digunakan.</p>
            </div>
            <div style="width: 240px; background: #fff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/cam.png') }}" alt="Camera" style="width: 80px; margin-bottom: 12px;">
                </div>
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Memorable</h4>
                <p style="font-size: 14px; color: #555;">Semua tempat dan layanan yang kami tawarkan dipilih karena punya nuansa lokal yang otentik.</p>
            </div>
            <div style="width: 240px; background: #fff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/star.png') }}" alt="Star" style="width: 80px; margin-bottom: 12px;">
                </div>
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Always new</h4>
                <p style="font-size: 14px; color: #555;">Kami terus menghadirkan destinasi dan aktivitas seru, supaya setiap petualanganmu selalu penuh kejutan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
