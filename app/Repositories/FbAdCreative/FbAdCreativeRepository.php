<?php
namespace Allison\Repositories\FbAdCreative;

use Allison\Repositories\Contracts\IfFbAdCreativeRepository;

use Allison\models\FbAd\AdCreative;

use FacebookAds\Object\ObjectStory\AttachmentData;

use Auth;

use Cache;

/**
 * Description of FbAdCreative
 *
 * @author Efutures
 */
class FbAdCreativeRepository implements IfFbAdCreativeRepository{
    
    
    public function getAllAdCreatives($remember = true)
    {
        if (Auth::user()->fbProfile) {

            if($remember) {

                $results = Cache::remember('adcreative_listing_cache', Config('database.CACHE_TIMEOUT'), function () {
                    return AdCreative::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
                });
            }

            return AdCreative::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();

        }
    }

    public function create($request, $ad_adcreative_helper){
        
        $ad_creative_id = $ad_adcreative_helper->handleCreateRequest($request);
        
        //echo "inside repository: <br>";
        //dd($ad_creative_id);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
            $ad_creative->title = $request->input('title');
            $ad_creative->body = $request->input('body');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->ad_type = 'link_ad';
            $ad_creative->save();

            $ad_creative->media()->attach($request->input('media_d'));
        
            return true;
        }
        
        return $ad_adcreative_helper;
        
    }
    
    public function listMedia($adcreative){
        $media = array();
        foreach($adcreative->media As $am){
            $media[$am->id] = $am->image_hash;
        }
        
        return $media;
    }

    public function listProducts($adcreative){
        $products = array();
        foreach($adcreative->products As $am){
            $products[$am->id] = $am->product_name;
        }

        return $products;
    }

    public function getAdCreative($id)
    {
        return AdCreative::find($id);
    }

    public function update($request, $ad_adcreative_helper, $id)
    {
                
        $ad_creative = AdCreative::find($id);
        
        $ad_adcreative_helper->handleUpdateRequest($ad_creative, $request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            $ad_creative->name = $request->input('name');
            $ad_creative->title = $request->input('title');
            $ad_creative->body = $request->input('body');
            $ad_creative->object_url = $request->input('object_url');
            //$ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->save();

            $ad_creative->media()->sync($request->input('media_d'));
            return true;
        }

        return $ad_adcreative_helper;
    }

    public function destroy($ad_adcreative_helper, $id)
    {
               
        $ad_creative = AdCreative::find($id);
        
        $ad_adcreative_helper->handleDeleteRequest($ad_creative);
        
        if($ad_adcreative_helper){

            $ad_creative->delete();
            
            return true;
            
        }

        return $ad_adcreative_helper;
    }
    
    public function listAdCreatives(){
        
        $ad_creatives = array();
        foreach($this->getAllAdCreatives() as $ac){
            $ad_creatives[$ac->id] = $ac->name;
        }
        
        return $ad_creatives;
    }
    
    
    public function createCallToAction($request, $ad_adcreative_helper){
       
        $ad_creative_id = $ad_adcreative_helper->handleCreateCallToActionRequest($request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            
            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            $ad_creative->ldf_call_to_action_type = $request->input('ldf_call_to_action_type');
            $ad_creative->ldf_link_caption = $request->input('ldf_link_caption');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ad_type = 'link_ad_call_to_action';
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->save();
            
            return true;
        }
       
        return $ad_adcreative_helper;
    }
    
    public function updateCallToAction($request, $ad_adcreative_helper, $id)
    {
                
        $ad_creative = AdCreative::find($id);
        
        $ad_adcreative_helper->handleUpdateCallToActionRequest($ad_creative, $request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            $ad_creative->ldf_call_to_action_type = $request->input('ldf_call_to_action_type');
            $ad_creative->ldf_link_caption = $request->input('ldf_link_caption');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->save();

            return true;
        }

        return $ad_adcreative_helper;
    }
    
    public function createLinkAd($request, $ad_adcreative_helper){
        
        $ad_creative_id = $ad_adcreative_helper->handleCreateLinkAdRequest($request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            
            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            //$ad_creative->ldf_call_to_action_type = $request->input('ldf_call_to_action_type');
            //$ad_creative->ldf_link_caption = $request->input('ldf_link_caption');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ad_type = 'link_ad_connected_to_page';
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->save();
            
            $ad_creative->media()->attach($request->input('media_d'));
            
            return true;
        }
       
        return $ad_adcreative_helper;
        
    }
    
    public function updateLinkAd($request, $ad_adcreative_helper, $id){
        
        
        $ad_creative = AdCreative::find($id);
                
        $ad_adcreative_helper->handleUpdateLinkAdRequest($ad_creative, $request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            //$ad_creative->ldf_call_to_action_type = $request->input('ldf_call_to_action_type');
            //$ad_creative->ldf_link_caption = $request->input('ldf_link_caption');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->save();
            
            $ad_creative->media()->sync($request->input('media_d'));

            return true;
        }

        return $ad_adcreative_helper;
        
    }
    
    public function createVideoPageLikeAd($request, $ad_adcreative_helper){
        
        $ad_creative_id = $ad_adcreative_helper->handleCreateVideoPageLikeAdRequest($request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            
            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->thumb_image_url = $request->input('thumb_image_url');
            $ad_creative->video_id = $request->input('video_id');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ad_type = 'video_page_like_ad';
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->save();
            
           
            
            return true;
        }
       
        return $ad_adcreative_helper;
        
    }
    
    public function updateVideoPageLikeAd($request, $ad_adcreative_helper, $id){
                
        $ad_creative = AdCreative::find($id);
                
        $ad_adcreative_helper->handleUpdateVideoPageLikeAdRequest($ad_creative, $request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            
            $ad_creative->name = $request->input('name');
            $ad_creative->ldf_message = $request->input('ldf_message');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->thumb_image_url = $request->input('thumb_image_url');
            $ad_creative->video_id = $request->input('video_id');
            $ad_creative->page_id = $request->input('page_id');
           
            $ad_creative->save();
           
            return true;
        }

        return $ad_adcreative_helper;
        
    }
    
    public function createPagePostAd($request, $ad_adcreative_helper){
        
        $ad_creative_id = $ad_adcreative_helper->handleCreatePagePostAdRequest($request);
        
        if ($ad_adcreative_helper->getExceptions() == null) {
            
            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
            $ad_creative->post_id = $request->input('post_id');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ad_type = $request->ad_type;
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->save();



            return true;
        }
       
        return $ad_adcreative_helper;
        
    }

    public function updatePagePostAd($request, $ad_adcreative_helper, $id){

        $ad_creative = AdCreative::find($id);

        $ad_adcreative_helper->handleUpdatePagePostAdRequest($ad_creative, $request);

        if ($ad_adcreative_helper->getExceptions() == null) {

            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->name = $request->input('name');
            $ad_creative->post_id = $request->input('post_id');
            $ad_creative->page_id = $request->input('page_id');
            //$ad_creative->ad_type = $request->ad_type;
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();

            $ad_creative->save();

            return true;
        }

        return $ad_adcreative_helper;


    }

    public function createCarouselAd($request, $fb_products, $ad_adcreative_helper){

        $batch = $this->prepareLinkData($fb_products, $request);

        $ad_creative_id = $ad_adcreative_helper->handleCreateCarouselAdRequest($request, $batch);


        if ($ad_adcreative_helper->getExceptions() == null) {

            $ad_creative = new AdCreative();
            $ad_creative->fb_profile_id = Auth::user()->fbProfile->id;
            $ad_creative->ad_creative_id = $ad_creative_id;
            $ad_creative->name = $request->input('name');
//            $ad_creative->post_id = $request->input('post_id');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ad_type = $request->ad_type;
            $ad_creative->ad_account = $ad_adcreative_helper->getAdAccountId();
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->save();

            $ad_creative->products()->attach($request->input('products'));

            return true;
        }

        return $ad_adcreative_helper;

    }

    public function updateCarouselAd($request, $fb_products, $ad_adcreative_helper, $id){

        $ad_creative = AdCreative::find($id);
        $batch = $this->prepareLinkData($fb_products, $request);

        $ad_adcreative_helper->handleUpdateCarouselAdRequest($ad_creative, $batch, $request);

        if ($ad_adcreative_helper->getExceptions() == null) {

            $ad_creative->name = $request->input('name');
            $ad_creative->page_id = $request->input('page_id');
            $ad_creative->ldf_caption = $request->input('ldf_caption');
            $ad_creative->object_url = $request->input('object_url');
            $ad_creative->save();

            $ad_creative->products()->sync($request->input('products'));

            return true;
        }

        return $ad_adcreative_helper;

    }

    private function prepareLinkData($fb_products, $request){

        /*
         *const CALL_TO_ACTION = 'call_to_action';
          const DESCRIPTION = 'description';
          const IMAGE_HASH = 'image_hash';
          const LINK = 'link';
          const NAME = 'name';
          const PICTURE = 'picture';
          const VIDEO_ID = 'video_id';
         */

        /*
         *$product1 = (new AttachmentData())->setData(array(
          AttachmentDataFields::LINK => 'https://www.link.com/product1',
          AttachmentDataFields::NAME => 'Product 1',
          AttachmentDataFields::DESCRIPTION => '$8.99',
          AttachmentDataFields::IMAGE_HASH => '<IMAGE_HASH>',
          AttachmentDataFields::VIDEO_ID => '<VIDEO_ID>',
        ));
         */

        $products = $fb_products->getProductsBatch($request['products']);
        $batch = array();

        #compose products array()
        if(sizeof($products) > 0){
            foreach($products as $product){

                $batch[] = (new AttachmentData())->setData(array(
                    'link' => $product->product_url,
                    'name' => $product->product_name,
                    'description' => $product->product_description,
                    'image_hash' => $product->media->image_hash
//                  'video_id'=>'' #to be done later
                ));

            }
        }

        return $batch;

    }
    
    
}
