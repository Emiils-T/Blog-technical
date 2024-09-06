<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-md ">
            <div class="flex justify-center">
                <div class="flex gap-3">
                    @if($categories->isNotEmpty())
                        @foreach($categories as $category)
                            <a href="{{route('category.index',$category)}}">
                                <span
                                    class="inline-block text-xs font-medium tracking-wider uppercase   mt-5 text-blue-600">{{ ucfirst($category->name) }}</span>
                            </a>
                        @endforeach
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
                            <a href="#">{{$post->author_name}}</a>
                        </p>
                        <div class="flex items-center space-x-2 text-sm">
                            <time class="text-gray-500 dark:text-gray-400"
                                  datetime="">{{$post->created_at->format('F j, Y')}}
                            </time>
                            <span>· 8 min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative z-0 mx-auto aspect-video max-w-screen-md overflow-hidden lg:rounded-lg">
        <img alt="Thumbnail"
             loading="eager"
             decoding="async"
             data-nimg="fill"
             class="object-cover"
             sizes="100vw"
             src="https://picsum.photos/seed/picsum/800/468"
             style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    </div>
    <div
        class="prose mx-auto my-3 dark:prose-invert prose-a:text-blue-600 max-w-prose sm:max-w-md md:max-w-lg lg:max-w-xl">
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
            <div x-data="{ open: false }" class="relative flex justify-center">
                <button @click="open = !open"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Actions
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false"
                     class="absolute mt-10 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <a href="{{ route('posts.edit', $post) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                        {{ __('Edit Post') }}
                    </a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100"
                                role="menuitem">
                            {{ __('Delete Post') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <div class="mx-auto max-w-screen-md ">
        <h2 class="text-lg font-bold mb-4">Comments</h2>
        <div class="flex flex-col space-y-4">
            <div x-data="comments()">

                @forelse($comments as $comment)
                    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <h3 class="text-lg font-bold mr-2">{{$comment->user->name}}</h3>
                                @if(Auth::id() === $comment->user_id)
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center p-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <img src="{{asset('images/meatballs-menu.svg')}}" alt="Menu"
                                                     class="w-4 h-4">
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                               @click.prevent="openEditModal({{ $comment->id }})">
                                                {{ __('Edit') }}
                                            </a>

                                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100"
                                                        onclick="event.preventDefault();
                                 if(confirm('Are you sure you want to delete this comment?')) {
                                     this.closest('form').submit();
                                 }">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="text-gray-700 text-sm">{{$comment->created_at->format('M d, Y H:i')}}</p>
                        </div>
                        <p class="text-gray-700" id="comment-{{ $comment->id }}">{{$comment->body}}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                @endforelse

                <div x-show="editModalOpen" class="fixed inset-0 overflow-y-auto" x-cloak>
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                              aria-hidden="true">&#8203;</span>

                        <div
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                            @click.away="editModalOpen = false">
                            <form x-bind:action="`/posts/{{ $post->id }}/comments/${commentToEdit}`" method="POST"
                                  x-ref="editForm">
                                @csrf
                                @method('PUT')
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="mb-4">
                                        <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Edit
                                            Comment</label>
                                        <textarea name="body" id="body" rows="3"
                                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                  x-text="document.querySelector(`#comment-${commentToEdit}`).textContent"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Update
                                    </button>
                                    <button type="button" @click="editModalOpen = false"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::check())
                <form action="{{ route('comments.store',$post) }}" method="POST"
                      class="bg-white p-4 rounded-lg shadow-md">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <h3 class="text-lg font-bold mb-2">Add a comment</h3>
                    <div class="mb-4">
                        <p class="block text-gray-700 font-bold mb-2">
                            {{ Auth::user()->name }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="body">
                            Comment
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('body') border-red-500 @enderror"
                            id="body" name="body" rows="3" placeholder="Enter your comment"
                            required>{{ old('body') }}</textarea>
                        @error('body')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Submit
                    </button>
                </form>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('comments', () => ({
                editModalOpen: false,
                commentToEdit: null,
                openEditModal(commentId) {
                    this.commentToEdit = commentId;
                    this.editModalOpen = true;
                    this.$refs.editForm.action = this.$refs.editForm.action.replace(':comment', commentId);
                }
            }))
        })
    </script>
</x-app-layout>
