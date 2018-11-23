<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../gatekeeper/gatekeeperhome">Gatekeeper</a> | 
<b>My Districts</b>
</div>
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
   <input name="ContactID" type="hidden" value="" />
   <!--<input name="NewStatus" type="hidden" value="" />-->    
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <fieldset><legend>Places where I can help connect returnees</legend>
   <table class="report" width="60">
       <tr><td colspan="5">Below is a list of locations where you are currently 
          recorded as having contacts willing to help returnees. 
           
          </td>
          <td>
           <input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.Postcode.value='';
                this.form.submit();}"/>
         </td>
       </tr>
      <tr>
         <!--<th style="cursor:pointer;" onclick="ReOrder('ContactID');">ID</th>-->
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('Postcode');">Postcode</th>
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
         <td nowrap>
             <input name="Postcode" type="number" size="6"
                    value="<?=(isset($Postcode)?$Postcode:'');?>"
                    onchange="this.form.submit();">
         </td>
<!--
         <td nowrap>
            <Select name="NewStatus" onchange="this.form.submit();">
            <option value=""></option>
            <option value="Active"<?=($NewStatus == 'Active'?' Selected':'');?>>Active</option>
            <option value="Dormant"<?=($NewStatus == 'Dormant'?' Selected':'');?>>Dormant</option>
	    <option value="Expired"<?=($NewStatus == 'Expired'?' Selected':'');?>>Expired</option>
            <option value="Concerns"<?=($NewStatus == 'Concerns'?' Selected':'');?>>Concerns</option>
            </Select>
          </td>
-->

         
      </tr>

<?php foreach($results as $row):?>
      <tr>
         <!--<td><?=$row['ContactID'];?></td>-->
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td nowrap><?=$row['Postcode'];?></td>
         <td nowrap><?=$row['ContactAlias'];?></td>
         
         <td><Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete contact <?=$row['ContactID'];?>?')){
                  return(false);
               }
            }
            this.form.ContactID.value = '<?=$row['ContactID'];?>'; 
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
