<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>Returnees</b>
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
<?=(isset($Message) and !$Message==''?'<p><b style="color:red;"><?=$Message;?></b></p>':'');?>
<fieldset><legend>Locations where returnees are known</legend>
<form id="myform" method="post" action="myreturnees">
   <input name="ReturneeID" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=(isset($ListOrder)?$ListOrder:'Country,Province,City,District');?>" />
   <input name="PageMode" type="hidden" value="<?=$PageMode;?>" />
   <table class="report" width="60">
       <tr><td colspan="6">Below is a list of locations where you have made 
          requested contacts to help returnees. 
           </td>
           <td><input type="button" value="Reset" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.Returning.value='';
                this.form.NewStatus.value='';
                this.form.submit();}"/>
          </td>
       </tr>
      <tr>
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('ReturneeAlias');">Returnee</th>
         <th style="cursor:pointer;" onclick="ReOrder('(Year,Mn)');">Return</th>
         <th style="cursor:pointer;" onclick="ReOrder('ReferralID');">ID</th>
         <th style="cursor:pointer;" onclick="ReOrder('Status');">Status</th>
      </tr>
      <tr>
         <td>
            <select name="Country" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();"  style="width:50px;" >
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td nowrap>
            <select name="District" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $district){?>
               <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>Alias</td>
         <td nowrap><select name="Returning"><?php 
                $Years = array('2014','2015','2016','2017','2018');
                $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                foreach($Years as $y){
                    foreach($Months as $m){?>
                <option value="<?=$m.' '.$y;?>" <?=($m.' '.$y==(isset($Returning)?$Returning:'#')
                                ?' Selected':'');?>><?=$m.' '.$y;?></option><?php
                    }
                }?> 
              </select>
          </td>
          <td>ID</td>
         <td nowrap>
            <Select name="NewStatus" onchange="this.form.submit();">
                <option value=""></option>
                <option value="No Referral"<?=(isset($NewStatus) and $NewStatus == 'No Referral'?' Selected':'');?>>No Referral</option>
                <option value="New Referral"<?=(isset($NewStatus) and $NewStatus == 'New Referral'?' Selected':'');?>>New Referral</option>
                <option value="Responded"<?=(isset($NewStatus) and $NewStatus == 'Responded'?' Selected':'');?>>Responded</option>
                <option value="Acknowledged"<?=(isset($NewStatus) and $NewStatus == 'Acknowledged'?' Selected':'');?>>Acknowledged</option>
                <option value="Concerned"<?=(isset($NewStatus) and $NewStatus == 'Concerned'?' Selected':'');?>>Concerned</option>
                <option value="Declined"<?=(isset($NewStatus) and $NewStatus == 'Declined'?' Selected':'');?>>Declined</option>
                <option value="Accepted"<?=(isset($NewStatus) and $NewStatus == 'Accepted'?' Selected':'');?>>Accepted</option>
                <option value="Connected"<?=(isset($NewStatus) and $NewStatus == 'Connected'?' Selected':'');?>>Connected</option>
                <option value="Confirmed"<?=(isset($NewStatus) and $NewStatus == 'Confirmed'?' Selected':'');?>>Confirmed</option>
                <option value="Contacted"<?=(isset($NewStatus) and $NewStatus == 'Contacted'?' Selected':'');?>>Contacted</option>
            </Select>
         </td>
      </tr>
<?php if(isset($results)){
            foreach($results as $row):?>
      <tr>
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td nowrap><?=$row['ReturneeAlias'];?></td>
         <td nowrap><?=$row['Returning'];?></td>
         <td nowrap><?=$row['ReferralID'];?></td>
         <td nowrap><?=$row['Status'];?></td>
         
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
             
      </tr><?php 
        endforeach;
     }?>
   </table>
   </form>
   </fieldset>
</DIV> <!-- content -->
