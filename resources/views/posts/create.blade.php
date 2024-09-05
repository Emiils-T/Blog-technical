<x-app-layout>
    <section class="bg-white dark:text-gray-800">
        <div class="container max-w-4xl p-6 mx-auto space-y-6 sm:space-y-12">
            <h2 class="text-3xl font-semibold text-center">Create a New Blog Post</h2>
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
                    <textarea id="body" name="body" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Create Post</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
