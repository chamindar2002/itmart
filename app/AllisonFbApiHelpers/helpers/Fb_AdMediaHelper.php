<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;

use FacebookAds\Object\AdImage;

use FacebookAds\Object\Fields\AdImageFields;

use FacebookAds\Http\Exception\RequestException;

use FacebookAds\Object\AdAccount;

use FacebookAds\Object\AdVideo;

use FacebookAds\Object\Fields\AdVideoFields;

use FacebookAds\Object\VideoThumbnail;
/**
 * Description of Fb_AdMediaHelper
 *
 * @author Efutures
 */
class Fb_AdMediaHelper extends FbContract{
    
    
    private $admedia;

    private $video;

    private $thumb_images = array();

    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }
    
    public function handleCreateRequest($request, $fileName){
        
        $this->admedia = new AdImage(null, $this->add_account_id);
        $this->admedia->{AdImageFields::FILENAME} = Fb_AdUtilities::fullview_media_path().$fileName;

        //$this->admedia->create();
        
        //echo 'Image Hash: '.$this->admedia->{AdImageFields::HASH}.PHP_EOL;
        //exit;
        
        try{
           
            $this->admedia->create();
                        
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
                
        return $this->admedia->{AdImageFields::HASH};
        
    }

    public function handleVideoCreateRequest($request, $fileName){

        #https://developers.facebook.com/docs/marketing-api/advideo/v2.5

        $this->video = new Advideo(null, $this->add_account_id);
        $this->video->{AdVideoFields::SOURCE} = Fb_AdUtilities::video_media_path().$fileName;;

        try{

            $this->video->create();

            return $this->video;


        }catch (RequestException $e) {
            $this->handleRequestException($e);
        }

    }
    
    public function handleDeleteRequest($media){
        
        $this->admedia = new AdImage(null, $this->add_account_id);
        $this->admedia->{AdImageFields::HASH} = $media->image_hash;
        //$this->admedia->delete();
        
        try{
           
            $this->admedia->delete();
            return true;
                        
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
        
    }
    
    public function handleReadRequest(){
        try{
            $this->ad_account = new AdAccount($this->add_account_id);
            $this->admedia = $this->ad_account->getAdImages(array(  
                            AdImageFields::ID,
                            AdImageFields::HASH,
                            AdImageFields::URL,
                            AdImageFields::NAME,
                            AdImageFields::STATUS,
                            AdImageFields::URL_128,
                           
                                                
                        ));
            
//            foreach($this->admedia As $ai){
//                echo $ai->{AdImageFields::ID}.PHP_EOL;
//                echo $ai->{AdImageFields::HASH}.PHP_EOL;
//                echo $ai->{AdImageFields::URL}.PHP_EOL;
//                echo $ai->{AdImageFields::NAME}.PHP_EOL;
//                echo $ai->{AdImageFields::STATUS}.PHP_EOL;
//                echo $ai->{AdImageFields::URL_128}.PHP_EOL;
//               
//                echo '----------------------------------------------------'.PHP_EOL;
                
//             }
        
//        exit();
           
        }catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
        
        return $this->admedia;
    }

    public function fetchThumbImages($video_id){

        if($video_id != ""){

            $video = new AdVideo($video_id);
            $thumbs = array();

            try{

                $thumbs = $video->getVideoThumbnails();

            } catch (AuthorizationException $e) {
                $this->handleRequestException($e);
            } catch (RequestException $e){
                $this->handleRequestException($e);
            }


            if(sizeof($thumbs) > 0){

                foreach($thumbs As $thumb){
                    $this->thumb_images[] = $thumb->uri;
                }
            }

            return $this->thumb_images;

        }

        return array();
    }
    
}
