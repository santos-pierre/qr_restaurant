<div
    class="fixed inset-0 z-40 overflow-hidden"
    x-cloak
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
                {{-- Close Button --}}
                <div
                        x-show="showProduct"
                        x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed top-4 right-4">
                        <button class="rounded-md text-blueGray-800 dark:text-blueGray-100 hover:text-blueGray-500 focus:outline-none focus:ring-2 focus:ring-blueGray-800 dark:focus:ring-blueGray-50" x-on:click="showProduct = false">
                            <span class="sr-only">Close panel</span>
                            <!-- Heroicon name: x -->
                            <x-heroicon-o-x class="font-bold w-7 h-7"/>
                        </button>
                </div>
                <div class="flex flex-col bg-opacity-100 shadow-xl dark:bg-blueGray-800 bg-blueGray-100 h-4/5">
                    @isset($selectedProduct)
                        <div class="flex-col flex-1 px-4 mt-6 space-y-10 sm:px-6 dark:text-blueGray-100 text-blueGray-800">
                        <!-- Replace with your content -->
                            <div class="flex flex-col justify-between h-full rounded-t-lg">
                                <div class="space-y-5">
                                    <div class="-mt-20">
                                        <img src={{$selectedProduct->getMedia()->first()->getUrl()}} alt="product_image" class="mx-auto">
                                    </div>
                                    <h1 class="text-lg font-bold text-center" x-text="product.name"></h1>
                                    <p class="text-sm dark:text-blueGray-300 text-blueGray-600" x-text="product.description"></p>
                                </div>
                                <div class="mb-5 space-y-5">
                                    <div class="flex items-center justify-center space-x-6">
                                        <button
                                            x-bind:disabled="disabledButton"
                                            type="button"
                                            class="p-1 text-teal-200 transition-all duration-200 ease-in-out bg-teal-600 rounded-full outline-none dark:text-green-600 dark:bg-teal-200 focus:outline-none active:ring dark:active:ring-teal-600 dark:active:bg-teal-400 active:ring-teal-200 active:bg-teal-400"
                                            x-on:click="removeProduct"
                                            >
                                            <x-heroicon-s-minus class="w-6 h-6" />
                                        </button>
                                        <span class="text-2xl font-bold" x-text="product.quantity"></span>
                                        <button
                                            type="button"
                                            class="p-1 text-teal-200 transition-all duration-200 ease-in-out bg-teal-600 rounded-full outline-none dark:text-green-600 dark:bg-teal-200 focus:outline-none active:ring dark:active:ring-teal-600 dark:active:bg-teal-400 active:ring-teal-200 active:bg-teal-400"
                                            x-on:click="addProduct"
                                            >
                                            <x-heroicon-s-plus class="w-6 h-6" />
                                        </button>
                                    </div>
                                    <div class="flex justify-between">
                                        {{-- Price --}}
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold">Price</span>
                                            <div class="flex items-center">
                                                <span class="text-lg font-bold" x-text="product.totalPrice"></span>
                                                <x-heroicon-s-currency-euro class="w-5 h-5"/>
                                            </div>
                                        </div>
                                        {{-- Button --}}
                                        <div>
                                            <button
                                                x-bind:disabled="disabledButton"
                                                class="flex items-center justify-center px-3 py-2 -mr-4 space-x-3 bg-teal-600 rounded-l-md focus:outline-none active:bg-teal-400"
                                                x-on:click="addProductToOrders">
                                                <x-heroicon-s-pencil-alt class="w-5 h-5 text-teal-50" />
                                                <span class="text-lg font-bold text-teal-50">Add to Order</span>
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
