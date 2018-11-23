<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<b>New Password</b>
</div> 
<H3>Change Password</H3>
<p>In order to set a new password, please first provide your old password. 
    Enter your new password twice and provide a new reminder. 
    Please complete all fields. 
</p>
<fieldset>
<legend>New Password</legend>
<form id="newpassword" name="newpassword" action="member/newpasswordsave" method="post">
   <input name="PageMode" type="Hidden" value="NewPassword"/>
   <table cellpadding=2>
      <tr>  
         <td>Old Password</td>
         <td><input id="OldPassword" name="OldPassword" type=password size=25"/></td>
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
         <td><input id ="Reminder" name="Reminder" type=text size=25 /></td>
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
