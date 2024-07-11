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
        <div id="session_message" class="flex items-center rounded-xl bg-blue-500 text-white text-sm font-bold px-4 py-3"
            role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ session('message') }}</p>
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
                class="w-full text-sm text-center text-gray-500 dark:text-gray-400 border-collapse border border-slate-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
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
                            <td class="px-6 py-4 border border-slate-300 text-left rtl:text-right">
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
                                <div class="flex justify-center">
                                    {{ $post->user->name }}
                                </div>
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
