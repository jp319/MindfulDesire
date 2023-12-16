<x-guest-layout class="bg-gray-200/50">

    <x-header />

    <section class="px-2 py-32 bg-transparent md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                            <span class="block xl:inline">Unlock Sexual</span>
                            <span class="block text-logo-blue xl:inline" data-primary="logo-blue">Wellness Wisdom!</span>
                        </h1>
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">Explore the essentials of sexual health effortlessly. Empower your journey to a healthier you with concise, insightful guidance on hygiene and well-being.</p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                            <a href="{{ route('blog') }}" class="relative inline-flex items-center justify-center p-4 px-6 py-3 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-indigo-500 rounded-full shadow-md group">
                                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-indigo-500 group-active:bg-indigo-700 group-active:translate-x-full group-hover:translate-x-0 ease rounded-full">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </span>
                                <span class="absolute flex items-center justify-center w-full h-full text-indigo-500 transition-all duration-300 transform group-hover:translate-x-full ease">Try Reading Now</span>
                                <span class="relative invisible">Try Reading Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl" data-rounded="rounded-xl" data-rounded-max="rounded-full">
                        <img src="{{ asset('storage/mindful-desire/hero-image.jpg') }}" alt="Book and coffee">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 bg-transparent relative">

        <div class="px-10 py-24 mx-auto max-w-7xl">
            <div class="w-full mx-auto text-left md:text-center">
                <h1 class="mb-6 text-5xl font-extrabold leading-none max-w-5xl mx-auto tracking-normal text-gray-900 sm:text-6xl md:text-6xl lg:text-7xl md:tracking-tight"> MindfulDesire: <span class="w-full text-transparent bg-clip-text bg-gradient-to-r from-logo-orange via-blue-500 to-logo-blue lg:inline">Nourishing Your Journey</span> to Wellness. </h1>
                <p class="px-0 mb-6 text-lg text-gray-600 md:text-xl lg:px-24"> Craft and share your health story effortlessly with MindfulDesire. Explore, customize, and embody well-being. Your journey, your way. </p>
            </div>
        </div>
    </section>

    <x-footer />

</x-guest-layout>
