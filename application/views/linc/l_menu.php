<div data-role="panel" id="sidemenu" data-display="overlay" data-theme='l'>
    <ul data-role="listview"><?php  
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
        <li><a href="/linc/member" data-role="list-divider" class="ui-btn ui-icon-home ui-btn-icon-left ui-li-divider">MEMBER</a></li>
        <li><a href="/linc/sysupdate" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">System Update</a></li>
        <li><a href="/linc/editmember" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Edit Details</a></li>
        <li><a href="/linc/newpassword" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">New Password</a></li>
        <li><a href="/linc/newreference" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">New Reference</a></li><?php
} else {?>
        <li><a href="/linc/home" data-role="list-divider" class="ui-btn ui-icon-home ui-btn-icon-left ui-li-divider">HOME</a></li>
        <li><a href="/linc/forreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Returnee</a></li>
        <li><a href="/linc/forsponsors" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Sponsor</a></li>
        <li><a href="/linc/faith" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Christian</a></li>
        <li><a href="/linc/newmember" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Register</a></li>
        <li><a href="/linc/login" class="ui-btn ui-icon-lock ui-btn-icon-left">Login</a></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
        <li><a href="/linc/sponsor" data-role="list-divider" class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">SPONSOR</a></li>
        <li><a href="/linc/newreturnee" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">New Returnee</a></li>  
    <!--<li><a href="/linc/myreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">My Returnees</a></li>--><?php
}
if(isset($Status) and ($Status=='Gatekeeper' OR $Status=='SysAdmin')){?>
         <li><a href="/linc/gatekeeper" data-role="list-divider" class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">GATEKEEPER</a></li>
         <li><a href="/linc/myplaces" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">My Places</a></li>

         <!--         <li><a href="/linc/allchurches" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Churches</a></li>
         <li><a href="/linc/mygroups" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Groups</a></li>
         <li><a href="/linc/mycontacts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Contacts</a></li>
            <li><a href="/linc/mydistricts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Districts</a></li>
         <li><a href="/linc/myreferrals" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Referrals</a></li>-->
         <li><a href="/c2p/home " class="ui-btn ui-icon-arrow-r ui-btn-icon-left">C2P Website</a></li><?php
}
if(isset($Status) and ($Status=='SysAdmin')){?>
<!--         <li><a href="/linc/sysadmin" data-role="list-divider"    class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">SYSADMIN</a></li>
         <li><a href="/linc/allmembers" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Members</a></li>
         <li><a href="/linc/allcontacts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Contacts</a></li>
         <li><a href="/linc/allchurches" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Churches</a></li>
         <li><a href="/linc/allgroups" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Groups</a></li>
         <li><a href="/linc/allreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Returnees</a></li>
         <li><a href="/linc/allreferrals" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Referrals</a></li>--><?php
}                
if(isset($Status) and ($Status=='Registered' or $Status=='Verified' or $Status=='Concerns' 
    or $Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
         <li><a href="/linc/feedback" class="ui-btn ui-icon-info ui-btn-icon-left">Feedback</a></li>
         <li><a href="/linc/logout" class="ui-btn ui-icon-lock ui-btn-icon-left">Logout</a></li><?php
}?>     
    </ul>
</div>
