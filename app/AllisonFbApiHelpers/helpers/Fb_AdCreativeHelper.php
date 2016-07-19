<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdAccountAssigner;

use Allison\models\FbAd\AdMedia;

use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;
use FacebookAds\Http\Exception\RequestException;

use FacebookAds\Object\ObjectStory\LinkData;
use FacebookAds\Object\Fields\ObjectStory\LinkDataFields;
use FacebookAds\Object\ObjectStorySpec;
use FacebookAds\Object\Fields\ObjectStorySpecFields;
use FacebookAds\Object\Values\CallToActionTypes;

use FacebookAds\Object\ObjectStory\VideoData;
use FacebookAds\Object\Fields\ObjectStory\VideoDataFields;

use FacebookAds\Object\Fields\ObjectStory\AttachmentDataFields;

use Facebook\FacebookRequest;
/**
 * Description of Fb_AdCreativeHelper
 *
 * @author Efutures
 *
 * source:
 * https://developers.facebook.com/docs/marketing-api/reference/ad-creative/
 */
class Fb_AdCreativeHelper  extends FbContract{
   
    private $ad_creative;

    public function init()
    {
       
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
        
    }
    
    public function handleCreateRequest($request){
        
        $this->ad_creative = new AdCreative(null, $this->add_account_id);
        
        $ad_media = AdMedia::find($request->media_d)->first();
                
        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->name,
          AdCreativeFields::TITLE => $request->title,
          AdCreativeFields::BODY => $request->body,
          AdCreativeFields::IMAGE_HASH => $ad_media->image_hash, 
          AdCreativeFields::OBJECT_URL => $request->object_url,
          //AdCreativeFields::LINK_URL => $request->link_url',  
            
            
        ));
        
        try {
             
           $this->ad_creative->create();
           
           return $this->ad_creative->id;
           //dd($this->ad_creative->id);
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
       
        
    }
    
    public function handleUpdateRequest($ad_creative, $request)
    {
        $ad_media = AdMedia::find($request->media_d)->first();
        
        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        
        $this->ad_creative->setData(array(
            AdCreativeFields::NAME => $request->name,
            AdCreativeFields::TITLE => $request->title,
            AdCreativeFields::BODY => $request->body,
            AdCreativeFields::IMAGE_HASH => $ad_media->image_hash, 
            AdCreativeFields::OBJECT_URL => $request->object_url,
        ));
        
        try {
             
           $this->ad_creative->update();

           //dd($this->ad_creative);
           return true;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
    }
    
    
    public function handleDeleteRequest($ad_creative)
    {
        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        try {
            
            $this->ad_creative->delete();
            return true;
            
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
    }
    
    
    public function handleCreateCallToActionRequest($request){
        
        
        $link_data = new LinkData();
        $link_data->setData(array(LinkDataFields::MESSAGE => $request->ldf_message,
                                  LinkDataFields::LINK => $request->object_url,
                                  LinkDataFields::CAPTION => $request->ldf_caption,
                                  LinkDataFields::CALL_TO_ACTION => array(
                                        'type' => $request->ldf_call_to_action_type,
                                        'value' => array(
                                          'link' => $request->object_url,
                                          'link_caption' => $request->ldf_link_caption,
                                        ),
                                      ),
                                  )
                );
        
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::LINK_DATA => $link_data,
        ));

        $this->ad_creative = new AdCreative(null, $this->add_account_id);

        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));

        //dd($this->ad_creative);
        
        try {
             
           $this->ad_creative->create();
           
           return $this->ad_creative->id;
           
        } catch (RequestException $e) {
            
            $this->handleRequestException($e);
        }
        
       
    }
    
    
    public function handleUpdateCallToActionRequest($ad_creative, $request){
        
        
        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        $link_data = new LinkData();
        $link_data->setData(array(LinkDataFields::MESSAGE => $request->ldf_message,
                                  LinkDataFields::LINK => $request->object_url,
                                  LinkDataFields::CAPTION => $request->ldf_caption,
                                  LinkDataFields::CALL_TO_ACTION => array(
                                        'type' => $request->ldf_call_to_action_type,
                                        'value' => array(
                                          'link' => $request->object_url,
                                          'link_caption' => $request->ldf_link_caption,
                                        ),
                                      ),
                                  )
                );
        
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::LINK_DATA => $link_data,
        ));
        
        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));
        
        
        //dd($this->ad_creative);
        
        try {
             
           $this->ad_creative->update();

           //dd($this->ad_creative);
           return true;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    }
    
    
    public function handleCreateLinkAdRequest($request){
        
        $link_data = new LinkData();
        
        $ad_media = AdMedia::find($request->media_d)->first();
        
        $link_data->setData(array(LinkDataFields::MESSAGE => $request->ldf_message,
                                  LinkDataFields::LINK => $request->object_url,
                                  LinkDataFields::CAPTION => $request->ldf_caption,
                                  LinkDataFields::IMAGE_HASH => $ad_media->image_hash, 
                                  )
                );
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::LINK_DATA => $link_data,
        ));
        
        $this->ad_creative = new AdCreative(null, $this->add_account_id);
        
        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));
        
        //dd($this->ad_creative);
        
        try {
             
            $this->ad_creative->create();

           return $this->ad_creative->id;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    }
    
    public function handleUpdateLinkAdRequest($ad_creative, $request){
        
        //$this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        $ad_media = AdMedia::find($request->media_d)->first();
        
        $link_data = new LinkData();
        
        $link_data->setData(array(LinkDataFields::MESSAGE => $request->ldf_message,
                                  LinkDataFields::LINK => $request->object_url,
                                  LinkDataFields::CAPTION => $request->ldf_caption,
                                  LinkDataFields::IMAGE_HASH => $ad_media->image_hash, 
                            )
                );
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::LINK_DATA => $link_data,
        ));
        
        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));
        
        
        //dd($this->ad_creative);
        
        try {
             
           $this->ad_creative->update();

           return true;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    }
    
    
    public function handleCreateVideoPageLikeAdRequest($request){
        
        $video_data = new VideoData();
        
        $video_data->setData(array(
        VideoDataFields::DESCRIPTION => $request->ldf_message,
        VideoDataFields::IMAGE_URL => $request->thumb_image_url,
        VideoDataFields::VIDEO_ID => $request->video_id,
        VideoDataFields::CALL_TO_ACTION => array(
            'type' => CallToActionTypes::LIKE_PAGE,
            'value' => array(
              'page' => $request->page_id,
            ),
          ),
        ));
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::VIDEO_DATA => $video_data,
        ));

        $this->ad_creative = new AdCreative(null, $this->add_account_id);

        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));
        
        try {
             
           $this->ad_creative->create();

           return $this->ad_creative->id;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    }
    
    public function handleUpdateVideoPageLikeAdRequest($ad_creative, $request){
        
        $video_data = new VideoData();
        
        $video_data->setData(array(
            VideoDataFields::DESCRIPTION => $request->ldf_message,
            VideoDataFields::IMAGE_URL => $request->thumb_image_url,
            VideoDataFields::VIDEO_ID => $request->video_id,
            VideoDataFields::CALL_TO_ACTION => array(
                'type' => CallToActionTypes::LIKE_PAGE,
                'value' => array(
                  'page' => $request->page_id,
                ),
              ),
        ));
        
        $object_story_spec = new ObjectStorySpec();
        $object_story_spec->setData(array(
          ObjectStorySpecFields::PAGE_ID => $request->page_id,
          ObjectStorySpecFields::VIDEO_DATA => $video_data,
        ));
        
        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);
        
        $this->ad_creative->setData(array(
          AdCreativeFields::NAME => $request->input('name'),
          AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));
        
        try{
             
           $this->ad_creative->update();

           return true;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    }

    public function handleUpdatePagePostAdRequest($ad_creative, $request){

        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);

        $this->ad_creative->setData(array(
            AdCreativeFields::NAME => $request->name,
            #combine page id and post id with and underscore to create the post_id (e.g.PageId_PostId=>181706508877956_186446901737250)
            AdCreativeFields::OBJECT_STORY_ID => $request->post_id,
        ));

        try{

            $this->ad_creative->update();

            return true;

        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }

    }
    
    public function handleCreatePagePostAdRequest($request){
        
        $this->ad_creative = new AdCreative(null, $this->add_account_id);
        
        $this->ad_creative->setData(array(
            AdCreativeFields::NAME => $request->name,
            #combine page id and post id with and underscore to create the post_id (e.g.PageId_PostId=>181706508877956_186446901737250)
            AdCreativeFields::OBJECT_STORY_ID => $request->post_id,
          )); 
        
        //dd($this->ad_creative);
        try {
             
           $this->ad_creative->create();

           return $this->ad_creative->id;
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
    }


    public function handleCreateCarouselAdRequest($request, $products){

        $link_data = new LinkData();
        $link_data->setData(array(
            LinkDataFields::LINK => $request->object_url,
            LinkDataFields::CAPTION => $request->ldf_caption,
            LinkDataFields::CHILD_ATTACHMENTS => $products,
        ));

        $object_story_spec = new ObjectStorySpec();

        $object_story_spec->setData(array(
                        ObjectStorySpecFields::PAGE_ID => $request->page_id,
                        ObjectStorySpecFields::LINK_DATA => $link_data,
        ));

        $this->ad_creative = new AdCreative(null, $this->add_account_id);
        $this->ad_creative->setData(array(
            AdCreativeFields::NAME => $request->name,
            AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));

        try {

            $this->ad_creative->create();

            return $this->ad_creative->id;

        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }

    }

    public function handleUpdateCarouselAdRequest($ad_creative, $products, $request){

        $this->ad_creative = new AdCreative($ad_creative->ad_creative_id);

        $link_data = new LinkData();
        $link_data->setData(array(
            LinkDataFields::LINK => $request->object_url,
            LinkDataFields::CAPTION => $request->ldf_caption,
            LinkDataFields::CHILD_ATTACHMENTS => $products,
        ));

        $object_story_spec = new ObjectStorySpec();

        $object_story_spec->setData(array(
            ObjectStorySpecFields::PAGE_ID => $request->page_id,
            ObjectStorySpecFields::LINK_DATA => $link_data,
        ));


        $this->ad_creative->setData(array(
            AdCreativeFields::NAME => $request->name,
            AdCreativeFields::OBJECT_STORY_SPEC => $object_story_spec,
        ));

        try{

            $this->ad_creative->update();

            return true;

        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }

    }
    
    public function getVideoThumbImageUrl($video_id){
       $appsecret_proof = hash_hmac('sha256', $this->access_token, Config('facebook.APP_SECRET'));

            $params = array(
                    'access_token' => $this->access_token,
                    'appsecret_proof' => $appsecret_proof,
             );
        
        $url = 'https://graph.facebook.com/v2.5/'.$video_id.'/thumbnails?access_token='.$this->access_token.'&appsecret_proof='.$appsecret_proof;
       
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_VERBOSE, true);
        $header[] = 'Content-Type: text/xml; charset=UTF-8';
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = json_decode(curl_exec($handle));
        
                  
         if (isset($response->error)) {
            #if error an object will be thrown
            $this->exceptions = $response->error->message;
         } elseif (isset($response->data)) {
            #if response has data indicates that return was successfull
            return $response->data;
         }
        //return $response;
    }

    public function getPagePosts($page_id){
        /*
         * https://developers.facebook.com/docs/graph-api/reference/v2.5/page/feed
         */

        $appsecret_proof = hash_hmac('sha256', $this->access_token, Config('facebook.APP_SECRET'));

        $params = array(
            'access_token' => $this->access_token,
            'appsecret_proof' => $appsecret_proof,
        );

        $url = 'https://graph.facebook.com/v2.5/'.$page_id.'/posts?access_token='.$this->access_token.'&appsecret_proof='.$appsecret_proof;

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_VERBOSE, true);
        $header[] = 'Content-Type: text/xml; charset=UTF-8';
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = json_decode(curl_exec($handle));


        if (isset($response->error)) {
            #if error an object will be thrown
            $this->exceptions = $response->error->message;
        } elseif (isset($response->data)) {
            #if response has data indicates that return was successfull
            return $response->data;
        }
        //return $response;
    }
    
    
}
