<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanam.in</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- TailwindCSS Browser Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#81e7af] to-white">
    <x-navbar :links="[
        ['href' => route('login'), 'label' => 'Login'],
        ['href' => route('register'), 'label' => 'Register'],
    ]" :showProfile="false" />

    <div class="grid grid-cols-4">
        <!-- Weather Card (Col 1) -->
        <div class="col-span-1 text-lg text-black font-bold rounded-xl text-center h-40 mx-5 my-5">
            <!-- Current Weather Summary -->
            <div
                class="p-5 w-4/5 flex justify-between rounded-3xl shadow-2xl cursor-pointer transform ease-in-out bg-white/20 duration-500 backdrop-blur-sm hover:scale-[105%]">
                <div class="flex flex-col">
                    <div class="mb-6">
                        <p class="font-bold text-5xl text-white">24°C</p>
                        <p class="font-semibold text-md text-white">Now</p>
                    </div>
                    <p class="font-semibold text-xl text-white">London, UK</p>
                </div>
                <div class="flex justify-end items-center">
                    <img class="w-28 h-28" src="{{ asset('images/4102326_cloud_sun_sunny_weather_icon.png') }}"
                        alt="weather icon" />
                </div>
            </div>

            <!-- Weather Details Section -->
            <div
                class="flex w-full justify-between bg-[#0198afb6] p-3 backdrop-blur-2xl rounded-xl ease-in-out duration-500">
                <!-- Left: Weather Type -->
                <div class="flex flex-col justify-start">
                    <img src="{{ asset('images/4102326_cloud_sun_sunny_weather_icon.png') }}" alt="weather icon" />
                    <p class="font-bold text-4xl text-white">Sunny</p>
                    <p class="font-semibold text-white">clear sky</p>
                </div>

                <!-- Right: Weather Metrics -->
                <div class="w-1/2 flex flex-col space-y-2">
                    <!-- Temperature -->
                    <div class="flex justify-around items-center bg-white/30 rounded-lg p-1 gap-6">
                        <ion-icon class="w-8 h-8 text-white" name="thermometer"></ion-icon>
                        <div>
                            <p class="font-bold text-2xl text-[#ff5a00] text-right">26.08 °C</p>
                            <p class="text-sm text-white text-right">Temperature</p>
                        </div>
                    </div>

                    <!-- Wind Speed -->
                    <div class="flex justify-around items-center bg-white/30 rounded-lg p-1 gap-6">
                        <ion-icon class="w-8 h-8 text-white" name="speedometer"></ion-icon>
                        <div>
                            <p class="font-bold text-2xl text-[#ff5a00] text-right">1.18 m/s</p>
                            <p class="text-sm text-white text-right">Wind</p>
                        </div>
                    </div>

                    <!-- Humidity -->
                    <div class="flex justify-around items-center bg-white/30 rounded-lg p-1 gap-6">
                        <ion-icon class="w-8 h-8 text-white" name="rainy"></ion-icon>
                        <div>
                            <p class="font-bold text-2xl text-[#ff5a00] text-right">89 %</p>
                            <p class="text-sm text-white text-right">Humidity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-2 bg-white text-lg text-black font-bold rounded-xl text-center mx-5 my-5">
            <h1>🌱 Welcome to Tanam.in</h1>

            <h2>Track. Grow. Thrive.</h2>

            <p>Your personal space to monitor your plants, follow helpful guides, set reminders, and keep your green
                life thriving.
                Whether you're a seasoned gardener or just getting started, we’re here to help every leaf grow better.
            </p>

            <br>

            <h4>Let’s grow together — one plant at a time. 🌿</h4>
        </div>
        <div class="bg-white text-black rounded-xl text-center mx-5 my-5 p-5 flex flex-col justify-center items-center">
            <h2 class="text-2xl font-bold mb-4">Get inspired today!!!</h2>
            <p id="quote" class="text-md italic text-gray-700 mb-4">
                Click the button to get inspired!
            </p>
            <button onclick="generateQuote()"
                class="bg-[#81e7af] hover:bg-[#5ec291] text-white font-semibold py-2 px-4 rounded-lg">
                New Quote
            </button>
        </div>
    </div>

    <script>
        const quotes = [
            "The only limit to our realization of tomorrow is our doubts of today. – F. D. Roosevelt",
            "Do what you can, with what you have, where you are. – Theodore Roosevelt",
            "Success is not final, failure is not fatal: it is the courage to continue that counts. – Winston Churchill",
            "Believe you can and you're halfway there. – Theodore Roosevelt",
            "You miss 100% of the shots you don’t take. – Wayne Gretzky",
            "Whether you think you can or you think you can’t, you’re right. – Henry Ford"
        ];

        function generateQuote() {
            const quoteText = document.getElementById("quote");
            const randomIndex = Math.floor(Math.random() * quotes.length);
            quoteText.textContent = quotes[randomIndex];
        }
    </script>

</body>

</html>