angular.module('productService', [])

    .factory('Product', function($http) {

        return {
            get : function() {
                return $http.get('/ad/ad-products-list');
            },
            show : function(id) {
                return $http.get('ad/ad-products/' + id);
            },
            save : function(productData) {
                return $http({
                    method: 'POST',
                    url: '/ad/ad-products',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(productData)
                });
            },
            destroy : function(id) {
                return $http.delete('/ad/ad-products/' + id);
            }
        }

    });