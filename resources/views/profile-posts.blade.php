<x-guest-layout>
    <x-header />

    @php
        $post_count = $posts->count();
        $has_post = $post_count > 0;
    @endphp

    @if($has_post)
        <livewire:post.my-posts :posts="$posts" :user="auth()->user()" />
    @else
        <!-- Empty -->
        <div class="w-full sm:container mx-auto">
            <div class="max-w-4xl mx-auto px-10 bg-white rounded-lg shadow-lg">
                <div class="flex flex-col items-center justify-center py-6">
                    <img src="https://cdn-icons-png.flaticon.com/128/907/907717.png" alt="Welcome Icon" class="w-24 h-24 mb-4">
                    <h2 class="text-3xl font-semibold mb-2">Welcome to Our App!</h2>
                    <p class="text-gray-600 text-center text-lg leading-relaxed"
                    >Start your journey with us by exploring the amazing features we have to offer:</p>
                    <ul class="mt-4 text-gray-600 text-center text-base leading-relaxed">
                        <li class="mb-2"><span class="text-green-500">✔</span> Create and share stunning content.</li>
                        <li class="mb-2"><span class="text-green-500">✔</span> Connect with like-minded users.</li>
                        <li class="mb-2"><span class="text-green-500">✔</span> Discover inspiring stories and ideas.</li>
                    </ul>
                    <button class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600"
                    >Get Started</button>
                </div>
            </div>
        </div>
        <!-- Empty -->
    @endif

    <x-footer />
</x-guest-layout>
