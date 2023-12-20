<x-guest-layout>
    <x-header/>

    <section class="py-12 sm:py-16 bg-transparent">
        <div class="max-w-7xl px-10 mx-auto sm:text-center">
            <p class="text-blue-500 font-medium uppercase">Filtered Posts</p>
            <h2 class="font-bold text-3xl sm:text-4xl lg:text-5xl mt-3">{{ ucwords($name) }} Posts.</h2>
            <p class="mt-4 text-gray-500 text-base sm:text-xl lg:text-2xl">Showing posts with {{ ucwords($name) }} category.<br class="lg:hidden hidden sm:block"> Check'em out below 👇</p>
            <a href="{{ route('categories') }}"
               class="font-bold text-indigo-500 hover:text-indigo-600 transition duration-150 ease-in-out"
            >Go Back</a>
        </div>
    </section>

    @if($posts->count() == 0)
        <section class="py-12 sm:py-16 bg-transparent">
            <div class="max-w-7xl px-10 mx-auto sm:text-center">
                <h2 class="font-bold text-3xl sm:text-4xl lg:text-5xl mt-3">No posts found.</h2>
                <p class="mt-4 text-gray-500 text-base sm:text-xl lg:text-2xl">There are no posts with {{ ucwords($name) }} category yet.</p>
            </div>
        </section>
    @else
        <livewire:post.all-posts :posts="$posts" />
    @endif

    <x-footer />
</x-guest-layout>
