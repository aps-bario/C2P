<DIV class="content">
<div class="breadcrumb">
<a href="../oneway/home">Oneway</a> | 
<a href="../sponsor/sponsorhome">Sponsor</a> | 
<b>New Returnee</b>
</div>
<H4>New Returnee Referral Request</H4>
<p>Please provide basic information about the location the person returnee is 
   returning to, then that is likely to be and a name (or alias) that a both 
   you and any contacts found will be able to use to identify this referral 
   in future.</p><?php 
if(isset($Message) and !$Message==''){?>
<p><b style="color:red;"><?=$Message;?></b></p><?php
}?>
<fieldset>
<legend> New Returnee Details </legend>
<form name="newreturnee" action="sponsor/newreturneesave" method="post">
<input name="PageMode" type="Hidden" value="Entry"/>
   <table>
      <tr>
          <td colspan=2 nowrap><small> Select location using fields below:</small></td>
          <td colspan=2 align="right">[<small> STATS: &nbsp;
            Loc:<?=(isset($Stats['Locations'])?$Stats['Locations']:'0');?> &nbsp; 
            Cnt:<?=(isset($Stats['Contacts'])?$Stats['Contacts']:'0');?> &nbsp; 
            Chu:<?=(isset($Stats['Churches'])?$Stats['Churches']:'0');?> &nbsp; 
            Grp:<?=(isset($Stats['Groups'])?$Stats['Groups']:'0');?> </small>]<small> &nbsp;
            <input type="button" value="Reset" onclick="{
                this.form.Country.value='China'; this.form.Province.value=''; 
                this.form.City.value=''; this.form.District.value='';
                this.form.Other.value=''; this.form.submit();}"/>
         </td> 
      </tr>
      <tr>  
          <td style="width:20%;"><small>Country</small></td>
          <td style="width:20%;"><small>Province</small></td>
          <td style="width:20%;"><small>City</small></td>
          <td style="width:40%;"><small>District / Other(if not listed)</small></td>
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
      </tr>
      <tr>
          <td><small>Return Date</small></td>
          <td colspan="2"><small>Returnee Name/Alias</small></td>
          <td><small>Other District</small></td>
           
      </tr>
      <tr>
          <td nowrap><select name="ReturnMonth"><?php 
                $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                foreach($Months as $m){?>
                <option value="<?=$m;?>" <?=($m==(isset($ReturnMonth)?$ReturnMonth:'#')?' Selected':'');?>><?=$m;?></option><?php
                }?> 
              </select><select name="ReturnYear"><?php
                $Years = array('2014','2015','2016','2017','2018');
                foreach($Years as $y){?>
                <option value="<?=$y;?>" <?=($y==(isset($ReturnYear)?$ReturnYear:'#')?' Selected':'');?>><?=$y;?></option><?php
                }?> 
              </select>
          </td>
          <td colspan="2"><input type="text" name="Returnee" size="25" value="<?php
            if(isset($Returnee) AND $Returnee==''?(isset($Returnee)?$Returnee:''):'');?>">
          </td>
          <td>
          <input type="text" name="Other" value="<?php
            if(isset($District) AND $District==''?(isset($Other)?$Other:''):'');?>"<?php 
            if(isset($District) AND !$District==''){ echo ' Disabled';}?>>
          </td>
      </tr>
      <tr>
        <td colspan="4"><small>Please provide a brief note about the returnee, but not contact details</small></td>
      </tr>
      <tr>
            <td colspan="4">
            <input type="text" name="Details" size=80 value="<?=(isset($Details)?$Details:'');?>">
        </td>
      </tr>
      <tr>  
         <td colspan="3"><b style="color:red;"><?=(isset($Message)?$Message:'');?></b></td>
         <td align=right>
             <input id="Submit" name="Button" type=submit value="Submit"
              onclick="this.form.PageMode.value = 'Insert'; this.form.submit();"/>
         </td>
      </tr>
      <tr>
          <td valign="top">NOTES:</td>
          <td colspan="3"><small>Loc: Distinct districts listed within area selected.<br/>
    Cnt: Number of people who have a contact in this area.<br/>
    Chu: Number of Amity (registered) churches in the area.<br/>
    Grp: Number of fellowhips groups known by contacts in area.</small>
          </td>
      </tr>
   </table> 
</form> 
</fieldset>

  
<p>You will see above drop-down list of for country, province, city and district.
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p>
</DIV>
