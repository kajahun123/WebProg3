<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function show(Publisher $publisher)
    {
        $products = $publisher->products()->orderBy('created_at', 'desc')->paginate(8);

        return view('publisher.show')->with(compact('publisher', 'products'));
    }
}
