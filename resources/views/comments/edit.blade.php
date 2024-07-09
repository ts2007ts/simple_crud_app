<x-layouts.main>

    <head>
        <script>
            setTimeout(() => {
                document.getElementById('session_message').remove();
            }, 3500);

            function confirmDeletion() {
                confirm("Are you sure you want to Delete This record ?");
            }
        </script>
    </head>

    <x-slot:name>Update Comment for {{ $post->title }}'s Post </x-slot>



    @if (session('message'))
        <div class="mt-2 text-red-500 flex items-center justify-start" id="session_message">
            <span class="font-bold size-20 text-nowrap">
                {{ session('message') }}
            </span>
        </div>
    @endif


    <form method="POST" action="{{ route('comment.update', $comment) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Body -->

        <div>
            <input type="hidden" value="{{ $post->id }}" name="postId">
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <x-textarea-input id="body" class="block mt-1 w-full" type="text" name="body" row="10"
                autofocus autocomplete="body">
                {{ old('body', $comment->body) }}
            </x-textarea-input>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                Update
            </x-primary-button>
        </div>
    </form>
</x-layouts.main>
