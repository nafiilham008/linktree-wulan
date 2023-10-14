<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">

    <h2 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $title }}
    </h2>

    <form action="{{ $action }}" class="mt-4" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $link ? $link->title : '')" required
                autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div class="mt-4">
            <x-input-label for="url" :value="__('Url')" />
            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $link ? $link->url : '')"
                required autofocus autocomplete="url" />
            <x-input-error class="mt-2" :messages="$errors->get('url')" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" rows="3"
                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $link ? $link->description : '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="mt-4">
            <x-input-label for="image" :value="__('Image')" />
            <input id="image" name="image" type="file" class="mt-1 block w-full">

            <!-- Display existing image if in edit mode and image exists -->
            @if ($edit && $link->image)
                <img src="{{ asset('storage/' . $link->image) }}" alt="{{ $link->title }}" class="mt-2 w-32 h-32">
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button class="mt-4">
            Save
        </x-primary-button>
    </form>

    @if ($edit)
        <button type="submit" class="text-gray-600 dark:text-slate-500 mt-4 float-right" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-link-deletion')">
            delete
        </button>
    @endif
</div>
@if ($edit)
    <x-modal name="confirm-link-deletion" focusable>
        <form action="{{ route('links.destroy', $link) }}" method="POST" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this link?') }}
            </h2>

            <p class="mt-1 text-lg text-gray-600 dark:text-gray-400">
                <span class="font-bold">
                    {{ $link->title }}:
                </span>
                {{ $link->url }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Link') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
@endif
