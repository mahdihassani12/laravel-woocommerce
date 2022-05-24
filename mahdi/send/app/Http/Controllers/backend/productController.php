<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;
use App\ProductUnit;
use App\Product;
use DB;
class productController extends Controller
{
     public function index()
    {
        $data['p_tab']='product';
        $data["tab"] = 'product';
        $data["page_title"] = trans("labels.products");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.product.index')->with('products',Product::fetchProducts())->withData($data);
    }
	
	
	 public function create()
    { 
         $data['p_tab']='product';
        $data["tab"] = 'add_product';
        $data["page_title"] = trans("labels.add_product");
        $data['setting']=$this->getUserSetting(1);
        $data['category']=ProductCategory::all();
        $data['unit']=ProductUnit::all();
        return view('backend.product.create')->withData($data);
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'product_code' => 'required',
            'long_desc' => 'required',
            'featured_image' => 'required',
            'guide_file' => 'mimes:pdf,docs,rar,zip,doc,pptx|max:10240'
        ]);
      try {
        DB::beginTransaction();
       
	   $product = new Product();
        $data = $request -> all();
        $product->name = $data['name'];
        $product->product_code = $data['product_code'];
        $product->long_desc = $data['long_desc'];
        $product->short_desc = $data['short_desc'];
        $product->price = $data['price'];
        $product->old_price = $data['old_price'];
        $product->qty = $data['qty'];
        $product->category_id = $data['category'];
        $product->unit_id = $data['unit'];
        $product->feature_image = 'no_image.jpg';


        
          if ($request->hasFile('featured_image')){ 
            $ext = $request->featured_image->getClientOriginalExtension();
            $image_name = uniqid().".".$ext; 
            $file = $request->file('featured_image');
            $destinationPath = public_path("uploads/products");
            $file->move($destinationPath, $image_name); 
            $photo=$image_name;
            $product->feature_image=$photo;
          }
          
         if ($request->hasFile('guide_file')){ 
            $ext = $request->guide_file->getClientOriginalExtension();
            $file_name = uniqid().".".$ext; 
            $file = $request->file('guide_file');
            $destinationPath = public_path("uploads/guide");
            $file->move($destinationPath, $file_name); 
            $product->guide_file=$file_name;
          }


         $morePrice=$request->mprice;
         $moreQty=$request->mqty;

         $morePriceData='';
         if(isset($morePrice)){
             for($i=0; $i<count($morePrice); $i++){
               if($morePrice[$i]){ 
                 $morePriceData.=$morePrice[$i].":".$moreQty[$i].",";
                 }
             }
           $morePriceData=substr($morePriceData, 0, -1);  
          $product->more_price= $morePriceData;
            
         }
         
         $galleryData='';
         if ($request->hasFile('gallery')){ 
                foreach($request->gallery as $files):
                $ext = $files->getClientOriginalExtension();
                $gallery = uniqid().date('His').".".$ext; 
                $file = $files;
                $destinationPath = public_path("uploads/gallery");
                $file->move($destinationPath, $gallery);
                $galleryData.=$gallery.'|';
               endforeach; 
               $product->gallery = substr($galleryData, 0, -1); 
            }

        $product -> save();
       
		   DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('products');
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
        $data["tab"] = 'product';
        $data["page_title"] = trans("labels.add_product");
        $data['setting']=$this->getUserSetting(1);
        $data['category']=ProductCategory::all();
        $data['unit']=ProductUnit::all();

		 
		 $data['product']=Product::find($id);
        return view('backend.product.edit')->withData($data);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'product_code' => 'required',
            'long_desc' => 'required',
           // 'featured_image' => 'required',
            'guide_file' => 'mimes:pdf,docs,rar,zip,doc,pptx|max:10240'
        ]);
      try {
        DB::beginTransaction();
       $oldProduct = Product::find($id);
        $product = Product::find($id);
        $data = $request -> all();
        $product->name = $data['name'];
        $product->product_code = $data['product_code'];
        $product->long_desc = $data['long_desc'];
        $product->short_desc = $data['short_desc'];
        $product->price = $data['price'];
        $product->old_price = $data['old_price'];
        $product->qty = $data['qty'];
        $product->category_id = $data['category'];
        $product->unit_id = $data['unit'];
        $product->feature_image = 'no_image.jpg';


          

        if ($request->hasFile('featured_image')){ 
            $ext = $request->featured_image->getClientOriginalExtension();
            $image_name = uniqid().".".$ext; 
            $file = $request->file('featured_image');
            $destinationPath = public_path("uploads/products");
            $file->move($destinationPath, $image_name); 
            $photo=$image_name;
            $product->feature_image=$photo;

            $oldPhoto = $oldProduct->feature_image;
            if(!is_null($oldPhoto) && file_exists(public_path('uploads/products/'.$oldPhoto))){
                unlink(public_path('uploads/products/'.$oldPhoto));
            }

          }
          
         if ($request->hasFile('guide_file')){ 
            $ext = $request->guide_file->getClientOriginalExtension();
            $file_name = uniqid().".".$ext; 
            $file = $request->file('guide_file');
            $destinationPath = public_path("uploads/guide");
            $file->move($destinationPath, $file_name); 
            $product->guide_file=$file_name;

             $oldFile = $oldProduct->guide_file;
            if(!is_null($oldFile) && file_exists(public_path('uploads/guide/'.$oldFile))){
                unlink(public_path('uploads/guide/'.$oldFile));
            }
          }


         $morePrice=$request->mprice;
         $moreQty=$request->mqty;

         $morePriceData='';
         if(isset($morePrice)){
             for($i=0; $i<count($morePrice); $i++){
               if($morePrice[$i]){ 
                 $morePriceData.=$morePrice[$i].":".$moreQty[$i].",";
                 }
             }
           $morePriceData=substr($morePriceData, 0, -1);  
          $product->more_price= $morePriceData;
            
         }
         
         $galleryData=$oldProduct->gallery.'|';
         if ($request->hasFile('gallery')){ 
                foreach($request->gallery as $files):
                $ext = $files->getClientOriginalExtension();
                $gallery = uniqid().date('His').".".$ext; 
                $file = $files;
                $destinationPath = public_path("uploads/gallery");
                $file->move($destinationPath, $gallery);
                $galleryData.=$gallery.'|';
               endforeach; 
               $product->gallery = substr($galleryData, 0, -1); 
            }

        $product -> save();
       
       DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('products');
    }

   
    public function deleteProduct($id)
    {
	   try {
        DB::beginTransaction(); 
		
        $product = product::find($id);
        $feature_image=$product->feature_image;
        $file=$product->guide_file;
        $gallery=explode("|", $product->gallery);

        if(!is_null($file) && file_exists(public_path('uploads/guide/'.$file))){
             unlink(public_path('uploads/guide/'.$file));
          }

        if(!is_null($feature_image) && file_exists(public_path('uploads/products/'.$feature_image))){
            unlink(public_path('uploads/products/'.$feature_image));
          }
         foreach ($gallery as $gl) {
          if(!is_null($gl) && file_exists(public_path('uploads/gallery/'.$gl))){
            unlink(public_path('uploads/gallery/'.$gl));
             }  
          }       

        $product -> delete();

         
            

        DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('products');
    }

    public function deleteGalleryPhoto(Request $req){
      $img=$req->image;
      $id=$req->pid;

      $gallery=DB::table('tbl_products')->where('id',$id)->first()->gallery; 
      $gallery=explode("|", $gallery);
      $output='';   
       foreach ($gallery as $gl) {
         if($gl!=$img){
           $output.=$gl.'|';
         }
       }
        $output = substr($output, 0, -1);
        
        if(!is_null($img) && file_exists(public_path('uploads/gallery/'.$img))){
                unlink(public_path('uploads/gallery/'.$img));
          }

          return DB::table('tbl_products')->where('id',$id)->update(['gallery'=>$output]);

    }
}
