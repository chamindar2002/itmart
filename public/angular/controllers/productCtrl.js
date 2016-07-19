angular.module('productCtrl', ['angularUtils.directives.dirPagination'])

    .controller('productController', function($scope, $http, Product, config) {

        console.log(config);
        // object to hold all the data for the new comment form
        $scope.productData = {};
        $scope.rowLimit = config.row_limit;
        $scope.sortColumn = 'id';
        $scope.reverseSort = false;
        $scope.recordsPerPage = config.records_per_page;
        $scope.products = [];

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Product.get()
            .success(function(data) {
                $scope.product = data;
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

        $scope.updateSelection = function($event, prod_name) {
           // products.push(prod_name);

            var checkbox = $event.target;
            var action = (checkbox.checked ? 'add' : 'remove');

            if(action == 'add'){
                console.log('adding '+prod_name);
                $scope.products.push(prod_name);
            }else{
                console.log('removing '+prod_name);
                var i = $scope.products.indexOf(prod_name);
                $scope.products.splice(i, 1);
                //pop(products, prod_name);
            }
            console.log($scope.products);

            $('#lbl_media_file_name').html('');
            $.each($scope.products, function( index, value ) {
                $('#lbl_media_file_name').append(value+'<br>');

            });


            //$('#lbl_media_file_name').append(prod_name + '<br>');
            //$('#mediaModal').modal('toggle');
        };
    });








