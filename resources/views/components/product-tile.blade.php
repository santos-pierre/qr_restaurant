<div class="flex space-x-3 bg-white rounded-lg shadow-sm dark:bg-blueGray-600 dark:shadow-sm">
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
