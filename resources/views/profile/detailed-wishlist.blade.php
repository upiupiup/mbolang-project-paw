@extends('layouts.app')

@section('title', $category->name . ' - Wishlist')

@section('content')
<div class="min-h-screen px-12 pt-32 pb-20 bg-white max-w-[1440px] mx-auto">

    {{-- Heading --}}
    <div class="mb-10">
        <h1 class="text-4xl font-bold">{{ $category->name }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $bookmarks->count() }} wishlist</p>
        <div class="mt-4 text-sm text-gray-600 flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&size=32" class="w-6 h-6 rounded-full">
            {{ auth()->user()->name }}
        </div>
    </div>

    {{-- Grid List --}}
    <div 
        x-data="wishlistModal()" 
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
    >
        @forelse ($bookmarks as $bookmark)
            <a href="{{ route('destination.show', $bookmark->destination->id) }}"
               class="group block relative shadow rounded-xl overflow-hidden hover:shadow-lg transition-all duration-200">
                {{-- Gambar --}}
                <img src="{{ asset('storage/destinasi/' . $bookmark->destination->image) }}"
                     alt="{{ $bookmark->destination->name }}"
                     class="w-full h-[160px] object-cover rounded-t-xl group-hover:scale-[1.02] transition">

                {{-- Info --}}
                <div class="p-3">
                    <h3 class="text-sm font-medium text-gray-900">{{ $bookmark->destination->name }}</h3>
                </div>

                {{-- Tombol Titik Tiga --}}
                <div x-data="{ openMenu: false }" class="absolute top-3 right-3 z-10">
                    <button @click.prevent.stop="openMenu = !openMenu"
                            class="p-1 rounded-full bg-white shadow flex flex-col items-center justify-center w-7 h-7">
                        <span class="block w-1 h-1 bg-gray-700 rounded-full mb-0.5"></span>
                        <span class="block w-1 h-1 bg-gray-700 rounded-full mb-0.5"></span>
                        <span class="block w-1 h-1 bg-gray-700 rounded-full"></span>
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="openMenu" @click.away="openMenu = false"
                         class="absolute right-0 mt-2 w-32 bg-white border shadow-lg rounded-lg text-sm z-50 py-1">
                        <button
                            @click.prevent="openDeleteModal({{ $bookmark->id }}, '{{ $bookmark->destination->name }}', '{{ route('bookmarks.destroy', $bookmark->id) }}')"
                            class="w-full text-left px-6 py-2 text-red-600 hover:bg-gray-100">
                            🗑️ Remove
                        </button>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500">Belum ada wishlist dalam kategori ini.</div>
        @endforelse

<!-- Modal Konfirmasi Delete -->
<div x-show="deleteModalOpen" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 min-h-screen">
    <div class="bg-white rounded-xl shadow-lg p-6 w-[360px] text-center">
        <h2 class="text-lg font-semibold mb-4">Delete Wishlist</h2>
        <p class="text-sm text-gray-600 mb-6">
            Yakin ingin menghapus wishlist "<span class="font-semibold" x-text="editCategoryName"></span>"?
        </p>

        <form :action="deleteAction" method="POST" @submit="deleteModalOpen = false" class="w-full">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3 mb-5">
                <button type="button"
                        @click="deleteModalOpen = false"
                        class="px-6 py-2 border rounded-full text-gray-700 hover:bg-gray-100 font-semibold transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 font-semibold transition">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>

    </div>
    <script>
        function wishlistModal() {
            return {
                deleteModalOpen: false,
                editCategoryName: '',
                deleteAction: '',
                openDeleteModal(id, name, action) {
                    this.editCategoryName = name;
                    this.deleteAction = action;
                    this.deleteModalOpen = true;
                }
            }
        }
    </script>

</div>
@endsection
