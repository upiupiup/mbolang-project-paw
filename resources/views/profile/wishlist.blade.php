@extends('layouts.app')

@section('title', 'My Wishlist - MBOLANG')

@section('content')
<div x-cloak class="min-h-screen px-12 pt-32 pb-16 bg-white" x-data="wishlistPage()">

    {{-- Heading --}}
    <div class="mb-8">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/my-wishlist.png') }}" class="w-10 h-10" alt="Wishlist Icon">
            <h1 class="text-4xl font-bold">My Wishlist</h1>
        </div>
        <div class="mt-2 w-45 h-[2px] bg-gray-300 rounded-full"></div>
    </div>

    {{-- Wishlist Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        {{-- Create New Wishlist --}}
        <div @click="openCreateModal"
            class="w-full border border-dashed border-[#376FB7] text-sm text-[#376FB7] py-3 rounded-lg hover:bg-[#EBF2FF]/70 transition opacity-80 hover:opacity-100 mb-4 flex flex-col justify-center items-center text-center cursor-pointer">
            <div class="text-2xl text-[#376FB7]">＋</div>
            <p class="mt-2 font-semibold text-sm">Create New Wishlist</p>
            <p class="text-xs text-gray-500">Add a category to your dream wishlist here</p>
        </div>

        {{-- Loop Kategori --}}
    @foreach (auth()->user()->categories as $cat)
        <a href="{{ route('categories.show', $cat->id) }}" class="relative bg-white shadow-lg shadow-black/20 rounded-xl overflow-hidden group hover:shadow-2xl hover:shadow-black/30 transition hover:-translate-y-1">
            {{-- Gambar atas --}}
            <div class="h-36 w-full">
                @if ($cat->bookmarks->count() > 0)
                    <img src="{{ asset('storage/destinasi/' . $cat->bookmarks->first()->destination->image) }}"
                         alt="{{ $cat->bookmarks->first()->destination->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs">
                        No Image
                    </div>
                @endif
            </div>

            {{-- Teks & info --}}
            <div class="p-4">
                <h3 class="font-semibold text-sm">{{ $cat->name }}</h3>
                <p class="text-xs text-gray-500">{{ $cat->bookmarks->count() }} wishlist</p>
            </div>

            {{-- Tombol titik tiga --}}
            <div x-cloak x-data="{ openMenu:false }" class="absolute top-3 right-3 z-10">
                <button @click="openMenu = !openMenu" class="p-1 rounded-full bg-white shadow flex flex-col items-center justify-center w-7 h-7">
                    <span class="block w-1 h-1 bg-gray-700 rounded-full mb-0.5"></span>
                    <span class="block w-1 h-1 bg-gray-700 rounded-full mb-0.5"></span>
                    <span class="block w-1 h-1 bg-gray-700 rounded-full"></span>
                </button>
                <div x-show="openMenu" @click.away="openMenu = false"
                    class="absolute right-0 mt-2 w-36 bg-white border shadow-lg rounded-lg text-sm z-50 py-1">
                    <button
                        @click="openEditModal({{ $cat->id }}, '{{ $cat->name }}')"
                        class="w-full text-left px-4 py-2 hover:bg-gray-100">
                        ✏️ Edit
                    </button>
                    <button
                        @click="openDeleteModal({{ $cat->id }}, '{{ $cat->name }}')"
                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                        🗑️ Delete
                    </button>
                </div>
            </div>
        </a>
    @endforeach

    </div>

    <!-- Modal Edit Kategori -->
    <div x-show="editModalOpen" x-cloak class="fixed top-0 left-0 inset-0 bg-black/50 flex items-center justify-center z-50 min-h-screen">
        <div class="bg-white rounded-xl shadow-lg p-6 w-[360px]">
            <h2 class="text-lg font-semibold mb-2">Edit Category</h2>
            <input type="text" x-model="editCategoryName"
                class="w-full border p-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-[#376FB7]"
                placeholder="Category name">
            <div class="flex justify-center gap-2 mb-5">
                <button @click="editModalOpen = false" class="px-6 py-2 border rounded-full text-gray-700 hover:bg-gray-100 transition font-semibold">Cancel</button>
                <button 
                    @click.prevent="updateCategory" 
                    :disabled="!editCategoryName.trim()" 
                    class="bg-[#376FB7] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#2d5ea0] transition disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div x-show="deleteModalOpen" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 min-h-screen">
        <div class="bg-white rounded-xl shadow-lg p-6 w-[360px]">
            <h2 class="text-lg font-semibold mb-4">Delete Category</h2>
            <p class="text-sm text-gray-600 mb-6 text-center">
                Yakin ingin menghapus kategori "<span class="font-semibold" x-text="editCategoryName"></span>"?
            </p>
            <div class="flex justify-center gap-2 mb-5">
                <button @click="deleteModalOpen = false" class="px-6 py-2 border rounded-full text-gray-700 hover:bg-gray-100 transition font-semibold">Cancel</button>
                <button 
                    @click="deleteCategory" 
                    class="bg-red-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-red-700 transition"
                >
                    Yes, Delete
                </button>
            </div>
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

{{-- Script Tambahan --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('wishlistPage', () => ({
        editModalOpen: false,
        deleteModalOpen: false,
        createModalOpen: false,
        editCategoryName: '',
        editCategoryId: null,
        newCategoryName: '',

        openEditModal(id, currentName) {
            this.editCategoryId = id;
            this.editCategoryName = currentName;
            this.editModalOpen = true;
        },

        openDeleteModal(id, name) {
            this.editCategoryId = id;
            this.editCategoryName = name;
            this.deleteModalOpen = true;
        },

        openCreateModal() {
            this.createModalOpen = true;
            this.newCategoryName = '';
        },

        updateCategory() {
            if (!this.editCategoryName.trim()) return;
            
            const name = this.editCategoryName.trim();
            if (!name) {
                alert('Nama kategori tidak boleh kosong!');
                return;
            }

            fetch(`/categories/${this.editCategoryId}`, {
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ name: this.editCategoryName })
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal update kategori');
                return response.json();
            })
            .then(() => location.reload())
            .catch(err => alert(err.message));
        },

        deleteCategory() {
            fetch(`/categories/${this.editCategoryId}`, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            }).then(() => location.reload());
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

@endsection
