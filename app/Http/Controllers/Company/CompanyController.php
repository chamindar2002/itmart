<?php

namespace Allison\Http\Controllers\Company;

use Allison\models\Company;
use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\models\Member;
use Illuminate\Support\Facades\Validator;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $companies = Company::all();
        return View('company.create', compact('members', 'companies'));
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
            'members' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('company/create')
                ->withErrors($validator)
                ->withInput();
        }else{

            $company = new Company();
            $company->name = $request->name;
            $company->save();

            $company->members()->attach($request->input('members'));
            //$member->name = $request->name;
            //$member->address = $request->address;

            if ($company->save()) {
                Session::flash('alert-success','Saved Successfully');

                return redirect('company/create');
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
        //
    }
}
