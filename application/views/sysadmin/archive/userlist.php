<DIV class="content">
<small>
<a href="../public/home.php">Home</a> | 
<a href="../admin/adminhome.php">Admin</a> | 
<b>User List</b>
</small>
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
   <form name="UserList" method="post">
   <input name="UserID" type="hidden" value="" />
   <input name="Status" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <fieldset><legend>User Listing</legend>
   <table class="report" width="60">
      <tr>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'UserID'; pageform.submit();">ID</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Email'; pageform.submit();">User Email</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'GivenName'; pageform.submit();">First Name</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'FamilyName'; pageform.submit();">Last Name</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Status'; pageform.submit();">Status</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'Registered'; pageform.submit();">Registered</th>
         <th style="cursor:hand;" onclick="pageform.ListOrder.value = 'LastVisited'; pageform.submit();">Last Visited</th>
      </tr>
<?php foreach($results as $row):?>
      <tr>
         <td><?=$row['UserID'];?></td>
         <td nowrap><?=$row['Email'];?></td>
         <td nowrap><?=$row['FirstName'];?></td>
         <td nowrap><?=$row['LastName'];?></td>
         <td><Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete user <?=$row['Email'];?>?')){
                  return(false);
               }
            }
            this.form.UserID.value = '<?=$row['UserID'];?>'; 
            this.form.Status.value = this.value;
            this.form.PageMode.value = 'Update';
            this.form.submit();">
            <option value="Register"<?php echo ($row['Status'] == "NewUser"?" Selected":"");?>>NewUser</option>
            <option value="Guest"<?php echo ($row['Status'] == "Guest"?" Selected":"");?>>Guest</option>
            <option value="Helper"<?php echo ($row['Status'] == "Helper"?" Selected":"");?>>Helper</option>
            <option value="Host"<?php echo ($row['Status'] == "Host"?" Selected":"");?>>Host</option>
            <option value="Admin"<?php echo ($row['Status'] == "Admin"?" Selected":"");?>>Admin</option>
            <option value="Expired"<?php echo ($row['Status'] == "Expired"?" Selected":"");?>>Expired</option>
            <option value="Delete">Delete</option>
         </Select>
         </td>
         <td nowrap><?=$row['Registered'];?></td>
         <td nowrap><?=$row['LastVisited'];?></td>
      </tr>
<?php endforeach;?>
   </table>
   </fieldset>
   </form>
   </small>
</DIV> <!-- content -->
