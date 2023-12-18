<x-guest-layout>

    <x-header sticky="{{ false }}" />

    <div class="bg-transparent py-6 sm:py-8 lg:pt-6 lg:pb-12">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
                <div>
                    <div class="h-24 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-[80vh]">
                        <img src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by Martin Sanchez" class="h-full w-full object-cover object-center" />
                    </div>
                </div>

                <div class="md:pt-0 overflow-scroll max-h-[80vh] rounded-xl max-w-screen-xl mx-auto relative border-4 px-3">
                    <div class="mb-6 px-10 mr-auto -ml-10 w-fit rounded-br-full backdrop-blur-2xl bg-gray-200/95 sticky top-0 flex flex-col items-center justify-center">
                        <h1 class="pt-2 mb-1 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-1 md:text-left">{{ $post->title }}</h1>
                        <p class="pb-3 text-center font-bold text-indigo-500 md:text-left">{{ $post->author->name }}</p>
                    </div>

                    <p class="mb-6 text-gray-500 sm:text-lg md:mb-8">
                        {{ $post->body }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
