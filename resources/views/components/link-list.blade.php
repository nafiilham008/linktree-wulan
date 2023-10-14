<div class="grid grid-flow-row gap-4">
    @foreach ($links as $link)
        <a href="{{ route('links.edit', $link) }}"
            class="hover:shadow-sm border border-gray-500 border-opacity-30 hover:border-opacity-80 dark:border dark:border-slate-300 dark:border-opacity-30 dark:hover:border-opacity-80 ease-out duration-300 rounded-lg">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">

                <!-- Display the image if it exists -->
                @if ($link->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $link->image) }}" alt="{{ $link->title }}"
                            class="w-full h-40 object-cover rounded-md shadow-md">
                    </div>
                @endif

                <h3 class="text-md text-gray-800 dark:text-gray-200 leading-tight mb-1">
                    {{ $link->title }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">
                    {{ $link->url }}
                </p>
                @if ($link->description)
                    <p class="text-gray-400 dark:text-gray-600 text-xs italic mb-2">
                        {{ $link->description }}
                    </p>
                @endif

                <!-- Display the click count -->
                <p class="text-gray-500 dark:text-gray-300 text-xs">
                    Clicked {{ $link->click_count }} times
                </p>

            </div>

        </a>
    @endforeach
</div>
