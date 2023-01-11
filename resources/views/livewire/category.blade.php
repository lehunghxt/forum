<div class="p-4">
    <div class="pb-4 mb-4 border-b border-gray-200">
        <h2 class="font-bold uppercase">Thể loại</h2>
    </div>
    <ul class="space-y-4">
        @foreach ($categories as $item)
            <li>
                <a href="{{ route('threads.showcate', $item->slug()) }}" class="flex items-center justify-between">
                    {{$item->name}}
                    <span class="px-2 text-white bg-green-300 rounded">{{ $item->threads_count }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>