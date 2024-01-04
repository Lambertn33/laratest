<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                            <div class="max-w-screen-md mb-8 lg:mb-16">
                                <div class="flex gap-4 items-center">
                                    <h4 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Products List
                                    </h4>
                                    @if (auth()->user()->is_admin)
                                    <a href="{{route('products.create')}}"
                                        class="bg-black text-white flex justify-center items-center px-4 py-2 rounded-md">Create
                                        New Product</a>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                                @forelse ($products as $product)
                                <div class="bg-gray-100 p-4 rounded-md">
                                    <div
                                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-gray-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">{{$product->name}}</h3>
                                    <h3 class="mb-2 text-xl font-bold">{{$product->price_gbp}}GBP</h3>
                                    <h3 class="mb-2 text-xl font-bold">{{$product->price}}USD</h3>
                                    <p class="text-gray-500">{{$product->description}}</p>
                                    @if (auth()->user()->is_admin)
                                    <div>
                                        <a href="{{route('products.edit', $product->id)}}"
                                            class="bg-black text-white flex w-full py-2 px-4 rounded-lg items-center justify-center">Edit</a>
                                    </div>
                                    @endif
                                </div>
                                @empty
                                <p>No Products available</p>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>