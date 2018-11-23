<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../reports/reports">Reports</a> | 
<b>Progress by Sponsor</b>
</div>
<h4>Progress by Sponsor</h4>
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
<fieldset><legend>Progress Key</legend>
    <b>Nor</b> - No Referral, <b>New</b> - New Referral, <b>Res</b> - Responded, <b>Ack</b> - Acknowledged, 
    <b>Con</b> - Concerned, <b>Can</b> - Cancelled, <br/><b>Dec</b> - Declined, <b>Acc</b> - Accepted, <b>Cha</b> - Chased, 
    <b>Cnd</b> - Connected, <b>Fai</b> - Failed, <b>Cfd</b> - Confirmed, <b>Ctd</b> - Contacted
</fieldset>
<fieldset><legend>Furthest Returnee Progress by Sponsor</legend>
<form id="myform" method="post">
   <input name="ContactID" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=(isset($ListOrder)?$ListOrder:'');?>" />
   <input name="PageMode" type="hidden" value="<?=(isset($PageMode)?$PageMode:'');?>" />
   <table class="report" width="60">
       <tr><td><input type="button" value="Reset Filter" onclick="{
                this.form.LastName.value=''; 
                this.form.FirstName.value=''; 
                this.form.submit();}"/></td>
            <td colspan="4">Click on headings to re-order the results. Click again to reverse.</td>
            <td colspan="13"><b>Number of returnees reaching progressive stages of referral.</b></td>            
       </tr>
      <tr height="20px">
         <th style="cursor:pointer;" onclick="ReOrder('LastName, FirstName');">Last&nbsp;Name</th>
         <th style="cursor:pointer;" onclick="ReOrder('FirstName, LastName, City');">First&nbsp;Name</th>
         <!--
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Returnees');">Returnees</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('NoReferral');">NoReferral</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('NewReferral');">NewReferral</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Responded');">Responded</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Acknowledged');">Acknowledged</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Concerned');">Concerned</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Cancelled');">Cancelled</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Declined');">Declined</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Accepted');">Accepted</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Chased');">Chased</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Connected');">Connected</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Failed');">Failed</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Confirmed');">Confirmed</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Contacted');">Contacted</th>
        -->
        <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Returnees');"><b>Referrals</b></th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('NoReferral');">NoR</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('NewReferral');">New</th>
        <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Responded');">Res</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Acknowledged');">Ack</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Concerned');">Con</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Cancelled');">Can</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Declined');">Dec</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Accepted');">Acc</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Chased');">Cha</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Connected');">Cnd</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Failed');">Fai</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Confirmed');">Cfd</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Contacted');">Ctd</th>
</tr>
<tr>
       
       <!--  <td>
            <select name="LastName" onchange="this.form.submit();" style="width:50px;">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>-->
         <td><!--
            <select name="City" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>-->
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
         <td colspan="14"></td>
</tr>

<?php foreach($results as $row):?>
      <tr>
         <td nowrap><?=$row['LastName'];?></td>
         <td nowrap><?=$row['FirstName'];?></td>
         <td nowrap><b><?=$row['Referrals'];?></b></td>
         <td nowrap><?=($row['NoReferral']==0?'':$row['NoReferral']);?></td>
         <td nowrap><?=($row['NewReferral']==0?'':$row['NewReferral']);?></td>
         <td nowrap><?=($row['Responded']==0?'':$row['Responded']);?></td>
         <td nowrap><?=($row['Acknowledged']==0?'':$row['Acknowledged']);?></td>
         <td nowrap><?=($row['Concerned']==0?'':$row['Concerned']);?></td>
         <td nowrap><?=($row['Cancelled']==0?'':$row['Cancelled']);?></td>
         <td nowrap><?=($row['Declined']==0?'':$row['Declined']);?></td>
         <td nowrap><?=($row['Accepted']==0?'':$row['Accepted']);?></td>
         <td nowrap><?=($row['Chased']==0?'':$row['Chased']);?></td>
         <td nowrap><?=($row['Connected']==0?'':$row['Connected']);?></td>
         <td nowrap><?=($row['Failed']==0?'':$row['Failed']);?></td>
         <td nowrap><?=($row['Confirmed']==0?'':$row['Confirmed']);?></td>
         <td nowrap><?=($row['Contacted']==0?'':$row['Contacted']);?></td>
      </tr>
<?php endforeach;?>
   </table>
   </form>
</fieldset>

<fieldset><legend>All Referral Progress Stages by Sponsor</legend>
<form id="myform" method="post">
   <input name="ContactID" type="hidden" value="" />
   <input name="ListOrder" type="hidden" value="<?=(isset($ListOrder)?$ListOrder:'');?>" />
   <input name="PageMode" type="hidden" value="<?=(isset($PageMode)?$PageMode:'');?>" />
   <table class="report" width="60">
       <tr><td><input type="button" value="Reset Filter" onclick="{
                this.form.LastName.value=''; 
                this.form.FirstName.value=''; 
                this.form.submit();}"/></td>
            <td colspan="4">Click on headings to re-order the results. Click again to reverse.</td>
            <td colspan="13"><b>Number of returnees reaching progressive stages of referral.</b></td>            
       </tr>
      <tr height="20px">
         <th style="cursor:pointer;" onclick="ReOrder('LastName, FirstName');">Last&nbsp;Name</th>
         <th style="cursor:pointer;" onclick="ReOrder('FirstName, LastName, City');">First&nbsp;Name</th>
         <!--
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Returnees');">Returnees</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('NoReferral');">NoReferral</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('NewReferral');">NewReferral</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Responded');">Responded</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Acknowledged');">Acknowledged</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Concerned');">Concerned</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Cancelled');">Cancelled</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Declined');">Declined</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Accepted');">Accepted</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Chased');">Chased</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Connected');">Connected</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Failed');">Failed</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Confirmed');">Confirmed</th>
         <th style="width: 10px; transform: rotate(-90deg); cursor:pointer;" class="vertical" onclick="ReOrder('Contacted');">Contacted</th>
        -->
        <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Returnees');"><b>Updates</b></th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('NoReferral');">NoR</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('NewReferral');">New</th>
        <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Responded');">Res</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Acknowledged');">Ack</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Concerned');">Con</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Cancelled');">Can</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Declined');">Dec</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Accepted');">Acc</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Chased');">Cha</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Connected');">Cnd</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Failed');">Fai</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Confirmed');">Cfd</th>
         <th style="cursor:pointer;" class="vertical" onclick="ReOrder('Contacted');">Ctd</th>
</tr>
<tr>
       
       <!--  <td>
            <select name="LastName" onchange="this.form.submit();" style="width:50px;">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>-->
         <td><!--
            <select name="City" onchange="this.form.submit();"  style="width:50px;">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>-->
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
         <td colspan="14"></td>
</tr>

<?php foreach($results2 as $row):?>
      <tr>
         <td nowrap><?=$row['LastName'];?></td>
         <td nowrap><?=$row['FirstName'];?></td>
         <td nowrap><b><?=$row['Referrals'];?></b></td>
         <td nowrap><?=($row['NoReferral']==0?'':$row['NoReferral']);?></td>
         <td nowrap><?=($row['NewReferral']==0?'':$row['NewReferral']);?></td>
         <td nowrap><?=($row['Responded']==0?'':$row['Responded']);?></td>
         <td nowrap><?=($row['Acknowledged']==0?'':$row['Acknowledged']);?></td>
         <td nowrap><?=($row['Concerned']==0?'':$row['Concerned']);?></td>
         <td nowrap><?=($row['Cancelled']==0?'':$row['Cancelled']);?></td>
         <td nowrap><?=($row['Declined']==0?'':$row['Declined']);?></td>
         <td nowrap><?=($row['Accepted']==0?'':$row['Accepted']);?></td>
         <td nowrap><?=($row['Chased']==0?'':$row['Chased']);?></td>
         <td nowrap><?=($row['Connected']==0?'':$row['Connected']);?></td>
         <td nowrap><?=($row['Failed']==0?'':$row['Failed']);?></td>
         <td nowrap><?=($row['Confirmed']==0?'':$row['Confirmed']);?></td>
         <td nowrap><?=($row['Contacted']==0?'':$row['Contacted']);?></td>
      </tr>
<?php endforeach;?>
   </table>
   </form>
    
</DIV>
<script>
$(function() {
    $("th.vertical").css("transform: rotate(-90deg);writing-mode: bt-lr; ");
    
    //-webkit-transform: rotate(-90deg);
    //-moz-transform: rotate(-90deg);
    
    //text-indent: -3em;
    //padding: 0px 0px 0px 0px;
    //margin: 0px;
    //text-align: left;
    //vertical-align: bottom;
    //top:0; left:0; width:5px; 
    //margin: 0px; 
   
});

</script>


<!-- content -->