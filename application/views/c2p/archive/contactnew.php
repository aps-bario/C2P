<DIV class="content">

<H3>My Contact Locations</H3>
<p>Please provide the referee contact details, (name, email and phone number of the person
   who told you about this service. If they are already a member an automated email
   will be sent to them to request confirmation that they know who you are, and that
   they would be happy to refer contacts that you send them. If the referee details 
   you supply are not to the system then an email will be sent to a system administrator, 
   who will then contact your referee personally, before upgrading your member account.</p>
<form name="newreturnee" action="../oneway/returneenew" method="post">
   <input name="PageMode" type="Hidden" value="ContactNew"/>
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
            if(isset($countries)){
               foreach($countries as $countryname){?>
               <option value="<?=$countryname;?>" <?=($countryname==$country?' Selected':'');?>></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province">
               <option value=""></option><?php
            if(isset($provinces)){
               foreach($provinces as $provincename){?>
               <option value="<?=$provincename;?>" <?=($provincename==$province?' Selected':'');?>></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City">
               <option value=""></option><?php
            if(isset($cities)){
               foreach($cities as $cityname){?>
               <option value="<?=$cityname;?>" <?=($cityname==$city?' Selected':'');?>></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="District">
               <option value=""></option><?php
            if(isset($districts)){
               foreach($districts as $districtname){?>
               <option value="<?=$districtname;?>" <?=($districtname==$district?' Selected':'');?>></option><?php
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
