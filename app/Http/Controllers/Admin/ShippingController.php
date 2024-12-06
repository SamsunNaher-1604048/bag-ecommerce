<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\shipping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ShippingController extends Controller
{
    protected  $shipping;
    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    public function index(): View
    {
        $data['type'] = "Shipping List";
        $data['shipments'] = $this->shipping->all();
        return view('admin.shipping.index',$data);
    }

    public function create(): View
    {
        $data['type'] = "Add New Shipping";
        return view('admin.shipping.create',$data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|unique:shippings',
            'price'=>'required',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $shipping = new shipping();
        $this->storeOrUpdate($shipping,$request);

        $alert = ['success','Shipping added successfully.'];
        return redirect()->route('admin.shipping.list')->withAlert($alert);

    }

    public function edit( $id ): View
    {
        $data['type'] = "Edit Shipping";
        $data['shipping'] = $this->shipping->findOrFail($id);

        if($data['shipping']){
            return view('admin.shipping.edit', $data);
        }
        $alert = ['danger','Something went wrong.'];
        return redirect()->route('admin.shipping.list')->withAlert($alert);
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required|unique:shippings,name,'.$id,
            'price'=>'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        try{
            $supplier = $this->shipping->findOrFail($id);
            $this->storeOrUpdate($supplier,$request);

            $alert = ['success','Supplier updated successfully.'];
            return redirect()->route('admin.shipping.list')->withAlert($alert);
        }catch (\Exception $e){
            $alert = ['danger','Something went wrong.'];
            return redirect()->back()->withAlert($alert);
        }
    }

    public function storeOrUpdate($shipping,$request):void
    {
        $shipping->name = $request->input('name');
        $shipping->price = $request->input('price');
        $shipping->status = $request->input('status')??0;
        $shipping->save();
    }


}
