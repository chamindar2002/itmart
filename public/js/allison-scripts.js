/**
 * Created by chaminda on 5/16/16.
 */

function appendValidationErrors(response){

    //if( $("#msgbox-success").css('display') == 'block') {
    //    $("#msgbox-success").css("display", "none");
    //}

    $("#msgbox-danger").css("display", "block");
    $('#msgbox-danger').html("<p>");

    $.each(response, function( index, value ) {
        //$('#lbl_media_file_name').append(value+'<br>');
        console.log(index + ' -> ' + value);
        $('#msgbox-danger').append("<li>"+value+"</li>");
        //alert(index + ' -> ' + value);
    });

    $('#msgbox-danger').append("</p>");


    $('#msg-modal').modal('show')
}


function appendSuccessMessage(response, modal_window){

    if(typeof response['status'] === "undefined"){
        return true;
    }

    //console.log(typeof response['status'] === "undefined");

    //console.log('x----------------------------');


    //if( $("#msgbox-danger").css('display') == 'block') {
    //    $("#msgbox-danger").css("display", "none");
    //}

    $("#msgbox-success").css("display", "block");
    $('#msgbox-success').html("<p>");
    var success = true;


    if(response['status'] == 'success'){
        //$('#msgbox-success').append(response['message'] + "<br />");
        $.each(response['message'], function( index, value ) {

            console.log(index + ' -> ' + value);
            $('#msgbox-success').append(value + "<br />");

        });

        $('#'+modal_window).modal('toggle');

    }else if(response['status'] == 'error'){
        showProgress();
        appendValidationErrors(response['message'])
        success = false;

    }

    $('#msgbox-success').append("</p>");


    $('#msg-modal').modal('show')

    return success;
}

function showProgress(){
    $('#msgbox-success').html("");
    if( $("#msgbox-success").css('display') == 'block') {
        $("#msgbox-success").css("display", "none");
    }

    $("#msgbox-danger").html("");
    if( $("#msgbox-danger").css('display') == 'block') {
        $("#msgbox-danger").css("display", "none");
    }

    $("#progress-bar").css("display", "block");
}

function hideProgress(){
    $("#progress-bar").css("display", "none");

}
//
//function  appendVideoThumbs(data, placeholder){
//
//    var htm = '<hr><table class="table table-hover">';
//    $.each( data, function( k, v){
//        htm += '<tr><td>';
//        htm += '<input type="radio" name="thumbs[]"  value="'+ v.id+'" class="opt_thumbs" uri="'+ v.uri+'" ng-model="videoThumbSelected.videoThumb_id" ng-change="showVideoThumbselected()"> <br>';
//        htm += '</td>';
//        htm += '<td><img src="'+ v.uri +'" width="100px"></td>';
//    });
//
//    htm += '</table>';
//
//    //console.log(htm);
//
//    $('#video_thumb_image_placeholder').html(htm);
//}


//var arr_group = [];
//
////console.log(JSON.stringify(arr_group));
//
////on edit append previous values from table to the arr_group array
//if($("#selected_target_groups").val() !== ''){
//    var arr_group = jQuery.parseJSON($("#selected_target_groups").val());
//    dump(arr_group);
//}
//
//
//$(document).on("click", "input[class=chk_interests]", function(e) {
//    var group_id = $(this).val();
//
//    if($(this).is(':checked')){
//        push(arr_group, group_id);
//    }else{
//        pop(arr_group, group_id);
//    }
//
//    console.log(JSON.stringify(arr_group));
//
//    $("#selected_target_groups").val(JSON.stringify(arr_group));
//
//    dump(arr_group);
//
//});
//
//function push(arr_group, item){
//    arr_group.push(item);
//
//}
//
//function pop(arr_group, item){
//    arr_group.pop(item);
//}
//
//function dump(arr_group){
//    $.each(arr_group, function(index, val) {
//        console.log(index+'=>'+val);
//    });
//}
//
  