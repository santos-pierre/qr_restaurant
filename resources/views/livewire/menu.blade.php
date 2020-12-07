<div
    x-data = "menuComponent()"
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
            <div
                class="mx-5 mb-10 space-y-4"
                :class="{'mb-16' : orders.length > 0}"
                wire:init='loadProducts'
                wire:loading.remove wire:target='sortBy'>
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
            <div class="fixed bottom-0" x-cloak x-show="orders.length > 0" x-on:click="showOrder = true">
                <button type="button" class="inline-flex items-center justify-center w-screen px-4 py-3 text-lg font-bold bg-teal-600 border border-transparent shadow-sm text-teal-50 rounded-t-md focus:outline-none active:bg-teal-400">
                    Your Order
                </button>
            </div>
        </div>
        {{-- Modal Product --}}
        <x-product-modal :selectedProduct="$selectedProduct" />
        {{-- Modal Cart --}}
        <div class="fixed inset-0 z-40 overflow-hidden" x-show="showOrder" x-cloak>
            <div class="absolute inset-0 overflow-hidden">
            {{-- OverLay --}}
            <div
                x-show="showOrder"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                aria-hidden="true">
            </div>
            <section class="absolute inset-y-0 left-0 flex max-w-full pr-10" aria-labelledby="slide-over-heading">
                <div
                    x-show="showOrder"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="relative w-screen max-w-md">
                    {{-- Close Icon --}}
                    <div
                        x-show="showOrder"
                        x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute top-0 right-0 flex pt-4 pl-2 -mr-8 sm:-mr-10 sm:pl-4">
                        <button class="text-gray-300 rounded-md hover:text-white focus:outline-none focus:ring-2 focus:ring-white" x-on:click="showOrder = false">
                            <x-heroicon-o-x class="font-bold w-7 h-7"/>
                        </button>
                    </div>
                    <div class="flex flex-col h-full pt-6 overflow-y-scroll shadow-xl bg-blueGray-100 dark:bg-blueGray-800">
                        <div class="px-4 sm:px-6">
                        <h2 id="slide-over-heading" class="text-xl font-bold dark:text-blueGray-100 text-blueGray-900">
                            Your Order
                        </h2>
                        </div>
                        <div class="relative flex-1 mt-6">
                        <!-- Replace with your content -->
                            <div class="absolute inset-0 space-y-3">
                                <div class="flex flex-col justify-between h-full">
                                    <div class="h-full space-y-5 overflow-y-scroll dark:scrollGradientDark scrollGradient">
                                        <template x-for="(item, index) in orders" :key="item.id">
                                            <div class="flex justify-between px-4">
                                                {{-- Name & Quantity --}}
                                                <div class="flex flex-col items-start space-y-2">
                                                    <div>
                                                        <span x-text="item.name" class="text-base font-semibold dark:text-blueGray-100 text-blueGray-900"></span>
                                                    </div>
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <button
                                                            type="button"
                                                            class="text-teal-400 transition-all duration-200 ease-in-out rounded-full outline-none dark:text-green-600 focus:outline-none active:ring dark:active:ring-teal-600 active:ring-teal-200 active:bg-teal-400"
                                                            x-on:click="removeProductQuantityOrder(item.id)">
                                                            <x-heroicon-s-minus class="w-5 h-5" />
                                                        </button>
                                                        <span class="font-medium dark:text-blueGray-100 text-blueGray-900" x-text="item.quantity"></span>
                                                        <button
                                                            type="button"
                                                            class="text-teal-400 transition-all duration-200 ease-in-out rounded-full outline-none dark:text-green-600 focus:outline-none active:ring dark:active:ring-teal-600 active:ring-teal-200 active:bg-teal-400"
                                                            x-on:click="addProductQuantityOrder(item.id)">
                                                            <x-heroicon-s-plus class="w-5 h-5" />
                                                        </button>
                                                    </div>
                                                </div>
                                                {{-- Price & Delete --}}
                                                <div class="flex flex-col items-end space-y-2">
                                                    <div class="text-teal-600 dark:text-teal-400">
                                                        <span x-text="item.totalPrice" class="mr-1 font-bold"></span>
                                                        <span class="font-bold">€</span>
                                                    </div>
                                                    <div>
                                                        <button
                                                            class="rounded-md text-blueGray-900 dark:text-blueGray-100 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                            x-on:click="deleteProductFromOrder(item.id)">
                                                            <x-heroicon-o-trash class="font-bold w-7 h-7" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="flex items-center justify-between my-6">
                                        <div class="px-4 space-y-1 dark:text-blueGray-100 text-blueGray-900">
                                            <span class="inline-block text-lg font-medium opacity-50">Total</span>
                                            <div class="text-xl">
                                                <span x-text="orderPriceTotal" class="mr-1 font-bold"></span>
                                                <span class="font-bold">€</span>
                                            </div>
                                        </div>
                                        <div >
                                            <div>
                                                <button
                                                    class="flex items-center justify-center px-3 py-2 space-x-3 bg-teal-600 rounded-l-md focus:outline-none active:bg-teal-400">
                                                    <x-heroicon-o-credit-card class="w-5 h-5 text-teal-50" />
                                                    <span class="text-lg font-bold text-teal-50">Proceed to Payment</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /End replace -->
                        </div>
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
            const reducer = (accumulator, currentValue) => Number(accumulator) + Number(currentValue.totalPrice);
            let defaultProduct = {
                quantity: 0,
                totalPrice: 0,
            }
            return {
                showProduct: false,
                showOrder: false,
                orders:[],
                orderPriceTotal: 0,
                product: defaultProduct,
                disabledButton : true,
                selectProduct : function (product) {
                    this.showProduct=true;
                    let found = this.orders.find(element => element.id === product.id);
                    if (found) {
                        this.product = found;
                    }else{
                        this.product = {...product, quantity: 0, totalPrice: 0};
                    }
                },
                resetProduct: function () {
                    this.showProduct = false;
                    this.product = defaultProduct;
                },
                // Product Modal Functions
                addProduct: function () {
                    let newQuantity = (this.product.quantity) + 1;
                    this.disabledButton = newQuantity === 0;
                    let newTotalPrice = ((this.product.price) * newQuantity).toFixed(2);
                    this.product = {
                        ...this.product,
                        quantity: newQuantity,
                        totalPrice: newTotalPrice
                    };
                },
                removeProduct: function () {
                    if (this.product.quantity > 0) {
                        let newQuantity = (this.product.quantity) - 1;
                        this.disabledButton = newQuantity === 0;
                        let newTotalPrice = ((this.product.price) * newQuantity).toFixed(2);
                        this.product = {
                            ...this.product,
                            quantity: newQuantity,
                            totalPrice: newTotalPrice
                        };
                    }
                },
                addProductToOrders: function () {
                    let productIndex = this.orders.findIndex(element => element.id === this.product.id);
                    if (this.product.quantity > 0) {
                        if (productIndex !== -1) {
                            this.orders[productIndex] = this.product;
                        }else{
                            this.orders = [... this.orders, this.product];
                        }
                        this.showProduct = false;
                        this.product= defaultProduct;
                        this.orderPriceTotal = this.calcOrderPrice();
                    }
                },
                // Order Modal Function
                addProductQuantityOrder: function (productId) {
                    let product = this.orders.find((element) => element.id === productId);
                    let productIndex = this.orders.findIndex((element) => element.id === productId);
                    product.quantity = product.quantity + 1;
                    product.totalPrice = (product.quantity * product.price).toFixed(2);
                    this.orders[productIndex] = product;
                    this.orderPriceTotal = this.calcOrderPrice();
                },
                removeProductQuantityOrder: function (productId) {
                    let product = this.orders.find((element) => element.id === productId);
                    let productIndex = this.orders.findIndex((element) => element.id === productId);
                    product.quantity = product.quantity - 1;
                    if (product.quantity === 0) {
                        this.orders = this.orders.filter((element) => element.id !== productId);
                    }else{
                        product.totalPrice = (product.quantity * product.price).toFixed(2);
                        this.orders[productIndex] = product;
                        this.orderPriceTotal = this.calcOrderPrice();
                    }
                },
                deleteProductFromOrder : function (productId) {
                    this.orders = this.orders.filter((element) => element.id !== productId);
                    this.orderPriceTotal = this.calcOrderPrice();
                },
                calcOrderPrice: function () {
                    return Number(this.orders.reduce(reducer,0)).toFixed(2);
                }
            }
        }
    </script>
@endpush
