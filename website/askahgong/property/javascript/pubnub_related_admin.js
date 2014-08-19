var admin_pubnub;
var new_error_callback=[];
var handled_error_callback=[];
var handling_error_callback=[];
var cancel_handling_error_callback=[];


function event_subscribe_admin(){
    
    if(!check_is_defined(MY_USERID)) return;
    
       // Init
    if(isTrue(IN_PRODUCTION)){
        admin_pubnub = PUBNUB.init({
            publish_key   : 'pub-c-ae60bbd0-75b2-4e40-8db5-1b810a09a19c',
            subscribe_key : 'sub-c-07a09324-ba29-11e3-8b59-02ee2ddab7fe',
            secret_key    : 'sec-c-MzA4M2RkZmYtYTZmNi00YjZjLWIwOWUtY2EwYzhjMDBiMDhh',
            uuid          : MY_USERID+"/admin"
        });
    }   
    else{
        admin_pubnub = PUBNUB.init({
            publish_key   : 'pub-c-a6ed9270-de5f-4d09-a6bf-d9e747d60c95',
            subscribe_key : 'sub-c-ea081254-e186-11e2-ab32-02ee2ddab7fe',
            secret_key    : 'sec-c-MThkNDMwMDctMTJhZS00OTIwLWFmMjktODYyYTM4ODk0ZWRi',
            uuid          : MY_USERID+"/admin"
        });
    }
       
   

    // LISTEN
    admin_pubnub.subscribe({
        channel : ['admin'],
        message : admin_receiver
    });
}

$(document).ready(function(){
    event_subscribe_admin();
});

function admin_receiver( message, envelope, channel ) {
    var obj=message.split("(%2)"),
         i,newObj;
    
    
     
    if(obj[0]==="newError"){
        for(i=0;i<new_error_callback.length;i+=1){
            var newObj={};
            newObj.processID=obj[1];
            new_error_callback[i](newObj);
        }
        return;
    }   
    
    if(obj[0]==="handledError"){
        for(i=0;i<handled_error_callback.length;i+=1){
            var newObj={};
            newObj.processID=obj[1];
            handled_error_callback[i](newObj);
        }
        return;
    }   

    if(obj[0]==="handlingError"){
        for(i=0;i<handling_error_callback.length;i+=1){
            var newObj={};
            newObj.processID=obj[1];
            newObj.userid=obj[2];
            newObj.username=obj[3];
            if(newObj.userid==MY_USERID) return;
            handling_error_callback[i](newObj);
        }
        return;
    }   
  

    if(obj[0]==="cancelHandlingError"){
        for(i=0;i<cancel_handling_error_callback.length;i+=1){
            var newObj={};
            newObj.processID=obj[1];
            cancel_handling_error_callback[i](newObj);
        }
        return;
    }   
  
    
    

  }
  


function pubnub_publish_admin(msg){

        pubnub.publish({
            channel : "admin",
            message : msg
        });
}

