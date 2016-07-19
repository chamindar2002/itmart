angular.module('adSetCtrl', ['angularUtils.directives.dirPagination'])

    .controller('adSetController', function($scope, $http, Adset, config, wizardService) {

        console.log(config);
        // object to hold all the data for the new comment form
        $scope.adSetData = {};
        $scope.targetSearchData = {};
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = true;
        $scope.recordsPerPage = config.records_per_page;

        $scope.targetSearchData.targeting_search_types = 'INTEREST';
        $scope.targetSearchData.searchLimit = 10;
        $scope.targetSearchData.selected_target_groups = null;
        $scope.targetSearchData.optimization_goals = 'LINK_CLICKS';
        $scope.targetSearchData.bid_amount = 2;
        $scope.targetSearchData.daily_budget= 100;
        $scope.targetSearchData.campaign_id = null;
        $scope.targetSearchData.target_name = 'NA';
        $scope.targetSearchData.geo_location = 'LK';


        $scope.selected = {};
        $scope.final = [];

        $scope.adSetSelected = {adset_id:0};


        //$scope.targetSearchData.selected_target_groups =  $scope.final;

        //$scope.campagins = [];

        // loading variable to show the spinning loading icon
        //$scope.loading = true;

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


        Adset.get()
            .success(function(data) {
                $scope.adsets = data;
                $scope.loading = false;
                //console.log(data);
        });


        $scope.searchTargets = function() {

            Adset.getTargets($scope.targetSearchData)
                .success(function(data) {
                    $scope.targets = data;
                    $scope.loading = false;
                    //console.log($scope.targets);
                });

        };



        $scope.toggleSelection = function toggleSelection(id) {

            //$scope.records = $.grep($scope.records, function( record ) {
            //
            //    return $scope.selected[ record.Id ];
            //});
            $scope.final = [];

            angular.forEach($scope.selected, function(value, key) {
                if(value){
                    console.log('key->' + key);
                    $scope.final.push(key);
                }
            });

            if($scope.final.length == 0) {

                $scope.targetSearchData.selected_target_groups = null;

            }else{

                $scope.targetSearchData.selected_target_groups = JSON.stringify($scope.final);
            }

            //
            //console.log($scope.selected);
            //console.log('-------------');
            //console.log($scope.final);
            //console.log('xxxxxx');
            //console.log($scope.targetSearchData.selected_target_groups);


        };

        //$scope.compose_array = function(){
        //    angular.forEach(obj, function(value, key) {
        //        console.log(key + ': ' + value);
        //    });
        //}



        $scope.submitAdSetData = function() {
            $scope.loading = true;

            $scope.servParam = wizardService.getServiceParams();
            $scope.targetSearchData.campaign_id = $scope.servParam.campaign_id;
            //console.log($scope.targetSearchData);
            //alert($scope.servParam.campaign_id);

            $('#msg-modal').modal('show');
            showProgress();


            // save the comment. pass in comment data from the form
            Adset.save($scope.targetSearchData)
                .success(function(data) {
                    //$scope.campaignData = {};


                    var res = appendSuccessMessage(data,'adset-modal');

                    if(res){
                        $scope.adSetData = {};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    Adset.get()
                        .success(function(data) {
                            $scope.adsets = data;
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

        $scope.showAdsetSelected = function(){


            wizardService.addAdsetId($scope.adSetSelected.adset_id);//set service parameter

            //$scope.xxxy = wizardService.getServiceParams();
            //console.log($scope.xxxy);

        }


    });



