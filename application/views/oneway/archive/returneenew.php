<DIV class="content">

<H3>Returnee Referral Request</H3>
<p>Please provide basic information about the location the person returnee is 
   returning to, then that is likely to be and a name (or alias) that a both 
   you and any contacts found will be able to use to identify this referral 
   in future.</p>
<p>You will find below drop-down list of for country, province, city and district.
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p>
<p>Please provide the referee contact details, (name, email and phone number of the person
   who told you about this service. If they are already a member an automated email
   will be sent to them to request confirmation that they know who you are, and that
   they would be happy to refer contacts that you send them. If the referee details 
   you supply are not to the system then an email will be sent to a system administrator, 
   who will then contact your referee personally, before upgrading your member account.</p>
<form name="newreturnee" action="../oneway/returneenew.php" method="post">
   <input name="PageMode" type="Hidden" value="ReturneeNew"/>
<div align=center>
   <table class="loginbox" >
      <tr>
         <td colspan=2><b>Please select a location using the fields below</b></td> 
      </tr>
      <tr>  
         <th>Country</th><th>Province</th><th>City</th><th>District</th>
         <th>Locs</th><th>Cont</th><th>Chur</th>
      </tr>
      <tr>
         <td>
            <select name="Country">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $countryname){?>
               <option value="<?=$countryname;?>" <?=($countryname==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$countryname;?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $provincename){?>
               <option value="<?=$provincename;?>" <?=($provincename==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$provincename;?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $cityname){?>
               <option value="<?=$cityname;?>" <?=($cityname==(isset($City)?$City:'#')?' Selected':'');?>><?=$cityname;?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="District">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $districtname){?>
               <option value="<?=$districtname;?>" <?=($districtname==(isset($District)?$District:'#')?' Selected':'');?>><?=$districtname;?></option><?php
               }
            }?>
            </select>
         </td>
      </tr>
      <tr>  
         <td colspan="5"><b><?php echo (isset($Message)?$Message:'');?></b></td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
   </table>
</div>
</form>
</DIV>
