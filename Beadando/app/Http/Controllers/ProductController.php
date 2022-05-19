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
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }


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
       

        $types = Type::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('product.edit')->with(compact('product', 'types','publishers'));
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
        

        $product->update($request->except('_token'));

        $image = $this->uploadImage($request);

        if ($image) {
            

            $post->cover = $image->basename;
            $product->save();
        }

        return redirect()
            ->route('product.edit', $product)
            ->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('home', $product)
            ->with('success', __('Product deleted succesfully'));
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

    public function buy(Product $product)
    {
        $this->authorize('shop', $product);
        $product->delete();
        return redirect()
            ->route('home', $product)
            ->with('success', __('Product bought succesfully'));
    }

    protected function resourceAbilityMap()
    {
        $abilityMap = parent::resourceAbilityMap();

        $abilityMap['comment'] = 'create';
        return $abilityMap;
    }
}
