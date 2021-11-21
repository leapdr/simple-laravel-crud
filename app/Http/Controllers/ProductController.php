<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use View;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function products(){
        return View::make('products.index')->with([
            'categories' => $this->getDistinctCategories(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check for pagination item limit
        $limit = $request->query('limit') ?: 15;

        $products = Product::orderBy('datetime', 'desc')->paginate($limit);

        return ProductResource::collection($products)
            ->additional(['categories' => $this->getDistinctCategories()]);
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
            'name'          => 'required|unique:products|max:50',
            'category'      => 'required|max:20',
            'description'   => 'required|max:2500',
        ]);

        $product = new Product;

        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->description = $request->input('description');
        
        $product->datetime = Carbon::parse($request->input('datetime'))->format('Y-m-d H:i:s');

        if( $product->save() ){
            return new ProductResource($product);
        } else {
            return response([
                'message' => 'Product creation failed',
            ], 202);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return new ProductResource($product);
        } else {
            return response([
                'message' => 'Product not found'
            ], 404);
        }
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
        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->description = $request->input('description');
        
        $product->datetime = Carbon::parse($request->input('datetime'))->format('Y-m-d H:i:s');

        if( $product->save() ){
            return new ProductResource($product);
        } else {
            return response([
                'message' => 'Product update failed',
            ], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if( $product ){
            $product->delete();
            return new ProductResource($product);
        } else {
            return response([
                'message' => 'Product not found'
            ], 404);
        }
    }

    /**
     * Search for a name or part of description
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        $products = Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orderBy('datetime', 'desc')
            ->paginate(15);
        return ProductResource::collection($products)
            ->additional(['categories' => $this->getDistinctCategories()]);
    }

    /**
     * Search for a name.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function filter($category)
    {
        $products = Product::where('category', $category)
            ->orderBy('datetime', 'desc')
            ->paginate(15);
        return ProductResource::collection($products)
            ->additional(['categories' => $this->getDistinctCategories()]);
    }

    /** 
     * Edit Form
     */
    public function edit($id){
        $product = Product::find($id);

        return View::make('products.form')->with([
            'product'   => $product,
            'type'      => 'edit',
            'nav_page'  => 'products',
        ]);
    }

    /** 
     * Search Page
     */
    public function searchPage($keyword){
        return View::make('products.index')->with([
            'search'    => $keyword,
            'nav_page'  => 'products',
        ]);
    }

    /** 
     * Search Page
     */
    public function filterPage($category){
        return View::make('products.index')->with([
            'filter'        => $category,
            'nav_page'      => 'products',
            'categories'    => $this->getDistinctCategories()
        ]);
    }

    private function getDistinctCategories(){
        $categories = DB::table('products')->distinct('category')->get();

        if( $categories ){
            $distinctCategories = $categories->pluck('category')->toArray();
            return $distinctCategories;
        } else {
            return [];
        }
    }

    public function validateCatDesc(Request $request){
        $request->validate([
            'category'      => 'required|max:20',
            'description'   => 'required|max:2500|min:10',
        ]);

        return response([
            'message' => 'Product details has been validated.',
        ], 200);
    }

    public function validateNameCatDesc(Request $request){
        $request->validate([
            'name'          => 'required|unique:products|max:50|min:5',
            'category'      => 'required|max:20',
            'description'   => 'required|max:2500|min:10',
        ]);

        return response([
            'message' => 'Product details has been validated.',
        ], 200);
    }

    public function validateDatetime(Request $request){
        $request->validate([
            'datetime'          => 'required|date',
        ]);

        return response([
            'message' => 'Product details has been validated.',
        ], 200);
    }
}
