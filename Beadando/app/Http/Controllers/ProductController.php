<?php

namespace App\Http\Controllers;

use Image;
use Auth;
use App\Models\Product;
use App\Models\Type;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ProductRequest;
use App\Models\Comment;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        return view('product.create')->with(['types' => $types, 'publishers' => $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Auth::user()->products()->create($request->except('_token'));
        $image = $this->uploadImage($request);

        if($image){
            $product->cover = $image->basename;
            $product->save();
        }
        
        return redirect()->route('product.details',$product)->with('success',__('Product saved succesfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($product->author != Auth::user()) {
            return abort(403);
        }

        $types = Type::orderBy('name')->get();

        return view('product.edit')->with(compact('product', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($product->author != Auth::user()) {
            return abort(403);
        }

        $product->update($request->except('_token'));

        $image = $this->uploadImage($request);

        if ($image) {
            

            $post->cover = $image->basename;
            $product->save();
        }

        return redirect()
            ->route('product.edit', $product)
            ->with('success', __('Post updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function uploadImage(Request $request)
    {
        $file = $request->file('cover');

        if (!$file) {
            return;
        }

        $fileName = uniqid();
        $cover = Image::make($file)->save(public_path("upload/products/{$fileName}.{$file->extension()}"));

        return $cover;
    }

    public function comment(Product $product, Request $request){
        $request->validate([
            'comment'=>'required|min:10',
        ]);

        $comment = new Comment;
        $comment->message = $request->comment;
        $comment->user()->associate(Auth::user());
        
       $product->comments()->save($comment);

       $url = route('product.details', $product) . "#comment-{$comment->id}";

       return redirect($url)->with('success', __('Comment saved successfully'));
    }
}