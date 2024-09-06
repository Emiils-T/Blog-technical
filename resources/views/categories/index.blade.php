<x-app-layout>
    <div class="flex justify-center">
        <div class="flex gap-3">
            <h2 class="inline-block text-m font-medium tracking-wider uppercase mt-5">
                Category: {{$category->name}} </h2>
        </div>
    </div>

    <section class="bg-white dark:text-gray-800">
        <div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
            <a href="{{ route('posts.show', $posts[0]->id) }}"
               class="block max-w-sm gap-3 mx-auto sm:max-w-full group hover:no-underline focus:no-underline lg:grid lg:grid-cols-12 dark:bg-gray-50">
                <img src="https://picsum.photos/seed/picsum/480/360" alt=""
                     class="object-cover w-full h-64 rounded sm:h-96 lg:col-span-7 dark:bg-gray-500">
                <div class="p-6 space-y-2 lg:col-span-5 bg-gray-50">
                    <h3 class="text-2xl font-semibold sm:text-4xl group-hover:underline group-focus:underline">{{$posts[0]->title}}</h3>
                    <div class="mt-3 flex items-center space-x-3 text-gray-500 dark:text-gray-400">
                        <span>{{$posts[0]->author_name}} </span><span
                            class="text-xs text-gray-300 dark:text-gray-600">•</span>
                        <time class="truncate text-sm" datetime="{{ $posts[0]->created_at->toIso8601String() }}">
                            {{ $posts[0]->created_at->format('F j, Y') }}
                        </time>
                    </div>
                    <div class="relative mt-4 h-48 overflow-hidden">
                        <p>{{$posts[0]->body}}</p>
                        <div
                            class="absolute bottom-0 left-0 h-full w-full bg-gradient-to-t from-gray-50 to-transparent rounded-lg"></div>
                    </div>
                </div>
            </a>
            <div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @for($i=1;$i<count($posts);$i++)
                    <a href="{{route('posts.show',$posts[$i]->id)}}"
                       class="max-w-sm mx-auto group hover:no-underline focus:no-underline dark:bg-gray-50">
                        <img role="presentation" class="object-cover w-full rounded h-44 dark:bg-gray-500"
                             src="https://picsum.photos/seed/picsum/480/360">
                        <div class="p-6 space-y-2 bg-gray-50">
                            <h3 class="text-2xl font-semibold group-hover:underline group-focus:underline">{{$posts[$i]->title}}</h3>
                            <span>{{$posts[$i]->author_name}} </span><span
                                class="text-xs text-gray-300 dark:text-gray-600">•</span>
                            <time class="truncate text-sm">
                                {{ $posts[$i]->created_at->format('F j, Y') }}
                            </time>
                            <div class="relative mt-4 h-32 overflow-hidden">
                                <p>{{$posts[$i]->body}}</p>
                                <div
                                    class="absolute bottom-0 left-0 h-full w-full bg-gradient-to-t from-gray-50 to-transparent rounded-lg"></div>
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
            <div class="mt-10 flex items-center justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
