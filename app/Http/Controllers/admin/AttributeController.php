<?php

namespace App\Http\Controllers\admin;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['attributes'] = Attribute::all();
        $data['title'] = 'Attributes';
        return view('admin.attribute.attributes',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_existing_att = Attribute::where('name', $request->name)->first();
        if($check_existing_att)
        {
            return redirect()->back()->with('error', 'Attribute Already Exist');
        }
        $att = new Attribute();
        $att->name = $request->name;
        $att->value = $request->value;
        $att->save();
        return redirect()->back()->with('success', 'Attribute Added Successfully');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $att = Attribute::where('id',$request->attribute_id)->first();
//        dd($cat);
        $att->name = $request->name;
        $att->value = $request->value;
        $att->save();
        return redirect()->back()->with('success','Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            if (Attribute::where('id',$id)->delete())
            {
                return redirect()->back()->with('success','Attribute has been deleted successfully.');
            }

    }
}
