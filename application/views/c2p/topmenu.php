<div class="topmenu">
<div class="topmenurow" id="main-menu">
   <a class="topmenuitem <?=($Menu=='c2p'?'active':'');?>" 
      href="/c2p/home" data-page-url="/c2p/home">HOME</a><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='Sponsor' or $Status=='Gatekeeper'
        or $Status=='Watchman' or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='member'?'active':'');?>" 
      href="/member/member" data-page-url="/member/member">Member</a><?php  
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='Watchman' or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='sponsor'?'active':'');?>" 
      href="/sponsor/sponsor" data-page-url="/sponsor/sponsor">Sponsor</a><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' or $Status=='Watchman' 
        or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='gatekeeper'?'active':'');?>" 
      href="/gatekeeper/gatekeeper" data-page-url="/gatekeeper/gatekeeper">Gatekeeper</a><?php  
}
if(isset($Status) and ($Status=='CityWatch' or $Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='citywatch'?'active':'');?>" 
      href="/citywatch/citywatch" data-page-url="/citywatch/citywatch">CityWatch</a><?php  
}
if(isset($Status) and ($Status=='CityWatch' or $Status=='SysAdmin')){?>
<!--   <a class="topmenuitem <?=($Menu=='reports'?'active':'');?>" 
      href="/reports/reports" data-page-url="/reports/reports">Reports</a>--><?php  
}
if(isset($Status) and ($Status=='SysAdmin')){?>
   <a class="topmenuitem <?=($Menu=='sysadmin'?'active':'');?>" 
      href="/sysadmin/sysadmin" data-page-url="/sysadmin/sysadmin">SysAdmin</a><?php  
}?>    
</div><?php
if($Menu=='c2p'){?>
<div  class="topmenurow" id="c2p-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='c2p/home'?'active':'');?>"
     href="/c2p/home" data-page-url="c2p/home">Welcome</a> 
  <a class="topmenuitem <?=($NextPage=='c2p/forreturnees'?'active':'');?>"
     href="/c2p/forreturnees" data-page-url="c2p/forreturnees">Returnee</a>  
  <a class="topmenuitem <?=($NextPage=='c2p/forsponsors'?'active':'');?>"
     href="/c2p/forsponsors" data-page-url="c2p/forsponsors">Sponsor</a>    
  <a class="topmenuitem <?=($NextPage=='c2p/faith'?'active':'');?>"
     href="/c2p/faith" data-page-url="c2p/faith">Our Beliefs</a>  
  <a class="topmenuitem <?=($NextPage=='c2p/feedback'?'active':'');?>"
     href="/c2p/feedback" data-page-url="c2p/feedback">Feedback</a>
  <a class="topmenuitem <?=($NextPage=='c2p/newmember'?'active':'');?>"
     href="/c2p/newmember" data-page-url="c2p/newmember">Register</a>  
  <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='member'){?>
<div  class="topmenurow" id="member-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">

    <a class="topmenuitem <?=($NextPage=='member/member'?'active':'');?>"
        href="/member/member" data-page-url="/member/member">MEMBER</a>  
    <a class="topmenuitem <?=($NextPage=='member/newreference'?'active':'');?>"
     href="/member/newreference" data-page-url="/member/newreference">New Reference</a> 
    <a class="topmenuitem <?=($NextPage=='member/accesslevels'?'active':'');?>"
        href="/member/accesslevels" data-page-url="member/accesslevels">Access Levels</a>
    <a class="topmenuitem <?=($NextPage=='member/sysupdate'?'active':'');?>"
        href="/member/sysupdate" data-page-url="member/sysupdate">System Update</a><?php  
    if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='SysAdmin')){?>  
  <a class="topmenuitem <?=($NextPage=='member/editmember'?'active':'');?>"
     href="/member/editmember" data-page-url="/member/editmember">Edit Details</a>    
  <a class="topmenuitem <?=($NextPage=='member/newpassword'?'active':'');?>"
     href="/member/newpassword" data-page-url="/member/newpassword">New Password</a><?php
    }      
    if(isset($Status) and ($Status=='Member')){?>
  <a class="topmenuitem <?=($NextPage=='sponsor/newreturnee'?'active':'');?>"
     href="/sponsor/newreturnee" data-page-url="/sponsor/newreturnee">First Returnee</a><?php
    }?>
    <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='sponsor'){?>
<div  class="topmenurow" id="sponsor-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='sponsor/sponsor'?'active':'');?>"
     href="/sponsor/sponsor" data-page-url="sponsor/sponsor">SPONSOR</a><?php  
    if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?> 
  <a class="topmenuitem <?=($NextPage=='sponsor/newreturnee'?'active':'');?>"
     href="/sponsor/newreturnee" data-page-url="/sponsor/newreturnee">New Returnee</a>  
  <a class="topmenuitem <?=($NextPage=='sponsor/myreturnees'?'active':'');?>"
     href="/sponsor/myreturnees" data-page-url="/sponsor/myreturnees">My Returnees</a><?php  
    }?>
    <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='gatekeeper'){?>
<div  class="topmenurow" id="gatekeeper-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='gatekeeper/gatekeeper'?'active':'');?>"
     href="/gatekeeper/gatekeeper" data-page-url="/gatekeeper/gatekeeper">GATEKEEPER</a> 
  <a class="topmenuitem <?=($NextPage=='gatekeeper/allchurches'?'active':'');?>"
     href="/gatekeeper/allchurches" data-page-url="/gatekeeper/allchurches">Churches</a>  
  <!--<a class="topmenuitem <?=($NextPage=='gatekeeper/mygroups'?'active':'');?>"
     href="/gatekeeper/mygroups" data-page-url="/gatekeeper/mygroups">Groups</a>    
  <a class="topmenuitem <?=($NextPage=='gatekeeper/mycontacts'?'active':'');?>"
     href="/gatekeeper/mycontacts" data-page-url="/gatekeeper/mycontacts">My Contacts</a> --> 
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myplaces'?'active':'');?>"
     href="/gatekeeper/myplaces" data-page-url="/gatekeeper/myplaces">My Places</a>
  <!--onClick="Mobile(this.href);return(false);"-->
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myreferrals'?'active':'');?>"
     href="/gatekeeper/myreferrals" data-page-url="/gatekeeper/myreferrals">My Referrals</a>
  <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='citywatch'){?>
<div  class="topmenurow" id="gatekeeper-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='citywatch/citywatch'?'active':'');?>"
     href="/citywatch/citywatch" data-page-url="/citywatch/citywatch">CITYWATCH</a> 
  <a class="topmenuitem <?=($NextPage=='citywatch/cityreferrals'?'active':'');?>"
     href="/citywatch/cityreferrals" data-page-url="/citywatch/myreferrals">City Referrals</a>
  <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='reports'){?>
<div  class="topmenurow" id="gatekeeper-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='reports/reports'?'active':'');?>"
     href="/reports/reports" data-page-url="/reports/reports">REPORTS</a> 
  <a class="topmenuitem <?=($NextPage=='gatekeeper/allchurches'?'active':'');?>"
     href="/gatekeeper/allchurches" data-page-url="/gatekeeper/allchurches">Churches</a>  
  <a class="topmenuitem <?=($NextPage=='gatekeeper/mygroups'?'active':'');?>"
     href="/gatekeeper/mygroups" data-page-url="/gatekeeper/mygroups">Groups</a>    
  <a class="topmenuitem <?=($NextPage=='gatekeeper/mycontacts'?'active':'');?>"
     href="/gatekeeper/mycontacts" data-page-url="/gatekeeper/mycontacts">My Contacts</a>  
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myplaces'?'active':'');?>"
     onClick="Mobile(this.href);return(false);"
     href="/gatekeeper/myplaces" data-page-url="/gatekeeper/myplaces">My Places</a>
  <a class="topmenuitem <?=($NextPage=='gatekeeper/myreferrals'?'active':'');?>"
     href="/gatekeeper/myreferrals" data-page-url="/gatekeeper/myreferrals">My Referrals</a>
  <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
} elseif($Menu=='sysadmin'){?>
<div  class="topmenurow" id="sysadmin-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
  <a class="topmenuitem <?=($NextPage=='sysadmin/sysadmin'?'active':'');?>"
     href="/sysadmin/sysadmin" data-page-url="/sysadmin/sysadmin">SYSADMIN</a><?php  
if(isset($Status) and ($Status=='Admin'
        OR $Status=='SysAdmin')){?> 
  <a class="topmenuitem <?=($NextPage=='sysadmin/allmembers'?'active':'');?>"
     href="/sysadmin/allmembers" data-page-url="/sysadmin/allmembers">Members</a>  
<!--  <a class="topmenuitem <?=($NextPage=='sysadmin/allcontacts'?'active':'');?>"
     href="/sysadmin/allcontacts" data-page-url="/sysadmin/allcontacts">Contacts</a>    
  <a class="topmenuitem <?=($NextPage=='sysadmin/allgroups'?'active':'');?>"
     href="/sysadmin/allgroups" data-page-url="/sysadmin/allgroups">Groups</a>-->
  <a class="topmenuitem <?=($NextPage=='sysadmin/membertree'?'active':'');?>"
     href="/sysadmin/membertree" data-page-url="/sysadmin/membertree">Member Tree</a>  
  <a class="topmenuitem <?=($NextPage=='sysadmin/allplaces'?'active':'');?>"
     href="/sysadmin/allplaces" data-page-url="/sysadmin/allplaces">Places</a>  
  <a class="topmenuitem <?=($NextPage=='sysadmin/allreturnees'?'active':'');?>"
     href="/sysadmin/allreturnees" data-page-url="/sysadmin/allreturnees">Returnees</a>  
   <a class="topmenuitem <?=($NextPage=='sysadmin/allreferrals'?'active':'');?>"
     href="/sysadmin/allreferrals" data-page-url="/sysadmin/allreferrals">Referrals</a>
   <a class="topmenuitem <?=($NextPage=='sysadmin/allchurches'?'active':'');?>"
     href="/sysadmin/allchurches" data-page-url="/sysadmin/allchurches">Churches</a>  
<?php
    }?>
    <a class="topmenuitem <?=($NextPage=='c2p/login'?'active':'');?>"
     href="/c2p/logout" data-page-url="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
</div><?php
}?>  
</div>
<script type="text/javascript">
function Mobile(url) {
    mobile = new window.open(url,'Mobile','height=480,width=320,resizable');
    if (window.focus) {mobile.focus()}
}
</script>



