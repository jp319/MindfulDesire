<x-guest-layout>

    <x-header sticky="{{ false }}" />

    @if($post->author->id == auth()->user()->id)

    <livewire:user.my-post :post="$post" />

    @endif

    <div class="bg-transparent py-6 sm:py-8 lg:pt-6 lg:pb-12">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
                <div class="mx-auto ">
                    <div class="overflow-hidden rounded-lg bg-gray-100  md:h-[80vh] ring-2 ring-black ring-opacity-5 shadow-2xl">
                        <img src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}" class=" h-[400px] md:h-full w-full object-cover object-center" />
                    </div>
                </div>

                <div class="md:pt-0 overflow-scroll max-h-[80vh] rounded-xl max-w-screen-xl mx-auto relative bg-slate-50 ring-2 ring-black ring-opacity-5 shadow-2xl px-3">
                    <div class="mb-6 px-10 mr-auto -ml-10 w-fit rounded-br-full backdrop-blur-2xl bg-gray-200/95 sticky top-0 flex flex-col items-center justify-center">
                        <h1 class="w-full pt-2 mb-1 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-1 md:text-left">{{ $post->title }}</h1>
                        <p class="w-full pb-3 text-center font-bold text-indigo-500 md:text-left">{{ $post->author->name }}</p>
                    </div>

                    <p class=" mb-6 text-gray-600 sm:text-lg md:mb-8 p-3 text-justify indent-10">
                        {{ $post->body }}
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ut atque dolores quisquam qui, incidunt alias nesciunt veniam nisi tempore obcaecati voluptates sequi delectus maiores consectetur vitae modi consequatur fugiat!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>