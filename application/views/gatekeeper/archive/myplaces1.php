<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../gatekeeper/gatekeeperhome">Gatekeeper</a> | 
<b>My Places</b>
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
       <tr><td colspan="4">Below is a list of locations where you are currently 
          recorded as having contacts willing to help returnees. 
           
          </td>
          <td>
           <input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.Postcode.value='';
                this.form.District.value='';
                this.form.Returnee.value=1; 
                this.form.Contact.value=1; 
                this.form.Fellowship.value=0; 
                this.form.Church.value=0;
                this.form.Nearby.value=0;
                this.form.submit();}"/>
         </td>
       </tr>
      <tr>
         <!--<th style="cursor:pointer;" onclick="ReOrder('ContactID');">ID</th>-->
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('Postcode');">Postcode</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('Returnee');" alt="Returnee">Rt</th>
         <th style="cursor:pointer;" onclick="ReOrder('Contact');" alt="Contact">Ct</th>
         <th style="cursor:pointer;" onclick="ReOrder('Fellowship');" alt="Fellowship">Fw</th>
         <th style="cursor:pointer;" onclick="ReOrder('Church');" alt="Church">Ch</th>
         <th style="cursor:pointer;" onclick="ReOrder('Nearby');" alt="Nearby">Nb</th>
      </tr>
            <tr>
         <td>
            <select name="Country" onchange="this.form.submit();" width="20">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();" width="50">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City" onchange="this.form.submit();" width="50">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td nowrap>
             <!--<input name="Postcode" type="number" width="6"
                    value="<?=(isset($Postcode)?$Postcode:'');?>"
                   onchange="this.form.submit();">-->
             <select name="Postcode" onchange="this.form.submit();" width="10">
                 <option value=""></option><?php
             if(isset($Postcodes)){
               foreach($Postcodes as $postcode){?>
               <option value="<?=$postcode['Name'];?>" <?=($postcode['Name']==(isset($Postcode)?$Postcode:'#')?' Selected':'');?>><?=$postcode['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td nowrap>
            <select name="District" onchange="this.form.submit();" width="50">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $district){?>
               <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
             <input name="Returnee" type="Checkbox" value="1" 
                <?=(isset($Returnee) and $Returnee==1?'Checked':'');?>
                onchange="this.form.submit();">
         </td>
         <td>
             <input name="Contact" type="Checkbox" value="1" 
                <?=(isset($Contact) and $Contact==1?'Checked':'');?>
                onchange="this.form.submit();">
         </td>
         <td>
             <input name="Fellowship" type="Checkbox" value="1" 
                <?=(isset($Fellowship) and $Fellowship==1?'Checked':'');?>
                onchange="this.form.submit();">
         </td>
         <td>
             <input name="Church" type="Checkbox" value="1" 
                <?=(isset($Church) and $Church==1?'Checked':'');?>
                onchange="this.form.submit();">
         </td>
         <td>
             <input name="Nearby" type="Checkbox" value="1" 
                <?=(isset($Nearby) and $Nearby==1?'Checked':'');?>
                onchange="this.form.submit();">
         </td>
      </tr>
      <tr>
          <td>Reminder</td>
          <td colspan="9">
              <input name="Reminder" type="text" size="100" value="<?=(isset($Reminder)?$Reminder:'');?>"
          </td>
      </tr>

<?php foreach($results as $row):?>
      <tr>
         <!--<td><?=$row['ContactID'];?></td>-->
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['Postcode'];?></td>
         <td nowrap><?=$row['District'];?></td>
        
         <td nowrap><?=($row['Returnee']==1?'Y':'');?></td>
         <td nowrap><?=($row['Contact']==1?'Y':'');?></td>
         <td nowrap><?=($row['Fellowship']==1?'Y':'');?></td>
         <td nowrap><?=($row['Church']==1?'Y':'');?></td>
         <td nowrap><?=($row['Nearby']==1?'Y':'');?></td>
         
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
