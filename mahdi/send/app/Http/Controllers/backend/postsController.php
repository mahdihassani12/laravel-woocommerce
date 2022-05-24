<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use App\Tag;
use App\Post;
use Illuminate\Support\Str;
use DB;
class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['p_tab']='post';
        $data["tab"] = 'post';
        $data["page_title"] = trans("labels.posts");
        $data['setting']=$this->getUserSetting(1); 
        return view('backend.posts.index')->with('posts',Post::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_tab']='post';
        $data["tab"] = 'add_post';
        $data["page_title"] = trans("labels.add_post");
        $data['setting']=$this->getUserSetting(1); 

        return view('backend.posts.create')->with('tags',Tag::all())->with('categories',PostCategory::all())->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function uploadDescriptionImage(Request $request){

        $image=$request->image;
        $image_name="null";
         if ($request->hasFile('image')){ 
                $ext = $request->image->getClientOriginalExtension();
                $image_name =date('YmdHis').uniqid().".".$ext; 
                $file = $request->file('image');
                $destinationPath = public_path("uploads/posts/content");
                $file->move($destinationPath, $image_name); 
                //$up_data['feature_image']=$image_name;
            }
            return $image_name;
            
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:tbl_posts',
            'content' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required'
        ]);

        $posts = new Post();
        $data = $request -> all();

        if ($files = $request->file('featured_image')) {
           $destinationPath = 'uploads/posts/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $featured_image = "$profileImage";
        }

        $posts -> title = $data['title'];
        $posts -> except = $data['excerpt'];
        $posts -> slug  = Str::slug($request->title);
        $posts -> content = $data['content'];
        $posts -> user_id = auth()->user()->id ;
        $posts -> featured_image = $featured_image;
        $date = $data['date'];
        $posts -> date = convertDateToGregorian($date);
       // print_r($request->tags);exit();
	 try {
         DB::beginTransaction();
			
        $posts -> save();
        $posts->tags()->attach($request->tags);
        $posts->categories()->attach($request->categories);
        
		DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
         $data['p_tab']='post';
        $data["tab"] = 'post';
        $data["page_title"] = trans("labels.post");
        $data['setting']=$this->getUserSetting(1); 

        return view('backend.posts.show')->with('post',$post)->withData($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['p_tab']='post';
        $data["tab"] = 'post';
        $data["page_title"] = trans("labels.edit_post");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.posts.edit')->with('post',Post::find($id))->with('tags',Tag::all())->with('categories',PostCategory::all())->withData($data);
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

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $posts = Post::find($id);
        $data = $request -> all();

        if ($files = $request->file('featured_image')) {
           $destinationPath = 'uploads/posts/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $featured_image = "$profileImage";
           $posts -> featured_image = $featured_image;

           $photo = Post::find($id)->featured_image;
            if(!is_null($photo) && file_exists(public_path('uploads/posts/'.$photo))){
                unlink(public_path('uploads/posts/'.$photo));
            }
           
        }

        $posts -> title = $data['title'];
        $posts -> except = $data['excerpt'];
        $posts -> slug  = Str::slug($request->title);
        $posts -> content = $data['content'];
        $posts -> user_id = auth()->user()->id ;
        $date = $data['date'];
        $posts -> date = convertDateToGregorian($date);
         try {
         DB::beginTransaction();
		   $posts -> update();
           $posts->tags()->sync($request->tags);
           $posts->categories()->sync($request->categories);
		   
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		
        return redirect('posts');
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
        $post = Post::find($id);
        $post -> delete();
        DB::table('tbl_post_tag')->where('post_id',$id)->delete();
        DB::table('tbl_category_post')->where('post_id',$id)->delete();
        $photo=$post->featured_image;
        if(!is_null($photo) && file_exists(public_path('uploads/posts/'.$photo))){
            unlink(public_path('uploads/posts/'.$photo));
        }
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		
        return redirect('posts');
    }
}



