<!--<div width="100%" style="position:absolute; overflow:auto;" >-->
<div id='cssmenu' style="position:absolute; top:124px;">
<ul>
   <li class='has-sub'><a href="../oneway/home.php"><span>C2P</span></a>
      <ul>
         <li><a href="../oneway/home.php"><span>Welcome</span></a></li>
         <li><a href="../oneway/forreturnees.php"><span>Returnees</span></a></li>
         <li><a href="../oneway/forsponsors.php"><span>Sponsors</span></a></li><?php  
   if(isset($UserStatus) and ($UserStatus=='Sponsor' or $UserStatus=='Member'
      or $UserStatus=='Sponsor' or $UserStatus=='Gatekeeper' 
      or $UserStatus=='SysAdmin' or $UserStatus=='Admin')){?>
         <li><a href="../oneway/forreferees.php"><span>Referees</span></a></li>
         <li><a href="../oneway/forgatekeepers.php"><span>Gatekeepers</span></a></li><?php  
   }?>
         <li><a href="../oneway/newmember.php"><span>Registration</span></a></li><?php  
   if(isset($UserStatus) and ($UserStatus=='Registered' or $UserStatus=='Verified' 
      or $UserStatus=='Member' or $UserStatus=='Sponsor' or $UserStatus=='Gatekeeper' 
      or $UserStatus=='SysAdmin' or $UserStatus=='Admin')){?>
         <li><a href="../oneway/newreferee.php"><span>New Referee</span></a></li>
         <li><a href="../oneway/newreturnee.php"><span>New Returnee</span></a></li><?php
   }?>  
         <li><a href="../oneway/faith.php"><span>Our Faith</span></a></li>  
         <li class='last'><a href="../oneway/contactus.php"><span>Contact Us</span></a></li>
      </ul>
   </li><?php  
if(isset($Status) and ($Status=='Registered'
        or $Status=='Verified'
        or $Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
   <li class='has-sub'><a href="../member/memberhome.php"><span>Member</span></a>
      <ul>
         <!--<li><a href="../member/membersecurity.php">Security</a></li>-->
         <li><a href="../member/newreferee.php">New Referee</a></li><?php  
   if(isset($Status) and ($Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
         <li><a href="../sponsor/newreturnee.php">New Returnee</a></li>
         <li><a href="../sponsor/myreturnees.php">My Returnees</a></li>
         <!--<li><a href="../member/summary.php">My Summary</a></li>--><?php  
   }?>
      </ul>
   </li><?php  
}
if(isset($Status) and ($Status=='Member' // Only to allow initial New Returnee
        or $Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin'or $Status=='Admin')){?>
   <li class='has-sub'><a href="../sponsor/sponsorhome.php"><span>Sponsor</span></a>
      <ul>
         <!--<li><a href="../sponsor/returneesecurity.php">Security</a></li>-->
         <li><a href="../sponsor/newreturnee.php">New Returnee</a></li><?php
   if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        OR $Status=='SysAdmin'or $Status=='Admin')){?>  
        <li><a href="../sponsor/myreturnees.php">My Returnees</a></li>
        <!--<li><a href="../sponsor/summary.php">My Summary</a></li>--><?php  
   }?>
      </ul>
   </li><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' 
        OR $Status=='SysAdmin'
        or $Status=='Admin')){?>
   <li class='has-sub'><a href='../gatekeeper/gatekeeperhome.php'><span>Gatekeeper</span></a>
      <ul>
         <!--<li><a href="../gatekeeper/contactsecurity.php">Security</a><li>-->
         <li><a href="../gatekeeper/allchurches.php">Amity Churches</a></li>
         <li><a href="../gatekeeper/mygroups.php">My Groups</a></li>
         <li><a href="../gatekeeper/newcontacts.php">New Contacts</a></li>
         <li><a href="../gatekeeper/mycontacts.php">My Contacts</a></li>
         <li><a href="../gatekeeper/myreferrals.php">My Referrals</a></li>
      </ul>
   </li><?php  
}
if(isset($Status) and ($Status=='Admin'
        OR $Status=='SysAdmin')){?>
   <li class='has-sub'><a hhref="../sysadmin/sysadminhome.php"><span>SysAdmin</span></a>
      <ul>
         <li><a href="../sysadmin/allmembers.php">Members</a></li>
         <li><a href="../sysadmin/allcontacts.php">Contacts</a></li>
         <li><a href="../sysadmin/allchurches.php">Churches</a></li>
         <li><a href="../sysadmin/allgroups.php">Groups</a></li>
         <li><a href="../sysadmin/allreturnees.php">Returnees</a></li>
         <li><a href="../sysadmin/allreferrals.php">Referrals</a></li>
         <li class='has-sub'><a href='#'><span>Reports</span></a>
         <ul>
            <li><a href='#'><span>Report 1</span></a></li>
            <li><a href='#'><span>Report 2</span></a></li>
            <li><a href='#'><span>Report 3</span></a></li>
            <li><a href='#'><span>Report 4</span></a></li>
            <li><a href='#'><span>Report 5</span></a></li>
            <li class='last'><a href='#'><span>Report 6</span></a>
            
            </li>
         </ul>
         </li>
      </ul>
   </li><?php  
}?>
   <li class='last'><a href='../oneway/login.php'><span>Login</span></a></li>
</ul>
</div>   <!--
</div>-->
<DIV class="page">