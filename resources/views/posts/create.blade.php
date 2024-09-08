<x-app-layout>
    <section class="bg-white dark:text-gray-800">
        <div class="container max-w-4xl p-6 mx-auto space-y-6 sm:space-y-12">
            <h2 class="text-3xl font-semibold text-center">Create a New Blog Post</h2>
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" id="title" name="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           required>
                </div>
                <div>
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
                    <textarea id="body" name="body" rows="6"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                              required></textarea>
                </div>
                <div>
                    <label for="categories" class="block mb-2 text-sm font-medium text-gray-900">Select
                        Categories</label>
                    <select id="categories" name="categories[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="new_categories" class="block mb-2 text-sm font-medium text-gray-900">Add New
                        Categories</label>
                    <input type="text" id="new_categories" name="new_categories"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Enter new categories, separated by commas">
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                            class="px-6 py-3 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </section>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#categories').select2({
                    placeholder: 'Select categories',
                    allowClear: true,
                    tags: true,
                    tokenSeparators: [',', ' '],
                });
            });
        </script>
    @endpush
</x-app-layout>
