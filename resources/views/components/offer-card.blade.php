@props(['offer'])

@php
$offer = \App\Models\Offer::find($offer->id);
@endphp

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block"
            src="{{ $offer->thumbnail ? asset('storage/' . $offer->thumbnail) : asset('images/no-image.png') }}"
            alt="" />
        <div>
            <h3 class="text-2xl font-bold">
                <a href="/offers/{{ $offer->slug }}/show">
                    {{ $offer->title }}
                </a>
            </h3>

            <div class="text-xl mb-4">
                {{ $offer->store->name }}
            </div>

            <x-offer-tags :tagsCsv="$offer->tags" />

            <div class="text-lg font-semibold mt-4">
                <span class="line-through">$ {{ $offer->price_old }}</span>
                <span>$ {{ $offer->price }}</span>
            </div>

            <div class="text-sm mt-8">
                {{ $offer->comments->count() }} <i class="fa-solid fa-comment"></i>
                {{ $offer->likes->count() }} <i class="fa-solid fa-thumbs-up"></i>
                {{ $offer->views->count() }} <i class="fa-solid fa-eye"></i>
            </div>

            <div class="text-sm mt-4">
                Posted by <a href="/user/{{ $offer->author->id }}">{{ $offer->author->name }}</a> ·
                {{ $offer->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>
</x-card>
