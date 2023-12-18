<div>

    <form wire:submit="uploadPost">
        <div class="space-y-2 py-2">
            <div class="w-full mx-auto">
                <label for="title" class="sr-only">Title</label>
                <input wire:model.blur="form.title" id="title" type="text" placeholder="title" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
            </div>

            <div class="w-full mx-auto" x-data="{ content: '' }">
                <label for="body" class="sr-only">Body</label>
                <textarea wire:model.blur="form.body" id="body" x-data="{ resize () { $el.style.height = '0px'; $el.style.height = $el.scrollHeight + 'px' } }"
                          x-ref="content"
                          x-model="content"
                          x-init="resize()"
                          @input="resize()"
                          type="text"
                          placeholder="describe your post..."
                          class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                ></textarea>
                <p class="text-xs text-right pt-2 pr-2 font-light font-mono" :class="content.length < 50 ? 'text-red-400' : 'text-green-400'"><span x-text="content.length"></span><span>/50 (min)</span></p>
            </div>

            <div class="w-full mx-auto">
                <x-form-components::files.file-pond class="border-neutral-300" wire:model.blur="form.image" :allow-drop="true" :max-files="1" accept="image/*" :show-errors="true" />
            </div>

            <div class="w-full mx-auto">
                <label for="categories[]" class="sr-only">Category</label>
                <select id="categories[]"
                        name="categories[]"
                        wire:model.blur="form.categories"
                        wire:ignore
                        x-data=
                            "
                                {
                                    select:
                                    new Select(
                                        document.getElementById('categories[]')
                                    )

                                }
                            "
                        x-init=
                            "
                                select.setValue('0');
                            "
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
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                    Upload Post
                </button>

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
            </div>

        </div>
    </form>

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

</div>
