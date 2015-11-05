/**
 * Created by shameless on 15/3/9.
 */
function doSearch(){
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();

    var start_timestamp = Date.parse(new Date(start_time));
    var end_timestamp = Date.parse(new Date(end_time));
    var diff_timestamp = end_timestamp - start_timestamp;

    if(diff_timestamp < 0){
        alert('起始时间必须小于结束时间');
        return;
    }

    var days = diff_timestamp/(60*60*24*1000);
    var precision = $("#precision").val();
    switch (precision){
        case 'hour':
            if(days > 7)
            {
                alert('请重新选择:时间精度-小时,时间区间最大为1周');
                return;
            }
            break;
        case 'day':
            if(days > 31)
            {
                alert('请重新选择:时间精度-天,时间区间最大为1个月');
                return;
            }
            break;
        case 'month':
            if(days > 365)
            {
                alert('请重新选择:时间精度-月,时间区间最大为1年');
                return;
            }
            break;
    }

    $("#search_form").submit();
}