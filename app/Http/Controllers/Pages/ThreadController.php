<?php

namespace App\Http\Controllers\Pages;

use App\Contracts\ViewsContract;
use App\Models\Tag;
use App\Models\Views;
use App\Models\Thread;
use App\Models\Category;
use App\Jobs\CreateThread;
use App\Jobs\UpdateThread;
use Illuminate\Http\Request;
use App\Policies\ThreadPolicy;
use Illuminate\Container\Container;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\ThreadStoreRequest;
use App\Jobs\SubscribeToSubscriptionAble;
use App\Jobs\UnsubscribeFromSubscriptionAble;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ThreadController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('vi');
        return $this->middleware([Authenticate::class, EnsureEmailIsVerified::class])->except(['index', 'show']);
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        $cacheKey = 'list_thread_' . $page;
        $threads = Cache::get($cacheKey);
        if ($threads != null)
            return $threads;

        $data = Thread::orderBy('id', 'desc')->paginate(10);
        $view = view('pages.threads.index', ['threads' => $data,])->render();
        Cache::set($cacheKey, $view, Carbon::now()->addMinute(10));
        return $view;
    }

    public function create()
    {
        return view('pages.threads.create', [
            'categories'    => Category::all(),
            'tags'          => Tag::all(),
        ]);
    }

    public function store(ThreadStoreRequest $request)
    {
        $this->dispatchSync(CreateThread::fromRequest($request));
        return redirect()->route('threads.index')->with('success', 'Thread created!');
    }

    public function showcate(Category $category)
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        $cacheKey = $category->slug . "_" . $page;
        $view = Cache::get($cacheKey);
        if ($view == null)
            return $view;
        $threads = Thread::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(10);
        $view = view('pages.threads.showcate', compact('threads', 'category'))->render();
        Cache::put($cacheKey, $view, Carbon::now()->addMinute(10));
        return $view;
    }

    public function show(Category $category, Thread $thread)
    {
        $cacheKey = $thread->slug;
        $view = Cache::get($cacheKey);
        if ($view != null)
            return $view;
        $view = view('pages.threads.show', compact('thread', 'category'))->render();
        Cache::put($cacheKey, $view, Carbon::now()->addMinute(10));
        return $view;
    }

    public function edit(Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $oldTags = $thread->tags()->pluck('id')->toArray();
        $selectedCategory = $thread->category;

        return view('pages.threads.edit', [
            'thread'            => $thread,
            'tags'              => Tag::all(),
            'oldTags'           => $oldTags,
            'categories'        => Category::all(),
            'selectedCategory'  => $selectedCategory,
        ]);
    }

    public function update(ThreadStoreRequest $request, Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $this->dispatchSync(UpdateThread::fromRequest($thread, $request));

        return redirect()->route('threads.index')->with('success', 'Thread Updated!');
    }

    public function subscribe(Request $request, Category $category, Thread $thread)
    {
        $this->authorize(ThreadPolicy::SUBSCRIBE, $thread);

        $this->dispatchSync(new SubscribeToSubscriptionAble($request->user(), $thread));

        return redirect()->route('threads.show', [$thread->category->slug(), $thread->slug()])
            ->with('success', 'You have been subscribed to this thread');
    }

    public function unsubscribe(Request $request, Category $category, Thread $thread)
    {
        $this->authorize(ThreadPolicy::UNSUBSCRIBE, $thread);

        $this->dispatchSync(new UnsubscribeFromSubscriptionAble($request->user(), $thread));

        return redirect()->route('threads.show', [$thread->category->slug(), $thread->slug()])
            ->with('success', 'You have been unsubscribed from this thread');
    }
}
