<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(request()->ajax()){
            $query = Category::query();

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                    <a href="'. route('dashboard.category.edit', $item->id) .'" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 mr-2 md:my-4 rounded shadow-lg">
                        Edit
                    </a>


                    <form class="inline-block" action="'. route('dashboard.category.destroy',$item->id) .'" method="POST">
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
        return view('pages.dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.category.create');
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
            'nama' => 'required'
        ]);

        $category = Category::create($request->all());

        return redirect()->route('dashboard.category.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages.dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $category->update($request->all());

        return redirect()->route('dashboard.category.index')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
