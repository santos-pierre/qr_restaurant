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
        <x-order-modal />
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
                    if (this.orders.length === 0) {
                        this.showOrder = false;
                    }
                },
                deleteProductFromOrder : function (productId) {
                    this.orders = this.orders.filter((element) => element.id !== productId);
                    this.orderPriceTotal = this.calcOrderPrice();
                    if (this.orders.length === 0) {
                        this.showOrder = false;
                    }
                },
                calcOrderPrice: function () {
                    return Number(this.orders.reduce(reducer,0)).toFixed(2);
                }
            }
        }
    </script>
@endpush
