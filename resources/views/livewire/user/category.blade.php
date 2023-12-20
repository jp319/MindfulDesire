<div>
    <button wire:click="$toggle('show_create_category_modal')"
            class="px-8 py-4 sm:w-auto w-full text-center text-base font-medium inline-block rounded text-white hover:bg-blue-600 bg-blue-500"
    >Create a new category</button>

    <!-- New Category -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_create_category_modal') }"
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
                         class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                    <div x-show="modalOpen"
                         x-trap.inert.noscroll="modalOpen"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-90"
                         class="relative w-full max-h-[90vh] overflow-auto py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-screen-sm sm:rounded-lg">

                        <div class="flex items-center justify-between pb-3">
                            <h3 class="text-lg font-semibold">Create a new Category</h3>
                            <button @click="$wire.show_create_category_modal=false"
                                    class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md bg-red-500 border-red-500 text-neutral-100 hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span>Close</span>
                            </button>
                        </div>

                        <div class="relative w-auto pb-2">

                            <form wire:submit="create">
                                <div class="space-y-2 py-2">

                                    <div class="w-full mx-auto">
                                        <label for="name" class="sr-only">Name</label>
                                        <input wire:model.blur="form.name" id="name" type="text" placeholder="name" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                    </div>
                                    <div class="w-full mx-auto">
                                        <div class="flex justify-center space-x-2 items-center">
                                            <label for="nativeColorPicker1">Pick a color</label>
                                            <input wire:model.blur="form.color" id="nativeColorPicker1" type="color" value="#6590D5" />
                                            <button
                                                id="burronNativeColor"
                                                type="button"
                                                class="inline-block rounded-full bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg"
                                                x-data=
                                                    "
                                                        {
                                                            colorPicker: document.getElementById('nativeColorPicker1'),
                                                            changeColorBtn: document.getElementById('burronNativeColor')
                                                        }
                                                    "
                                                x-init=
                                                    "
                                                        changeColorBtn.style.backgroundColor = colorPicker.value;
                                                        colorPicker.addEventListener('input', () => {
                                                            changeColorBtn.style.backgroundColor = colorPicker.value;
                                                            console.log(colorPicker.value);
                                                        });
                                                    "
                                            >
                                                Sample
                                            </button>
                                        </div>
                                    </div>

                                    <div class="w-full mx-auto">

                                        <button type="submit"
                                                class="inline-block rounded bg-indigo-600 px-8 py-3 text-sm font-medium text-white transition hover:-rotate-2 hover:scale-110 focus:outline-none focus:ring active:bg-indigo-500">
                                            Create
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
    <!-- New Category -->

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
    <!-- Error -->
</div>
