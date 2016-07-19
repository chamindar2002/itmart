angular.module('wizardNavCtrl', ['angularUtils.directives.dirPagination'])

    .controller('wizardNavController', function($scope, $http, Campaign, config, wizardService) {

        var nav_steps = [
            "_first",
            "_second",
            "_third",
            "_fourth",
            "_fifth"
        ];

        var wizard_params = {
                            _first:{
                                data:null,
                                signature: 'campaign_id',
                                message: ['Campaign not selected'],
                            },
                            _second:{
                                data:null,
                                signature: 'adset_id',
                                message: ['Ad Set not selected'],
                            },
                            _third:{
                                data:null,
                                signature: 'media_id',
                                message: ['Media not selected'],
                            },
                            _fourth:{
                                data:null,
                                signature: 'creative_id',
                                message: ['Ad Creative not selected'],
                            },
                            _fifth:{
                                data:null,
                                signature: 'ad',
                                message: ['Ad not selected'],
                            }
        };

        //{campaign_id:null, adset_id:null, media_id:null, adset_id:null, creative_id:null, products:[], ad:null};

        //var i = 2;//start from media
        var i = 0;//start from campaign
        var n = 0;//previous
        var end = nav_steps.length;

        //show first
        var _cur = nav_steps[i];

        $('#'+_cur).css('display', 'block');

        //var is_safe = validateServiceParams(_cur);

        i++;//begin wizard from next onwards

        $scope.next = function(){


            if(i < end){

                n = i - 1;

                //console.log("i : "+i+" n : "+n);
                _cur = nav_steps[i];

                is_safe = validateServiceParams(_cur);

                if(is_safe){

                    if(n >= 0){
                        var _prv = nav_steps[n];
                        $('#'+_prv).css('display', 'none');
                        //console.log("cur : "+_cur+" prv : "+_prv);
                    }


                    $('#'+_cur).css('display', 'block');
                    $('#li'+_cur).addClass('wz-progress-cur');

                    i++;



                }



            }

            toggleWizardNavigationButtons();

        }

        $scope.prev = function(){

            var c = i - 1;//current
            var p = 0;//previous
            var _b_cur = nav_steps[c];

            if(c > 0){
                p = c - 1;

                var _b_prv = nav_steps[p];
                $('#'+_b_prv).css('display', 'block');
                $('#'+_b_cur).css('display', 'none');
                //alert("i : "+nav_steps[i]+" n : "+nav_steps[n]);
                //alert("cur : "+_cur+" prv : "+_prv);
                $('#li'+_b_cur).removeClass('wz-progress-cur');

                i--;
            }

            toggleWizardNavigationButtons();

        };

        $('#li'+_cur).addClass('wz-progress-cur');


        function validateServiceParams(_cur){

            wizard_params._first.data = wizardService.getServiceParams().campaign_id;
            wizard_params._second.data = wizardService.getServiceParams().adset_id;
            wizard_params._third.data = wizardService.getServiceParams().media_id;
            wizard_params._fourth.data = wizardService.getServiceParams().creative_id;
            wizard_params._fifth.data = wizardService.getServiceParams().ad;

            //console.log('------------------------------------');

            //console.log('[i] =>' + i);

            var _prv = i - 1;

            //console.log('[_prv] =>'+_prv);

            var _previous = nav_steps[_prv];

            //console.log('[_previous] =>'+_previous);

            var is_safe = true;


            if(_prv >= 0){
                $.each(wizard_params,function(key,value){

                    if(key == _previous){

                        console.log('kick :' + key +'-' + _cur);
                        console.log('data : '+value.data);
                        if(value.data == null){
                            //alert(_previous + ' not selected');
                            appendValidationErrors(value.message);
                            is_safe = false;
                            return false; // break from the loop

                        }

                    }

                    //console.log(key + ' - should not be here');
                });
            }

            //console.log('------------------------------------');

            return is_safe;

        }


        function toggleWizardNavigationButtons(){
            var end = nav_steps.length;

            //handle back button class
            if(i > 1){
                $('#wz-prev').removeClass('btn-default');
                $('#wz-prev').addClass('btn-success');
            }else if(i == 1){
                $('#wz-prev').removeClass('btn-success');
                $('#wz-prev').addClass('btn-default');
            }

            //handle next button class

            if(i == end){
                $('#wz-next').removeClass('btn-success');
                $('#wz-next').addClass('btn-default');
            }else if(i < end){
                $('#wz-next').removeClass('btn-default');
                $('#wz-next').addClass('btn-success');
            }

            //console.log('i =>'+i+' end =>'+end);
        }

        window.onbeforeunload = function() {
            return "You're about to exit the wizard";
        }



    });



//toggleWizardNavigationButtons