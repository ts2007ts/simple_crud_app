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

    <x-slot:name>Create new Comment for {{ $post->user->name }}'s Post </x-slot>


    @if (session('message'))
        <div id="session_message" class="flex items-center rounded-xl bg-blue-500 text-white text-sm font-bold px-4 py-3"
            role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <div class="mt-4 mb-4">
        @foreach ($comments as $comment)
            <div class="flex justify-between gap-1 items-center w-full bg-gray-300 px-6 py-4 rounded-full m-2">
                <div>
                    {{ $comment->body }}
                </div>
                <div class="flex items-stretch gap-3">

                    <a href="{{ route('comment.edit', ['comment' => $comment, 'post' => $post]) }}">
                        <i class="fa fa-pencil" style="color:blue"></i>
                    </a>

                    <div>
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDeletion()">
                                <i class="fa fa-trash" style="color:red"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-10">
            {{ $comments->links() }}
        </div>
    </div>



    <form method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Body -->

        <div>
            <input type="hidden" value="{{ $post->id }}" name="postId">
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <x-textarea-input id="body" class="block mt-1 w-full" type="text" name="body" row="10"
                autofocus autocomplete="body">
                {{ old('body') }}
            </x-textarea-input>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                Create
            </x-primary-button>
        </div>
    </form>
</x-layouts.main>
