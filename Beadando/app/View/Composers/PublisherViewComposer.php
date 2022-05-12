<?php

namespace App\View\Composers;

use App\Models\Publisher;
use Illuminate\View\View;

class PublisherViewComposer
{
    public function compose(View $view)
    {
        $publishers = Publisher::orderBy('name')->get();
        $view->with('publishers', $publishers);
    }
}