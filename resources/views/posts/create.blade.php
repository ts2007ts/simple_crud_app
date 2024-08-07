<x-layouts.main>

    <x-slot:name>Create new Post</x-slot>
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus
                autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" class="block mt-1 w-full" name="description" row="10"
                autocomplete="description">
                {{ old('description') }}
            </x-textarea-input>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Image -->
        <div class="mt-4">
            <x-input-label for="imageUrl" :value="__('Image')" />

            <x-text-input id="imageUrl" class="block mt-1 w-full" type="file" name="imageUrl" name="imageUrl" />

            <x-input-error :messages="$errors->get('imageUrl')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                Create
            </x-primary-button>
        </div>
    </form>
</x-layouts.main>
