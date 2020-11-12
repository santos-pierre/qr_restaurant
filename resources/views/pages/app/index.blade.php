@extends('layouts.app')

@section('body')
<div x-data="tabsElements()">
        {{-- Header --}}
        <div class="dark:bg-gray-900 light:bg-cool-gray-50 pt-5 fixed top-0 z-10 w-full">
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-bold leading-7 sm:text-3xl sm:leading-9 sm:truncate ml-3">
                    Bienvenue chez O'Tacos
                </h2>
            </div>
            {{-- Navbar --}}
            <div class="w-full overflow-y-hidden mt-5">
                <div class="overflow-x-scroll w-full flex-no-wrap overflow-y-hidden" style="display: -webkit-box">
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
        <div class="mt-28">
            {{-- Container --}}
            <div class="mx-4">
                {{-- Product --}}
                <div class="flex flex-col space-y-2">
                    <h2 class="font-bold text-base">
                        Poke de saumon
                    </h2>
                    <p class="opacity-75 text-xs font-medium">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                    </p>
                    <span class="font-bold text-base">
                        13 €
                    </span>
                    <hr class="opacity-50">
                </div>
                <div class="flex flex-col space-y-2">
                    <h2 class="font-bold text-base">
                        Poke de saumon
                    </h2>
                    <p class="opacity-75 text-xs font-medium">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                    </p>
                    <span class="font-bold text-base">
                        13 €
                    </span>
                    <hr class="opacity-50">
                </div>
                <div class="flex flex-col space-y-2">
                    <h2 class="font-bold text-base">
                        Poke de saumon
                    </h2>
                    <p class="opacity-75 text-xs font-medium">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                    </p>
                    <span class="font-bold text-base">
                        13 €
                    </span>
                    <hr class="opacity-50">
                </div>
                <div class="flex flex-col space-y-2">
                    <h2 class="font-bold text-base">
                        Poke de saumon
                    </h2>
                    <p class="opacity-75 text-xs font-medium">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                    </p>
                    <span class="font-bold text-base">
                        13 €
                    </span>
                    <hr class="opacity-50">
                </div>
                <div class="flex flex-col space-y-2">
                    <h2 class="font-bold text-base">
                        Poke de saumon
                    </h2>
                    <p class="opacity-75 text-xs font-medium">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras finibus at lectus ut pelle ...
                    </p>
                    <span class="font-bold text-base">
                        13 €
                    </span>
                    <hr class="opacity-50">
                </div>
                {{-- Title Category --}}
                <h2 class="font-bold text-lg my-2 -ml-2" x-ref="Entrées" style="scroll-margin-top: 110px">Entrées</h2>
    
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script>
        function tabsElements() {
          return {
            categories: [
              {
                id: 1,
                name: "Tendances",
                selected: true
              },
              {
                id: 2,
                name: "Plat en sauce",
                selected: false
              },
              {
                id: 3,
                name: "Entrées",
                selected: false
              },
              {
                id: 4,
                name: "Desserts",
                selected: false
              },
              {
                id: 5,
                name: "Boissodsqfns",
                selected: false
              },
              {
                id: 6,
                name: "Boissonsdqsds",
                selected: false
              },
              {
                id: 7,
                name: "Boissons",
                selected: false
              }
            ],
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