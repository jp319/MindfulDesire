<div>
    <div x-data="{ modalOpen: false }"
         @keydown.escape.window="modalOpen = false"
         @keydown.window.prevent.ctrl.k="modalOpen = !modalOpen"
         :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
        <button @click="modalOpen=true" class="bg-gray-100/[.30] p-2 rounded-full border-2 border-gray-100/[.30] absolute top-0 left-0 hidden py-2 mt-6 ml-10 mr-2 text-gray-600 lg:flex lg:items-center lg:gap-x-2 md:mt-0 md:ml-2 lg:mx-3 md:relative">
            <svg class="inline w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
            Create Post<span class="ml-auto pl-3 flex-none text-xs font-semibold">Ctrl K</span>
        </button>
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
                <div x-show="modalOpen"
                     x-trap.inert.noscroll="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                     class="overflow-auto relative w-full mt-6 mb-auto py-1 bg-white border shadow-lg px-1 border-neutral-200 max-w-screen-xl sm:rounded-lg">
                    <div class="flex items-center justify-center p-1">
                        <div class="w-full max-h-[90vh] overflow-auto relative">
                            <!-- component -->

                            <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>

                            <div class="editor mx-auto w-full flex flex-col text-gray-800 px-4 gap-2">

                                <livewire:user.upload-post />

                            </div>

                            <div class="absolute top-0 right-0">
                                <button @click="modalOpen=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    <span>Close</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
