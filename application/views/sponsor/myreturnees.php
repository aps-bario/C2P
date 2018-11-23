<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../sponsor/sponsorhome">Sponsor</a> | 
<b>My Returnees</b>
</div>
<h4>My Returnees</h4>
<style>
table, tr, th,td, input, select{font-size:x-small;}
</style>
<script>
function ProcessClickLink(obj,CLCode){
    //alert(obj+' - CLCode='+CLCode);
    this.loadHTML(obj,'ProcessClickLink','CLCode='+CLCode);
}
function NewReferralCheck(obj,ReturneeID){
    this.loadHTML(obj,'NewReferralCheck','ReturneeID='+ReturneeID);
}
function loadHTML(obj,fn,query){
    var xmlhttp;
    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState===4 && xmlhttp.status===200){
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            $('#'+obj).html(xmlhttp.responseText).trigger("create"); 
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}    
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
<fieldset><legend>List of Returnees you have referred</legend>
<form id="myform" method="post">
   <input name="ContactID" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=(isset($ListOrder)?$ListOrder:'');?>" />
   <input name="PageMode" type="hidden" value="<?=(isset($PageMode)?$PageMode:'');?>" />
   <table class="report" width="60">
       <tr><td colspan="9">Below is list of your returnee referrals, together 
          with a record of progress. 
           </td>
           <td><input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.Returning.value='';
                //this.form.NewStatus.value='';
                this.form.submit();}"/></td>
       </tr>
      <tr>
         <th>Ref.</th>
         <!--<th style="cursor:pointer;" onclick="ReOrder('ContactID');">ID</th>
         <th style="cursor:pointer;" onclick="ReOrder('Country');">Country</th>-->
         <th style="cursor:pointer;" onclick="ReOrder('Province');">Province</th>
         <th style="cursor:pointer;" onclick="ReOrder('City');">City</th>
         <th style="cursor:pointer;" onclick="ReOrder('District');">District</th>
         <th style="cursor:pointer;" onclick="ReOrder('ReturneeAlias');">Returnee</th>
         <th style="cursor:pointer;" onclick="ReOrder('CONCAT(ReturnYear, M.Mn)');">Returning</th>
         <th style="cursor:pointer;" onclick="ReOrder('LatestStatus');">Status</th>
         <th style="cursor:pointer;" onclick="ReOrder('AcknowledgedDate');">Gatekeeper</th>
         <th style="cursor:pointer;" onclick="ReOrder('ContactedDate');">Returnee</th>
         <th style="cursor:pointer;" onclick="ReOrder('ReferredDate');">New&nbsp;Referral</th>
     
</tr>
            <tr>
          <td>ID</td>
         <!--<td>
            <select name="Country" onchange="this.form.submit();" style="width:50px;">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>-->
         <td>
            <select name="Province" onchange="this.form.submit();"  style="width:50px;">
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
         <td nowrap><!--
            <select name="District" onchange="this.form.submit();">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $district){?>
               <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
               }
            }?>
            </select>-->
         </td>
         
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
          <td>Replied</td>
          <td>Confirmed</td>
          <td>Request</td>
          <!--
          <td nowrap>
             <select name="NewStatus" onchange="this.form.submit();">
               <option value=""></option><?php
            //if(isset($Statuses)){
               foreach($Statuses as $s){?>
               <option value="<?=$s['Status'];?>" <?=($s['Status']==$NewStatus?' Selected':'');?>><?=$s['Status'];?></option><?php
               }
            //}?>
            </select>
         </td>-->
      </tr>

<?php foreach($results as $row):?>
      <tr>
         <td nowrap><?=$row['ReferralID'];?></td>
         <!--<td nowrap><?=$row['Country'];?></td>-->
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td nowrap><?=$row['ReturneeAlias'];?></td>
         <td nowrap><?=$row['Returning'];?></td>
         <td nowrap><?=$row['Status'];?></td>
         <td nowrap>
             <label id="Acknowledged<?=$row['ReferralID'];?>" style="cursor:pointer;" 
                onClick="ProcessClickLink(this.id,'<?=$row['AcknowledgedCode'];?>');">
                <?=($row['AcknowledgedDate']!=null?date('d/m/y',strtotime($row['AcknowledgedDate'])):'[ Click ]');?>
                </label>
         </td>
         <td nowrap>
             <label id="Contacted<?=$row['ReferralID'];?>" style="cursor:pointer;" 
                onClick="ProcessClickLink(this.id,'<?=$row['ContactedCode'];?>');">
                <?=($row['ContactedDate']!=null?date('d/m/y',strtotime($row['ContactedDate'])):'[ Click ]');?>
                </label>
         </td>
         <td nowrap>
             <label id="Referred<?=$row['ReferralID'];?>" style="cursor:pointer;" 
                onClick="NewReferralCheck(this.id,'<?=$row['ReturneeID'];?>');">
                <?=($row['ReferredDate']!=null?date('d/m/y',strtotime($row['ReferredDate'])):'[ Click ]');?>
                </label>
         </td>
      </tr>
<?php endforeach;?>
   </table>
   </form>
   </fieldset>
</DIV>
<SCRIPT>
// MyReferrals Script      
$(document).ready(function(){
})

</SCRIPT>


<!-- content -->