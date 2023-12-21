<div>
    <div class="relative w-full mx-auto bg-transparent">
        <section class="py-8 lg:py-16 antialiased">
            <div class="max-w-2xl mx-auto px-4">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Comments ({{ $comment_count }})</h2>
                </div>

                @auth
                    <form class="mb-6" wire:submit="comment">
                        <div class="w-full mx-auto mb-2">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea wire:model.blur="form.body" id="comment" type="text" placeholder="Type your message here." class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                                      required
                            ></textarea>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-primary-200 bg-blue-500">
                            Post comment
                        </button>
                    </form>
                @else
                    <div class="bg-transparent py-6">
                        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                            <div class="flex flex-col items-center justify-between gap-4 rounded-lg bg-gray-100/50 p-4 sm:flex-row md:p-8">
                                <div>
                                    <h2 class="text-xl font-bold text-indigo-500 md:text-2xl">Post a comment</h2>
                                    <p class="text-gray-600">Sign in or Sign up to post a comment</p>
                                </div>

                                <div class="flex">
                                    <x-register-or-login-modal />
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth


                @if($comment_count > 0)
                    @foreach($comments as $comment)
                        @php
                            $user_profile = $comment->user->profile_photo_url;
                            $user_name = $comment->user->name;

                            $date_readable = date('F j, Y', strtotime($comment->created_at));
                            $date_with_cardinal = date('F jS, Y', strtotime($comment->created_at));
                            $date_numeric = date('Y-m-d', strtotime($comment->created_at));
                            $date_for_humans = $comment->created_at->diffForHumans();

                            $comment_body = $comment->body;
                            $comment_id = $comment->id;
                        @endphp
                        <article class="p-6 text-base bg-white rounded-lg mb-2">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                             src="{{ $user_profile }}"
                                             alt="{{ $user_name }}">
                                        {{ $user_name }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <time pubdate datetime="{{ $date_numeric }}"
                                              title="{{ $date_with_cardinal }}">{{ $date_readable }}</time>
                                        <span>({{ $date_for_humans }})</span>
                                    </p>
                                </div>

                                @auth
                                    @if($comment->user->id == auth()->user()->id)
                                        <!-- Dropdown button -->
                                        <div x-data="{ show: false }" class="relative">

                                            <div class="relative inline-block text-left">
                                                <div>
                                                    <button @click="show = !show"
                                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                                            type="button">
                                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                                        </svg>
                                                        <span class="sr-only">Comment settings</span>
                                                    </button>
                                                </div>

                                                <!--
                                                  Dropdown menu, show/hide based on menu state.

                                                  Entering: "transition ease-out duration-100"
                                                    From: "transform opacity-0 scale-95"
                                                    To: "transform opacity-100 scale-100"
                                                  Leaving: "transition ease-in duration-75"
                                                    From: "transform opacity-100 scale-100"
                                                    To: "transform opacity-0 scale-95"
                                                -->
                                                <div x-cloak
                                                     x-show="show"
                                                     @click.away="show = false"
                                                     x-transition:enter="transition ease-out duration-100"
                                                     x-transition:enter-start="transform opacity-0 scale-95"
                                                     x-transition:enter-end="transform opacity-100 scale-100"
                                                     x-transition:leave="transition ease-in duration-75"
                                                     x-transition:leave-start="transform opacity-100 scale-100"
                                                     x-transition:leave-end="transform opacity-0 scale-95"
                                                     class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                    <div class="py-1" role="none">
                                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                        <button wire:click="confirmEdit({{ $comment_id }})" type="button" class="text-left w-full text-gray-700 block px-4 py-2 text-sm hover:bg-gray-200 transition-all ease-in-out duration-200" role="menuitem" tabindex="-1" id="menu-item-0"
                                                        >Edit</button>
                                                        <button wire:click="confirmDelete({{ $comment_id }})" type="button" class="text-left w-full text-gray-700 block px-4 py-2 text-sm hover:bg-gray-200 transition-all ease-in-out duration-200" role="menuitem" tabindex="-1" id="menu-item-1"
                                                        >Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dropdown button -->
                                    @endif
                                @endauth

                            </footer>
                            <p class="text-gray-500">{{ $comment_body }}</p>
                        </article>

                    @endforeach
                @endif

            </div>
        </section>
    </div>

    <!-- Delete -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_delete_modal') }" :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
            <template x-teleport="body">
                <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                        <div class="flex items-center justify-between pb-3">
                            <h3 class="text-lg font-semibold">Confirm</h3>
                        </div>
                        <div class="relative w-auto pb-8">
                            <p>
                                Are you sure you want to delete your comment?
                                If you do, it will be gone forever.
                                This action cannot be undone.
                            </p>
                        </div>
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                            <button wire:click="$toggle('show_delete_modal')" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700">Cancel</button>
                            <button wire:click="delete" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700">Confirm</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Delete -->

    <!-- Edit -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_edit_modal') }" :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
            <template x-teleport="body">
                <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative w-full max-h-[90vh] overflow-auto py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-screen-xl sm:rounded-lg">

                        <div class="flex items-center justify-between pb-3">
                            <h3 class="text-lg font-semibold">Edit your Comment</h3>
                            <button @click="$wire.show_edit_modal=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md bg-red-500 border-red-500 text-neutral-100 hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Close</span>
                            </button>
                        </div>

                        <div class="relative w-auto pb-2">

                            <form wire:submit="edit">
                                <div class="space-y-2 py-2">

                                    <div class="w-full mx-auto" x-data="{ content: `{{ $edited_body }}` }">
                                        <label for="edit_comment" class="sr-only">Body</label>
                                        <textarea wire:model.blur="edited_body" id="edit_comment" x-data="
                                                        {
                                                            resize ()
                                                                {
                                                                    $el.style.height = '0px';
                                                                    $el.style.height = $el.scrollHeight + 'px';
                                                                },
                                                            element: document.getElementById('edit_comment')
                                                        }
                                                      " x-ref="content" x-model="content" x-init="resize(); element.value = content; element.dispatchEvent(new Event('input'));" @input="resize()" type="text" placeholder="write your comment..." class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                        <p class="text-xs text-right pt-2 pr-2 font-light font-mono" :class="content.length < 4 ? 'text-red-400' : 'text-green-400'"><span x-text="content.length"></span><span>/4 (min)</span></p>
                                    </div>

                                    <div class="w-full mx-auto">

                                        <button type="submit" class="inline-block rounded bg-indigo-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 focus:outline-none focus:ring active:bg-indigo-500">
                                            Update Comment
                                        </button>

                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Edit -->

    <!-- Error -->
    @if($errors->any())

        <div x-data="{ show: false }" x-init="setTimeout( () => { show = true }, 100 )">
            <template x-teleport="body">
                <!-- Global notification live region, render this permanently at the end of the document -->
                <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-[99]">
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
                        <div x-cloak x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-red-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M12 8H12.01M12 11V16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p class="text-sm font-medium text-gray-900">Warning</p>
                                        @foreach($errors->all() as $error)
                                            <p class="mt-1 text-sm text-gray-500">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                    <div class="ml-4 flex flex-shrink-0">
                                        <button @click="show = false" wire:click="close" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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
    <!-- Error -->
</div>
