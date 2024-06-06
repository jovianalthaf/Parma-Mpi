{{-- MENAMPILKAN DATA TRANSAKSI SEBAGAI PEMBELI ATAU PEMILIK APOTEK --}}
{{-- // FILE INI UNTUK MENAMPILKAN DATA KATEGORI
// NANTI ADA MENU HAPUS MAUPUN EDIT ATAU DELETE --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details') }}
            </h2>
            {{-- <a href="{{ route('admin.products.create') }}"
                class="py-3 px-5 rounded-full text-white bg-indigo-700">Tambahkan Kategori</a> --}}

        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <div class="item-card flex gap-y-3 flex-col md:flex-row justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-slate-500">
                                Total Transaksi
                            </p>
                            <h3 class = "text-xl font-bold text-indigo-950">
                                Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    <div>
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-slate-500">
                            {{ $productTransaction->created_at->format('d M Y ') }}
                        </h3>
                        <h2 class="text-xl font-bold text-slate-500">
                            {{ $productTransaction->created_at->format('H:i:s ') }}</h2>
                    </div>
                    @if ($productTransaction->is_paid)
                        <span class="py-3 px-4 w-fit rounded-full  bg-green-500">
                            <p class="text-white font-bold ">
                                Success
                            </p>
                        </span>
                    @else
                        <span class="py-3 px-4 w-fit rounded-full  bg-orange-500">
                            <p class="text-white font-bold ">
                                Pending
                            </p>
                        </span>
                    @endif

                </div>
                <hr class="my-3">
                <h3 class="text-xl font-bold text-slate-500">
                    List of Item
                </h3>
                <div class="grid-cols-1 md:grid-cols-4 grid gap-x-10">
                    {{-- PRODUCT --}}
                    <div class ="flex flex-col gap-y-5 col-span-2">
                        @forelse($productTransaction->transactionDetails as $detail)
                            <div class="item-card flex flex-row justify-between item-center">
                                <div class="flex flex-row items-center gap-x-3">
                                    <img src="{{ Storage::url($detail->product->photo) }}" alt=""
                                        class="w-[50px] h-[50px]">
                                    <div>
                                        <h3 class = "text-xl font-bold text-indigo-950">
                                            {{ $detail->product->name }}
                                        </h3>
                                        <h4></h4>
                                        <p class="text-base text-slate-500">
                                            Rp {{ number_format($detail->product->price) }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-base text-slate-500">
                                    {{ $detail->product->category->name }}
                                </p>
                            </div>
                        @empty
                        @endforelse
                        <h3 class="text-xl font-bold text-slate-500">
                            Details Of Delivery
                        </h3>
                        <div class="item-card flex flex-row justify-between item-center">
                            <p class="text-base text-slate-500">
                                Address
                            </p>
                            <h3 class = "text-xl font-bold text-indigo-950">
                                {{ $productTransaction->address }}
                            </h3>
                        </div>

                        <div class="item-card flex flex-row justify-between item-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>
                            <h3 class = "text-xl font-bold text-indigo-950">
                                {{ $productTransaction->city }}
                            </h3>
                        </div>

                        <div class="item-card flex flex-row justify-between item-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>
                            <h3 class = "text-xl font-bold text-indigo-950">
                                {{ $productTransaction->post_code }}
                            </h3>
                        </div>

                        <div class="item-card flex flex-row justify-between item-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>
                            <h3 class = "text-xl font-bold text-indigo-950">
                                {{ $productTransaction->phone_number }}
                            </h3>
                        </div>

                        <div class="item-card flex flex-col justify-between item-center">
                            <p class="text-base text-slate-500">
                                Notes
                            </p>
                            <h3 class = "text-lg font-bold text-indigo-950">
                                {{ $productTransaction->notes }}
                            </h3>
                        </div>
                    </div>
                    {{-- PEMBAYARAN --}}
                    <div class="flex flex-col gap-y-5 col-span-2 items-end">
                        <h3 class="text-xl font-bold text-indigo-950">
                            Bukti Pembayaran :
                        </h3>
                        <img src="{{ Storage::url($productTransaction->proof) }}" alt=""
                            class="w-[400px] bg-red-300 h-[350px]">
                    </div>

                </div>
                <hr class="my-3">
                @role('owner')
                    @if ($productTransaction->is_paid)
                    @else
                        <form method="POST" action="{{ route('product_transactions.update', $productTransaction) }}">
                            @csrf
                            @method('PUT')
                            <button class = " font-bold py-3 px-5 rounded-full text-white bg-indigo-700">
                                Approve Order
                            </button>
                        </form>
                    @endif
                @endrole

                @role('buyer')
                    <a href = "#"class=" font-bold py-3 px-5 rounded-full text-white bg-indigo-700 w-fit">
                        Contact Admin
                    </a>
                @endrole
            </div>
        </div>

</x-app-layout>
