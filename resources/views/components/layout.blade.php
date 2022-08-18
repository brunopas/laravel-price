<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#1e40af",
                    },
                },
            },
        };
    </script>
    <title>LaraPrice | Find Offers & Coupons</title>
</head>

<body class="mb-48">
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo" /></a>
        <ul class="flex space-x-4 mr-6 text-lg">
            <li class="font-semibold">
                <a href="/" class="px-4 py-2 font-semibold text-sm bg-blue-800 text-white rounded-full shadow-sm">
                    LAST OFFERS</a>
            </li>
            <li class="font-semibold">
                <a href="/offers/top"
                    class="px-4 py-2 font-semibold text-sm bg-blue-800 text-white rounded-full shadow-sm">TOP OFFERS</a>
            </li>
            <li class="font-semibold">
                <a href="/coupons"
                    class="px-4 py-2 font-semibold text-sm bg-blue-800 text-white rounded-full shadow-sm">LAST
                    COUPONS</a>
            </li>
            <li class="font-semibold">
                <a href="/store/coupons"
                    class="px-4 py-2 font-semibold text-sm bg-blue-800 text-white rounded-full shadow-sm">COUPONS BY
                    STORE</a>
            </li>

            <li class="font-semibold">
                |
            </li>

            @auth
                <li class="font-bold">
                    {{ auth()->user()->username }}
                </li>
                <li class="font-semibold">
                    <a href="/offers/manage"
                        class="px-4 py-2 font-semibold text-sm bg-black text-white rounded-full shadow-sm">
                        MANAGE OFFERS
                    </a>
                </li>
                <li class="font-semibold">
                    <span class="px-4 py-2 font-semibold text-sm bg-black text-white rounded-full shadow-sm">
                        <form method="POST" action="/auth/logout" class="inline">
                            @csrf

                            <button type="submit">
                                LOGOUT
                            </button>
                        </form>
                    </span>
                </li>
            @else
                <li class="font-semibold">
                    <a href="/auth/register"
                        class="px-4 py-2 font-semibold text-sm bg-black text-white rounded-full shadow-sm">
                        REGISTER
                    </a>
                </li>
                <li class="font-semibold">
                    <a href="/auth/login"
                        class="px-4 py-2 font-semibold text-sm bg-black text-white rounded-full shadow-sm">
                        LOG IN
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-20 mt-20 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        @auth
            <p>
                <a href="/offers/create" class="absolute top-1 right-10 bg-black text-white py-1 px-5 text-center w-40">
                    Share Offer
                </a>
                <a href="/coupons/create" class="absolute top-11 right-10 bg-black text-white py-1 text-center px-5 w-40">
                    Share Coupon
                </a>
            </p>
        @endauth
    </footer>

    <x-flash-message />
</body>

</html>
