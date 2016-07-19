<?php

namespace Allison\AllisonFbApiHelpers\helpers;

/**
 * Description of Fb_AudienceUtilities
 *
 * @author Efutures
 */
class Fb_AudienceUtilities {
    
    public static function make_custom_audience_rule($str, $rule_definer){
        /*  https://developers.facebook.com/docs/marketing-api/custom-audience-website/v2.5
         *  {"or": [
            {"url":{"i_contains":"shoes"}},
            {"url":{"i_contains":"boots"}}
            ]}
         * 
         * //$v = '{"or": [{"url":{"i_contains":"shoes"}},{"url":{"i_contains":"boots"}}]}';
         */
        if($str != ''){
            $str = explode(',',$str);
            
            $rule = array();
            foreach($str as $key=>$value){
                #replaced the operator 'eq,i_contais,etc to the value selected from rule_definer dropdown box
                //$rule['or'][] = array('url' => array('i_contains'=>$value));
                $rule['or'][] = array('url' => array($rule_definer=>$value));
            }
        }
        
        return json_encode($rule);
    }
    
    public static function custom_audience_sub_types(){
       $sub_types = array(
           'WEBSITE' => 'WEBSITE',
           //'CUSTOM'  => 'CUSTOM' #temporaly disabled
       );
       
       return $sub_types;
    }
    
    public static function custom_audience_pre_fill(){
        return array(
            'true' =>'TRUE',
            'false'=>'FALSE'
        );
    }
    
    public static function website_traffic(){
        return array(
            'anyone_who_visits'=>'Anyone who visits your website',
            'specific_pages'=>'People who visits specific web pages'
        );
    }
    
    public static function rule_definer(){
        return array(
            'i_contains'=>'URL Contains',
            'eq'=>'URl Equals (Case sensitive)'
        );
    }
    
    public static function custom_audience_data_types(){
        return array(
            'EMAIL_SHA256' => 'Email',
            'UID' => 'App Users',
            'PHONE_SHA256' => 'Phone Numbers',
            'MOBILE_ADVERTISER_ID' => 'Mobile Advertiser ID\'s'
      
        );
    }
    
    public static function format_customer_list($value){
        
        $html = htmlentities($value);
        
        $list = array();
        if($value){
            $arr_line_breaks = explode(PHP_EOL, $html);

            foreach($arr_line_breaks as $key=>$value){
                $arr_commas = explode(',', $value);
                    foreach($arr_commas as $k=>$v){
                        $list[] = trim($v);
                    }
            }
            
        }
        
       
        return $list;
        
    }
}
