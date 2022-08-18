<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>

    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <h3 class="text-2xl font-bold mb-2">{{ $coupon->store->name }}</h3>

                <div class="border border-gray-200 w-full mb-6"></div>

                <div>
                    <h3 class="text-2xl font-semibold mb-4">
                        Coupon Code
                    </h3>
                    <div class="text-md space-y-6">
                        {{ $coupon->code }}
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-2xl font-semibold mb-4">
                        Coupon Description
                    </h3>
                    <div class="text-md space-y-6">
                        {{ $coupon->description }}
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-2xl font-semibold mb-4">
                        Application Rules
                    </h3>
                    <div class="text-md space-y-6">
                        {{ $coupon->application_rules }}

                        <a href="{{ $coupon->store->website }}" target="_blank"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe"> </i> Go To Store
                        </a>
                    </div>
                </div>

                <div class="text-sm mt-4">
                    Posted by <a href="/user/{{ $coupon->author->id }}">{{ $coupon->author->name }}</a> ·
                    {{ $coupon->updated_at->diffForHumans() }}
                </div>
            </div>
        </x-card>

        @auth
            @if (auth()->user()->id == $coupon->author->id)
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/coupons/{{ $coupon->id }}/edit">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>

                    <form method="POST" action="/coupons/{{ $coupon->id }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                </x-card>
            @endif
        @endauth
    </div>
</x-layout>
