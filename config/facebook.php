<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    'APP_ID'     => '1090869727620403',
    'APP_SECRET' => '17718a7691e446ee50f7113085e92d19',
    'MEDIA_MAX_SIZE' => '3145728', #bytes
    'API_VERSION '=>'v2.5',
    'APP_ACCESS_TOKEN' => '1090869727620403|b_ULYnS93XAlOYO77HB1R0DL7iM', #https://developers.facebook.com/tools/access_token/


    'OBJECTIVES' => [
        'CANVAS_APP_ENGAGEMENT' => 'CANVAS_APP_ENGAGEMENT',
        'CANVAS_APP_INSTALLS'  => 'CANVAS_APP_INSTALLS',
        'EVENT_RESPONSES' => 'EVENT_RESPONSES',
        'LOCAL_AWARENESS' => 'LOCAL_AWARENESS',
        'MOBILE_APP_ENGAGEMENT' => 'MOBILE_APP_ENGAGEMENT',
        'MOBILE_APP_INSTALLS' => 'MOBILE_APP_INSTALLS',
        'NONE'  => 'NONE',
        'OFFER_CLAIMS'  => 'OFFER_CLAIMS',
        'PAGE_LIKES' => 'PAGE_LIKES',
        'POST_ENGAGEMENT' => 'POST_ENGAGEMENT',
        'PRODUCT_CATALOG_SALES' => 'PRODUCT_CATALOG_SALES',
        'LINK_CLICKS' => 'LINK_CLICKS',
        'CONVERSIONS' => 'CONVERSIONS',
        'VIDEO_VIEWS' => 'VIDEO_VIEWS',
    ],
    
    'STATUSES' => [
        'PAUSED' => 'STATUS_PAUSED',
        'ACTIVE'  => 'STATUS_ACTIVE',
//        'STATUS_DELETED'  => 'STATUS_DELETED',
//        'ARCHIVED' => 'STATUS_ARCHIVED'
        
    ],
    
    'MEDIA_IMAGES' => [
        'THUMB_SIZE_W' => '60',
        'THUMB_SIZE_H' => '50',
        'NO_IMAGE' => 'no_image.png',
        'NO_IMAGE_TYPE' => 'png'
        
    ],
    
    'OPTIMIZATION_GOALS' =>[
         'APP_INSTALLS' => 'APP_INSTALLS',
         'ENGAGED_USERS' => 'ENGAGED_USERS',
         'EVENT_RESPONSES' => 'EVENT_RESPONSES',
         'LINK_CLICKS' => 'LINK_CLICKS',
         //'NONE' => 'NONE',
         'OFFER_CLAIMS' => 'OFFER_CLAIMS',
         'OFFSITE_CONVERSIONS' => 'OFFSITE_CONVERSIONS',
         'PAGE_LIKES' => 'PAGE_LIKES',
         'POST_ENGAGEMENT' => 'POST_ENGAGEMENT',
         'REACH' => 'REACH',
         'VIDEO_VIEWS' => 'VIDEO_VIEWS',
         'IMPRESSIONS' => 'IMPRESSIONS'
    ],
    
    'CALL_TO_ACTION_TYPES'=> [
        'BOOK_TRAVEL' => 'BOOK_TRAVEL',
        'BUY_NOW' => 'BUY_NOW',
        'CALL_NOW' => 'CALL_NOW',
        'DOWNLOAD' => 'DOWNLOAD', #temporaly ignore
        'GET_DIRECTIONS' => 'GET_DIRECTIONS', #temporaly ignore
        'GET_OFFER' => 'GET_OFFER',
        'INSTALL_APP' => 'INSTALL_APP',
        'INSTALL_MOBILE_APP' => 'INSTALL_MOBILE_APP',
        'LEARN_MORE' => 'LEARN_MORE',
        'LIKE_PAGE' => 'LIKE_PAGE', #temporaly ignore
        'LISTEN_MUSIC' => 'LISTEN_MUSIC',
        'MESSAGE_PAGE' => 'MESSAGE_PAGE',
        'NO_BUTTON' => 'NO_BUTTON',
        'OPEN_LINK' => 'OPEN_LINK',
        'PLAY_GAME' => 'PLAY_GAME',
        'SHOP_NOW' => 'SHOP_NOW',
        'SIGN_UP' => 'SIGN_UP',
        'SUBSCRIBE' => 'SUBSCRIBE',
        'USE_APP' => 'USE_APP',
        'USE_MOBILE_APP' => 'USE_MOBILE_APP',
        'WATCH_MORE' => 'WATCH_MORE',
        'WATCH_VIDEO' => 'WATCH_VIDEO',
    ]

];
