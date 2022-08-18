<x-layout>
    @include('partials._hero')
    @include('partials._search')
    @include('partials._header')

    <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($coupons) == 0)
            @foreach ($coupons as $coupon)
                <x-coupon-card :coupon="$coupon" />
            @endforeach
        @else
            <p>No Coupons found.</p>
        @endunless
    </div>

    <div class="mt-6 p-4">
        {{ $coupons->links() }}
    </div>
</x-layout>
