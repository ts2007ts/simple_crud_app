<x-layouts.main>
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
                        {{-- <th scope="col" class="px-6 py-3 border border-slate-300">
                            Actions
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $post->title }}
                            </th>
                            <td class="px-6 py-4 border border-slate-300">
                                {{ $post->description }}
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
                            {{-- <td class="px-6 py-4 border border-slate-300">
                                <span></span>
                                <span></span>
                                <span></span>
                            </td> --}}
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
