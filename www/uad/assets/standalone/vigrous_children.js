/**
 * Created by shameless on 15/1/19.
 */
var action='/comissioner/vigrousChildren',data='',args=new Object();

function doSearch(){
    var search_create_time = $("#search_create_time").val();
    data = 'search_create_time='+search_create_time;
    args.url = action;
    args.data = data;
    return args;
}

//$('#search_create_time').datepicker({format: 'yyyy-mm-dd'});
