<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use DB;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='page';
        $data["tab"] = 'contactus';
        $data["page_title"] = trans("labels.contact_us");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.contact.index')->with('contact',Contact::orderBy('id', 'ASC')->paginate(1))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.contact.create');
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
            'phone' => 'required',
            'phone2' => 'required',
            'email' => 'required',
            'email2' => 'required',
            'address' => 'required'
        ]);

        $contact = new Contact();
        $data = $request -> all();

        $contact -> phone = $data['phone'];
        $contact -> phone2 = $data['phone2'];
        $contact -> email = $data['email'];
        $contact -> email2 = $data['email2'];
        $contact -> address = $data['address'];
        try {
            DB::beginTransaction(); 
            $contact -> save();
            DB::commit();
            $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('contact');

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
        $data['p_tab']='page';
        $data["tab"] = 'contactus';
        $data["page_title"] = trans("labels.contact_us");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.contact.edit')->with('contact',Contact::find($id))->withData($data);
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
            'phone' => 'required',
            'phone2' => 'required',
            'email' => 'required',
            'email2' => 'required',
            'address' => 'required'
        ]);

        $contact =Contact::find($id);
        $data = $request -> all();

        $contact -> phone = $data['phone'];
        $contact -> phone2 = $data['phone2'];
        $contact -> email = $data['email'];
        $contact -> email2 = $data['email2'];
        $contact -> address = $data['address'];
        try {
            DB::beginTransaction(); 
            $contact -> update();
            DB::commit();
            $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
