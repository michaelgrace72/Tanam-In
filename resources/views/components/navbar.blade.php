@props([
    'links' => [],
    'showProfile' => false,
    'user' => null,
])

<nav class="bg-[#005247] px-4 py-3 flex justify-between items-center">
    <div class="flex items-center space-x-8">
        <span class="text-white font-bold text-xl">Tanam.in</span>
        @if($showProfile)
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}" class="text-white hover:underline">{{ $link['label'] }}</a>
            @endforeach
        @endif
    </div>
    <div class="flex items-center space-x-4">
        @if ($showProfile && $user)
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="w-8 h-8 rounded-full object-cover border-2 border-white"
                            src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                    @else
                        <span class="text-white font-semibold">{{ $user->name }}</span>
                    @endif
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg py-2 z-50" x-transition>
                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        @elseif(!$showProfile)
            <a href="{{ route('login') }}"
                class="text-sm text-gray-500 dark:text-white border border-[#FE8C00] dark:border-[#FE8C00] rounded px-4 py-1 hover:bg-gray-100 dark:hover:bg-[#004235] transition">Login</a>
            <a href="{{ route('register') }}"
                class="text-sm text-black dark:text-black border border-[#FE8C00] rounded px-4 py-1 bg-[#FE8C00] hover:bg-blue-50 dark:hover:bg-[#F83600] transition">Register</a>
        @endif
    </div>
</nav>