<div x-data = "menuComponent()"
    class="md:max-w-screen-md md:mx-auto" >
    <div>
        {{-- Header --}}
        <div class="fixed top-0 z-10 w-full pt-5 dark:bg-blueGray-900 bg-coolGray-100 md:max-w-screen-md">
            <div class="flex-1 min-w-0">
                <h2 class="ml-3 text-xl font-bold leading-7 truncate sm:text-3xl sm:leading-9">
                    {{$restaurant->name}}
                </h2>
            </div>
            {{-- Navbar --}}
            <div class="w-full my-5 overflow-y-hidden">
                <div class="flex-no-wrap w-full mx-5 space-x-2 overflow-x-scroll overflow-y-hidden" style="display: -webkit-box">
                    <div
                        wire:click="sortBy('')"
                        class="block px-4 py-1 text-sm font-medium transition duration-150 ease-in rounded-full dark:transition dark:duration-150 dark:ease-in text-blueGray-100 dark:bg-blueGray-600 bg-blueGray-400"
                        :class="{'opacity-50' : $wire.filter !== '' }"
                        >
                        <span>All</span>
                    </div>
                    @foreach ($categories as $category)
                        <div
                            wire:click="sortBy({{$category->id}})"
                            class="block px-3 py-1 text-sm font-medium rounded-full text-blueGray-100 dark:bg-blueGray-600 bg-blueGray-400"
                            :class="{'opacity-50' : $wire.filter !== {{$category->id}}, 'opacity-100' : $wire.filter === {{$category->id}} }"
                            >
                            <span>{{$category->name}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Menu --}}
        <div class="mt-32 md:mt-40">
            {{-- Container --}}
            {{-- Loading when change filter --}}
            <div class="flex items-center justify-center">
                <div wire:loading wire:target='sortBy'>
                    <svg class="w-5 h-5 mr-3 -ml-1 text-blueGray-600 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            <div class="mx-5 mb-5 space-y-4" wire:init='loadProducts' wire:loading.remove wire:target='sortBy'>
                {{-- Product --}}
                @forelse($products as $key => $product)
                    <x-product-tile :product='$product'/>
                @empty
                    {{-- Loadin State --}}
                    @foreach (range(1,5) as $product)
                        <x-product-tile-skeleton/>
                    @endforeach
                @endforelse
            </div>
        </div>
        {{-- Modal Product --}}
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div
            class="fixed inset-0 z-40 overflow-hidden"
            style="display: none"
            x-show="showProduct">
            <div
                x-show="showProduct"
                class="fixed inset-0 transition-opacity"
                aria-hidden="true"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100 "
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 "
                x-transition:leave-end="opacity-0"
                >
                    {{-- Overlay --}}
                    <div class="absolute inset-0 z-50 opacity-75 dark:bg-blueGray-800 bg-blueGray-200"></div>
                </div>
            <div class="absolute inset-0 overflow-hidden">
                <section
                    class="absolute inset-y-0 right-0 flex max-w-full"
                    x-show="showProduct"
                    aria-labelledby="slide-over-heading"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-7000"
                    x-transition:enter-start="translate-y-full"
                    x-transition:enter-end="translate-y-0 "
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full">
                    <div class="flex flex-col justify-end w-screen max-w-md">
                        <div class="flex flex-col bg-opacity-100 shadow-xl dark:bg-blueGray-800 bg-blueGray-100 h-4/5">
                            @isset($selectedProduct)
                                <div class="flex-col flex-1 px-4 mt-6 sm:px-6 space-y-10 dark:text-blueGray-100 text-blueGray-800">
                                <!-- Replace with your content -->
                                    <div class="flex flex-col h-full justify-between rounded-t-lg">
                                        <div class="space-y-5">
                                            <div class="-mt-20">
                                                <img src={{$selectedProduct->getMedia()->first()->getUrl()}} alt="product_image" class="mx-auto">
                                            </div>
                                            <h1 class="font-bold text-lg text-center" x-text="product.name"></h1>
                                            <p class="dark:text-blueGray-300 text-blueGray-600 text-sm" x-text="product.description"></p>
                                        </div>
                                        <div class="mb-5 space-y-5">
                                            <div class="flex justify-center space-x-6 items-center">
                                                <button
                                                    type="button"
                                                    class="rounded-full text-teal-200 dark:text-green-600 dark:bg-teal-200 bg-teal-600 p-1 outline-none focus:outline-none focus:ring dark:focus:ring-teal-600 focus:ring-teal-200"
                                                    x-on:click="removeProduct($refs.removeProduct)"
                                                    x-ref="removeProduct">
                                                    <x-heroicon-s-minus class="h-6 w-6" />
                                                </button>
                                                <span class="font-bold text-2xl" x-text="product.quantity"></span>
                                                <button
                                                    type="button"
                                                    class="rounded-full text-teal-200 dark:text-green-600 dark:bg-teal-200 bg-teal-600 p-1 outline-none focus:outline-none focus:ring dark:focus:ring-teal-600 focus:ring-teal-200"
                                                    x-on:click="addProduct($refs.addProduct)"
                                                    x-ref="addProduct">
                                                    <x-heroicon-s-plus class="h-6 w-6" />
                                                </button>
                                            </div>
                                            <div class="flex justify-between">
                                                {{-- Price --}}
                                                <div class="flex flex-col">
                                                    <span class="font-bold text-sm">Price</span>
                                                    <div class="flex items-center">
                                                        <span class="font-bold text-lg" x-text="product.totalPrice"></span>
                                                        <x-heroicon-s-currency-euro class="h-5 w-5"/>
                                                    </div>
                                                </div>
                                                {{-- Button --}}
                                                <div>
                                                    <button class="flex justify-center items-center bg-teal-600 px-3 py-2 space-x-3 rounded-l-md -mr-4">
                                                        <x-heroicon-s-pencil-alt class="h-5 w-5 text-teal-50" />
                                                        <span class="font-bold text-lg text-teal-50">Add to Order</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- /End replace -->
                                </div>
                            @endisset
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function menuComponent () {
            return {
                showProduct: false,
                cart:[],
                product: {
                    quantity: 0,
                    totalPrice: null,
                },
                selectProduct : function (product) {
                    this.showProduct=true;
                    this.product={...product, quantity: 0, totalPrice: 0};
                },
                addProduct: function (el) {
                    let newQuantity = (this.product.quantity) + 1;
                    let newTotalPrice = (this.product.price) * newQuantity;
                    this.product = {
                        ...this.product,
                        quantity: newQuantity,
                        totalPrice: newTotalPrice
                    };
                },
                removeProduct: function (el) {
                    if (this.product.quantity > 0) {
                        let newQuantity = (this.product.quantity) - 1;
                        let newTotalPrice = (this.product.price) * newQuantity;
                        this.product = {
                            ...this.product,
                            quantity: newQuantity,
                            totalPrice: newTotalPrice
                        };
                    }
                }
            }
        }
    </script>
@endpush
