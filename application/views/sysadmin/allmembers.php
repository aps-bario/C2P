<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> |
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>Members</b>
</div>
<script>
function ReOrder(ListOrder){
    if(document.forms[0].ListOrder.value === ListOrder){
        document.forms[0].ListOrder.value = ListOrder+' DESC';
    } else {
        document.forms[0].ListOrder.value = ListOrder;
    }
    document.forms[0].submit(); 
}
function Mimic(Email){
    document.forms[0].MimicEmail.value = Email;
    document.forms[0].action = 'sysadmin/mimicmember'
    document.forms[0].submit(); 
}
</script>
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
   <form name="MemberList" method="post">
   <input name="ListMemberID" type="hidden" value="" />
   <input name="NewStatus" type="hidden" value="" />
   <input name="MimicEmail" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />    
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <fieldset><legend>Members</legend>
   <table  data-role="table"  class="ui-mini ui-responsive ui-shadow" ><!-- data-mode="columntoggle"   report -->
       <thead>
      <tr>
         <th data-priority="10" style="cursor:pointer;" onclick="ReOrder('MemberID');">Mimic</th>
         <th data-priority="2" style="cursor:pointer;" onclick="ReOrder('FirstName');">First Name</th>
         <th data-priority="1" style="cursor:pointer;" onclick="ReOrder('LastName');">Last Name</th>
         <th data-priority="4" style="cursor:pointer;" onclick="ReOrder('Email');">Email</th>
         <th data-priority="3" style="cursor:pointer;" onclick="ReOrder('Status');">Status</th>
         <th data-priority="9" style="cursor:pointer;" onclick="ReOrder('Updated');">Registered</th>
         <th data-priority="6" style="cursor:pointer;" onclick="ReOrder('OptedIn');">OptedIn</th>
         <th data-priority="7" style="cursor:pointer;" onclick="ReOrder('Confirmed');">Confirmed</th>
         <th data-priority="8" style="cursor:pointer;" onclick="ReOrder('Forgotten');">Forgotten</th>
         <th data-priority="5" style="cursor:pointer;" onclick="ReOrder('LastVisited');">Last Visited</th>
      </tr>
      </thead>
      <TBODY>
<?php foreach($results as $row):?>
      <tr>
         <td nowrap><input type="button" value="<?=$row['MemberID'];?>" width="3"
            onclick="Mimic('<?=$row['Email'];?>');"/></td>
         <td nowrap><?=$row['FirstName'];?></td>
         <td nowrap><?=$row['LastName'];?></td>
         <td nowrap><?=$row['Email'];?></td>
                  <td><Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete user <?=$row['Email'];?>?')){
                  return(false);
               }
            }
            this.form.ListMemberID.value = '<?=$row['MemberID'];?>'; 
            this.form.NewStatus.value = this.value;
            this.form.PageMode.value = 'Update';
            this.form.submit();">
            <option value="Registered"<?=($row['Status'] == "Registered"?" Selected":"");?>>Registered</option>
            <option value="Verified"<?=($row['Status'] == "Verified"?" Selected":"");?>>Verified</option>
            <option value="Returnee"<?=($row['Status'] == "Returnee"?" Selected":"");?>>Returnee</option>
            <option value="Member"<?=($row['Status'] == "Member"?" Selected":"");?>>Member</option>
            <option value="Sponsor"<?=($row['Status'] == "Sponsor"?" Selected":"");?>>Sponsor</option>
            <option value="Gatekeeper"<?=($row['Status'] == "Gatekeeper"?" Selected":"");?>>Gatekeeper</option>
            <option value="SysAdmin"<?=($row['Status'] == "Admin"?" Selected":"");?>>Admin</option>
            <option value="SysAdmin"<?=($row['Status'] == "SysAdmin"?" Selected":"");?>>SysAdmin</option>
            <option value="Concerns"<?=($row['Status'] == "Concerns"?" Selected":"");?>>Concerns</option>
            <option value="Expired"<?=($row['Status'] == "Expired"?" Selected":"");?>>Expired</option>
            <option value="Forgotten"<?=($row['Status'] == "Forgotten"?" Selected":"");?>>Forgotten</option>
            <option value="<?=$row['Status'];?>"><?=$row['Status'];?> ??</option>
            <option value="Delete">Delete</option>
         </Select>
         </td>
         <td nowrap><?=substr($row['Updated'],0,10);?></td>
         <td nowrap><?=substr($row['OptedIn'],0,10);?></td>
         <td nowrap><?=substr($row['Confirmed'],0,10);?></td>
         <td nowrap><?=substr($row['Forgotten'],0,10);?></td>
         <td nowrap><?=$row['LastVisited'];?></td>
         
      </tr>
<?php endforeach;?>
      </TBODY>
   </table>
   </fieldset>
   </form>
   </small>
</DIV> <!-- content -->
