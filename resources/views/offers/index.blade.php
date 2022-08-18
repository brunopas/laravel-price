<x-layout>
    @include('partials._hero')
    @include('partials._search')
    @include('partials._header')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($offers) == 0)
            @foreach ($offers as $offer)
                <x-offer-card :offer="$offer" />
            @endforeach
        @else
            <p>No Offers found.</p>
        @endunless
    </div>

    <div class="mt-6 p-4">
        {{ $offers->links() }}
    </div>
</x-layout>
