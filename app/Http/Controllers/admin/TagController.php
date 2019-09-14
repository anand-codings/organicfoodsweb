<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::all();
        $data['title'] = 'Tags';
        return view('admin.tag.tags',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_existing_tag = Tag::where('name', $request->name)->first();
        if($check_existing_tag)
        {
            return redirect()->back()->with('error', 'Tag Name Already Exist');
        }
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('success', 'Tag Added Successfully');
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
        $tag = Tag::where('id',$request->attribute_id)->first();
//        dd($cat);
        $tag->name = $request->name;
        $att->save();
        return redirect()->back()->with('success','Tag has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Tag::where('id',$id)->delete())
        {
            return redirect()->back()->with('success','Tag has been deleted successfully.');
        }

    }
}
