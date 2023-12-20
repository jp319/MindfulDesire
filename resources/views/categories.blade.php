<x-guest-layout>
    <x-header/>

    <section class="py-12 sm:py-16 bg-transparent">
        <div class="max-w-7xl px-10 mx-auto sm:text-center">
            <p class="text-blue-500 font-medium uppercase">Browse Categories</p>
            <h2 class="font-bold text-3xl sm:text-4xl lg:text-5xl mt-3">Ease your search with Categories.</h2>
            <p class="mt-4 text-gray-500 text-base sm:text-xl lg:text-2xl">Dive deeper, explore further: Categories unlock a universe of possibilities!<br class="lg:hidden hidden sm:block"> Check'em out below 👇</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-10 my-12 sm:my-16">
                <a href="{{ route('categories.show', ['category' => 'uncategorized']) }}" class="group">
                    <div class="rounded-lg py-3 flex flex-col items-center justify-center shadow-lg border border-gray-100 group-active:bg-gray-50 group-hover:brightness-50 group-hover:scale-110 transition-all ease-in-out duration-300">
                        <p class="font-bold mt-2">Uncategorized</p><span>({{ $posts_with_no_category }})</span>
                    </div>
                </a>
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        @php
                            $count = \App\Services\PostHelperService::getNumberOfPostsInACategory($category->id)
                        @endphp
                        <a href="{{ route('categories.show', ['category' => $category->slug]) }}" class="group">
                            <div class="rounded-lg py-3 flex flex-col items-center justify-center shadow-lg border border-gray-100 group-active:bg-gray-50 group-hover:brightness-50 group-hover:scale-110 transition-all ease-in-out duration-300">
                                <p class="font-bold mt-2">{{ $category->name }}</p><span>({{ $count }})</span>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>

            <livewire:user.category />

        </div>
    </section>

    <x-footer />
</x-guest-layout>
