<div>
    @php
        $post_count = $posts->count();
    @endphp

    <section class="bg-transparent">
        <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-4 md:py-6 sm:space-y-4 md:space-y-8 max-w-7xl">
            <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
                @if($post_count > 0)
                    @foreach($posts as $post)
                        <!-- Small -->
                        <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4 relative">
                            <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="block relative">
                                <img
                                    class="absolute inset-0 -z-10 object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56 blur-md"
                                    src="{{ asset('storage/'.$post->image) }}" loading="lazy"
                                    alt="Photo by {{ $post->author->name }}">
                                <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56" src="{{ asset('storage/'.$post->image) }}" loading="lazy" alt="Photo by {{ $post->author->name }}">
                            </a>

                            <x-category-badge :post="$post" />

                            <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h2>
                            <p class="text-sm text-gray-500">{{ $post->excerpt }}</p>
                            <p class="pt-2 text-xs font-medium"><a href="{{ route('blog') }}?author={{ $post->author->id }}" class="mr-1 underline">{{ $post->author->name }}</a> · <span class="mx-1">{{ \App\Services\DateService::formatPublishedAtDate($post->published_at) }}</span> · <span class="mx-1 text-gray-600">3 min. read</span></p>
                        </div>
                        <!-- Small -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @if($post_count < $remaining_posts)
        <section class="w-full flex items-center justify-center" x-intersect="$dispatch('load-more-posts')">
            <div class="transition-all duration-300 ease-in-out" wire:loading>
                <svg class="w-40 h-40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g transform="rotate(0 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(30 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(60 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(90 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(120 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(150 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(180 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(210 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(240 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(270 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(300 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
                        </rect>
                    </g><g transform="rotate(330 50 50)">
                        <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#fe718d">
                            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
                        </rect>
                    </g>
                    <!-- [ldio] generated by https://loading.io/ --></svg>
            </div>
        </section>
    @endif
</div>
