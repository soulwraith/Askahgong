    function delete_comment_admin(button,commentid){
        var comment=$(button).parents(".alert");
        var result=confirm("Are you sure you want to delete this comment?");
        if(result){
             $.post("admin/discussion_manage/delete_comment_admin/",{commentid:commentid});
            $(button).parents(".admin-controls").remove();  
            $(".comment"+commentid).html("<em>This comment has been deleted.</em>");
        }
         
  
    }
    
    function mark_as_helpful(button,type,commentid,userid){
        var result=confirm("Are you sure you want to mark this reply as helpful reply? This action is irreversible.");
        if(result){
            var $controls=$(button).parents(".admin-controls");
            $controls.find(".helpful").remove();
            if(type===1){
                $controls.find(".helpful-text").html("Helpful!");
            }
            else if(type===2){
                $controls.find(".helpful-text").html("Super Helpful!");
            }
            
            $.post("admin/discussion_manage/mark_as_helpful/"+type,{commentid:commentid,userid:userid});
            
        }
        
    
        
    }

     function mark_as_good_topic(button,topicid,userid){
        var result=confirm("Are you sure you want to mark this topic as good topic? This action is irreversible.");
        if(result){
            var $controls=$(button).parents(".admin-controls");
            $controls.find(".helpful").remove();
            
            $controls.find(".goodtopic-text").html("Good Topic!");
         
    
            
            $.post("admin/discussion_manage/mark_as_goodtopic/",{topicid:topicid,userid:userid});
            
        }
        
    
        
    }



    function me_handled_error(error_id){
        $(".error-item[error_id="+error_id+"]").remove();
        pubnub_publish_admin("handledError(%2)"+error_id);
     }
     
     function me_handling_error(error_id){
        var $error;
        $error=$(".error-item[error_id="+error_id+"]");
        if($error.hasClass("handling")) return;
        $error.addClass("handling");
        $error.find(".handling-username").html("You");
        $error.attr("handle-by","you");
        $.post("admin/error_learning/set_handling/"+error_id,{username:MY_USERNAME});
        pubnub_publish_admin("handlingError(%2)"+error_id+"(%2)"+MY_USERID+"(%2)"+MY_USERNAME);
     }
     
     function me_cancel_handling_error(error_id){
        var $error;
        $error=$(".error-item[error_id="+error_id+"]");
        var username=$error.find(".handling-username").html();
        if($error.attr("handle-by")!=="you" && username!==MY_USERNAME) return;
        
        $error.removeClass("handling");
        $error.attr("handle-by","");
        $.post("admin/error_learning/set_handling/"+error_id,{username:""});
        pubnub_publish_admin("cancelHandlingError(%2)"+error_id);
     }
     
     
     function handled_error(obj){
        $(".error-item[error_id="+obj.processID+"]").remove();
        refresh_admin_counter(-1);
     }
     
     
     
     function handling_error(obj){
        var $error;
        $error=$(".error-item[error_id="+obj.processID+"]");
        $error.addClass("handling");
        $error.attr("handle-by","other");
        $error.find(".handling-username").html(obj.username);
        
     }
     
    
     
     function cancel_handling_error(obj){
        $(".error-item[error_id="+obj.processID+"]").removeClass("handling");
        
     }
     
     function new_error(obj){
         if($(".error-item[error_id="+obj.processID+"]").length<=0){
             $.post("admin/error_learning/get_pending_error/"+obj.processID,function(result){
                 $(".PAGE_ERROR").find(".error-list").append(result);
             });
         }
         refresh_admin_counter(+1);
     }
     
    function refresh_admin_counter(difference){
         var $counter=$(".admin-container").find(".error-counter");
        var count=$counter.html();
        count=parseInt(count,10)+difference;
        $counter.html(count);
        if(count>0){
            $counter.show();
            if(difference>0) playSound("admin");
        }
        else{
            $counter.hide();
        }
    } 
     
     
    $.post("admin/general/get_admin_html",function(html){
       $("body").append(html); 
       refresh_admin_counter(0);
    });
     
    
    new_error_callback.push(new_error);
    handled_error_callback.push(handled_error);
    handling_error_callback.push(handling_error);
    cancel_handling_error_callback.push(cancel_handling_error);