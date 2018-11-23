<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<a href="../sysadmin/sysadmin">SysAdmin</a> | 
<b>Reset Password</b>
</div> 
<H3>Reset Password</H3>
<p>Reset a password for an existing user. Provide their email address and set a 
    temporary password and they will then be sent an email asking them to login 
    and change it. In order to set a new password please enter it twice.
    the reminder will ask them to refer to the email. 
</p>
<fieldset>
<legend>New Password</legend>
<form id="newpassword" name="newpassword" action="sysadmin/resetpasswordsave" method="post">
   <input name="PageMode" type="Hidden" value="ResetPassword"/>
   <table cellpadding=2>
      <tr>  
         <td>User Email Password</td>
         <td><input id="PasswordEmail" name="PasswordEmail" type="email" size=50"/></td>
      </tr>
     <tr>  
         <td>New Password</td>
         <td><input id="Password" name="Password" type=password size=25 /></td>
      </tr>
     <tr>  
         <td>Repeat Password</td>
         <td><input id="Confirm" name="Confirm" type=password size=25 /></td>
      </tr>
      <tr>  
         <td>Password Reminder</td>
         <td><input id ="Reminder" name="Reminder" type="hidden" size=25 
                    value="Refer to email sent you"/></td>
     </tr>
      <tr>  
         <td></td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
      <tr><td colspan=3><b><?=$Message?></b></td></tr>
   </table>
</form>
</fieldset>
</DIV>
