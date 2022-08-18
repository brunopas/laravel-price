<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-10">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Offer
            </h2>
            <p class="mb-4">{{ $offer->title }}</p>
        </header>

        <form method="POST" action="/offers/{{ $offer->slug }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="inline-block text-lg font-semibold mb-2">Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    value="{{ old('title') ?? $offer->title }}" />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="url" class="inline-block text-lg font-semibold mb-2">Offer URL</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="url"
                    value="{{ old('url') ?? $offer->url }}" />

                @error('url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="inline-block text-lg font-semibold mb-2">Price</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price"
                    value="{{ old('price') ?? $offer->price }}" />

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price_old" class="inline-block text-lg font-semibold mb-2">Old Price</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price_old"
                    value="{{ old('price_old') ?? $offer->price_old }}" />

                @error('price_old')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="coupon" class="inline-block text-lg font-semibold mb-2">Coupon</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="coupon"
                    value="{{ old('coupon') ?? $offer->coupon }}" />

                @error('coupon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg font-semibold mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    value="{{ old('tags') ?? $offer->tags }}" />

                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg font-semibold mb-2">
                    Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description">{{ old('description') ?? $offer->description }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="inline-block text-lg font-semibold mb-2">
                    Offer Thumbnail
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="thumbnail" />

                <img class="w-48 mr-6 mb-6"
                    src="{{ $offer->thumbnail ? asset('storage/' . $offer->thumbnail) : asset('images/no-image.png') }}"
                    alt="" />

                @error('thumbnail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg font-semibold mb-2">
                    Ofer Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ old('description') ?? $offer->description }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Edit Offer
                </button>

                <a href="/" class="text-black ml-4">Back</a>
            </div>
        </form>
    </x-card>
</x-layout>
