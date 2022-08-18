<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-10">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Coupon
            </h2>
            <p class="mb-4">Share a Coupon to help people</p>
        </header>

        <form method="POST" action="/coupons/{{ $coupon->id }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="store_id" class="inline-block text-lg font-semibold mb-2">Store</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="store_id">
                    <option value="">Select a Store</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}"
                            {{ old('store_id') ? (old('store_id') == $store->id ? 'selected' : '') : ($coupon->store_id == $store->id ? 'selected' : '') }}>
                            {{ $store->name }}
                        </option>
                    @endforeach
                </select>

                @error('store_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="code" class="inline-block text-lg font-semibold mb-2">Code</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="code"
                    value="{{ old('code') ?? $coupon->code }}" />

                @error('code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg font-semibold mb-2">
                    Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ old('description') ?? $coupon->description }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="application_rules" class="inline-block text-lg font-semibold mb-2">Application Rules</label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="application_rules" rows="10">{{ old('application_rules') ?? $coupon->application_rules }}</textarea>

                @error('application_rules')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Edit Coupon
                </button>

                <a href="/" class="text-black ml-4">Back</a>
            </div>
        </form>
    </x-card>
</x-layout>
