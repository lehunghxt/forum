<x-guest-layout>
    <main class="grid grid-cols-4 gap-8 mt-8 wrapper">

        <x-partials.sidenav :thread="$thread" />

        <section class="flex flex-col gap-y-4 col-span-12 md:col-span-3">

            <x-alerts.main />

            <small class="text-xs text-gray-400"><a href="/" class="font-bold">Threads</a>>{{ $category->name() }}>{{ $thread->title() }}</small>

            <article class="p-5 bg-white shadow">
                <div class="relative grid grid-cols-8">

                    {{-- Avatar --}}
                    <div class="col-span-1 flex justify-items-center items-center">
                        <x-user.avatar :user="$thread->author()" />
                    </div>

                    {{-- Thread --}}
                    <div class="relative col-span-7 space-y-6">
                        <div class="space-y-3">
                            <h2 class="text-xl tracking-wide hover:text-blue-400">
                                {{ $thread->title() }}
                            </h2>
                            <div class="text-gray-500 text-sm">
                                {!! $thread->body() !!}
                            </div>
                        </div>

                        <div class="flex justify-between">

                            <div class="flex space-x-5 text-gray-500">
                                {{-- Likes --}}
                                <livewire:like-thread :thread="$thread" />

                                {{-- View Count --}}
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                                    <span class="text-xs text-gray-500">{{ views($thread)->count() }}</span>
                                </div>
                            </div>

                            {{-- Date Posted --}}
                            <div class="flex items-center text-xs text-gray-500">
                                <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                Ngày đăng: {{ $thread->created_at->diffForHumans() }}
                            </div>
                        </div>


                    </div>
                    {{-- Edit Button --}}
                    <div class="absolute top-0 right-2">
                        <div class="flex space-x-2">
                            @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                            <x-links.secondary href="{{ route('threads.edit', $thread->slug()) }}">
                                Sửa
                            </x-links.secondary>
                            @endcan

                            @can(App\Policies\ThreadPolicy::DELETE, $thread)
                            <livewire:thread.delete :thread="$thread" :key="$thread->id()" />
                            @endcan
                        </div>
                    </div>
                </div>
            </article>

            {{-- Replies --}}
            <div class="mt-6 space-y-5">
                <h2 class="mb-0 text-sm font-bold uppercase">Trả lời</h2>
                <hr>
                @foreach($thread->replies() as $reply)
                    <livewire:reply.update :reply="$reply" :wire:key="$reply->id()" />
                @endforeach
            </div>

            @auth
            <div class="p-5 space-y-4 bg-white shadow">
                <h2 class="text-gray-500">Gửi một trả lời</h2>
                <x-form action="{{ route('replies.store') }}">
                    <div>
                        <input type="text" name="body" class="w-full bg-gray-200 border-none shadow-inner rounded focus:ring-blue-400" autocomplete="off"/>
                        <x-form.error for="body" />

                        <input type="hidden" name="replyable_id" value="{{ $thread->id() }}">
                        <x-form.error for="replyable_id" />
                        <input type="hidden" name="replyable_type" value="threads">
                        <x-form.error for="replyable_type" />

                    </div>

                    <div class="grid mt-4">
                        {{-- Button --}}
                        <x-buttons.primary class="justify-self-end">
                            {{ __('Post') }}
                        </x-buttons.primary>
                    </div>
                </x-form>
            </div>
            @else
            <div class="flex justify-between p-4 text-gray-700 bg-blue-200 rounded">
                <h2>Vui lòng đăng nhập để để lại bình luận</h2>
                <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
            @endauth
        </section>
    </main>
</x-guest-layout>
