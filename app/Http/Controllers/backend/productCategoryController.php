<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;
use DB;
class productCategoryController extends Controller
{
     public function index()
    {
        $data['p_tab']='product';
        $data["tab"] = 'pcategory';
        $data["page_title"] = trans("labels.categories");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.product_category.index')->with('category',ProductCategory::orderBy('id', 'DESC')->where('parent_id',null)->paginate(10))->with('parents',ProductCategory::all()->where('parent_parent_id',null))->withData($data);
    }
	
	
	 public function create()
    { 
        return view('backend.product_category.create')->with('parents',ProductCategory::all()->where('parent_parent_id',null));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
      try {
        DB::beginTransaction();
       
	   $pcategory = new ProductCategory();
        $data = $request -> all();
        $pcategory->name = $data['name'];

        $pcategory->parent_id = $data['parent_id'];

      if($data['parent_id']!=""){
           $parentParent=ProductCategory::findOrFail($data['parent_id'])->parent_id;
           if($parentParent){
              $pcategory->parent_parent_id = $parentParent;
           }
        }
       // print_r($parentParent);exit();
        
        if ($files = $request->file('photo')) {
           $destinationPath = 'public/uploads/product_category/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $pcategory->photo = $profileImage;
        }

        $pcategory -> save();
       
		   DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('product_categories');
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
        $data["tab"] = 'pcategory';
        $data["page_title"] = trans("labels.categories");
        $data['setting']=$this->getUserSetting(1);

		 $data['parents']=ProductCategory::all();//->where('parent_id',null);
		 $data['category']=ProductCategory::find($id);
        return view('backend.product_category.edit')->withData($data);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        try {
        DB::beginTransaction();  
			$cat = ProductCategory::find($id);
			$data = $request -> all();
			$cat -> name = $data['name'];
			$cat -> parent_id = $data['parent_id'];

            if($data['parent_id']!=""){
            $parentParent=ProductCategory::findOrFail($data['parent_id'])->parent_id;
            if($parentParent){
               $cat->parent_parent_id = $parentParent;
               }
            }


       if ($files = $request->file('photo')) {
           $destinationPath = 'public/uploads/product_category/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $cat->photo = $profileImage;
        }
        

			$cat -> save();
        DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('product_categories');
    }

   
    public function deleteProductCategory($id)
    {

	   try {
        DB::beginTransaction(); 
		
        $pcat = ProductCategory::find($id);
        $pcat -> delete();

        DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('product_categories');
    }
}
