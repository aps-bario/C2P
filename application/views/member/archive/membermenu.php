<!--<DIV class="leftmenu">
<DIV class="leftmenuitem">
  <a href="../member/memberhome.php">MEMBERS</a>
</DIV><?php  
if(isset($Status) and ($Status=='Registered'
        or $Status=='Verified'
        or $Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../member/membersecurity.php">Security</a>
</DIV><?php  
} 
if(isset($Status) and ($Status=='Verified'
        or $Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../member/newreferee.php">New Referee</a>
</DIV><?php  
} 
if(isset($Status) and ($Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../sponsor/newreturnee.php">New Returnee</a>
</DIV><?php  
}
if(isset($Status) and ($Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>  
<DIV class="leftmenuitem">
  <a href="../sponsor/myreturnees.php">My Returnees</a>
</DIV><?php  
}
if(isset($Status) and ($Status=='Member'
        or $Status=='Sponsor'
        or $Status=='Gatekeeper'
        or $Status=='SysAdmin' 
        or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../member/summary.php">My Summary</a>
</DIV><?php  
}?>
</DIV>-->