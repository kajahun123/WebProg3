<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function show(Type $type)
    {
        $products = $type->products()->orderBy('created_at', 'desc')->paginate(8);

        return view('type.show')->with(compact('type', 'products'));
    }
}
