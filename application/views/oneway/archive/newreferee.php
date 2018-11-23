<DIV class="content"> 

<H3>Member Referee Entry</H3>
<p>Thank you for your registration. You have now been sent an email to confirm 
   your email address. Please click the link you will find in that email that 
   will bring you back to this web-site and continue the process.</p>
<p>Please now continue your registration by providing a details of a referee.</p>
<p>Although we wish to make the process of referring those returning to China as 
   easy as possible we are also committed to protecting the personal details of 
   those already there, as well as of those returning. For that reason we need 
   to ensure that everyone using this service is known well by at least one other 
   member, who can provide a reference that will give others confidence in sharing
   details about others they know in China.</p>
<p>Please provide the referee contact details, (name, email and phone number of the person
   who told you about this service. If they are already a member an automated email
   will be sent to them to request confirmation that they know who you are, and that
   they would be happy to refer contacts that you send them. If the referee details 
   you supply are not to the system then an email will be sent to a system administrator, 
   who will then contact your referee personally, before upgrading your member account.</p>

<form name="newreferee" action="../oneway/newrefereesave"method="post">
   <input name="PageMode" type="Hidden" value="NewReferee"/>
<div align=center>
   <table class="loginbox" >
      <tr>
         <td colspan=2><b>Referee Details</b></td> 
         <td colspan=3><b><?=$LoginMessage?></b></td>
      </tr>
      <tr>  
         <td>First&nbsp;Name</td>
         <td colspan="2">
            <input id="RefFirstName" name="RefFirstName" type=text size=25 value="<?=(isset($RefFirstName)?$RefFirstName:'');?>"/>
         </td>
         <td>Last&nbsp;Name</td>
         <td colspan="2">
            <input id="RefLastName" name="RefLastName" type=text size=25 value="<?=(isset($RefLastName)?$RefLastName:'');?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input id="RefEmail" name="RefEmail" type=text size=25 
                   value="<?=(isset($RefEmail)?$RefEmail:'');?>"/>
	</td>
         <td>Mobile/Phone</td>
         <td colspan="2">
            <input id="RefPhone" name="RefPhone" type=text size=25 
                   value="<?=(isset($RefPhone)?$RefPhone:'');?>"/>
         </td>
      </tr>
      <tr>
         <td colspan="6"><small>If your referee may not easily 
   recognise you easily from your contact details, then it may be a 
   good idea to give them some context or background information, how you know them or 
   why you are asking for a reference. Please add this below.</small></td>
      </tr>
      <tr>  
         <td colspan="6">
            <textarea id="RefDetails" name="RefDetails" type=textbox cols=70 rows="5"/><?php
            echo (isset($RefDetails)?$RefDetails:'');?></textarea>
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
