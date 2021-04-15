<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $product = Product::with(['product_variant', 'variant_price'])->get();
        $variant = Variant::with('product_varients')->get();
       //dd($product);
        return view('products.index', [
            'product' => $product,
            'variant' => $variant
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search_product(Request $request){
        $title = $request->title;
        $variant = $request->variant;
        $price_from = (int)$request->price_from;
        $price_to = (int)$request->price_to;
        $date = $request->date;
       

        
            $product = Product::where('title', $title)
            ->orWhereHas('product_variant', function($q) use($variant){
                $q->where('variant', $variant);
            })
            ->orWhereHas('variant_price', function($q) use($price_from, $price_to){
                $q->where('price', '>=', $price_from)->where('price', '<=', $price_to);
            })->get();
            $variant = Variant::with('product_varients')->get();
            return view('products.index', [
                'product' => $product,
                'variant' => $variant
            ]);
        
    }
}
