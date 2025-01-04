<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5)->all();
        return Inertia::render('Products/index', [
            'products' => $products,
            //'comments' => $this->getComments(),
            'comments'=>Inertia::defer(function () {
                return $this->getComments();
            })
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Products/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        $file = $request->file('image');
        $img_name = $file->getClientOriginalName();
        $file->move(public_path('uploads/img'),$img_name);

         Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $img_name

        ]);

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $id = $product->id;


        if($request->hasFile('image')){
            $file = $request->file('image');
            $img_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/img'),$img_name);

            Product::where('id', $id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $img_name,
            ]);
            $old_image = 'uploads/img/' . $product->image;
            File::delete($old_image);


        }else{
            Product::where('id', $id)->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    //External API
    private function getComments(){
        $response = Http::get('https://jsonplaceholder.typicode.com/comments');
        return $response->json();
    }
}
