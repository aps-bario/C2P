<!--<DIV class="leftmenu">
<DIV class="leftmenuitem">
  <a href="../oneway/home.php">WELCOME</a>
</DIV>  
<DIV class="leftmenuitem">
  <a href="../oneway/about.php">About Oneway</a>
</DIV>
<DIV class="leftmenuitem">
  <a href="../oneway/forreturnees.php">Returnees</a>
</DIV>  
<DIV class="leftmenuitem">
  <a href="../oneway/forsponsors.php">Sponsors</a>
</DIV>  <?php  
if(isset($UserStatus)   
	and ($UserStatus=='Sponsor' 
	or $UserStatus=='Member'
	or $UserStatus=='Sponsor'
	or $UserStatus=='Gatekeeper'
	or $UserStatus=='SysAdmin'
	or $UserStatus=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../oneway/forreferees.php">Referees</a>
</DIV>  <?php  
}
if(isset($UserStatus)   
	and ($UserStatus=='Member'
	or $UserStatus=='Sponsor'
	or $UserStatus=='Gatekeeper'
	or $UserStatus=='SysAdmin'
	or $UserStatus=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../oneway/forgatekeepers.php">Gatekeepers</a>
</DIV>  <?php  
}?>
<DIV class="leftmenuitem">
  <a href="../oneway/newmember.php">Registration</a>
</DIV>  <?php  
if(isset($UserStatus)   
	and ($UserStatus=='Registered' 
   or $UserStatus=='Verified' 
	or $UserStatus=='Member'
	or $UserStatus=='Sponsor'
	or $UserStatus=='Gatekeeper'
	or $UserStatus=='SysAdmin'
	or $UserStatus=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../oneway/newreferee.php">New Referee</a>
</DIV> <?php
}
if(isset($UserStatus)   
	and ($UserStatus=='Registered' 
   or $UserStatus=='Verified' 
	or $UserStatus=='Member'
	or $UserStatus=='Sponsor'
	or $UserStatus=='Gatekeeper'
	or $UserStatus=='SysAdmin'
	or $UserStatus=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../oneway/newreturnee.php">New Returnee</a>
</DIV> <?php
}?>  
<DIV class="leftmenuitem">
  <a href="../oneway/faith.php">Our Faith</a>
</DIV>  
<DIV class="leftmenuitem">
  <a href="../oneway/contactus.php">Contact Us</a>
</DIV>  
</DIV>-->