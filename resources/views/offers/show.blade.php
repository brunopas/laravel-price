<x-layout>
    @include('partials._search')

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>

    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6 border-2"
                    src="{{ $offer->thumbnail ? asset('storage/' . $offer->thumbnail) : asset('images/no-image.png') }}"
                    alt="" />

                <h3 class="text-lg mb-4">{{ $offer->title }}</h3>

                <div class="text-lg font-semibold mb-4">
                    <span class="line-through">$ {{ $offer->price_old }}</span>
                    <span>$ {{ $offer->price }}</span>
                </div>

                <x-offer-tags :tagsCsv="$offer->tags" />

                <div class="text-md my-4">
                    {{ $offer->comments->count() }} <i class="fa-solid fa-comment"></i>
                    {{ $offer->likes->count() }} <i class="fa-solid fa-thumbs-up"></i>
                    {{ $offer->views->count() }} <i class="fa-solid fa-eye"></i>
                </div>

                <div class="border border-gray-200 w-full mb-6"></div>

                <div>
                    <h3 class="text-2xl font-semibold mb-4">
                        Offer Description
                    </h3>
                    <div class="text-md space-y-6">
                        {{ $offer->description }}

                        <a href="{{ $offer->url }}" target="_blank"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe"> </i> Go To Offer
                        </a>
                    </div>
                </div>

                <div class="text-sm mt-4">
                    Posted by <a href="/user/{{ $offer->author->id }}">{{ $offer->author->name }}</a> ·
                    {{ $offer->updated_at->diffForHumans() }}
                </div>
            </div>
        </x-card>

        @auth
            @if (auth()->user()->id == $offer->author->id)
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/offers/{{ $offer->slug }}/edit">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>

                    <form method="POST" action="/offers/{{ $offer->slug }}">
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
