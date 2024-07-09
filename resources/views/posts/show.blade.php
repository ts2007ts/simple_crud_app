<x-layouts.main>
    <x-slot:name>Post Details</x-slot>

    <div class="mt-6 grid grid-cols-2 font-serif">
        <div class="mt-10 text-purple-700">
            Post Title: <span class="font-bold text-black ">{{ $post->title }}</span>
        </div>
        <div class="mt-10 text-purple-700">
            Post Description: <span class="font-bold text-black ">{{ $post->description }}</span>
        </div>
        <div class="mt-10 text-purple-700">
            Post Created By: <span class="font-bold text-black uppercase">{{ $post->user->name }}</span>
        </div>
        <div class="mt-10 text-purple-700">
            Post Created at: <span class="font-bold text-black uppercase">{{ $post->created_at->format('d/m/Y') }}</span>
        </div>
        <div class="mt-10 text-purple-700">
            Post Updated at: <span
                class="font-bold text-black uppercase">{{ $post->updated_at->format('d/m/Y') }}</span>
        </div>
        <div class="mt-10 text-purple-700">
            <div class="flex justify-normal gap-3 items-center">

                <p>Post Image:</p>
                @if ($post->imageUrl)
                    <img class="w-12 h-12 rounded" src="{{ url('storage/' . $post->imageUrl) }}" alt="">
                @else
                    <span class="font-bold text-black uppercase">N/A</span>
                @endif
            </div>

        </div>
    </div>
</x-layouts.main>
