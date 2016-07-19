<?php

namespace Allison\AllisonFbApiHelpers\helpers;

use Route;

use URL;
/**
 * Description of Fb_AdWizard
 *
 * @author Efutures
 */
class Fb_AdWizard {
    
    protected $modules = array();
    
    protected $param = null;
    
    protected $current_route;
    
    protected $previous;

    public function __construct(){
        
//        $this->current_route = Route::current()->getPath();
//        $this->param = Route::current()->parameters();
//        $this->previous_url = URL::previous();
//
//        $this->initialize();
       
    }
    
    private function initialize(){
        $this->modules = [
            [
                'name'    => 'ad-wizard',
                'prev_url'=> $this->previous_url,
                'prev'    => '',
                'next'    => 'ad/ad-campaign/create',
                'params'  => $this->param
            ],
            [
                'name'    => 'ad/ad-campaign',
                'prev_url'=> $this->previous_url,
                'prev'    => '',
                'next'    => 'ad/ad-set',
                'params'  => $this->param
            ],
            [
                'name'    => 'ad/ad-campaign/{ad_campaign}/edit',
                'prev_url'    => $this->previous_url,
                'prev'    => 'ad/ad-campaign',
                'next'    => 'ad/ad-set',
                'params'  => $this->param
            ],
            [
                'name'    => 'ad/ad-set',
                'prev_url'    => $this->previous_url,
                'prev'    => 'ad/ad-set',
                'next'    => 'ad/ad-media',
                'params'  => $this->param,
            ]
            
        ];
    }
    
    public function getCurrentModule(){
       foreach($this->modules As $m){
          if($m['name'] == $this->current_route){
//              echo '<pre>';
//              print_r($m);
//              echo '</pre>';
              return $m;
          }
       }
       
//              echo '<pre>';
//              echo $this->current_route;
//              echo '</pre>';
    }
    
    
    
}
