<DIV class="content">
<form name="newuser" action="../oneway/newusersave"method="post">
   <input name="PageMode" type="Hidden" value="NewUser"/>
<H3>New User - Registration</H3>
<!-- <p><i style="color:#FF0000;">This web service does not hold any information about people in China 
or even those returning to China. </i> <br/>
It is simply a service to link people who have friends returning home with those who already 
have connections in China. </p>

<p>If you are currently in China, or will be soon be returning there, then we do not want to hold your information. 
Please find a friend, who does not reside in that country and who is willing to act as your 'sponsor'. 
This person should then register <a href="">here</a> in order to make contact enquiries on your behalf. </p>

<p>If you are Chinese and would like to help connect others returning home, then you also will need a friend to be your 
representative outside China. Once we have verified their identity, they will take sole responsibility for deciding whether or not 
to pass on to you details of anyone returning to your home town.</p>
-->
<p>In order to access information on this site, or even to refer a person returning to China, 
we first need to know a little about you; just enough to be able to be able to contact you 
and also to check your references in order to verify your identity. Your personal details 
and any other information you supply with be held securely, it will not be passed to any third party, and 
you will be able to edit it, or remove it, at any time.</p>
<div align=center>
   <table class="loginbox" cellpadding=2>
      <tr><td colspan=3><b><?=$LoginMessage?></b></td></tr>
      <tr>  
         <td>First&nbsp;Name</td>
         <td colspan="2">
            <input name="FirstName" type=text size=25 value="<?=$FirstName;?>"/>
         </td>
         <td>Last&nbsp;Name</td>
         <td colspan="2">
            <input name="LastName" type=text size=25 value="<?=$LastName;?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input name="UserEmail" type=text size=25 value="<?=$UserEmail;?>"/>
	</td>
         <td>Mobile / Phone</td>
         <td colspan="2">
            <input name="UserPhone" type=text size=25 value="<?=$UserPhone;?>"/>
         </td>
      </tr>
      <tr>  
         <td>New&nbsp;Password</td>
         <td colspan="2">
            <input name="Password" type=password size=25 />
         </td>
         <td>Repeat&nbsp;Passwd</td>
         <td colspan="2">
            <input name="Confirm" type=password size=25 />
         </td>
      </tr>
      <tr>  
         <td>Passwd&nbsp;Reminder</td>
         <td colspan="2">
            <input name="Reminder" type=text size=25 value="<?=$Reminder?>"/>
         </td>
         <td>Type of User</td>
         <td>
            <select name="Account">
               <option value="Sponsor" <?=($Account=='Sponsor'?' Selected':'')?>>Sponsor</option>
               <option value="Gatekeeper" <?=($Account=='Gatekeeper'?' Selected':'')?>>Gatekeeper</option>
            </select>
         </td>
         <td align=right>
            <input name="Submit" type=button value="Register"
               onclick="document.Login.PageMode.value = 'NewUser'; document.Login.submit();"/>
         </td>
      </tr>
   </table>
</div>
</DIV>
