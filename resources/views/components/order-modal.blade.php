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
                                    <template x-for="(order, index) in orders" :key="order.id">
                                        <div class="flex justify-between px-4">
                                            {{-- Name & Quantity --}}
                                            <div class="flex flex-col items-start space-y-2">
                                                <div>
                                                    <span x-text="order.name" class="text-base font-semibold dark:text-blueGray-100 text-blueGray-900"></span>
                                                </div>
                                                <div class="text-teal-600 dark:text-teal-400">
                                                    <span x-text="order.totalPrice" class="mr-1 font-bold"></span>
                                                    <span class="font-bold">€</span>
                                                </div>
                                                <div class="flex items-center justify-center space-x-2">
                                                    <button
                                                        type="button"
                                                        class="text-teal-400 transition-all duration-200 ease-in-out rounded-full outline-none dark:text-green-600 focus:outline-none active:ring dark:active:ring-teal-600 active:ring-teal-200 active:bg-teal-400"
                                                        x-on:click="removeProductQuantityOrder(order.id)">
                                                        <x-heroicon-s-minus class="w-5 h-5" />
                                                    </button>
                                                    <span class="font-medium dark:text-blueGray-100 text-blueGray-900" x-text="order.quantity"></span>
                                                    <button
                                                        type="button"
                                                        class="text-teal-400 transition-all duration-200 ease-in-out rounded-full outline-none dark:text-green-600 focus:outline-none active:ring dark:active:ring-teal-600 active:ring-teal-200 active:bg-teal-400"
                                                        x-on:click="addProductQuantityOrder(order.id)">
                                                        <x-heroicon-s-plus class="w-5 h-5" />
                                                    </button>
                                                </div>
                                            </div>
                                            {{-- Price & Delete Icon --}}
                                            <div class="flex flex-col justify-center space-y-2">
                                                <div>
                                                    <button
                                                        class="rounded-md text-blueGray-900 dark:text-blueGray-100 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                        x-on:click="deleteProductFromOrder(order.id)">
                                                        <x-heroicon-o-trash class="font-bold w-7 h-7" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex items-center justify-between my-6">
                                    <div class="pl-4 space-y-1 dark:text-blueGray-100 text-blueGray-900">
                                        <span class="inline-block text-lg font-medium opacity-50">Total</span>
                                        <div class="text-xl">
                                            <span x-text="orderPriceTotal" class="mr-1 font-bold"></span>
                                            <span class="font-bold">€</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <button
                                                class="flex items-center justify-center px-2 py-2 space-x-2 bg-teal-600 rounded-l-md focus:outline-none active:bg-teal-400">
                                                <span class="text-base font-bold text-teal-50">Proceed to Payment</span>
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
