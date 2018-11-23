<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../member/member">Member</a> | 
<b>New Reference</b>
</div>
<H4>Member Reference Entry</H4>
<p>Thank you for your registration. You have now been sent an email to confirm 
   your email address. Please click the link you will find in that email that 
   will bring you back to this web-site and continue the process.</p>
<p>Please now continue your registration by providing a details of a reference.</p>
<p>Although we wish to make the process of referring those returning to China as 
   easy as possible we are also committed to protecting the personal details of 
   those already there, as well as of those returning. For that reason we need 
   to ensure that everyone using this service is known well by at least one other 
   member, who can provide a reference that will give others confidence in sharing
   details about others they know in China.</p>
<p>Please provide the reference contact details, (name, email and phone number of the person
   who told you about this service. If they are already a member an automated email
   will be sent to them to request confirmation that they know who you are, and that
   they would be happy to refer contacts that you send them. If the reference details 
   you supply are not to the system then an email will be sent to a system administrator, 
   who will then contact your reference personally, before upgrading your member account.</p>
<fieldset>
<legend>Reference Details</legend>
<div align=center>
<form name="newreference" action="../c2p/newreferencesave"method="post">
   <input name="PageMode" type="Hidden" value="NewReference"/>
   <table>
      <tr>  
         <td>First&nbsp;Name</td>
         <td colspan="2">
            <input id="RefFirstName" name="RefFirstName" type=text size=25 
                   placeholder="Enter Forename(s)/Given Name"
                   value="<?=(isset($RefFirstName)?$RefFirstName:'');?>"/>
         </td>
         <td>Last&nbsp;Name</td>
         <td colspan="2">
            <input id="RefLastName" name="RefLastName" type=text size=25 
                   placeholder="Enter Surname/Family Name"
                   value="<?=(isset($RefLastName)?$RefLastName:'');?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input id="RefEmail" name="RefEmail" type="email" size=25 
                   placeholder="Enter valid email address"
                   value="<?=(isset($RefEmail)?$RefEmail:'');?>"/>
	</td>
         <td>Mobile/Phone</td>
         <td colspan="2">
            <input id="RefPhone" name="RefPhone" type="tel" size=25 
                   placeholder="+99 999 9999999"
                   value="<?=(isset($RefPhone)?$RefPhone:'');?>"/>
         </td>
      </tr>
      <tr>
         <td colspan="8"><small>If your reference may not easily 
   recognise you easily from your contact details, then it may be a 
   good idea to give them some context or background information, how you know them or 
   why you are asking for a reference. Please add this below.</small></td>
      </tr>
      <tr>  
         <td colspan="8">
            <textarea id="RefDetails" name="RefDetails" type=textbox cols=70 rows="5"/><?php
            echo (isset($RefDetails)?$RefDetails:'');?></textarea>
         </td>
      </tr>
      <tr>  
         <td colspan="5"><b style="color:red;"><?php echo (isset($Message)?$Message:'');?></b></td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
   </table>
</form>
</div>
</fieldset>
</DIV>
