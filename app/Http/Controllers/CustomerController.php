<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Customer';
        return view('main.master.customer', compact('title'));
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
        Customer::create($request->all());
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
            return DataTables::of(Customer::all())
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
        $customer = Customer::find($id);
        $data = [
            'supplier' => $customer,
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
        $customer = Customer::find($id);
        $customer->update($request->all());
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
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
