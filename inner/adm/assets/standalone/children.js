/**
 * Created by shameless on 15/6/16.
 */
var action='/user/children',data='',args=new Object();
function doSearch(){
    args.url = action;
    args.data = "uid="+uid;
    return args;
}