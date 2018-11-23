<!--<DIV class="leftmenu">
<DIV class="leftmenuitem">
  <a href="../sponsor/sponsorhome.php">SPONSORS</a>
</DIV><?php  
if(isset($Status) and ($Status=='Member' // Only to allow initial New Returnee
        or $Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin'or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../sponsor/returneesecurity.php">Security</a>
</DIV><?php  
} 
if(isset($Status) and ($Status=='Member' // Only to allow initial New Returnee
        or $Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin'or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../sponsor/newreturnee.php">New Returnee</a>
</DIV><?php  
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        OR $Status=='SysAdmin'or $Status=='Admin')){?>  
<DIV class="leftmenuitem">
  <a href="../sponsor/myreturnees.php">My Returnees</a>
</DIV><?php  
}
if(FALSE and isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        OR $Status=='SysAdmin'or $Status=='Admin')){?>
<DIV class="leftmenuitem">
  <a href="../sponsor/summary.php">My Summary</a>
</DIV><?php  
}?>
</DIV>-->