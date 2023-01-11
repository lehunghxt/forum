<div class="p-4">
    <div class="pb-4 mb-4 border-b border-gray-200">
        <h2 class="font-bold uppercase">Tag</h2>
    </div>
    <ul class="flex flex-row">
        @foreach ($tags as $item)
            <li class="p-1 text-xs text-white bg-green-400 rounded m-1"><a href="">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</div>