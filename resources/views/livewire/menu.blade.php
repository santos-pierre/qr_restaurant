<div class="md:max-w-screen-md md:mx-auto">
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
                        wire:click="sortBy({{null}})"
                        class="block px-4 py-1 text-sm rounded-full dark:bg-blueGray-600">
                        <span>All</span>
                    </div>
                    @foreach ($categories as $category)
                        <div
                            wire:click="sortBy({{$category->id}})"
                            class="block px-3 py-1 text-sm rounded-full dark:bg-blueGray-600">
                            <span>{{$category->name}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Menu --}}
        <div class="mt-32 md:mt-40">
            {{-- Container --}}
            <div class="mx-5 space-y-4">
                {{-- Product --}}
                @foreach ($products as $key => $product)
                    <div class="flex space-x-3 bg-white rounded-lg dark:bg-blueGray-600">
                        <div class="flex-none">
                            <img src={{$product->getMedia()->first()->getUrl('thumb')}} class="object-fill rounded-lg rounded-r-none" alt="">
                        </div>
                        <div class="flex flex-col justify-center space-y-2 dark:text-blueGray-300 text-blueGray-900">
                            <span class="text-sm font-bold">
                                {{$product->name}}
                            </span>
                            <span class="text-sm font-bold text-teal-400 dark:text-teal-200">
                                {{$product->price}} €
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
