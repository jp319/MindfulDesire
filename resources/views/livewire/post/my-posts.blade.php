<div>
    @php
        $post_count = $posts->count();
    @endphp

    <section class="bg-transparent">
        <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16 max-w-7xl">
            <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
                @if($post_count > 0)
                    @foreach($posts as $post)
                        @php
                            $is_published = $post->published_at !== null;
                            $published_date =
                            $is_published
                                ? \App\Services\DateService::formatPublishedAtDate($post->published_at)
                                : 'unpublished';
                        @endphp
                        <!-- Small -->
                        <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4 relative">
                            <a href="{{ route('blog.show', ['post' => $post->slug]) }}" class="block relative">
                                <img
                                    class="absolute inset-0 -z-10 object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56 blur-md"
                                    src="{{ asset('storage/'.$post->image) }}" loading="lazy"
                                    alt="Photo by {{ $post->author->name }}">
                                <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56" src="{{ asset('storage/'.$post->image) }}" loading="lazy"
                                     alt="Photo by {{ $post->author->name }}">
                            </a>

                            <x-category-badge :post="$post" />

                            <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h2>
                            <p class="text-sm text-gray-500">{{ $post->excerpt }}</p>
                            <p class="pt-2 text-xs font-medium"><a href="{{ route('blog') }}?author={{ $post->author->id }}" class="mr-1 underline">{{ $post->author->name }}</a> · <span class="mx-1">{{ $published_date }}</span> · <span class="mx-1 text-gray-600">3 min. read</span></p>


                            <div class="flex justify-between gap-x-24">
                                <div class="flex gap-2.5">
                                    <button wire:click="deletePost({{ $post->id }})"
                                            class="inline-block rounded-lg bg-red-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-red-600 focus-visible:ring active:bg-red-700 sm:flex-none md:text-base"
                                    >Delete</button>

                                    @if($is_published)
                                        <button wire:click="unpublishPost({{ $post->id }})"
                                                class="inline-block rounded-lg bg-gray-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-600 focus-visible:ring active:bg-gray-700 sm:flex-none md:text-base"
                                        >Unpublish</button>
                                    @else
                                        <button wire:click="publishPost({{ $post->id }})"
                                                class="inline-block rounded-lg bg-blue-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-blue-300 transition duration-100 hover:bg-blue-600 focus-visible:ring active:bg-blue-700 sm:flex-none md:text-base"
                                        >Publish</button>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- Small -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Confirm Delete Post Modal -->
    <div x-data="{ modalOpen: @entangle('confirming_delete_post') }"
         @keydown.escape.window="modalOpen = false"
         :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                <div x-show="modalOpen"
                     x-trap.inert.noscroll="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-3">
                        <h3 class="text-lg font-semibold">Confirm</h3>
                    </div>
                    <div class="relative w-auto pb-8">
                        <p>
                            Are you sure you want to delete your post?
                            If you do, it will be gone forever.
                            This action cannot be undone.
                        </p>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                        <button wire:click="cancelDelete" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                        >Cancel</button>
                        <button wire:click="confirmDelete" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                        >Confirm</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <!-- Confirm Delete Post Modal -->

    <!-- Confirm Publish Post Modal -->
    <div x-data="{ modalOpen: @entangle('confirming_publish_post') }"
         @keydown.escape.window="modalOpen = false"
         :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                <div x-show="modalOpen"
                     x-trap.inert.noscroll="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-3">
                        <h3 class="text-lg font-semibold">Confirm</h3>
                    </div>
                    <div class="relative w-auto pb-8">
                        <p>
                            Are you sure you want to publish this post?
                            If you do, it will be visible to the public.
                            You can always unpublish it later.
                        </p>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                        <button wire:click="cancelPublish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                        >Cancel</button>
                        <button wire:click="confirmPublish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                        >Confirm</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <!-- Confirm Publish Post Modal -->

    <!-- Confirm Unpublish Post Modal -->
    <div x-data="{ modalOpen: @entangle('confirming_unpublish_post') }"
         @keydown.escape.window="modalOpen = false"
         :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                <div x-show="modalOpen"
                     x-trap.inert.noscroll="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90"
                     class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-3">
                        <h3 class="text-lg font-semibold">Confirm</h3>
                    </div>
                    <div class="relative w-auto pb-8">
                        <p>
                            Are you sure you want to unpublish this post?
                            If you do, it will not be visible to the public.
                            You can always publish it later.
                        </p>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                        <button wire:click="cancelUnpublish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                        >Cancel</button>
                        <button wire:click="confirmUnpublish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                        >Confirm</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <!-- Confirm Unpublish Post Modal -->

    <!-- Error Modal -->
    @if($errors->any())

        <div x-data="{ show: false }" x-init="setTimeout( () => { show = true }, 100 )">
            <template x-teleport="body">
                <!-- Global notification live region, render this permanently at the end of the document -->
                <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50">
                    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
                        <!--
                          Notification panel, dynamically insert this into the live region when it needs to be displayed

                          Entering: "transform ease-out duration-300 transition"
                            From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            To: "translate-y-0 opacity-100 sm:translate-x-0"
                          Leaving: "transition ease-in duration-100"
                            From: "opacity-100"
                            To: "opacity-0"
                        -->
                        <div x-cloak
                             x-show="show"
                             x-transition:enter="transform ease-out duration-300 transition"
                             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-red-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 8H12.01M12 11V16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p class="text-sm font-medium text-gray-900">Warning</p>
                                        @foreach($errors->all() as $error)
                                            <p class="mt-1 text-sm text-gray-500">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="ml-4 flex flex-shrink-0">
                                        <button @click="show = false" wire:click="closeErrorModal" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="sr-only">Close</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    @endif
    <!-- Error Modal -->

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
