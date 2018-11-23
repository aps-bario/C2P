    <div data-role="panel" id="sidemenu" data-display="push" data-theme='<!-- comment -->'>
    <ul data-role="listview"><?php  
if(isset($Status) and ($Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
        <li><a href="/mobile/member" data-role="list-divider" class="ui-btn ui-icon-home ui-btn-icon-left ui-li-divider">MY ACCOUNT</a></li>
        <li><a href="/mobile/sysupdate" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">System Updates</a></li>
        <li><a href="/mobile/editmember" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Edit My Details</a></li>
        <li><a href="/mobile/newpassword" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Change Password</a></li>
        <li><a href="/mobile/newreference" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Add Reference</a></li><?php
} else {?>
        <li><a href="/mobile/home" data-role="list-divider" class="ui-btn ui-icon-home ui-btn-icon-left ui-li-divider">HOME</a></li>
        <li><a href="/mobile/forreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Returnee</a></li>
        <li><a href="/mobile/forsponsors" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Sponsor</a></li>
        <li><a href="/mobile/faith" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Christian</a></li>
        <li><a href="/mobile/newmember" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Register</a></li>
        <li><a href="/mobile/login" class="ui-btn ui-icon-lock ui-btn-icon-left">Login</a></li><?php
}
if(isset($Status) and ($Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
        <li><a href="/mobile/sponsor" data-role="list-divider" class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">RETURNEES</a></li>
        <li><a href="/mobile/newreturnee" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">New Returnee</a></li>  
    <!--<li><a href="/mobile/myreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">My Returnees</a></li>--><?php
}
if(isset($Status) and ($Status=='Gatekeeper' OR $Status=='SysAdmin')){?>
         <li><a href="/mobile/gatekeeper" data-role="list-divider" class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">GATEKEEPER</a></li>
         <li><a href="/mobile/myplaces" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">My Places</a></li>
<!--         <li><a href="/mobile/allchurches" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Churches</a></li>
         <li><a href="/mobile/mygroups" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Groups</a></li>
         <li><a href="/mobile/mycontacts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Contacts</a></li>
            <li><a href="/mobile/mydistricts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Districts</a></li>
         <li><a href="/mobile/myreferrals" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Referrals</a></li>-->
         <li><a href="/c2p/home " class="ui-btn ui-icon-arrow-r ui-btn-icon-left">C2P Website</a></li><?php
}
if(isset($Status) and ($Status=='SysAdmin')){?>
<!--         <li><a href="/mobile/sysadmin" data-role="list-divider"    class="ui-btn ui-icon-arrow-r ui-btn-icon-left ui-li-divider">SYSADMIN</a></li>
         <li><a href="/mobile/allmembers" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Members</a></li>
         <li><a href="/mobile/allcontacts" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Contacts</a></li>
         <li><a href="/mobile/allchurches" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Churches</a></li>
         <li><a href="/mobile/allgroups" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Groups</a></li>
         <li><a href="/mobile/allreturnees" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Returnees</a></li>
         <li><a href="/mobile/allreferrals" class="ui-btn ui-icon-arrow-r ui-btn-icon-left">Referrals</a></li>--><?php
}                
if(isset($Status) and ($Status=='Registered' or $Status=='Verified' or $Status=='Concerns' 
    or $Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
         <li><a href="/mobile/feedback" class="ui-btn ui-icon-info ui-btn-icon-left">Feedback</a></li>
         <li><a href="/mobile/logout" class="ui-btn ui-icon-lock ui-btn-icon-left">Logout</a></li><?php
}?>     
    </ul>
</div>
