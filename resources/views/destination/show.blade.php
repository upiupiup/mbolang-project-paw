@extends('layouts.app')

@section('title', $destination->name . ' - MBOLANG')

@section('content')
{{-- Tambahkan properti isBookmarked di Alpine --}}
<section class="w-full max-w-[1440px] mx-auto pt-36 px-12 pb-16 bg-white relative" x-data="bookmarkModal({{ $isBookmarked ? 'true' : 'false' }})">

    {{-- ✅ Bagian Judul dan Tombol Bookmark --}}
    <div class="max-w-5xl mx-auto flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">{{ $destination->name }}</h1>

        <button id="bookmarkBtn"
                data-destination-id="{{ $destination->id }}"
                @click="openBookmarkModal = true"
                class="p-2 rounded-full border hover:bg-gray-100 transition">
            <img 
                src="{{ asset('assets/my-wishlist.png') }}" 
                alt="bookmark" 
                class="w-5 h-5 transition duration-200"
                :class="{ 
                    'brightness-0 sepia saturate-200 hue-rotate-30': selectedCategoryId,
                    'grayscale-0 sepia-0 hue-rotate-0 saturate-150 brightness-105': isBookmarked 
                }"
            />
        </button>
    </div>

    {{-- ✅ Gambar --}}
    <div class="max-w-5xl mx-auto mb-8">
        <img src="{{ asset('storage/destinasi/' . $destination->image) }}" 
             alt="{{ $destination->name }}" 
             class="w-full rounded-lg shadow-md object-cover max-h-[500px]">
    </div>

    {{-- ✅ Konten Deskripsi --}}
    <div class="max-w-5xl mx-auto text-gray-700 text-lg leading-relaxed text-justify">
        <p class="mb-6">
            {{ $destination->description ?? 'Belum ada deskripsi untuk destinasi ini.' }}
        </p>

        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <img src="{{ asset('assets/location-icon.png') }}" class="w-5 h-5 mt-1" alt="Lokasi">
                <div>
                    {{ $destination->location }}
                    @if ($destination->gmaps_link)
                        <div>
                            <a href="{{ $destination->gmaps_link }}" target="_blank" class="text-blue-600 underline">Lihat Lokasi</a>
                        </div>
                    @endif
                </div>
            </div>

            @if ($destination->contact_person)
                <div class="flex items-start gap-3">
                    <img src="{{ asset('assets/phone.png') }}" class="w-5 h-5 mt-1" alt="Kontak">
                    <div>{{ $destination->contact_person }}</div>
                </div>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ url('/') }}" 
           class="inline-block mt-10 bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition">
            ← Kembali ke Home
        </a>
    </div>

    {{-- ✅ Modal Bookmark --}}
    <div x-show="openBookmarkModal"
         class="fixed inset-0 bg-black/40 flex justify-center items-center z-50"
         x-cloak>
        <div class="bg-white rounded-2xl w-[420px] shadow-[0_10px_25px_rgba(0,0,0,0.15)] max-h-[90vh] flex flex-col">

            {{-- Header + Filter (Tetap) --}}
            <div class="px-6 pt-7 pb-4 border-b">
                <h2 class="text-2xl font-semibold text-gray-900 mb-3">Save to Wishlist</h2>
                <input type="text"
                       placeholder="Filter categories..."
                       x-model="searchCategory"
                       class="w-full border border-[#D1D5DB] focus:border-[#376FB7] focus:ring-2 focus:ring-[#376FB7]/50 transition text-sm text-gray-800 p-3 rounded-lg placeholder-gray-400">
            </div>

            {{-- 🗂️ Scrollable List --}}
            <div class="overflow-y-auto flex-1 px-6 py-2 space-y-1 max-h-[200px]">
                <template x-for="cat in filteredCategories" :key="cat.id">
                    <div @click="selectedCategoryId = cat.id"
                         class="border px-4 py-5 rounded-lg cursor-pointer flex items-center justify-between transition-all duration-150"
                         :class="selectedCategoryId === cat.id ? 'border-[#376FB7] bg-[#EBF2FF]' : 'hover:bg-[#e5edfa] hover:border-[#376FB7] hover:opacity-90'">
                        <span x-text="cat.name" class="text-sm font-medium text-gray-800"></span>
                        <template x-if="selectedCategoryId === cat.id">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#376FB7]" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 5.707 8.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </template>
                    </div>
                </template>
            </div>

            {{-- ➕ Tombol + Footer --}}
            <div class="px-6 pt-3 pb-6 border-t">
                <button @click="openCreateModal"
                        class="w-full border border-dashed border-[#376FB7] text-sm text-[#376FB7] py-3 rounded-lg hover:bg-[#EBF2FF]/70 transition opacity-80 hover:opacity-100 mb-4">
                    + Create a new category
                </button>

                <div class="flex justify-between gap-4">
                    <button @click="saveBookmark"
                            class="w-full bg-[#376FB7] text-white py-2 rounded-full text-sm font-semibold shadow hover:bg-[#2d5ea0] transition">
                        Save
                    </button>
                    <button @click="openBookmarkModal = false"
                            class="w-full border border-[#376FB7] text-[#376FB7] bg-white py-2 rounded-full text-sm font-semibold hover:bg-[#f0f6ff] transition">
                        Back
                    </button>
                </div>
            </div>

            <!-- Modal Create Kategori -->
            <div x-show="createModalOpen" x-cloak class="fixed top-0 left-0 inset-0 bg-black/50 flex items-center justify-center z-50 min-h-screen">
                <div class="bg-white rounded-xl shadow-lg p-6 w-[360px]">
                    <h2 class="text-lg font-semibold mb-2">Create Category</h2>
                    <input type="text" x-model="newCategoryName"
                        class="w-full border p-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#376FB7]"
                        placeholder="Category name">
                    <div class="flex justify-center gap-2 mb-5">
                        <button @click="createModalOpen = false" class="px-6 py-2 border rounded-full text-gray-700 hover:bg-gray-100 transition font-semibold">Cancel</button>
                        <button 
                            @click.prevent="createNewCategory" 
                            :disabled="!newCategoryName.trim()" 
                            class="bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ✅ Script Bookmark --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('bookmarkModal', (initialState = false) => ({
                openBookmarkModal: false,
                selectedCategoryId: null,
                searchCategory: '',
                isBookmarked: initialState,
                categories: @json(auth()->user()->categories),

                get filteredCategories() {
                    return this.categories.filter(cat =>
                        cat.name.toLowerCase().includes(this.searchCategory.toLowerCase())
                    );
                },

                saveBookmark() {
                    fetch("/bookmarks", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({
                            destination_id: document.getElementById("bookmarkBtn").dataset.destinationId,
                            category_id: this.selectedCategoryId
                        })
                    }).then(res => res.json()).then(data => {
                        alert(data.message);
                        this.openBookmarkModal = false;
                        this.isBookmarked = true;
                    });
                },

                createModalOpen: false,
                newCategoryName: '',

                openCreateModal() {
                    this.createModalOpen = true;
                    this.newCategoryName = '';
                },

                createNewCategory() {
                    fetch('/categories', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({ name: this.newCategoryName })
                    }).then(res => res.json())
                      .then(() => location.reload());
                }
            }))
        });
    </script>
</section>
@endsection
