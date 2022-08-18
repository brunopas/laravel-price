<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Offers
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($offers->isEmpty())
                    @foreach ($offers as $offer)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="show.html">
                                    {{ $offer->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/offers/{{ $offer->slug }}/edit" class="text-black px-6 py-2 rounded-xl">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/offers/{{ $offer->slug }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-800">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">
                                No Offers Found
                            </p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>
