<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-4 gap-6">
            <!-- Weather Card (Col 1) -->
            <div class="col-span-1 text-lg text-black font-bold rounded-xl text-center h-40">
                <!-- Current Weather Summary -->
                <div class="p-5 w-4/5 flex justify-between rounded-3xl shadow-2xl cursor-pointer transform ease-in-out bg-white/20 duration-500 backdrop-blur-sm hover:scale-[105%] mx-auto">
                    <div class="flex flex-col">
                        <div class="mb-6">
                            <p class="font-bold text-5xl text-white">24°C</p>
                            <p class="font-semibold text-md text-white">Now</p>
                        </div>
                        <p class="font-semibold text-xl text-white">London, UK</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <img class="w-28 h-28" src="{{ asset('images/4102326_cloud_sun_sunny_weather_icon.png') }}" alt="weather icon" />
                    </div>
                </div>
                <!-- Weather Details Section -->
                <div class="flex w-full justify-between bg-[#0198afb6] p-3 backdrop-blur-2xl rounded-xl ease-in-out duration-500 mt-4">
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
            <!-- ...existing dashboard content (col-span-3 or other columns)... -->
            <div class="col-span-3 flex items-center justify-center">
                <h1 class="text-3xl font-bold">hi</h1>
            </div>
        </div>
    </div>
</x-app-layout>