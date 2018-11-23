<div  id="secondary-navigation-wrapper">
    <div id="before-secondary-navigation"></div>
	<div id="secondary-navigation-container">
	<ul id="secondary-navigation">
     <li class="<?=($NextPage=='member/memberhome'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="member/memberhome" data-page-url="member/memberhome"> 
               <div class="title rendered-link-content">MEMBER</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='member/sysupdate'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="member/sysupdate" data-page-url="member/sysupdate"> 
               <div class="title rendered-link-content">System Update</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='SysAdmin')){?>
      <li class="<?=($NextPage=='member/editmember'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="member/editmember" data-page-url="member/editmember"> 
               <div class="title rendered-link-content">Edit Details</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='member/newpassword'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="member/newpassword" data-page-url="member/newpassword"> 
               <div class="title rendered-link-content">New Password</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='member/newreferee'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="member/newreferee" data-page-url="member/newreferee"> 
               <div class="title rendered-link-content">New Referee</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
          <?php
}      
if(isset($Status) and ($Status=='Member')){?>
      <li class="rendered-link" > 
         <div class="<?=($NextPage=='member/newreturnee'?'current-page ':'');?>link-content"> 
            <a href="sponsor/newreturnee" data-page-url="sponsor/newreturnee"> 
               <div class="title rendered-link-content">First Returnee</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php
}?>      
      </ul>
	</div>
	<div id="after-secondary-navigation"></div>
</div>
</div>
