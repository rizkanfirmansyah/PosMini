<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Produk';
        $categories = Category::all();
        return view('main.master.product', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = FacadesValidator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'file' => 'required|mimes:jpg,svg,png',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $validated->errors()], 500);
        }

        if ($request->file('file')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('file')->getClientOriginalName());
            Storage::put($request->file('file'), $filename);
            $request->request->add(['photo' => $filename]);
        }
        $request->request->add(['created_by' => 'admin']);
        $product = Product::create($request->all());
        $product->category()->attach($request->category);
        return response()->json(['message' => 'Data berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        if ($id == null) {
            return DataTables::of(Product::all())
                ->addColumn('category', function ($product) {
                    $category = ' ';
                    foreach ($product->category as $value) {
                        $category .= '<a class="badge badge-primary">' . $value->name . '</a> ';
                    }
                    return $category;
                })
                ->addColumn('action', function ($product) {
                    $category = '
                    <a class="btn btn-sm btn-danger Delete" data-id="' . $product->id . '"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-sm btn-warning Edit" data-id="' . $product->id . '"><i class="fas fa-edit"></i></a>
                    ';
                    return $category;
                })
                ->rawColumns(['description', 'action', 'category'])->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $data = [
            'product' => $product,
            'categories' => $product->category()->get(),
        ];
        return response()->json(['message' => 'Data ditemukan', 'data' => $data], 200);
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
        $validated = FacadesValidator::make($request->all(), [
            'name' => 'required|max:255|unique:products,name,'.$id,
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'file' => 'mimes:jpg,svg,png',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $validated->errors()], 500);
        }
        if ($request->file('file')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('file')->getClientOriginalName());
            Storage::put($request->file('file'), $filename);
            $request->request->add(['photo' => $filename]);
        }
        $request->request->add(['created_by' => 'admin']);
        $product = Product::find($id);
        $product->update($request->all());
        $product->category()->detach();
        $product->category()->attach($request->category);
        return response()->json(['message' => 'Data berhasil diperbaharui'], 200);
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
        $product->category()->detach();
        $product->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
