<?php

namespace Allison\Repositories\FbAdmedia;

use Allison\Repositories\Contracts\IfFbAdMediaRepository;

use Allison\models\FbAd\AdMedia;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;

use FacebookAds\Object\Fields\AdImageFields;

use Auth;

use Input;

use File;

use DB;

use Cache;

class FbAdMediaRepository implements IfFbAdMediaRepository
{
    public function getAllAdMedia($remember = true)
    {
        if (Auth::user()->fbProfile) {

            DB::connection()->enableQueryLog();

            #helpfull for caching queries in laravel: https://www.youtube.com/watch?v=zCMypIqZQzo
            #redis tutorial: https://www.youtube.com/watch?v=S_jA39Uayak
            #installing on amazon remote server: https://mariuszprzydatek.com/2014/08/23/amazon-aws-installing-redis-on-ebs/
            if($remember) {

                $results = Cache::remember('media_listing_cache', Config('database.CACHE_TIMEOUT'), function () {
                    return AdMedia::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
                });
            }

            return AdMedia::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();

            $log = DB::getQueryLog();
            //dd($log);

            //dd(Config::get('database.CACHE_TIMEOUT'));

            return $results;
           
        }
    }
    

    public function create($request, $fileName, $file_size, $admedia_helper)
    {
        
        $image_hash = $admedia_helper->handleCreateRequest($request, $fileName);
        
        if ($admedia_helper->getExceptions() == null) {
                    
            #http://laravel.com/docs/4.2/requests

            $file = $request->file('media_file');


            $media = new AdMedia();
            $media->fb_profile_id = Auth::user()->fbProfile->id;
            $media->ad_account = Auth::user()->fbAdAccount->ad_account_id;
            $media->original_file_name = $file->getClientOriginalName();
            $media->media_file = $fileName;
            $media->media_extension = $file->getClientOriginalExtension();
            $media->size = $file_size;
            $media->image_hash = $image_hash;
            $media->type = 'image';
            
            if ($media->save()) {
                return true;
            }
            
        }
        
        return false;
    }



    public function createVideo($request, $fileName, $file_size, $admedia_helper)
    {
          $video = $admedia_helper->handleVideoCreateRequest($request, $fileName);

            if ($admedia_helper->getExceptions() == null) {


                $file = $request->file('media_file');


                $media = new AdMedia();
                $media->fb_profile_id = Auth::user()->fbProfile->id;
                $media->ad_account = Auth::user()->fbAdAccount->ad_account_id;
                $media->original_file_name = $file->getClientOriginalName();
                $media->media_file = $fileName;
                $media->media_extension = $file->getClientOriginalExtension();
                $media->size = $file_size;
                $media->type = 'video';
                $media->video_id = $video->id;

                if ($media->save()) {
                    return $media;
                }

            }

            return false;
    }

    public function updateVideo($request, $id){

        $media = $this->getAdMedia($id);
        $media->url_128 = $request->thumb_url;
        if ($media->save()) {
            return $media;
        }

        return false;

    }

    public function getAdMedia($id)
    {
        return AdMedia::find($id);
    }

    public function update($request, $ad_admedia_helper, $id)
    {
    }

    public function destroy($ad_admedia_helper, $id)
    {
        $media = AdMedia::find($id);

        $result = $ad_admedia_helper->handleDeleteRequest($media);

        if ($ad_admedia_helper->getExceptions() == null) {
            
            $path_thumbs = Fb_AdUtilities::thumbview_media_path();
            $path_full = Fb_AdUtilities::fullview_media_path();
            
            //dd($path_thumbs.$media->media_file);
            
            File::delete($path_thumbs.$media->media_file);
            File::delete($path_full.$media->media_file);
            
            
            if ($media->delete()) {
                return true;
            }
        }

        return false;
    }
    
    public function syncFbAdMedia($admedia_helper){
        
        $response = $admedia_helper->handleReadRequest();
        
        foreach ($response As $am){
            
            $ad_media_existing = AdMedia::where('image_hash', $am->{AdImageFields::HASH})->first();
            
            if($ad_media_existing){
                
                $ad_media = AdMedia::find($ad_media_existing->id);
                $ad_media->url_128 = $am->{AdImageFields::URL_128};
                $ad_media->url = $am->{AdImageFields::URL};
                $ad_media->status = $am->{AdImageFields::STATUS};
                
                
                $result = array_diff($ad_media['attributes'], $ad_media['original']);
                
                #update only if there is a change in the record fetched from api
                if(sizeof($result) > 0){
                                        
                      if ($ad_media->save()) {
                          
                            //return true;
                            
                      }
                      
                      
                }
            }else{
                
                $media = new AdMedia();
                $media->fb_profile_id = Auth::user()->fbProfile->id;
                $media->ad_account = Auth::user()->fbAdAccount->ad_account_id;
                $media->media_file = $am->{AdImageFields::NAME};
                $media->image_hash = $am->{AdImageFields::HASH}; 
                $media->url_128 = $am->{AdImageFields::URL_128};
                $media->url = $am->{AdImageFields::URL};
                $media->status = $am->{AdImageFields::STATUS};
                
                if($media->save()){
                  //echo  $am->{AdImageFields::HASH};
                  //echo '<hr>';
                }
            }
        }
        
        //exit();
    }
}
