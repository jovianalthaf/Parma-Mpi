{{-- MENAMPILKAN DATA TRANSAKSI SEBAGAI PEMBELI ATAU PEMILIK APOTEK --}}
{{-- // FILE INI UNTUK MENAMPILKAN DATA KATEGORI
// NANTI ADA MENU HAPUS MAUPUN EDIT ATAU DELETE --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Apotek Orders') : __('My Transactions') }}
            </h2>
            {{-- <a href="{{ route('admin.products.create') }}"
                class="py-3 px-5 rounded-full text-white bg-indigo-700">Tambahkan Kategori</a> --}}

        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse($product_transactions as $transaction)
                    <div class="item-card flex flex-row justify-between item-center">
                        <a href="{{ route('product_transactions.show', $transaction) }}">View Detail
                            <div class="flex flex-row items-center gap-x-3">
                                <div>
                                    <p class="text-base text-slate-500">
                                        Total Transaksi
                                    </p>
                                    <h3 class = "text-xl font-bold text-indigo-950">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <div class="hidden md:flex flex-col">
                            <p class="text-base text-slate-500">
                                Date
                            </p>
                            <h3 class="text-xl font-bold text-slate-500">
                                {{ $transaction->created_at }}
                            </h3>
                        </div>
                        @if ($transaction->is_paid)
                            <span class="py-3 px-4 rounded-full  bg-green-500">
                                <p class="text-white font-bold ">
                                    Success
                                </p>
                            </span>
                        @else
                            <span class="py-3 px-4 rounded-full  bg-orange-500">
                                <p class="text-white font-bold ">
                                    Pending
                                </p>
                            </span>
                        @endif
                        <div class = "hidden md:flex flex-row item-center gap-x-4">
                            <a href="{{ route('product_transactions.show', $transaction) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">View Detail</a>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <p>Belum Tersedia transaksi.</p>
                @endforelse



            </div>
        </div>
    </div>
</x-app-layout>
