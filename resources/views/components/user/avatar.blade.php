@isset($user)
<a href="{{ route('profile', $user) }}" class="flex flex-col items-center text-sm text-center transition border-2 border-transparent rounded-full focus:outline-none">
    <img {{ $attributes->merge(['class' => 'object-cover rounded-full w-8 h-8 md:w-10 md:h-10' ]) }} src="{{ $user->profile_photo_url }}" alt="{{ $user->name() }}" />
    {{-- <span class="mt-2 text-xs text-gray-500">{{ $user->name() }}</span> --}}
</a>
@else
<span class="inline-flex rounded-md">
    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
        {{ Auth::user()->name() }}
    </button>
</span>
@endisset
