<DIV class="content">
<div class="breadcrumb">
<a href="../oneway/homte.php">Oneway</a> | 
<a href="../gatekeeper/gatekeeperhome.php">Gatekeepers</a> | 
<b>All locations</b>
</DIV>>
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
   <form name="MyContacts" method="post">
   <input name="ContactID" type="hidden" value="" />
   <input name="NewStatus" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <fieldset><legend>Members</legend>
   <table class="report" width="60">
      <tr>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'MemberID'; pageform.submit();">ID</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Email'; pageform.submit();">User Email</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'FirstName'; pageform.submit();">First Name</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'LastName'; pageform.submit();">Last Name</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Status'; pageform.submit();">Status</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Registered'; pageform.submit();">Registered</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Update'; pageform.submit();">Last Visited</th>
      </tr>
<?php foreach($results as $row):?>
      <tr>
         <td><?=$row['ContactID'];?></td>
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td><Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete user <?=$row['Email'];?>?')){
                  return(false);
               }
            }
            this.form.ContactID.value = '<?=$row['ContactID'];?>'; 
            this.form.NewStatus.value = this.value;
            this.form.PageMode.value = 'Update';
            this.form.submit();">
            <option value="Active"<?php echo ($row['Status'] == "Active"?" Selected":"");?>>Active</option>
            <option value="Dormant"<?php echo ($row['Status'] == "Dormant"?" Selected":"");?>>Dormant</option>
	    <option value="Expired"<?php echo ($row['Status'] == "Expired"?" Selected":"");?>>Expired</option>
            <option value="Concerns"<?php echo ($row['Status'] == "Concerns"?" Selected":"");?>>Concerns</option>
            <option value="Delete">Delete</option>
         </Select>
         </td>
      </tr>
<?php endforeach;?>
   </table>
   </fieldset>
   </form>
   </small>
</DIV> <!-- content -->
