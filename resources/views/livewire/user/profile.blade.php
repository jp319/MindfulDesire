<div>
    <form wire:submit="save">

        <div class="mt-20 text-center border-b pb-12">
            <div class="relative h-11 w-full text-4xl font-medium flex items-center justify-center">
                <label for="name" class="sr-only">Static</label>
                <input id="name" placeholder="{{ $user->name }}" type="text"
                       value="{{ $user->name }}" wire:model.blur="form.name"
                       class="peer h-full max-w-fit bg-transparent text-center border-0
                          pt-4 pb-1.5 font-sans text-4xl font-medium text-gray-700 transition-all"
                />
            </div>

            <div class="flex justify-center items-end text-gray-600 font-light w-full mx-auto">
                <input id="name" placeholder="{{ $user->city }}" type="text"
                       value="{{ $user->city }}" wire:model.blur="form.city"
                       class="peer h-full w-28 bg-transparent text-right border-0
                      mt-3 pb-1.5 text-gray-600 transition-all font-light"
                /><span class="-ml-2 mb-1">,</span>
                <input id="name" placeholder="{{ $user->country }}" type="text"
                       value="{{ $user->country }}" wire:model.blur="form.country"
                       class="peer h-full w-28 bg-transparent text-left border-0
                      mt-3 pb-1.5 text-gray-600 transition-all font-light"
                />
            </div>

            <div class="flex justify-center items-end text-gray-600 font-light w-full mx-auto">
                <input id="name" type="date"
                       value="{{ $user->birthdate }}" wire:model.blur="form.birthdate"
                       class="peer h-full w-30 bg-transparent text-right border-0
                      mt-3 pb-1.5 text-gray-600 transition-all font-light"
                /><span class="mb-1.5">({{ $user->age }} years old)</span>
            </div>
            {{--
            <p class="mt-8 text-gray-500">Solution Manager - Creative Tim Officer</p>
            <p class="mt-2 text-gray-500">University of Computer Science</p>
            --}}
        </div>

        <div class="mt-8 flex flex-col justify-center">
            <textarea id="name" placeholder="{{ $user->about_me }}" type="text"
                      class="peer h-full w-md bg-transparent border-0 px-16
                             pb-1.5 text-gray-600 transition-all font-light
                             text-center"
                      wire:model.blur="form.about_me"
            >{{ $user->about_me }}</textarea>
            {{--
            <button class="text-indigo-500 py-2 px-4  font-medium mt-4">
                Show more
            </button>
             --}}
        </div>

        <div class="flex w-full justify-center sm:justify-end items-center pt-5">
            <button type="submit" class="text-white py-2 px-4 uppercase rounded bg-green-400 hover:bg-green-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                Save Changes
            </button>
        </div>
    </form>

    <div x-data="{ show: false }" x-on:profile-updated.window="show = true">
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
                                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-gray-900">Successfully saved!</p>
                                    <p class="mt-1 text-sm text-gray-500">Your profile information was updated</p>
                                </div>
                                <div class="ml-4 flex flex-shrink-0">
                                    <button @click="show = false" type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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

</div>
