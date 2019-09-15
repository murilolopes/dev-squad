<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \App\Product::latest()->paginate(10);
  
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::get()->all('name', 'id');
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|max:64',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $product = \App\Product::create($request->all());
        if ($request->file('photo'))
            $product->addMediaFromRequest('photo')->toMediaCollection('product_photos');

        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = \App\Product::findOrFail($id);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = \App\Category::get()->all('name', 'id');
        $product = \App\Product::findOrFail($id);

        return view('products.edit',compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);

        $request->validate([
            'name' => ['required', Rule::unique('products')->ignore($product->id), 'max:64'],
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);
        
        if ($request->file('photo')) {
            if (count($product->media)) $product->media[0]->delete();
            $product->addMediaFromRequest('photo')->toMediaCollection('product_photos');
        }

  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Product::findOrFail($id);
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
