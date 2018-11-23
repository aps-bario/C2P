<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> |
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>Member Tree</b>
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
   <fieldset><legend>Member Tree by Organisation</legend>
   <table  data-role="table"  class="ui-mini ui-responsive ui-shadow" >
      <TBODY>
<?php foreach($results as $row):?>
      <tr>
          <td>|<?php for($l=1;$l<=$row['TreeLevel'];$l++){?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|<?php }?>--->
              <b><?=$row['FirstName'];?> <?=$row['LastName'];?> </b>
              [<?=$row['MemberID'];?>] </td>
          <td><?=$row['Email'];?> </td>
          <td><?=$row['Mobile'];?></td>
          <td><?=$row['Status'];?></td>
      </tr>
<?php endforeach;?>
      </TBODY>
   </table>
   </fieldset>
   </form>
   </small>
</DIV> <!-- content -->
