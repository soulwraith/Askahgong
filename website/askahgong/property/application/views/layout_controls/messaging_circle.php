<div>
     <div class="message-circle transition">
         <img src="<?=get_user_profile_pic($user->id)?>">
         <span class="icons close-button"></span>
     </div>
     <div class="username-box">
         <div class="user-status-container">
             <div class="user-status user-state <?php if($user->isonline) echo "online"; else echo "offline";?> icons inline-block" userid="<?=$user->id?>">
               </div>
             <div class="notification-count amber icons <?php if($unread<=0) echo "hidden-object"?>"><?=$unread?>
             </div>
       </div>
       <div class="usertyping hidden-object typing-container" userid="<?=$user->id?>">                   
       	<img src="image/usertyping2.gif">     			
       </div>
         <div class="overflow-ellipsis name-text">
         	<?=$user->username?>
         </div>
         <img class="username-shadow top" src="image/discussion_shadow_top.png">
     </div>
     <div class="messaging-list-parent">
         <div class="messaging-list-container">
         	
             <a class="expand-messaging icons hide-overflow-tooltip" data-toggle='tooltip' title='Expand This Conversation' href="contact/messaging/<?=$user->id?>" target="_blank"><a>
             <a class="hide-messaging icons hide-overflow-tooltip" data-toggle='tooltip' title='Minimize This Conversation'><a>
             <div class="messaging">
             	<?=$this->load->view("layout_controls/message_listing")?>
             </div>
         </div>
         <div class="messaging-arrow">
         </div>
     </div>
     <div class="message-preview-parent transition">
         <div class="message-preview-container overflow-ellipsis">
               
         </div>
         <div class="message-preview-arrow">
         </div>
     </div>


 </div>
