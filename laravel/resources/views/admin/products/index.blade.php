{{-- // FILE INI UNTUK MENAMPILKAN DATA KATEGORI
// NANTI ADA MENU HAPUS MAUPUN EDIT ATAU DELETE --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Product') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="py-3 px-5 rounded-full text-white bg-indigo-700">Tambahkan Kategori</a>

        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                @forelse($products as $product)
                    <div class="item-card flex flex-row justify-between item-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[50px] h-[50px]">
                            <div>
                                <h3 class = "text-xl font-bold text-indigo-950">
                                    {{ $product->name }}
                                </h3>
                                <h4></h4>
                                <p class="text-base text-slate-500">
                                    Rp {{ number_format($product->price) }}
                                </p>

                            </div>

                        </div>
                        <p class="text-base text-slate-500">
                            {{ $product->category->name }}
                        </p>
                        <div class = "flex flex-row item-center gap-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')
                                <button class = " font-bold py-3 px-5 rounded-full text-white bg-rose-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum ada produk ditambahkan oleh pemilik apotek
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
