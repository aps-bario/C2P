<DIV class="content">
<small>
<a href="../oneway/home">Oneway</a> | 
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>Referrals</b>
</small>
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
<?=(isset($Message) and !$Message==''?'<p><b style="color:red;"><?=$Message;?></b></p>':'');?>
<fieldset><legend>Locations where I have contacts</legend>
<form id="myform" method="post">
   <input name="ContactID" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=$ListOrder;?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <table class="report" width="60">
       <tr><td colspan="6">Below is a list of locations where you are currently 
          recorded as having contacts willing to help returnees. 
           </td>
           <td><input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.Returning.value='';
                this.form.NewStatus.value='';
                this.form.submit();}"/></td>
       </tr>
      <tr>
         <!--<th style="cursor:pointer;" onclick="ReOrder('ContactID');">ID</th>-->
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('ReturneeAlias');">Returnee</th>
         <th style="cursor:pointer;" onclick="ReOrder('R.ReturnYear, M.Mn');">Returning</th>
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
         <!--<td></td>-->
         <td>Alias</td>
         <td nowrap><select name="Returning" onchange="this.form.submit();">
                 <option></option><?php 
                $Years = array('2014','2015','2016','2017','2018');
                $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                foreach($Years as $y){
                    foreach($Months as $m){?><option value="<?=$m.' '.$y;?>"<?=(
                        $m.' '.$y == (isset($Returning)?$Returning:'#')
                            ?' Selected':'');?>><?=$m.' '.$y;?></option><?php
                    }
                }?> 
              </select>
          </td>
          <td nowrap>
             <select name="NewStatus" onchange="this.form.submit();">
               <option value=""></option><?php
            //if(isset($Statuses)){
               foreach($Statuses as $s){?>
               <option value="<?=$s['Status'];?>" <?=($s['Status']==$NewStatus?' Selected':'');?>><?=$s['Status'];?></option><?php
               }
            //}?>
            </select>
         </td>
      </tr>

<?php foreach($results as $row):?>
      <tr>
         <!--<td><?=$row['ContactID'];?></td>-->
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <!--<td nowrap><?=$row['FirstName'];?> <?=$row['LastName'];?></td>-->
         <td nowrap><?=$row['ReturneeAlias'];?></td>
         <td nowrap><?=$row['Returning'];?></td>
         <td><?=$row['Status'];?>
             <!--<Select onchange="if(this.value=='Delete'){
               if(!confirm('Delete user <?=$row['ContactID'];?>?')){
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
         </Select>-->
         </td>
      </tr>
<?php endforeach;?>
   </table>
   </form>
   </fieldset>
</DIV> <!-- content -->
