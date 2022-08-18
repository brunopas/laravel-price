<x-layout>
    @include('partials._hero')
    @include('partials._search')
    @include('partials._header')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($stores) == 0)
            @foreach ($stores as $store)
                <x-store-card :store="$store" />
            @endforeach
        @else
            <p>No Stores found.</p>
        @endunless
    </div>

    <div class="mt-6 p-4">
        {{ $stores->links() }}
    </div>
</x-layout>
