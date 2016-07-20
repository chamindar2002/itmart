<?php

namespace Allison\Http\Controllers\Products;

use Allison\models\ProductsMedia;
use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

#temp
use Input;
//use Validator;
use Redirect;
use Session;
use Image;
use URL;
use Response;
use File;

use Event;

class ProductsController extends Controller
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
        return view('productsmedia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function upload(Request $request){

        //dd($request);
        $file = array('media_file'=> $request->file('media_file'));

        $media_config = Config('facebook.MEDIA_IMAGES');

        //var_dump(Input::all());exit;

        //var_dump($file);exit;

        if(ProductsMedia::validate($file)->fails()){

            if($request->ajax()){
                //dd(AdMedia::validate($file)->errors()->all()[0]);
                //sleep(5);
                return ['status'=>'error', 'message'=> ['error_message'=>ProductsMedia::validate($file)->errors()->all()[0]], 'error_code'=> null,'data' => null];

            }

            return Redirect::to('media/create')->withInput()->withErrors(ProductsMedia::validate($file));

        }else{


            if($request->hasFile('media_file')){

                #no problems uploading
                if($request->file('media_file')->isValid()){

                    $file_size = $request->file('media_file')->getSize();
                    $extension = Input::file('media_file')->getClientOriginalExtension(); // getting media_file extension
                    $fileName = $this->generateUniqueFileName().'.'.$extension; // renaming media_file

                    //$request->file('media_file')->move(Fb_AdUtilities::media_path(), $fileName);


                    #save full size images
                    $img = Image::make($request->file('media_file'));
                    //$img->fit($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                    $img->save($this->fullview_media_path().$fileName);

                    #save thumb size images
                    $img = Image::make($request->file('media_file'));
                    $img->fit($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                    $img->save($this->thumbview_media_path().$fileName);


                    //$this->fb_media->create($request, $fileName, $file_size, $admedia_helper);

                    Session::flash('alert-success', 'Upload successfull');

                    $media = new ProductsMedia();
                    $media->product_id = 1;
                    $media->original_file_name = $file->getClientOriginalName();
                    $media->media_file = $fileName;
                    $media->media_extension = $file->getClientOriginalExtension();
                    $media->size = $file_size;

                    $media->type = 'image';

                    if ($media->save()) {
                        Session::flash('alert-success','Saved Successfully');

                    }else{
                        Session::flash('alert-danger','Not successfull');
                    }


                    Redirect::to('media/create');


                }else {

                    if($request->ajax()){
                        return ['status'=>'error', 'message'=> ['error_message'=>'uploaded file is not valid'], 'error_code'=> null,'data' => null];

                    }
                    // sending back with error message.
                    Session::flash('alert-danger', 'uploaded file is not valid');
                    //return Redirect::to('ad/ad-media/create');
                }
            }

        }

        if(!$request->ajax())
            return Redirect::to('media/create');

    }

    public function generateUniqueFileName(){
        return md5(date('Y-m-d H:i:s:u'));
    }

    public static function thumbview_media_path()
    {
        return storage_path().'/ad-images/thumb_images/';
    }

    public static function fullview_media_path()
    {
        return storage_path().'/ad-images/full_images/';
    }
}
