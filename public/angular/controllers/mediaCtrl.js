angular.module('mediaCtrl', ['angularUtils.directives.dirPagination'])

    .controller('mediaController', function($scope, $http, Media, config) {

        console.log(config);
        // object to hold all the data for the new comment form
        $scope.mediaData = {};
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = false;
        $scope.recordsPerPage = config.records_per_page;

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Media.get()
            .success(function(data) {
                $scope.media = data;
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
    });








