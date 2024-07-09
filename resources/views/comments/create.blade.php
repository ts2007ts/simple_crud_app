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

    @if (session('message'))
        <div class="mt-2 text-red-500 flex items-center justify-start" id="session_message">
            <span class="font-bold size-20 text-nowrap">
                {{ session('message') }}
            </span>
        </div>
    @endif


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
