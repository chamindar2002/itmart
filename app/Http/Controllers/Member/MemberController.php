<?php

namespace Allison\Http\Controllers\Member;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

use Validator;
use Allison\models\Member;
use Session;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return View('member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('member/create')
                ->withErrors($validator)
                ->withInput();
        }else{

            $member = new Member();
            $member->name = $request->name;
            $member->address = $request->address;

            if ($member->save()) {
                Session::flash('alert-success','Saved Successfully');

                return redirect('member/');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return View('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        return View('member.edit', compact('member'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('member/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }else{

            $member = Member::find($id);
            $member->name = $request->name;
            $member->address = $request->address;

            if ($member->save()) {
                Session::flash('alert-success','Saved Successfully');

                return redirect('member/');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect('member/');
    }
}
