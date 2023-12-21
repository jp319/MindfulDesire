@props(['post' => \App\Models\Post::first() ])

@if($post instanceof \App\Models\Post)
    <div class="w-full flex flex-wrap gap-2">
        @forelse($post->categories as $category)
            <div class="flex items-center px-3 py-1.5 leading-none rounded-full text-xs font-medium uppercase text-white inline-block" style="background-color: {{ $category->color }};">
                <span><a href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a></span>
            </div>
        @empty
            <div class="bg-gray-500 flex items-center px-3 py-1.5 leading-none rounded-full text-xs font-medium uppercase text-white inline-block">
                <span><a href="{{ route('categories.show', ['category' => 'uncategorized']) }}">Uncategorized</a></span>
            </div>
        @endforelse
    </div>
@endif
