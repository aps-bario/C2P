<div class="topmenu">
<div class="topmenurow" id="main-menu">
   <a class="topmenuitem <?=($Menu=='oneway'?'active':'');?>" 
      href="/oneway/home" data-page-url="/oneway/home">ONEWAY</a><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='Sponsor' or $Status=='Gatekeeper'
        or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='member'?'active':'');?>" 
      href="/member/memberhome" data-page-url="/member/memberhome">Member</a><?php  
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='sponsor'?'active':'');?>" 
      href="/sponsor/sponsorhome" data-page-url="/sponsor/sponsorhome">Sponsor</a><?php  
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='gatekeeper'?'active':'');?>" 
      href="/gatekeeper/gatekeeperhome" data-page-url="/gatekeeper/gatekeeperhome">Gatekeeper</a><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' 
        OR $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='sysadmin'?'active':'');?>" 
      href="/sysadmin/sysadminhome" data-page-url="/sysadmin/sysadminhome">SysAdmin</a><?php  
}?>
</div><?php
if($Menu=='oneway'){?>
<div  class="topmenurow" id="oneway-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='oneway/home'?'active':'');?>"
     href="/oneway/home" data-page-url="oneway/home">Home</a> 
  <a class="topmenuitem <?=($NextPage=='oneway/forreturnees'?'active':'');?>"
     href="/oneway/forreturnees" data-page-url="oneway/forreturnees">Returnee</a>  
  <a class="topmenuitem <?=($NextPage=='oneway/forsponsors'?'active':'');?>"
     href="/oneway/forsponsors" data-page-url="oneway/forsponsors">Sponsor</a>    
  <a class="topmenuitem <?=($NextPage=='oneway/faith'?'active':'');?>"
     href="/oneway/faith" data-page-url="oneway/faith">Christian</a>  
  <a class="topmenuitem <?=($NextPage=='oneway/feedback'?'active':'');?>"
     href="/oneway/feedback" data-page-url="oneway/feedback">Feedback</a>
  <a class="topmenuitem <?=($NextPage=='oneway/newmember'?'active':'');?>"
     href="/oneway/newmember" data-page-url="oneway/newmember">Registration</a>  
   <a class="topmenuitem <?=($NextPage=='oneway/login'?'active':'');?>"
     href="/oneway/logout" data-page-url="/oneway/logout">Login</a> 
</div><?php
} elseif($Menu=='member'){?>
<div  class="topmenurow" id="member-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">

    <a class="topmenuitem <?=($NextPage=='member/memberhome'?'active':'');?>"
        href="/member/memberhome" data-page-url="/member/memberhome">MEMBER</a> 
    <a class="topmenuitem <?=($NextPage=='member/sysupdate'?'active':'');?>"
        href="/member/sysupdate" data-page-url="member/sysupdate">System Update</a><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='SysAdmin')){?>  
  <a class="topmenuitem <?=($NextPage=='member/editmember'?'active':'');?>"
     href="/member/editmember" data-page-url="/member/editmember">Edit Details</a>    
  <a class="topmenuitem <?=($NextPage=='member/newpassword'?'active':'');?>"
     href="/member/newpassword" data-page-url="/member/newpassword">New Password</a>  
  <a class="topmenuitem <?=($NextPage=='member/newreferee'?'active':'');?>"
     href="/member/newreferee" data-page-url="/member/newreferee">New Referee</a><?php
}      
if(isset($Status) and ($Status=='Member')){?>
  <a class="topmenuitem <?=($NextPage=='sponsor/newreturnee'?'active':'');?>"
     href="/sponsor/newreturnee" data-page-url="/sponsor/newreturnee">First Returnee</a><?php
}?>      
</div><?php
} elseif($Menu=='sponsor'){?>
<div  class="topmenurow" id="sponsor-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='sponsor/sponsorhome'?'active':'');?>"
     href="/sponsor/sponsorhome" data-page-url="sponsor/sponsorhome">SPONSOR</a><?php  
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?> 
  <a class="topmenuitem <?=($NextPage=='sponsor/newreturnee'?'active':'');?>"
     href="/sponsor/newreturnee" data-page-url="/sponsor/newreturnee">New Returnee</a>  
  <a class="topmenuitem <?=($NextPage=='sponsor/myreturnees'?'active':'');?>"
     href="/sponsor/myreturnees" data-page-url="/sponsor/myreturnees">My Returnees</a><?php  
}?>
</div><?php
} elseif($Menu=='gatekeeper'){?>
<div  class="topmenurow" id="gatekeeper-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='gatekeeper/gatekeeperhome'?'active':'');?>"
     href="/gatekeeper/gatekeeperhome" data-page-url="/gatekeeper/gatekeeperhome">GATEKEEPER</a> 
  <a class="topmenuitem <?=($NextPage=='gatekeeper/allchurches'?'active':'');?>"
     href="/gatekeeper/allchurches" data-page-url="/gatekeeper/allchurches">Churches</a>  
  <a class="topmenuitem <?=($NextPage=='gatekeeper/mygroups'?'active':'');?>"
     href="/gatekeeper/mygroups" data-page-url="/gatekeeper/mygroups">Groups</a>    
  <a class="topmenuitem <?=($NextPage=='gatekeeper/mycontacts'?'active':'');?>"
     href="/gatekeeper/mycontacts" data-page-url="/gatekeeper/mycontacts">My Contacts</a>  
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myplaces'?'active':'');?>"
     href="/gatekeeper/myplaces" data-page-url="/gatekeeper/myplaces">My Places</a>
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myreferrals'?'active':'');?>"
     href="/gatekeeper/myreferrals" data-page-url="/gatekeeper/myreferrals">My Referrals</a>   
</div><?php
} elseif($Menu=='sysadmin'){?>
<div  class="topmenurow" id="sysadmin-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='sysadmin/sysadminhome'?'active':'');?>"
     href="/sysadmin/sysadminhome" data-page-url="/sysadmin/sysadminhome">SYSTEM</a><?php  
if(isset($Status) and ($Status=='Admin'
        OR $Status=='SysAdmin')){?> 
  <a class="topmenuitem <?=($NextPage=='sysadmin/allmembers'?'active':'');?>"
     href="/sysadmin/allmembers" data-page-url="/sysadmin/allmembers">Members</a>  
  <a class="topmenuitem <?=($NextPage=='sysadmin/allcontacts'?'active':'');?>"
     href="/sysadmin/allcontacts" data-page-url="/sysadmin/allcontacts">Contacts</a>    
  <a class="topmenuitem <?=($NextPage=='sysadmin/allchurches'?'active':'');?>"
     href="/sysadmin/allchurches" data-page-url="/sysadmin/allchurches">Churches</a>  
  <a class="topmenuitem <?=($NextPage=='sysadmin/allgroups'?'active':'');?>"
     href="/sysadmin/allgroups" data-page-url="/sysadmin/allgroups">Groups</a>
  <a class="topmenuitem <?=($NextPage=='sysadmin/allreturnees'?'active':'');?>"
     href="/sysadmin/allreturnees" data-page-url="/sysadmin/allreturnees">Returnees</a>  
   <a class="topmenuitem <?=($NextPage=='sysadmin/allreferrals'?'active':'');?>"
     href="/sysadmin/allreferrals" data-page-url="/sysadmin/allreferrals">Referrals</a><?php
    }?> 
</div>
<?php
}?>
</div>

<?php if(false){ ?>
<!--
<nav data-role="navbar" id="topmenu">
<ul data-role="listview" >
   <li data-role="list-divider" class="selected"><span>ONEWAY</span></li>
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
-->
<?php
}?>


