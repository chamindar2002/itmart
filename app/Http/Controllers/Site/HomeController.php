<?php

namespace Allison\Http\Controllers\Site;

use Illuminate\Http\Request;
use Allison\Http\Controllers\Controller;


//use App;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('site.index');
    }

    public function apiTest(Request $request)
    {
        $response = $request->all();

        //$response = $jmu->getJson(141);
//        App::bind('JsonMediaUtils',function(){
//            
//        });
        dd($response);
    }

    public function acl_test()
    {
        return View('site.acl');
    }
}
