<?php

namespace App\View\Composers;

use App\Models\Type;
use Illuminate\View\View;

class TypeViewComposer
{
    public function compose(View $view)
    {
        $types = Type::orderBy('name')->get();
        $view->with('types', $types);
    }
}