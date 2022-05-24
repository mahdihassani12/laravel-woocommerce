<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\ProductUnit;
use Illuminate\Http\Request;
use DB; 
class productUnitController extends Controller
{
     public function index()
    {
        $data['p_tab']='product';
        $data["tab"] = 'punit';
        $data["page_title"] = trans("labels.units");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.product_unit.index')->with('unit',ProductUnit::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }
	
	
	 public function create()
    {
        $data['p_tab']='product';
        $data["tab"] = 'punit';
        $data["page_title"] = trans("labels.add_unit");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.product_unit.create')->withData($data);
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
      try {
        DB::beginTransaction();
       
	   $unit = new ProductUnit();
        $data = $request -> all();
        $unit -> name = $data['name'];
        $unit -> save();
       
		   DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('units');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $data['p_tab']='product';
        $data["tab"] = 'punit';
        $data["page_title"] = trans("labels.edit_unit");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.product_unit.edit')->with('unit',ProductUnit::find($id))->withData($data);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        try {
        DB::beginTransaction();  
			$unit = ProductUnit::find($id);
			$data = $request -> all();
			$unit -> name = $data['name'];
			$unit -> save();
        DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('units');
    }

   
    public function deleteUnit($id)
    {
	   try {
        DB::beginTransaction(); 
		
        $unit = ProductUnit::find($id);
        $unit -> delete();

        DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('units');
    }
}
