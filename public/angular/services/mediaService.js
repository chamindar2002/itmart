angular.module('mediaService', [])

    .factory('Media', function($http) {

        return {
            get : function() {
                return $http.get('/ad/ad-media');
            },
            show : function(id) {
                return $http.get('/ad/ad-media' + id);
            },
            save : function(mediaData) {
                return $http({
                    method: 'POST',
                    url: '/ad/ad-media',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(mediaData)
                });
            },
            destroy : function(id) {
                return $http.delete('/ad/ad-media/' + id);
            }
        }

    });