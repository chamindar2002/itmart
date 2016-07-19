config_ = [
    {
        row_limit:100,//maximum no of rows to be displayed in a list
        records_per_page:5,
        path:'/media'

    }

];


var mediaApp = angular.module('mediaApp', ['mediaCtrl', 'mediaService']).value('config', config_[0]);

var productApp = angular.module('productApp', ['productCtrl', 'productService']).value('config', config_[0]);

var wizardApp = angular.module('wizardApp',['campaignCtrl',
                                            'campaignService',
                                            'adSetCtrl',
                                            'adSetService',
                                            'mediaCtrl',
                                            'mediaService',
                                            'adCreativeCtrl',
                                            'adCreativeService',
                                            'productGalleryCtrl',
                                            'productService',
                                            'adsCtrl',
                                            'adsService',
                                            'wizardNavCtrl'
                                           ]).value('config', config_[0])
    .service('wizardService', function() {


        var serviceParams = {campaign_id:null, adset_id:null, media_id:null, creative_id:null, products:[], ad:null};


        var getServiceParams = function(){
            return serviceParams;
        };

        var addCampaignId = function(v){
            serviceParams.campaign_id = v;
        };

        var addMediaId = function(v){
            serviceParams.media_id = v;
        }

        var addAdsetId = function(v){
            serviceParams.adset_id = v;
        }

        var addCreativeId = function(v){
            serviceParams.creative_id = v;
        }

        var addProducts = function(v){
            serviceParams.products = v;
        }

        var addAd = function(v){
            serviceParams.ad = v;
        }

        return {
            getServiceParams:getServiceParams,
            addCampaignId:addCampaignId,
            addMediaId:addMediaId,
            addAdsetId:addAdsetId,
            addCreativeId:addCreativeId,
            addProducts:addProducts,
            addAd:addAd
        };

        //stackoverflow.com/questions/20181323/passing-data-between-controllers-in-angulaar-js

    });

//var wzAdSetApp = angular.module('wzAdSetApp', ['adSetCtrl', 'adSetService']).value('config', config_[0]);

//var app = angular.module('app', ['app.mediaApp']);

//app.value('config', config_[0]);
