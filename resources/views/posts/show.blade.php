<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-md ">
            <div class="flex justify-center">
                <div class="flex gap-3">
                    @if($categories->isNotEmpty())
                        @foreach($categories as $category) @endforeach
                        <a href="/category/{{$category->name}}">
                            <span class="inline-block text-xs font-medium tracking-wider uppercase   mt-5 text-blue-600">{{ ucfirst($category->name) }}</span>
                        </a>
                    @endif
                </div>
            </div>
            <h1 class="text-brand-primary mb-3 mt-2 text-center text-3xl font-semibold tracking-tight dark:text-white lg:text-4xl lg:leading-snug">
                {{$post->title}}
            </h1>
            <div class="mt-3 flex justify-center space-x-3 text-gray-500 mb-4">
                <div class="flex items-center gap-3">
                    <div class="relative h-10 w-10 flex-shrink-0">
                    </div>
                    <div>
                        <p class="text-gray-800 dark:text-gray-400">
                            <a href="/author/mario-sanchez">{{$post->author_name}}</a>
                        </p>
                        <div class="flex items-center space-x-2 text-sm">
                            <time class="text-gray-500 dark:text-gray-400" datetime="">{{$post->created_at->format('F j, Y')}}
                            </time>
                            <span>· 8 min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative z-0 mx-auto aspect-video max-w-screen-lg overflow-hidden lg:rounded-lg">
        <img alt="Thumbnail"
             loading="eager"
             decoding="async"
             data-nimg="fill"
             class="object-cover"
             sizes="100vw"
             src="https://picsum.photos/seed/picsum/800/468"
             style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    </div>
    <div class="prose mx-auto my-3 dark:prose-invert prose-a:text-blue-600 max-w-prose sm:max-w-md md:max-w-lg lg:max-w-xl">

        <article class="mx-auto max-w-screen-md ">
            <div class="prose mx-auto my-3 dark:prose-invert prose-a:text-blue-600">
                <p>
                    {{$post->body}}
                </p>
            </div>
            <div class="mb-7 mt-7 flex justify-center">
                <a
                    class="bg-brand-secondary/20 rounded-full px-5 py-2 text-sm text-blue-600 dark:text-blue-500 "
                    href="/">← View all posts
                </a>
            </div>
        </article>
        @if (auth()->id() === $post->user_id)
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Actions
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <a href="{{ route('posts.edit', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                        {{ __('Edit Post') }}
                    </a>

                    <form action="{{ route('posts.delete', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem">
                            {{ __('Delete Post') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
