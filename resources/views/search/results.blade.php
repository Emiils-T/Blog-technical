<x-app-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4 text-center mt-4">Search Results for "{{ $query }}"</h2>
        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->body, 100) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">Read more</a>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 flex items-center justify-center mb-6">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600">No results found for "{{ $query }}".</p>
        @endif
    </div>
</x-app-layout>
