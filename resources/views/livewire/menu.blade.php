<div class="md:max-w-screen-md md:mx-auto">
    <div x-data="tabsElements($wire)">
        {{-- Header --}}
        <div class="fixed top-0 z-10 w-full pt-5 dark:bg-blueGray-900 bg-coolGray-50 md:max-w-screen-md">
            <div class="flex-1 min-w-0">
                <h2 class="ml-3 text-xl font-bold leading-7 sm:text-3xl sm:leading-9 sm:truncate">
                    Bienvenue chez <br> {{$restaurant->name}}
                </h2>
            </div>
            {{-- Navbar --}}
            <div class="w-full mt-5 overflow-y-hidden">
                <div class="flex-no-wrap w-full overflow-x-scroll overflow-y-hidden" style="display: -webkit-box">
                    <template x-for="(category, index) in categories" :key="index" >
                        <div
                            @click="selectElement(category)"
                            class="block px-3 py-2 text-sm"
                            :class="{'font-bold border-b-2 dark:border-coolGray-100 border-blueGray-700' : category.selected,
                                  'font-medium opacity-75 border-b-1.5 dark:border-coolGray-100 border-coolGray-400' : !category.selected }">
                            <span x-text="category.name"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        {{-- Menu --}}
        <div class="mt-36 md:mt-40">
            {{-- Container --}}
            <div class="mx-4">
                {{-- Product --}}
                @foreach ($products as $key => $product)
                    @if (!$loop->first)
                        <span class="inline-block py-4 -ml-2 text-lg font-bold" x-ref="{{$key}}" style="scroll-margin-top: 8rem">{{$key}}</span>
                    @endif
                    @foreach ($product as $item)
                            <div class="flex flex-col space-y-2">
                                <span class="text-base font-bold">
                                    {{$item->p_name}}
                                </span>
                                <p class="text-xs font-medium opacity-75">
                                    {{$item->p_description}}
                                </p>
                                <span class="text-base font-bold">
                                    {{$item->p_price}} €
                                </span>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-2 opacity-50">
                            @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function tabsElements(state) {
                return {
                    categories: state.get('categories').map((category) =>{
                        return {
                            ...category,
                            'selected': category.order === 0 ? true : false,
                        };
                    }),
                    selectElement(item) {
                        if (item.order === 0) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                        }else{
                            this.$refs[item.name].scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                        this.categories = this.categories.map((category) => {
                            if (category.id === item.id) {
                                return { ...category, selected: true };
                            } else {
                                return { ...category, selected: false };
                            }
                        });
                        return this.categories.find((category) => category.id === item.id);
                    }
                };
            }
          </script>
        @endpush
</div>
