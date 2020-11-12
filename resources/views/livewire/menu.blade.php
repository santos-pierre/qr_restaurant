<div>
    <div x-data="tabsElements()">
        {{-- Header --}}
        <div class="dark:bg-gray-900 light:bg-cool-gray-50 pt-5 fixed top-0 z-10 w-full">
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-bold leading-7 sm:text-3xl sm:leading-9 sm:truncate ml-3 truncate">
                    Bienvenue chez {{$restaurant->name}}
                </h2>
            </div>
            {{-- Navbar --}}
            <div class="w-full overflow-y-hidden mt-5">
                <div class="overflow-x-scroll w-full flex-no-wrap overflow-y-hidden" style="display: -webkit-box">
                    {{-- @foreach ($categories as $category)
                        <div
                        @click="selectElement(category)"
                        class="text-sm py-2 px-3 block"
                        :class="{'font-bold border-b-2 dark:border-dark light:border-light' : category.selected, 
                            'font-medium opacity-75 border-b-1.5 border-light-gray' : !category.selected }">
                            <span>{{$category->name}}</span>
                        </div>
                    @endforeach --}}
                    <template x-for="(category, index) in categories" :key="index" >
                        <div
                            @click="selectElement(category)"
                            class="text-sm py-2 px-3 block"
                            :class="{'font-bold border-b-2 dark:border-dark light:border-light' : category.selected, 
                                  'font-medium opacity-75 border-b-1.5 border-light-gray' : !category.selected }">
                            <span x-text="category.name"></span>
                        </div>
                      </template>
                </div>
            </div>
        </div>
        {{-- Menu --}}
        <div class="mt-36">
            {{-- Container --}}
            <div class="mx-4">
                {{-- Product --}}
                @foreach ($products as $key => $product)
                    @if ($loop->first)
                        @foreach ($product as $item)
                            <div class="flex flex-col space-y-2">
                                <h2 class="font-bold text-base">
                                    {{$item->p_name}}
                                </h2>
                                <p class="opacity-75 text-xs font-medium">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                                </p>
                                <span class="font-bold text-base">
                                    {{$item->p_price}} €
                                </span>
                                <hr class="opacity-50">
                            </div>
                        @endforeach
                    @endif
                    @if (!$loop->first)
                        <h2 class="font-bold text-lg my-2 -ml-2 truncate" x-ref="{{$key}}" style="scroll-margin-top: 5rem">{{$key}}</h2>
                        @foreach ($product as $item)
                            <div class="flex flex-col space-y-2">
                                <h2 class="font-bold text-base">
                                    {{$item->p_name}}
                                </h2>
                                <p class="opacity-75 text-xs font-medium">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                                </p>
                                <span class="font-bold text-base">
                                    {{$item->p_price}} €
                                </span>
                                <hr class="opacity-50">
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function tabsElements() {
                let RawCategories = <?=json_encode($categories);?>;
                let formattedCategories = RawCategories.map((category) =>{
                    let newElement = {
                        'name': category.name,
                        'selected': category.order === 0 ? true : false,
                        'id': category.id
                    };
                    return newElement;
                });
                return {
                    categories: formattedCategories,
                    selectElement(item) {
                        let target = this.$refs[item.name];
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
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
