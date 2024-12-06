<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ColorController extends Controller
{
    protected $color;
    public function __construct( Color $color )
    {
        $this->color = $color;
    }

    public function index(): View
    {
        $data['type'] = 'Colors List';
        $data['colors'] = $this->color->latest()->get();
        return view('admin.color.index',$data);
    }

    public function create(): View
    {
        $data['type'] = 'Add Color';
        return view('admin.color.create',$data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:colors|max:50',
            'code' => 'required|unique:colors|max:10',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $color = new Color();
        $this->saveColorData($color,$request);

        $alert = ['success', 'color created successfully'];
        return redirect()->route('admin.colors.list')->withAlert($alert);
    }

    public function edit($id):View|RedirectResponse
    {
        $data['type'] = 'Update Color';
        $data['color'] = $this->color->findOrFail($id);

        if( $data['color'] ){
            return view('admin.color.edit', $data);
        }

        $alert = ['danger', 'Something went wrong'];
        return redirect()->back()->withAlert($alert);
    }

    public function update(Request $request, $id) :RedirectResponse
    {
       $validation = Validator::make($request->all(), [
           'name' => 'required|max:50|unique:colors,name,'.$id,
           'code' => 'required|max:10|unique:colors,code,'.$id,
       ]);

       if ($validation->fails()) {
           return redirect()->back()->withErrors($validation)->withInput();
       }

        try {
           $color = Color::findOrFail($id);
           $this->saveColorData($color,$request);

           $alert = ['success', 'color updated successfully'];
           return redirect()->route('admin.colors.list')->withAlert($alert);

        }catch (\Exception $exception){
           $alert = ['danger', 'Something went wrong'];
           return redirect()->back()->withAlert($alert);
        }

    }

    private function saveColorData(Color $color,Request $request):void
    {
        $color->name = $request->input('name');
        $color->code = $request->input('code');
        $color->status = $request->input('status')??0;
        $color->save();
    }
}
