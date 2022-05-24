<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product_Request;
use DB;
class product_requestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['p_tab']='';
        $data["tab"] = 'request';
        $data["page_title"] = trans("labels.requests");
        $data['setting']=$this->getUserSetting(1);
		
        return view('backend.requests.index')->with('requests',Product_Request::orderBy('id', 'DESC')->paginate(10))->withData($data);
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
       $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'product_name' => 'required',
            'address' => 'required'
        ]);

        $reqs = new Product_Request();
        $data = $request->all();

        $reqs -> name = $data['name'];
        $reqs -> phone = $data['phone'];
        $reqs -> email = $data['email'];
        $reqs -> product_name = $data['product_name'];
        $reqs -> address = $data['address'];

        try {
       DB::beginTransaction();  
          $reqs -> save();
       DB::commit();
        $this->CreateMessages('request_sent');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('request_not_sent');
            throw $e;
        }
        
		
        return redirect('product-request');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();  
            $reqs = Product_Request::find($id);
            $reqs -> delete();
            DB::commit();
            $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('requests');
    }
	
	public function changeStatus(Request $request){
		$id=$request->id;
		$status=$request->status;
		$reqs = Product_Request::find($id);
		$reqs->status=$status;
		$reqs->save();
	}
}
