<div id="navigation-wrapper" class="hwrap">
<div id="navigation" class="horizontal">
<div  id="primary-navigation-wrapper">
<div id="before-primary-navigation"></div>
<div id="primary-navigation-container" class="fixed-width">
   <ul id="primary-navigation" class="cols-7" >
      <li class="<?=($Menu=='oneway'?'current-page ':'');?>section page-oneway rendered-link"> 
         <div class="link-content"> 
            <a href="oneway/home" data-page-url="oneway/home" > 
               <div class="title rendered-link-content">ONEWAY</div>
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='Sponsor' or $Status=='Gatekeeper'
        or $Status=='SysAdmin')){?>
      <li class="<?=($Menu=='member'?'current-page ':'');?>section page-member rendered-link"> 
         <div class="link-content"> 
            <a href="member/memberhome" data-page-url="member/memberhome"> 
               <div class="title rendered-link-content">Member</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?>
     <li class="<?=($Menu=='sponsor'?'current-page ':'');?>section page-sponsor rendered-link"> 
         <div class="link-content"> 
            <a href="sponsor/sponsorhome" data-page-url="sponsor/sponsorhome"> 
               <div class="title rendered-link-content">Sponsor</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' 
        OR $Status=='SysAdmin')){?>
     <li class="<?=($Menu=='gatekeeper'?'current-page ':'');?>section page-gatekeeper rendered-link"> 
         <div class="link-content"> 
            <a href="gatekeeper/gatekeeperhome" data-page-url="gatekeeper/gatekeeperhome"> 
               <div class="title rendered-link-content">Gatekeeper</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
}
if(isset($Status) and $Status=='SysAdmin'){?>
      <li class="<?=($Menu=='sysadmin'?'current-page ':'');?>section page-sysadmin rendered-link"> 
         <div class="link-content"> 
            <a href="sysadmin/sysadminhome" data-page-url="sysadmin/sysadminhome"> 
               <div class="title rendered-link-content">SysAdmin</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
}?>
   </ul>
</div>
<div id="after-primary-navigation"></div>
</div>

