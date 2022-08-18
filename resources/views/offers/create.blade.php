<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-10">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create Offer
            </h2>
            <p class="mb-4">Share an Offer to help people</p>
        </header>

        <form method="POST" action="/offers" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="title" class="inline-block text-lg font-semibold mb-2">Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    value="{{ old('title') }}" />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="url" class="inline-block text-lg font-semibold mb-2">Offer URL</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="url"
                    value="{{ old('url') }}" />

                @error('url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="store_id" class="inline-block text-lg font-semibold mb-2">Store</label>
                <select class="border border-gray-200 rounded p-2 w-full" name="store_id">
                    <option value="">Select a Store</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}"
                            {{ old('store_id') && old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                        </option>
                    @endforeach
                </select>

                @error('store_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="inline-block text-lg font-semibold mb-2">Price</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price"
                    value="{{ old('price') }}" />

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price_old" class="inline-block text-lg font-semibold mb-2">Old Price</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price_old"
                    value="{{ old('price_old') }}" />

                @error('price_old')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="coupon" class="inline-block text-lg font-semibold mb-2">Coupon</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="coupon"
                    value="{{ old('coupon') }}" />

                @error('coupon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg font-semibold mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    value="{{ old('tags') }}" />

                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="inline-block text-lg font-semibold mb-2">
                    Offer Thumbnail
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="thumbnail" />

                @error('thumbnail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg font-semibold mb-2">
                    Ofer Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Create Offer
                </button>

                <a href="/" class="text-black ml-4">Back</a>
            </div>
        </form>
    </x-card>
</x-layout>
