<DIV class="content">
<H3>Returnee Referral Request</H3>
<p>Please provide basic information about the location the person returnee is 
   returning to, then that is likely to be and a name (or alias) that a both 
   you and any contacts found will be able to use to identify this referral 
   in future.</p>
<form name="newreturnee" action="returneenew"method="post">
   <input name="PageMode" type="Hidden" value="ReturneeNew"/>
<div align=center>
   <table style="background-color:#dddddd; border-width:1;">
      <tr>
          <td colspan=2 nowrap>NEW REQUEST<small> Select location using fields below:</small></td>
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
            <input type="text" name="Other" value="<?php
            if(isset($District) AND $District==''?(isset($Other)?$Other:''):'');?>"<?php 
            if(isset($District) AND !$District==''){ echo ' Disabled';}?>>
         </td>
      </tr>
      <tr>
          <td><small>Returnee Name/Alias</small></td>
          <td><small>Return Date</small></td>
          <td colspan="3"><small>A brief note</small></td> 
      </tr>
      <tr>
          <td><input type="text" name="Returnee" size="10" value="<?php
            if(isset($Returnee) AND $Returnee==''?(isset($Returnee)?$Returnee:''):'');?>">
          </td>
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
          <td colspan="2">
              <input type="text" name="Details" size=50 value="<?=(isset($Details)?$Details:'');?>">
          </td> 
      </tr>
      <tr>  
         <td colspan="3"><b><?=(isset($Message)?$Message:'');?></b></td>
         <td align=right>
             <input id="Submit" name="Button" type=submit value="Submit"
              onclick="this.form.action='returneeadd'; this.form.submit();"/>
         </td>
      </tr>
   </table> 
</div>
<p>NOTES:<br/>
    Loc: Distinct districts listed within area selected.<br/>
    Cnt: Number of people who have a contact in this area.<br/>
    Chu: Number of Amity (registered) churches in the area.<br/>
    Grp: Number of fellowhips groups known by contacts in area.</p>
   <p>You will see above drop-down list of for country, province, city and district.
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p>
</form>
</DIV>
