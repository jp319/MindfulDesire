<x-guest-layout>
    <x-header />

    {{--
    <form class="flex flex-col md:flex-row gap-3">
        <div class="flex">
            <input type="text" placeholder="Search for the tool you like"
                   class="w-full md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500"
            >
            <button type="submit" class="bg-sky-500 text-white rounded-r px-2 md:px-3 py-0 md:py-1">Search</button>
        </div>
        <select id="pricingType" name="pricingType"
                class="w-full h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
            <option value="All" selected="">All</option>
            <option value="Freemium">Freemium</option>
            <option value="Free">Free</option>
            <option value="Paid">Paid</option>
        </select>
    </form>
    --}}

    @php
    $post_count = $posts->count();
    $has_post = $post_count > 0;
    $post_number = 1;
    @endphp

    @if(request('author') !== null)
    @php
    $author = \App\Models\User::find(request('author'));
    @endphp
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <p class="mb-2 text-center font-semibold text-indigo-500 md:mb-3 lg:text-lg">Viewing</p>

            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">{{ $author->name }}'s posts</h2>

            <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                This is a collection of all the posts created by {{ $author->name }}.
                <a href="{{ route('blog') }}" class="font-bold text-indigo-500 hover:text-indigo-600 transition duration-150 ease-in-out">Go Back</a>
            </p>
        </div>
    </div>
    @endif

    <section class="bg-transparent">
        <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-8 sm:space-y-8 md:space-y-16 max-w-7xl relative">

            @if($has_post)
            @php
            $post = $posts->first();
            @endphp
            <!-- Feature -->
            <div class="flex flex-col items-center sm:px-5 md:flex-row">
                <div class="w-full md:w-1/2">
                    <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="block relative">
                        <img class="absolute inset-0 -z-10 object-cover w-full h-full rounded-lg max-h-64 sm:max-h-96 blur-md" src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}">
                        <img class="object-contain w-full h-full rounded-lg max-h-64 sm:max-h-96" src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}">
                    </a>
                </div>
                <div class="flex flex-col items-start justify-center w-full h-full py-6 mb-6 md:mb-0 md:w-1/2">
                    <div class="flex flex-col items-start justify-center h-full space-y-3 transform md:pl-10 lg:pl-16 md:space-y-5">
                        <div class="bg-pink-500 flex items-center pl-2 pr-3 py-1.5 leading-none rounded-full text-xs font-medium uppercase text-white inline-block">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span>Newest</span>
                        </div>
                        <h1 class="text-4xl font-bold leading-none lg:text-5xl xl:text-6xl"><a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h1>
                        <p class="pt-2 text-sm font-medium">by <a href="{{ route('blog') }}?author={{ $post->author->id }}" class="mr-1 underline">{{ $post->author->name }}</a> · <span class="mx-1">{{ \App\Services\DateService::formatPublishedAtDate($post->published_at) }}</span>
                            · <span class="mx-1 text-gray-600">5 min. read</span></p>
                    </div>
                </div>
            </div>
            <!-- Feature -->
            @else
            <!-- Empty -->
            <div class="w-full sm:container mx-auto">
                <div class="max-w-4xl ring-2 ring-black ring-opacity-5 mx-auto px-10 bg-white rounded-lg shadow-xl">
                    <div class="flex flex-col items-center justify-center py-6">
                        <img src="https://cdn-icons-png.flaticon.com/128/907/907717.png" alt="Welcome Icon" class="w-24 h-24 mb-4">
                        <h2 class="text-3xl font-semibold mb-2">Welcome to Our App!</h2>
                        <p class="text-gray-600 text-center text-lg leading-relaxed">Start your journey with us by exploring the amazing features we have to offer:</p>
                        <ul class="mt-4 text-gray-600 text-center text-base leading-relaxed">
                            <li class="mb-2"><span class="text-green-500">✔</span> Create and share stunning
                                content.
                            </li>
                            <li class="mb-2"><span class="text-green-500">✔</span> Connect with like-minded users.
                            </li>
                            <li class="mb-2"><span class="text-green-500">✔</span> Discover inspiring stories and
                                ideas.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Empty -->
            @endif

            <div class="isolate pointer-events-none">
                <div class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 transform-gpu justify-center overflow-hidden blur-3xl sm:bottom-0 sm:right-[calc(50%-6rem)] sm:top-auto sm:translate-y-0 sm:transform-gpu sm:justify-end" aria-hidden="true">
                    <div class="aspect-[1108/632] w-[69.25rem] flex-none bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-25" style="clip-path: polygon(73.6% 48.6%, 91.7% 88.5%, 100% 53.9%, 97.4% 18.1%, 92.5% 15.4%, 75.7% 36.3%, 55.3% 52.8%, 46.5% 50.9%, 45% 37.4%, 50.3% 13.1%, 21.3% 36.2%, 0.1% 0.1%, 5.4% 49.1%, 21.4% 36.4%, 58.9% 100%, 73.6% 48.6%)"></div>
                </div>
            </div>

            @if($post_count > 1)
            <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">

                @foreach($posts->skip(1) as $post)
                @php
                $post_number++;
                @endphp

                <!-- Big -->
                <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-6">
                    <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="block relative">
                        <img class="absolute inset-0 -z-10 object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-96 blur-md" src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}">
                        <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-96" src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}">
                    </a>

                    <div class="w-full flex flex-wrap gap-2">
                        @forelse($post->categories as $category)
                        <div class="flex items-center px-3 py-1.5 leading-none rounded-full text-xs font-medium uppercase text-white inline-block" style="background-color: {{ $category->color }};">
                            <span>{{ $category->name }}</span>
                        </div>
                        @empty
                        <div class="bg-gray-500 flex items-center px-3 py-1.5 leading-none rounded-full text-xs font-medium uppercase text-white inline-block">
                            <span>Uncategorized</span>
                        </div>
                        @endforelse
                    </div>

                    <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h2>
                    <p class="text-sm text-gray-500">{{ $post->excerpt }}</p>
                    <p class="pt-2 text-xs font-medium"><a href="{{ route('blog') }}?author={{ $post->author->id }}" class="mr-1 underline">{{ $post->author->name }}</a>
                        · <span class="mx-1">{{ \App\Services\DateService::formatPublishedAtDate($post->published_at) }}</span>
                        · <span class="mx-1 text-gray-600">3 min. read</span></p>
                </div>
                <!-- Big -->

                @if($post_number == 3)
                @break
                @endif
                @endforeach

            </div>
            @endif

            <div class="isolate pointer-events-none">
                <div class="absolute left-1/2 right-0 top-full -z-10 hidden -translate-y-1/2 transform-gpu overflow-hidden blur-3xl sm:block" aria-hidden="true">
                    <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
            </div>

        </div>
    </section>


    {{--
    <x-categories :categories="$categories"/>
    --}}

    <livewire:post.all-posts :posts="$posts->slice(3)" />

    <x-footer />
</x-guest-layout>