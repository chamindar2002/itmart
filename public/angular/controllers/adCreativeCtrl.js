angular.module('adCreativeCtrl', ['angularUtils.directives.dirPagination', 'ngSanitize'])

    .controller('adCreativeController', function($scope, $http, AdCreative, config, wizardService) {

        //console.log(config);
        // object to hold all the data for the new comment form
        $scope.adCreativeData = {
            name:null,
            body:null,
            title:null,
            object_url:null,
            media_d:[],
            ldf_message:null,
            ad_type:null,
            ldf_caption:null,
            adCreativeData:null,
            ldf_call_to_action_type: '',
            ldf_link_caption:null,
            thumb_image_url:null,
            video_id:null,
            post_id:null,
            page_id:null,
            products:null
        };
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = true;
        $scope.recordsPerPage = config.records_per_page;

        $scope.loading = true;

        $scope.adCreativeSelected = {adCreative_id:0}

        $scope.adcreatives = {};

        $scope.videoThumbSelected = {videoThumb_id:0}
        $scope.pagePostSelected = {pagePost_id:0}

        $scope.htm = '<strong>No Images</strong>';
        $scope.htm_posts = '<strong>No Posts</strong>';

        AdCreative.get()
            .success(function(data) {
                $scope.adcreatives = data;
                $scope.loading = false;
                //console.log(data);
            });


        $scope.sortData = function(column){
            $scope.reverseSort = ($scope.sortColumn == column) ? !$scope.reverseSort: false;
            $scope.sortColumn = column;
        }

        $scope.getSortClass = function(column){
            if($scope.sortColumn == column){
                return $scope.reverseSort ? 'arrow-down' : 'arrow-up'
            }

            return '';
        }


        $scope.showAdCreativeSelected = function(){

            wizardService.addCreativeId($scope.adCreativeSelected.adCreative_id);

            console.log($scope.adCreativeSelected);
            console.log(wizardService.getServiceParams());

        };

        $scope.submitAdLinkAdCreativeData = function(){

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            if(wizardService.getServiceParams().media_id != null){
                $scope.adCreativeData.media_d.push(wizardService.getServiceParams().media_id);
            }


            AdCreative.save($scope.adCreativeData)
                .success(function(data) {
                    //$scope.campaignData = {};


                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    if(res){
                        $scope.adCreativeData = {name:null,
                            body:null,
                            title:null,
                            object_url:null,
                            media_d:[]};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                       });


                })
                .error(function(data) {

                    //console.log(data);
                    appendValidationErrors(data);

                    $scope.loading = false;
                    hideProgress();

                });

        };

        $scope.submitLinkAdConPageCreativeData = function(){

            $scope.adCreativeData.ad_type = 'link_ad_connected_to_page';

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            if(wizardService.getServiceParams().media_id != null){
                $scope.adCreativeData.media_d.push(wizardService.getServiceParams().media_id);
            }

            AdCreative.savePageLinkAd($scope.adCreativeData)
                .success(function(data) {
                    //$scope.campaignData = {};


                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    if(res){
                        $scope.adCreativeData = {name:null,
                            body:null,
                            title:null,
                            object_url:null,
                            media_d:[]};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                        });


                })
                .error(function(data) {

                    //console.log(data);
                    appendValidationErrors(data);

                    $scope.loading = false;
                    hideProgress();

                });

        }

        $scope.submitCallToActionCreativeData = function(){

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            if(wizardService.getServiceParams().media_id != null){
                $scope.adCreativeData.media_d.push(wizardService.getServiceParams().media_id);
            }

            AdCreative.saveCallToActionAd($scope.adCreativeData)
                .success(function(data) {
                    //$scope.campaignData = {};


                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    if(res){
                        $scope.adCreativeData = {name:null,
                            body:null,
                            title:null,
                            object_url:null,
                            media_d:[]};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                        });


                })
                .error(function(data) {

                    //console.log(data);
                    appendValidationErrors(data);

                    $scope.loading = false;
                    hideProgress();

                });
        }

        $scope.submitVideoPageLikeAdCreativeData = function(){

            $scope.adCreativeData.ad_type = 'video_page_like_ad';

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            AdCreative.saveVideoPageLikeAd($scope.adCreativeData)
                .success(function(data) {
                    //$scope.campaignData = {};


                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    if(res){
                        $scope.adCreativeData = {name:null,
                            body:null,
                            title:null,
                            object_url:null,
                            media_d:[]};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                        });


                })
                .error(function(data) {

                    //console.log(data);
                    appendValidationErrors(data);

                    $scope.loading = false;
                    hideProgress();

                });
        }

        //$scope.video_thumb_image_placeholder = '<h1>ss</h1>';

        $scope.fetchVideoThumbs = function(){

            if($scope.adCreativeData.video_id != null){

                AdCreative.fetchVideoThumbImages($scope.adCreativeData)
                    .success(function(data) {


                        var res = appendSuccessMessage(data,'adcreative-selector-modal');

                        if(res){



                            $scope.htm = '<ul class="img-library">';
                            $.each( data, function( k, v){
                                //$scope.htm += '<tr><td>';
                                $scope.htm += '<li class="img-library-item">';
                                $scope.htm += '<input type="radio" name="thumbs[]"  value="'+ v.uri+'" class="opt_thumbs" uri="'+ v.uri+'" ng-model="videoThumbSelected.videoThumb_id" ng-change="showVideoThumbselected()"> ';
                                //$scope.htm += '</td><td>';
                                $scope.htm += '<img src="'+ v.uri +'" width="70px">';
                                $scope.htm += '</li>';
                                //$scope.htm += '</td>';
                            });

                            $scope.htm += '</div>';


                            $scope.video_thumb_image_placeholder = $scope.htm;


                        }else{
                            hideProgress();
                        }



                    })
                    //.error(function(data) {
                    //
                    //    //console.log(data);
                    //    appendValidationErrors(data);
                    //
                    //    $scope.loading = false;
                    //    hideProgress();
                    //
                    //});


            }


        };


        $scope.showVideoThumbselected = function(){
            $scope.adCreativeData.thumb_image_url = $scope.videoThumbSelected.videoThumb_id;

        }


        $scope.submitPagePostAdCreativeData = function(){

            $scope.adCreativeData.ad_type = 'ad_from_existing_page_post';

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            AdCreative.savePagePostAd($scope.adCreativeData)
                .success(function(data) {

                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                        });

                }).error(function(data) {

                //console.log(data);
                appendValidationErrors(data);

                $scope.loading = false;
                hideProgress();

            });
        };

        $scope.fetchPagePosts = function(){

            if($scope.adCreativeData.page_id != null){

                AdCreative.fetchPagePosts($scope.adCreativeData)
                    .success(function(data) {


                        var res = appendSuccessMessage(data,'adcreative-selector-modal');

                        if(res){



                            $scope.htm_posts = '<ul class="img-library">';
                            $.each( data, function( k, v){

                                $scope.htm_posts += '<li class="img-library-item">';
                                $scope.htm_posts += '<input type="radio" name="posts[]"  value="'+ v.id+'" class="opt_thumbs" class="opt_posts" ng-model="pagePostSelected.pagePost_id" ng-change="showPagePostsselected()"> ';

                                if(v.message){
                                    $scope.htm_posts += v.message;
                                }else if(v.story){
                                    $scope.htm_posts += v.story;
                                }else{
                                    $scope.htm_posts += '-';
                                }

                                $scope.htm_posts += '</li>';

                            });


                            //console.log(htm_posts);


                        }else{
                            hideProgress();
                        }



                    })

            }

        };

        $scope.showPagePostsselected = function(){
            $scope.adCreativeData.post_id = $scope.pagePostSelected.pagePost_id
        };

        $scope.submitCarousalAdData = function(){

            $scope.adCreativeData.ad_type = 'carousel_ad';

            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            $scope.serviceparams = wizardService.getServiceParams()
            $scope.adCreativeData.products = $scope.serviceparams.products;

            AdCreative.saveProductsAd($scope.adCreativeData)
                .success(function(data) {

                    var res = appendSuccessMessage(data,'adcreative-selector-modal');

                    AdCreative.get()
                        .success(function(data) {
                            $scope.adcreatives = data;
                            $scope.loading = false;
                            hideProgress();

                        });

                }).error(function(data) {

                //console.log(data);
                appendValidationErrors(data);

                $scope.loading = false;
                hideProgress();

            });

        };

    }).directive('dir', function($compile, $parse) {
    return {
        restrict: 'E',
        link: function(scope, element, attr) {
            scope.$watch(attr.content, function() {
                element.html($parse(attr.content)(scope));
                $compile(element.contents())(scope);
            }, true);
        }
    }
});



