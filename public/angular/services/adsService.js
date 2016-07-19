angular.module('adsService', [])

    .factory('Ads', function($http) {

        return {
            get : function() {
                return $http.get('/Api/wz-ad');
            },

            save : function(adsData) {
                return $http({
                    method: 'POST',
                    url: '/Api/wz-ad',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(adsData)
                });
            },
            destroy : function(id) {
                return $http.delete('/api/wz-campagin' + id);
            }
        }

    });

