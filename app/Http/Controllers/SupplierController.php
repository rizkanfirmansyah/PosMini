<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Supplier';
        return view('main.master.supplier', compact('title'));
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
        $validated = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $validated->errors()], 500);
        }

        $request->request->add(['created_by' => 'admin']);
        Supplier::create($request->all());
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
            return DataTables::of(Supplier::all())
                ->addColumn('action', function ($product) {
                    $category = '
                    <a class="btn btn-sm btn-danger Delete" data-id="' . $product->id . '"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-sm btn-warning Edit" data-id="' . $product->id . '"><i class="fas fa-edit"></i></a>
                    ';
                    return $category;
                })
                ->rawColumns(['address', 'action'])->make(true);
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
        $supplier = Supplier::find($id);
        $data = [
            'supplier' => $supplier,
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
        $validated = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $validated->errors()], 500);
        }
        $request->request->add(['created_by' => 'admin']);
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
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
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
