<x-layouts.main>

    <x-slot:name>
        {{ strtoupper(Auth::user()->name) }}'s Posts
    </x-slot:name>

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

    @if (session('message'))
        <div class="mt-2 text-red-500 flex items-center justify-start" id="session_message">
            <span class="font-bold size-20 text-nowrap">
                {{ session('message') }}
            </span>
        </div>
    @endif

    <div class="mt-2">
        <a href="{{ route('post.create') }}">
            <x-primary-button>
                Create Post
            </x-primary-button>
        </a>
    </div>

    <div class="mt-6">
        <div class="relative overflow-x-auto rounded-3xl">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-collapse border border-slate-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 border border-slate-300">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-300">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-300 text-nowrap">
                            Created By
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-300 text-nowrap">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-300">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 items-center">
                            <th scope="row"
                                class="px-6 py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4 border border-slate-300">
                                <div class="flex flex-col justify-center">
                                    <div>
                                        {{ $post->description }}
                                    </div>
                                    <div class="mt-2">
                                        <a class="text-blue-500"
                                            href="{{ route('comment.create', $post) }}">comments</a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 border border-slate-300 uppercase">
                                {{ $post->user->name }}
                            </td>
                            <td class="px-6 py-4 border border-slate-300">
                                @if ($post->imageUrl)
                                    <img class="w-10 h-10 rounded" src="{{ url('storage/' . $post->imageUrl) }}"
                                        alt="">
                                @else
                                @endif
                            </td>
                            <td class="px-6 py-4 border border-slate-300 ">
                                <div class="flex justify-center gap-2">
                                    <div>
                                        <a href="{{ route('post.show', $post) }}">
                                            <i class="fa fa-eye" style="color:green"></i>
                                        </a>
                                    </div>
                                    @if (Auth::id() === $post->user->id)
                                        <div>
                                            <a href="{{ route('post.edit', $post) }}">
                                                <i class="fa fa-pencil" style="color:blue"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('post.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmDeletion()">
                                                    <i class="fa fa-trash" style="color:red"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </div>

</x-layouts.main>
