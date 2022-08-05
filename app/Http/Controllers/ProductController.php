<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $query = Product::query();

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                    <a href="'. route('dashboard.product.gallery.index', $item->id) .'" class="bg-purple-400 hover:bg-purple-500 text-white font-bold py-1 px-3 mr-2 md:my-4 rounded shadow-lg">
                        Gallery
                    </a>
                    <a href="'. route('dashboard.product.edit', $item->id) .'" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 mr-2 md:my-4 rounded shadow-lg">
                        Edit
                    </a>


                    <form class="inline-block" action="'. route('dashboard.product.destroy',$item->id) .'" method="POST">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 mr-2 md:my-4 rounded shadow-lg"> Hapus
                    </button>
                    '. method_field('delete'). csrf_field() .'
                    </form>
                    
                ';
            })
            ->editColumn('price', function($item){
                return number_format($item->price);
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard.product.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = New Product;
        $product->name = $request->nama;
        $product->slug = Str::slug($request->nama);
        $product->description = $request->deskripsi;
        $product->price = $request->harga;
        $product->category_id = $request->kategori;
        $product->stocks = $request->stok;
        $product->save();


        return redirect()->route('dashboard.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.dashboard.product.edit', compact(['product','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->name = $request->nama;
        $product->slug = Str::slug($request->nama);
        $product->description = $request->deskripsi;
        $product->price = $request->harga;
        $product->category_id = $request->kategori;
        $product->stocks = $request->stok;
        $product->update();
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard.product.index');
    }
}
