angular.module('campaignService', [])

    .factory('Campaign', function($http) {

        return {
            get : function() {
                return $http.get('/Api/wz-campagin');
            },
            show : function(id) {
                return $http.get('/api/wz-campagin' + id);
            },
            save : function(campaignData) {
                return $http({
                    method: 'POST',
                    url: '/Api/wz-campagin',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(campaignData)
                });
            },
            destroy : function(id) {
                return $http.delete('/api/wz-campagin' + id);
            }
        }

});

