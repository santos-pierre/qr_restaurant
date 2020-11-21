<div class="md:max-w-screen-md md:mx-auto">
    <div x-data="tabsElements($wire)">
        {{-- Header --}}
        <div class="dark:bg-blueGray-900 bg-coolGray-50 pt-5 fixed top-0 z-10 w-full md:max-w-screen-md">
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-bold leading-7 sm:text-3xl sm:leading-9 sm:truncate ml-3">
                    Bienvenue chez <br> {{$restaurant->name}}
                </h2>
            </div>
            {{-- Navbar --}}
            <div class="w-full overflow-y-hidden mt-5">
                <div class="overflow-x-scroll w-full flex-no-wrap overflow-y-hidden" style="display: -webkit-box">
                    <template x-for="(category, index) in categories" :key="index" >
                        <div
                            @click="selectElement(category)"
                            class="text-sm py-2 px-3 block"
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
                        <span class="font-bold text-lg py-4 -ml-2 inline-block" x-ref="{{$key}}" style="scroll-margin-top: 8rem">{{$key}}</span>
                    @endif
                    @foreach ($product as $item)
                            <div class="flex flex-col space-y-2">
                                <span class="font-bold text-base">
                                    {{$item->p_name}}
                                </span>
                                <p class="opacity-75 text-xs font-medium">
                                    {{$item->p_description}}
                                </p>
                                <span class="font-bold text-base">
                                    {{$item->p_price}} €
                                </span>
                            </div>
                            @if (!$loop->last)
                                <hr class="opacity-50 my-2">
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
