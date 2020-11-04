@extends('layouts.app')

@section('body')
    {{-- Header --}}
    <div class="flex-1 min-w-0 mt-5">
        <h2 class="text-xl font-bold leading-7 sm:text-3xl sm:leading-9 sm:truncate ml-3">
            Bienvenue chez O'Tacos
        </h2>
    </div>
    {{-- Navbar --}}
    <div class="w-full overflow-y-hidden mt-5">
        <div class="overflow-x-scroll w-full flex-no-wrap overflow-y-hidden" x-data="tabsElements()" style="display: -webkit-box">
            <template x-for="(category, index) in categories" :key="index">
                <div
                  @click="selectElement(category)"
                  class="text-sm py-2 px-3"
                  :class="{'font-bold border-b-2 dark:border-text-dark light:border-text-light' : category.selected, 
                            'font-medium opacity-75 border-b-1.5 border-light-gray' : !category.selected }"
                >
                  <span x-text="category.name"></span>
                </div>
              </template>
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