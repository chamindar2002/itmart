<?php

namespace Allison\Repositories\FbProducts;

use Allison\Repositories\Contracts\IfFbAdProductsRepository;

use Allison\models\FbAd\AdProduct;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdAccountAssigner;

use Auth;

use Input;


class FbAdProductsRepository implements IfFbAdProductsRepository
{
    public function getAllProducts()
    {
        if (Auth::user()->fbProfile) {
            return AdProduct::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
        }
    }

    public function getProduct($id){

        return AdProduct::find($id);

    }
    

    public function create($request)
    {

            $fb_products = new AdProduct();
            $fb_products->product_name = $request->product_name;
            $fb_products->product_description = $request->product_description;
            $fb_products->fb_profile_id = Auth::user()->fbProfile->id;
            $fb_products->ad_account = Fb_AdAccountAssigner::getAddAccountId();
            $fb_products->media_id = $request->media_id;
            $fb_products->product_url = $request->product_url;
            $fb_products->video_id = '';

            if ($fb_products->save()) {
                return true;
            }


        return false;

    }

    public function getAdMedia($id)
    {

    }

    public function update($request, $id)
    {
        $fb_products = AdProduct::find($id);


        $fb_products->product_name = $request->product_name;
        $fb_products->product_description = $request->product_description;
        //$fb_products->fb_profile_id = Auth::user()->fbProfile->id;
        //$fb_products->ad_account = Fb_AdAccountAssigner::getAddAccountId();
        $fb_products->media_id = $request->media_id;
        $fb_products->product_url = $request->product_url;
        //$fb_products->video_id = '';

        if ($fb_products->save()) {
                return true;
        }


        return false;

    }

    public function destroy($id)
    {
        $fb_products = AdProduct::find($id);


        if($fb_products->delete()){

            return true;

        }

        return false;

    }

    public function getProductsBatch($product_ids){

        $batch = AdProduct::whereIn('id',$product_ids)->get();

        return $batch;

    }
}
