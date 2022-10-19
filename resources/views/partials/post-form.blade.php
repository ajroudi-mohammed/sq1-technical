<div class="overflow-x-auto">
    <div
        class="min-w-screen min-h-screen bg-gray-100 flex mt-10 justify-center bg-gray-100 font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">
            <form action="/posts" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        value="{{isset($post) ? $post->title : '' }}" {{ isset($post) ? 'readonly' : '' }} id="title" name="title" type="text" placeholder="title">
                </div>

                <div class="mb-4 bg-white rounded-t-lg dark:bg-gray-800">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea id="description" {{ isset($post) ? 'readonly' : '' }} name="description" rows="4" class="px-0 w-full text-sm text-gray-900 bg-gray-200 appearance-none border-2 border-gray-200 rounded pl-4" placeholder="Write a comment..." required>{{ isset($post) ? $post->description : '' }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    @if ( !isset($post) )
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create
                    </button>
                    @endif

                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="{{ route('dashboard') }}">
                        Back
                    </a>
                </div>
            </form>

        </div>
    </div>

</div>
