<div>
    <div class="max-w-screen-xl w-fit mx-auto">
        <div class="relative top-0 left-0 z-50 w-auto transition-all duration-150 ease-out">
            <div class="relative top-0 left-0 z-40 w-auto h-10 transition duration-200 ease-out">
                <div class="w-full h-full p-1 bg-transparent">
                    <div class="flex justify-between w-full h-full select-none text-neutral-900">
                        <div class="isolate inline-flex rounded-md shadow-sm">
                            <button wire:click="$toggle('show_edit_modal')" type="button" class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"
                            >Edit</button>
                            @if($post->published)
                                <button wire:click="$toggle('show_unpublish_modal')" type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"
                                >Unpublish</button>
                            @else
                                <button wire:click="$toggle('show_publish_modal')" type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"
                                >Publish</button>
                            @endif
                            <button wire:click="$toggle('show_delete_modal')" type="button" class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10"
                            >Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_edit_modal') }"
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
                         class="relative w-full max-h-[90vh] overflow-auto py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-screen-xl sm:rounded-lg">

                        <div class="flex items-center justify-between pb-3">
                            <h3 class="text-lg font-semibold">Edit your Post</h3>
                            <button @click="$wire.show_edit_modal=false"
                                    class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md bg-red-500 border-red-500 text-neutral-100 hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span>Close</span>
                            </button>
                        </div>

                        <div class="relative w-auto pb-2">

                            <form wire:submit="editForm">
                                <div class="space-y-2 py-2">

                                    <div class="w-full mx-auto">
                                        <label for="title" class="sr-only">Title</label>
                                        <input wire:model.blur="form.title" id="title" type="text" placeholder="title" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                    </div>

                                    <div class="w-full mx-auto" x-data="{ content: `{{ $post->body }}` }">
                                        <label for="edit_body" class="sr-only">Body</label>
                                        <textarea wire:model.blur="form.body"
                                                  id="edit_body"
                                                  x-data=
                                                      "
                                                        {
                                                            resize ()
                                                                {
                                                                    $el.style.height = '0px';
                                                                    $el.style.height = $el.scrollHeight + 'px';
                                                                },
                                                            element: document.getElementById('edit_body')
                                                        }
                                                      "
                                                  x-ref="content"
                                                  x-model="content"
                                                  x-init="resize(); element.value = content; element.dispatchEvent(new Event('input'));"
                                                  @input="resize()"
                                                  type="text"
                                                  placeholder="describe your post..."
                                                  class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                                        ></textarea>
                                        <p class="text-xs text-right pt-2 pr-2 font-light font-mono" :class="content.length < 50 ? 'text-red-400' : 'text-green-400'"><span x-text="content.length"></span><span>/50 (min)</span></p>
                                    </div>

                                    <div class="w-full mx-auto">
                                        <div class="relative w-full rounded-lg border border-transparent bg-yellow-50 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-yellow-600">
                                            <svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                            <h5 class="ml-8 mb-1 font-medium leading-none tracking-tight">Note</h5>
                                            <div class="ml-8 text-sm opacity-80">
                                                <p>If you want to change the image of your current post, you can upload a new one.</p>
                                                <p>If you don't want to change the image, just leave the input empty.</p>
                                            </div>
                                        </div>
                                        <x-form-components::files.file-pond class="border-neutral-300" wire:model.blur="form.image" :allow-drop="true" :max-files="1" accept="image/*" :show-errors="true">
                                            <x-slot:config>
                                                onaddfile(error, file)
                                                {
                                                $wire.form.change_image=true;
                                                },
                                                onremovefile(error, file)
                                                {
                                                $wire.form.change_image=false;
                                                },
                                            </x-slot:config>
                                        </x-form-components::files.file-pond>
                                    </div>

                                    <div class="w-full mx-auto">
                                        <label for="edit_categories[]" class="sr-only">Category</label>
                                        <select id="edit_categories[]"
                                                name="edit_categories[]"
                                                wire:model.blur="form.categories"
                                                wire:ignore
                                                x-data=
                                                    "
                                                        {
                                                            select:
                                                            new Select(
                                                                document.getElementById('edit_categories[]')
                                                            )

                                                        }
                                                    "
                                                x-init=
                                                    '
                                                        select.setValue(@json($selected_categories));
                                                    '
                                                data-te-select-filter="true"
                                                data-te-select-placeholder="Categories"
                                                multiple
                                        >
                                            <option value="0">Uncategorized</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-full mx-auto">

                                        <button type="submit"
                                                class="inline-block rounded bg-indigo-600 px-8 py-3 text-sm font-medium text-white transition hover:-rotate-2 hover:scale-110 focus:outline-none focus:ring active:bg-indigo-500">
                                            Update Post
                                        </button>

                                        @if($post->published)
                                            <div class="inline-flex ml-5">
                                                <div class="flex items-start mb-6">
                                                    <div class="flex items-center h-5">
                                                        <input wire:model.blur="form.published" name="custom-checkbox" id="custom-checkbox" type="checkbox" class="hidden peer">
                                                        <label for="custom-checkbox" class="peer-checked:[&_svg]:scale-100 text-sm font-medium text-neutral-600 peer-checked:text-blue-600 [&_svg]:scale-0 peer-checked:[&_.custom-checkbox]:border-blue-500 peer-checked:[&_.custom-checkbox]:bg-blue-500 select-none flex items-center space-x-2">
                                                            <span class="flex items-center justify-center w-5 h-5 border-2 rounded custom-checkbox text-neutral-900"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-white duration-300 ease-out"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg></span>
                                                            <span>Publish</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

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

    <!-- Delete -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_delete_modal') }"
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
                            <button wire:click="$toggle('show_delete_modal')" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                            >Cancel</button>
                            <button wire:click="delete" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                            >Confirm</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Delete -->

    <!-- Publish -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_publish_modal') }"
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
                         class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
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
                            <button wire:click="$toggle('show_publish_modal')" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                            >Cancel</button>
                            <button wire:click="publish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                            >Confirm</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Publish -->

    <!-- Unpublish -->
    <div>
        <div x-data="{ modalOpen: @entangle('show_unpublish_modal') }"
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
                         class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
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
                            <button wire:click="$toggle('show_unpublish_modal')" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 bg-blue-900 hover:bg-blue-700"
                            >Cancel</button>
                            <button wire:click="unpublish" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-danger-900 focus:ring-offset-2 bg-danger-900 hover:bg-danger-700"
                            >Confirm</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Unpublish -->

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
