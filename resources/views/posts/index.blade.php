<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Posts</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Posts List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                    <div class="flex items-center p-4">
                        <img src="{{ $post->user->profile_photo_url ?? 'https://i.pravatar.cc/100?u=' . $post->user_id }}"
                            class="w-10 h-10 rounded-full mr-3" alt="User">
                        <div>
                            <div class="font-semibold">{{ $post->user->name ?? 'User ' . $post->user_id }}</div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                        </div>
                        @if(Auth::id() === $post->user_id)
                            <div class="ml-auto flex gap-2">
                                <!-- Edit Button -->
                                <button onclick="openEditModal({{ $post->id }}, '{{ addslashes($post->content) }}')"
                                    class="text-blue-500 hover:text-blue-700 px-2 py-1 rounded">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ url('/posts/' . $post->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 px-2 py-1 rounded">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    @if($post->image_path)
                        <img src="{{ $post->image_path }}" alt="Post Image"
                            class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4 flex-1">
                        <p class="text-gray-800">{{ $post->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Floating Add Button -->
    <button id="addPostBtn"
        class="fixed bottom-8 right-8 bg-green-500 hover:bg-green-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-3xl shadow-lg z-50"
        onclick="showModal('postModal')" aria-label="Add Post">+</button>

    <!-- Create Post Modal -->
    <div id="postModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('postModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Create Post</h2>
            <form action="{{ url('/posts') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <textarea name="content" class="w-full border rounded p-2 mb-4" rows="3"
                    placeholder="What's on your mind?" required></textarea>
                <input type="file" name="image" class="mb-4" accept="image/*" />
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Post</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div id="editPostModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('editPostModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Edit Post</h2>
            <form id="editPostForm" method="POST">
                @csrf
                @method('PUT')
                <textarea id="editContent" name="content" class="w-full border rounded p-2 mb-4" rows="3"
                    required></textarea>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(postId, content) {
            document.getElementById('editPostModal').classList.remove('hidden');
            document.getElementById('editPostModal').classList.add('flex');
            document.getElementById('editContent').value = content;
            document.getElementById('editPostForm').action = '/posts/' + postId;
        }
        function showModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function hideModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
        document.getElementById('addPostBtn').onclick = function () { showModal('postModal'); };
    </script>

    @livewireScripts
</x-app-layout>