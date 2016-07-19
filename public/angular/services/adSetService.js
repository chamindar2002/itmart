angular.module('adSetService', [])

    .factory('Adset', function($http) {

        return {

            getTargets : function(targetSearchData) {
                //console.log(targetSearchData);
                return $http.get('/Api/wz-search-targets',{params:{
                                                            'searchText':targetSearchData.searchText,
                                                            'searchLimit':targetSearchData.searchLimit,
                                                            'geoLocations':targetSearchData.geoLocations,
                                                            'searchType':targetSearchData.searchType
                                                            }
                });
            },
            get : function() {
                return $http.get('/Api/wz-adset');
            },
            save : function(targetSearchData) {
                return $http({
                    method: 'POST',
                    url: '/Api/wz-adset',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(targetSearchData)
                });
            },

        }
});

