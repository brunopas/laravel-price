@props(['store'])

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{ asset('images/no-image.png') }}" alt="" />

        <div>
            <h3 class="text-2xl font-bold ">
                {{ $store->name }}
            </h3>

            <div class="text-md font-semibold mb-4">
                {{ $store->coupons->count() }} Coupons
            </div>
        </div>
    </div>
</x-card>
