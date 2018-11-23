<DIV class="content">
<small>
<a href="../oneway/home">Oneway</a> | 
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>List Members</b>
</small>
<script>
function ReOrder(ListOrder){
    if(document.forms[0].ListOrder.value == ListOrder){
        document.forms[0].ListOrder.value = ListOrder+' DESC';
    } else {
        document.forms[0].ListOrder.value = ListOrder;
    }
    document.forms[0].submit(); 
}
</script>    
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
   <form name="MemberList" method="post">
   <input name="ListMemberID" type="hidden" value="" />
   <input name="NewStatus" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <fieldset><legend>Members</legend>
   <table class="report" width="60">
      <tr>
         <th style="cursor:hand;" onclick="ReOrder('MemberID');">ID</th>
         <th style="cursor:hand;" onclick="ReOrder('Email');">Email</th>
         <th style="cursor:hand;" onclick="ReOrder('FirstName');">First Name</th>
         <th style="cursor:hand;" onclick="ReOrder('LastName');">Last Name</th>
         <th style="cursor:hand;" onclick="ReOrder('Status');">Status</th>
         <th style="cursor:hand;" onclick="ReOrder('Registered');">Registered</th>
         <th style="cursor:hand;" onclick="ReOrder('Updated');">Last Visited</th>
      </tr>
<?php foreach($results as $row):?>
      <tr>
         <td><?=$row['MemberID'];?></td>
         <td nowrap><?=$row['Email'];?></td>
         <td nowrap><?=$row['FirstName'];?></td>
         <td nowrap><?=$row['LastName'];?></td>
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
            <option value="<?=$row['Status'];?>"><?=$row['Status'];?> ??</option>
            <option value="Delete">Delete</option>
         </Select>
         </td>
         <td nowrap><?=$row['Updated'];?></td>
         <td nowrap><?=$row['LastVisited'];?></td>
      </tr>
<?php endforeach;?>
   </table>
   </fieldset>
   </form>
   </small>
</DIV> <!-- content -->
