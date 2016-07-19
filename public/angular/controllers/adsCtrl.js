angular.module('adsCtrl', ['angularUtils.directives.dirPagination'])

    .controller('adsController', function($scope, $http, Ads, config, wizardService) {

        //console.log(config);
        // object to hold all the data for the new comment form
        $scope.adsData = {
            name:null,
            ad_creative_id:null,
            ad_set_id:null
        };
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = true;
        $scope.recordsPerPage = config.records_per_page;


        // loading variable to show the spinning loading icon
        $scope.loading = true;

        $scope.adsSelected = {ad_id:0};




        // get all the comments first and bind it to the $scope.comments object
        Ads.get()
            .success(function(data) {
                $scope.ads = data;
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

        $scope.showAdSelected = function(){
            wizardService.addAd($scope.adsSelected.ad_id);

            console.log(wizardService.getServiceParams());
        }


        $scope.submitAdData = function() {
            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            $scope.serviceparams = wizardService.getServiceParams();
            $scope.adsData.ad_creative_id = $scope.serviceparams.creative_id;
            $scope.adsData.ad_set_id = $scope.serviceparams.adset_id;

            // save the comment. pass in comment data from the form
            Ads.save($scope.adsData)
                .success(function(data) {

                    var res = appendSuccessMessage(data,'add-campaign-modal');

                    if(res){
                        //$scope.adsData = {};//clear form data
                    }

                    // if successful, we'll need to refresh the comment list
                    Ads.get()
                        .success(function(data) {
                            $scope.ads = data;
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


    });



