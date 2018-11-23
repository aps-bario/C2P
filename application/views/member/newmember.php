<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<b>Registration</b>
</div> 
<H3>New Member Registration</H3>
<p>In order to access information on this site, or refer a person returning home, 
we first need to know a little about you.  
Your personal details and any other information you supply with be held securely, 
it will not be passed to any third party, 
and you will be able to edit it, or remove it, at any time.</p>
<p>After this step you will be asked to submit a reference.</p>
<fieldset>
<legend> New Member Details </legend>
<form id="newmember" name="newmember" action="c2p/newmembersave" method="post">
   <input name="PageMode" type="Hidden" value="NewMember"/>
   <input name="Account" type="Hidden" value="Registered"/>
   
   <table cellpadding=2>
      <tr>  
         <td>First&nbsp;Name</td>
         <td colspan="2">
            <input id="FirstName" name="FirstName" type="text" size=25 
                   placeholder="Enter Forename(s)/Given Name"
                   value="<?=(isset($FirstName)?$FirstName:'');?>"/>
         </td>
         <td>Last&nbsp;Name</td>
         <td colspan="2">
            <input id="LastName" name="LastName" type="text" size=25
                   placeholder="Enter Surname/Family Name"
                   value="<?=(isset($LastName)?$LastName:'');?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input id="Email" name="Email" type="email" size=25 
                   placeholder="Enter a valid email address"
                   value="<?=(isset($Email)?$Email:'');?>"/>
	</td>
         <td>Mobile/Phone</td>
         <td colspan="2">
            <input id="C2P_Mobile" name="C2P_Mobile" type="tel" size=25
                   placeholder="+99 999 9999999"
                   value="<?=(isset($C2P_Mobile)?$C2P_Mobile:'');?>"/>
         </td>
      </tr>
      <tr>  
         <td>New&nbsp;Password</td>
         <td colspan="2">
            <input id="Password" name="Password" type="password" size=25 />
         </td>
         <td>Repeat&nbsp;Passwd</td>
         <td colspan="2">
            <input id="Confirm" name="Confirm" type="password" size=25 />
         </td>
      </tr>
      <tr>  
         <td>Passwd&nbsp;Reminder</td>
         <td colspan="2">
            <input id ="Reminder" name="Reminder" type=text size=25 value="<?=(isset($Reminder)?$Reminder:'');?>"/>
         </td>
         <td colspan='2'><!--Type of User</td>
         <td>
            <select id="Account" name="Account">
                <option value="Member" <?=($Account=='Member'?' Selected':'')?>>Member</option>
               <option value="Sponsor" <?=($Account=='Sponsor'?' Selected':'')?>>Sponsor</option>
               <option value="Gatekeeper" <?=($Account=='Gatekeeper'?' Selected':'')?>>Gatekeeper</option>
            </select>-->
         </td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
      <tr><td colspan=3><b><?=$Message?></b></td></tr>
   </table>
</form>
</fieldset>
</DIV>
