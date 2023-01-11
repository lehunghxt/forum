<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tag extends Component
{
    public function render()
    {
        $cacheKey = 'Sidebar_Tag';
        $view = \Illuminate\Support\Facades\Cache::get($cacheKey);
        if($view != null) 
            return $view;
        $tags = \App\Models\Tag::get();
        $view = view('livewire.tag', compact('tags'))->render();
        \Illuminate\Support\Facades\Cache::set($cacheKey, $view);
        return $view;
    }
}
