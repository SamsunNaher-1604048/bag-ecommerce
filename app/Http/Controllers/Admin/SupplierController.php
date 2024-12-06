<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SupplierController extends Controller
{
    protected $supplier;
    public function __construct( Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index():View
    {
        $data['type'] = 'Supplier List';
        $data['suppliers'] = $this->supplier->all();
        return view('admin.supplier.index', $data);
    }

    public function create():View
    {
        $data['type'] = 'Create Supplier';
        return view('admin.supplier.create', $data);
    }

    public function store(Request $request):RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:suppliers',
            'email' => 'required|unique:suppliers',
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $supplier = new Supplier();
        $this->storeOrUpdate($supplier,$request);

        $alert = ['success','Supplier added successfully.'];
        return redirect()->route('admin.suppliers.list')->withAlert($alert);

    }

    public function edit($id):View|RedirectResponse
    {
        $data['type'] = 'Edit Supplier';
        $data['supplier'] = $this->supplier->find($id);

        if($data['supplier']){
            return view('admin.supplier.edit', $data);
        }
        $alert = ['danger','Something went wrong.'];
        return redirect()->route('admin.suppliers.list')->withAlert($alert);
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone,'.$id,
            'email' => 'required|unique:suppliers,email,'.$id,
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        try{

            $supplier = $this->supplier->findOrFail($id);
            $this->storeOrUpdate($supplier,$request);

            $alert = ['success','Supplier updated successfully.'];
            return redirect()->route('admin.suppliers.list')->withAlert($alert);
        }catch (\Exception $e){
            $alert = ['danger','Something went wrong.'];
            return redirect()->back()->withAlert($alert);
        }
    }

    protected function storeOrUpdate(Supplier $supplier, Request $request):void
    {
        $supplier->name = $request->input('name');
        $supplier->phone  = $request->input('phone');
        $supplier->email = $request->input('email');
        $supplier->address  = $request->input('address');
        $supplier->save();
    }

}
