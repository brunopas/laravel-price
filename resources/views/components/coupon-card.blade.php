@props(['coupon'])

<x-card>
    <div class="flex">
        <div>
            <h3 class="text-2xl font-bold ">
                <a href="/coupons/{{ $coupon->id }}/show">
                    {{ $coupon->store->name }}
                </a>
            </h3>

            <div class="text-xl mb-4">
                {{ $coupon->description }}
            </div>

            @if ($coupon->application_rules)
                <div class="text-md mt-8">
                    <p class="font-semibold">Application Rules</p>
                    {{ $coupon->application_rules }}
                </div>
            @endif

            <div class="text-sm mt-4">
                Posted by <a href="/user/{{ $coupon->author->id }}">{{ $coupon->author->name }}</a> ·
                {{ $coupon->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>
</x-card>
