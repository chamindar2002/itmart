angular.module('campaignCtrl', ['angularUtils.directives.dirPagination'])

    .controller('campaginController', function($scope, $http, Campaign, config, wizardService) {

        //console.log(config);
        // object to hold all the data for the new comment form
        $scope.campaignData = {};
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = true;
        $scope.recordsPerPage = config.records_per_page;
        //$scope.campagins = [];

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        $scope.campaignSelected = {campaign_id:0};




        // get all the comments first and bind it to the $scope.comments object
        Campaign.get()
            .success(function(data) {
                $scope.campaign = data;
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


        $scope.submitCampaignData = function() {
            $scope.loading = true;

            $('#msg-modal').modal('show');
            showProgress();

            // save the comment. pass in comment data from the form
            Campaign.save($scope.campaignData)
                .success(function(data) {
                    //$scope.campaignData = {};

                    var res = appendSuccessMessage(data,'add-campaign-modal');

                    if(res){
                        $scope.campaignData = {};//clear form data
                    }
                    //$('#add-campaign-modal').modal('toggle')

                    // if successful, we'll need to refresh the comment list
                    Campaign.get()
                        .success(function(data) {
                            $scope.campaign = data;
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

        $scope.showCampaignSelected = function(){


            wizardService.addCampaignId($scope.campaignSelected.campaign_id);//set service parameter

            //$scope.xxxy = wizardService.getServiceParams();
            //console.log($scope.xxxy.campaign_id);

        }


    });



