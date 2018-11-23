<div id="navigation-wrapper" class="hwrap">
<div id="navigation" class="horizontal">
<div  id="primary-navigation-wrapper">
<div id="before-primary-navigation"></div>
<div id="primary-navigation-container" class="fixed-width">
   <ul id="primary-navigation" class="cols-7" >
      <li class="<?=($Menu=='oneway'?'current-page ':'');?>section page-oneway rendered-link"> 
         <div class="link-content"> 
            <a href="oneway/home" data-page-url="oneway/home" > 
               <div class="title rendered-link-content">C2P</div>
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

<!--
<nav data-role="navbar" id="topmenu">
<ul data-role="listview" >
   <li data-role="list-divider" class="selected"><span>C2P</span></li>
      <li><a href="oneway/home" data-icon="home">HOME</a>
         <ul data-role="listview">
            <li><a href="oneway/forreturnees">Returnee</a></li>
            <li><a href="oneway/forsponsors">Sponsor</a></li>
            <li><a href="oneway/faith">Christian</a></li>
            <li><a href="oneway/feedback">Feedback</a></li>
            <li ><a href="oneway/logout">Login</a></li>
        </ul>
    </li>
   <li><a href="member/memberhome">MEMBER</a>
       <ul data-role="listview">
            <li><a href="member/sysupdate">System Update</a></li>
            <li><a href="member/editmember">Edit Details</a></li>
            <li><a href="member/newpassword">New Password</a></li>
            <li><a href="member/newreferee">New Referee</a></li>
        </ul>
    </li>
   <li><a href="sponsor/sponsorhome">SPONSOR</a>
       <ul data-role="listview">
            <li><a href="sponsor/newreturnee">New Returnee</a></li>
            <li><a href="sponsor/myreturnees">My Returnees</a></li>
        </ul>
       
    </li>
   <li><a href="gatekeeper/gatekeeperhome">GATEKEEPER</a>
    <ul data-role="listview">
            <li><a href="gatekeeper/allchurches">Churches</a></li>
            <li><a href="gatekeeper/mygroups">Groups</a></li>
            <li><a href="gatekeeper/mycontacts">Contacts</a></li>
            <li><a href="gatekeeper/mydistricts">Districts</a></li>
            <li><a href="gatekeeper/myreferrals">Referrals</a></li>
        </ul>
    </li>
        <li><a href="sysadmin/systemhome">SYSTEM</a>
         <ul data-role="listview">
            <li><a href="sysadmin/allmembers">Members</a></li>
            <li><a href="sysadmin/allcontacts">Contacts</a></li>
            <li><a href="sysadmin/allchurches">Churches</a></li>
            <li><a href="sysadmin/allgroups">Groups</a></li>
            <li><a href="sysadmin/allreturnees">Returnees</a></li>
            <li><a href="sysadmin/allreferrals">Referrals</a></li>
        </ul>
    </li>
</ul>
</nav>        


<nav data-role="navbar" data-theme="a" id="main-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
   <a class="ui-btn topmenuitem" href="#">C2P</a>
   <a class="ui-btn topmenuitem" href="#">Menu2</a>
   <a class="ui-btn topmenuitem" href="#">Menu3</a>
   <a class="ui-btn topmenuitem" href="#">Menu4</a>
   <a class="ui-btn topmenuitem" href="#">Menu5</a>
</nav>
<nav data-role="navbar" data-theme="a" id="oneway-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
   <a class="ui-btn topmenuitem" href="#">Home</a>
   <a class="ui-btn topmenuitem" href="#">Menu2</a>
   <a class="ui-btn topmenuitem" href="#">Menu3</a>
   <a class="ui-btn topmenuitem" href="#">Menu4</a>
   <a class="ui-btn topmenuitem" href="#">Menu5</a>
</nav>
-->
<div id="after-primary-navigation"></div>
</div>

