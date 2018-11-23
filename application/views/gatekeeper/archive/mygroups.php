<DIV class="content">
<div class="breadcrumb">
<a href="../oneway/home">Oneway</a> | 
<a href="../gatekeeper/gatekeeperhome">Gatekeeper</a> | 
<b>My Groups</b>
</DIV>
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
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
   <form id="myform" method="post">
   <input name="GroupID" type="hidden" value="" />
   <!--<input name="NewStatus" type="hidden" value="" />-->    
   <input name="ListOrder" type="hidden" 
          value="<?=(isset($ListOrder)?$ListOrder:'Country, Province, City, District');?>" />
   <input name="PageMode" type="hidden" value="<?=(isset($PageMode)?$PageMode:'List');?>" />
   <fieldset><legend>Locations where I know of groups</legend>
   <table class="report" width="60">
       <tr><td colspan="5">Below is a list of locations where you are currently 
          recorded as knowing groups that returnees might be introduced to. 
           
          </td>
          <td>
           <input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.NewStatus.value='';
                this.form.submit();}"/>
         </td>
       </tr>
      <tr>
         <!--<th style="cursor:pointer;" onclick="ReOrder('GroupID');">ID</th>-->
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('GroupAlias');">Alias</th>
         <th style="cursor:pointer;" onclick="ReOrder('Status');">Status</th>
      </tr>
            <tr>
         <td>
            <select name="Country" onchange="this.form.submit();">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City" onchange="this.form.submit();">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td nowrap>
            <select name="District" onchange="this.form.submit();">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $district){?>
               <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>      
         </td>
         <td nowrap><Select name="NewStatus" onchange="this.form.submit();">
            <option value=""></option>
            <option value="Active"<?=($NewStatus == 'Active'?' Selected':'');?>>Active</option>
            <option value="Dormant"<?=($NewStatus == 'Dormant'?' Selected':'');?>>Dormant</option>
	    <option value="Expired"<?=($NewStatus == 'Expired'?' Selected':'');?>>Expired</option>
            <option value="Concerns"<?=($NewStatus == 'Concerns'?' Selected':'');?>>Concerns</option>
         </Select>
         
      </tr>

<?php foreach($results as $row):?>
      <tr>
         <!--<td><?=$row['GroupID'];?></td>-->
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td nowrap><?=$row['GroupAlias'];?></td>
         
         <td><Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete group <?=$row['GroupID'];?>?')){
                  return(false);
               }
            }
            this.form.GroupID.value = '<?=$row['GroupID'];?>'; 
            this.form.NewStatus.value = this.value;
            this.form.PageMode.value = 'Update';
            this.form.submit();">
            <option value="Active"<?=($row['Status'] == 'Active'?' Selected':'');?>>Active</option>
            <option value="Dormant"<?=($row['Status'] == 'Dormant'?' Selected':'');?>>Dormant</option>
	    <option value="Expired"<?=($row['Status'] == 'Expired'?' Selected':'');?>>Expired</option>
            <option value="Concerns"<?=($row['Status'] == 'Concerns'?' Selected':'');?>>Concerns</option>
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
