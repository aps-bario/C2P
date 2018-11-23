<div  id="secondary-navigation-wrapper">
    <div id="before-secondary-navigation"></div>
	<div id="secondary-navigation-container">

	<ul id="secondary-navigation">
      <li class="<?=($NextPage=='sysadmin/sysadminhome'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/sysadminhome" data-page-url="sysadmin/sysadminhome"> 
               <div class="title rendered-link-content">SYSTEM</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li><?php  
if(isset($Status) and ($Status=='Admin'
        OR $Status=='SysAdmin')){?>
      <li class="<?=($NextPage=='sysadmin/allmembers'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allmembers" data-page-url="sysadmin/allmembers"> 
               <div class="title rendered-link-content">Members</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sysadmin/allcontacts'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allcontacts" data-page-url="sysadmin/allcontacts"> 
               <div class="title rendered-link-content">Contacts</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sysadmin/allchurches'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allchurches" data-page-url="sysadmin/allchurches"> 
               <div class="title rendered-link-content">Churches</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sysadmin/allgroups'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allgroups" data-page-url="sysadmin/allgroups"> 
               <div class="title rendered-link-content">Groups</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sysadmin/allreturnees'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allreturnees" data-page-url="sysadmin/allreturnees"> 
               <div class="title rendered-link-content">Returnees</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sysadmin/allreferrals'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sysadmin/allreferrals" data-page-url="sysadmin/allreferrals"> 
               <div class="title rendered-link-content">Referrals</div> 
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

