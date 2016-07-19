angular.module('adCreativeService', [])

    .factory('AdCreative', function($http) {

        return {
            get : function() {
                return $http.get('/Api/wz-adcreative');
            },
            save : function(adCreativeData) {
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });
            },

            savePageLinkAd:function(adCreativeData){
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative-page-link-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });
            },

            saveCallToActionAd:function(adCreativeData){
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative-callto-action-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });
            },

            saveVideoPageLikeAd:function(adCreativeData){
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative-video-pagelike-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });
            },
            fetchVideoThumbImages:function(adCreativeData){

                return $http.get('video-thumb-url?video_id='+adCreativeData.video_id);

            },
            savePagePostAd:function(adCreativeData){
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative-page-post-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });
            },
            fetchPagePosts:function(adCreativeData){
                return $http.get('list-page-posts?page_id='+adCreativeData.page_id);
            },

            saveProductsAd:function(adCreativeData){

                return $http({
                    method: 'POST',
                    url: '/Api/wz-adcreative-carousal-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adCreativeData)
                });

            }


        }
    });

