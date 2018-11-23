<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<b>Edit Member</b>
</div> 
<H3>Edit Your Details</H3>


<fieldset>
<legend>Member Details </legend>
<p>Your personal data (shown below) is held securely and will only be sent to 
    another registered member of this network when you request a returnee referral
    so that they may contact you. It will not be shared with any other third party.</p>
<p><i><b>New General Data Protection Regulation</b> (GDPR 2018) gives you the right to be 'forgotten', 
    which will permanently erase your personal data below from this web-site. 
    It will not however remove your referral history as this is required to maintain the integrity of this network. 
    There is currently no automated way to be 'forgotten' so in the meantime 
    please email admin@connecting2people.net from your registered email address.</i></p>
<p>In order to change any item, please complete all fields including your current password, as this confirms you identity</p>
<p><b>Please complete all fields.</b></p>
<form id="newmember" name="newmember" action="member/editmembersave" method="post">
   <input name="PageMode" type="Hidden" value="EditMember"/>
   <div style='float: left; margin-right: 10px;'>
   <table cellpadding=2>
      <tr>  
         <td>First Name</td>
         <td colspan='2'>
            <input id="FirstName" name="FirstName" type=text size=25 value="<?=(isset($FirstName)?$FirstName:'');?>"/>
         </td>
         
         
         
         
         </td>
     </tr>
     <tr>  
         <td>Last Name</td>
         <td colspan='2'>
            <input id="LastName" name="LastName" type=text size=25 value="<?=(isset($LastName)?$LastName:'');?>"/>
         </td>
     </tr>
     <tr>  
         <td>Email Address</td>
         <td colspan='2'>
            <input id="Email" name="Email" type=text size=25 value="<?=(isset($Email)?$Email:'');?>"/>
	</td>
     </tr>
     <tr>  
         <td>Mobile Phone</td>
         <td colspan='2'>
            <input id="C2P_Mobile" name="C2P_Mobile" type=text size=25 value="<?=(isset($C2P_Mobile)?$C2P_Mobile:'');?>"/>
         </td>
     </tr>
     <tr>  
         <td nowrap>Current Password</td>
         <td colspan='2'><input id="OldPassword" name="OldPassword" type=password size=25"/></td>
     </tr>
     <tr>  
         <td nowrap>Current Status</td>
         <td><b><?=(isset($Status)?$Status:'');?></b></td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
      <tr><td colspan=3><b><?=$Message?></b></td></tr>
   </table>
   </div>
   <div >
       <p><b>PLEASE NOTE: </b>If you change your email address, then you will be sent an email requesting confirmation. 
       You will also then need to submit a reference request again, so that we can be sure who 
       will be receiving your messages. Your account will effectively be suspended until both
       these confirmations have been completed.</p>
       <p>You will need to supply your current password in order to update your details.</p>
       
   </div>
</form>
</fieldset>
</DIV>
