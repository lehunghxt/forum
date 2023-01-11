<?php
use App\Models\Category;
namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Category extends Component
{
    public function render()
    {
        $cacheKey = 'Sidebar_Category';
        $view = \Illuminate\Support\Facades\Cache::get($cacheKey);
        if($view != null)
            return $view;
        $categories = \App\Models\Category::withCount('threads')->get();
        $view = view('livewire.category', compact('categories'))->render();
        \Illuminate\Support\Facades\Cache::set($cacheKey, $view);
        return $view;
    }
}
