<DIV class="content">
<form name="aboutyou" action="../oneway/aboutyousave.php" method="post">
   <input name="PageMode" type="Hidden" value="Register"/>
<H3>About You</H3>
<p><i style="color:#FF0000;">This web service does not hold any information about people in China 
or even those returning to China. </i> <br/>
It is simply a service to link people who have friends returning home with those who already 
have connections in China. </p>

<p>If you are currently in China, or will be soon be returning there, then we do not want to hold your information. 
Please find a friend, who does not reside in that country and who is willing to act as your 'sponsor'. 
This person should then register <a href="">here</a> in order to make contact enquiries on your behalf. </p>

<p>If you are Chinese and would like to help connect others returning home, then you also will need a friend to be your 
representative outside China. Once we have verified their identity, they will take sole responsibility for deciding whether or not 
to pass on to you details of anyone returning to your home town.</p>

<p>In order to access information on this site, or even to refer a person returning to China, 
we first need to know a little about you; just enough to be able to be able to contact you 
and also to check your references in order to verify your identity. Your personal details 
and any other information you supply with be held securely, it will not be passed to any third party, and 
you will be able to edit it, or remove it, at any time.</p>
<div align=center>
   <table class="loginbox" cellpadding=5>
      <tr><th colspan=3><h4>Please enter your details</h4></th></tr>
      <tr><td colspan=3></td></tr>
      <tr><td colspan=3><b><?=$LoginMessage?></b></td></tr>
      <tr>  
         <td>First&nbsp;Name&nbsp;(Given)</td>
         <td colspan="2">
            <input name="FirstName" type=text size=35 value="<?=$FirstName;?>"/>
         </td>
      </tr>
     <tr>  
         <td>Last&nbsp;Name&nbsp;(Family)</td>
         <td colspan="2">
            <input name="LastName" type=text size=35 value="<?=$LastName;?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input name="UserEmail" type=text size=35 value="<?=$UserEmail;?>"/></td>
      </tr>
     <tr>  
         <td>Phone&nbsp;Number</td>
         <td colspan="2">
            <input name="UserPhone" type=text size=35 value="<?=$UserPhone;?>"/>
         </td>
      </tr>
      <tr>  
         <td>New&nbsp;Password</td>
         <td colspan="2">
            <input name="Password" type=password size=35 />
         </td>
      </tr>
      <tr>  
         <td>Confirm&nbsp;Password</td>
         <td colspan="2">
            <input name="Confirm" type=password size=35 />
         </td>
      </tr>
      <tr>  
         <td>Password&nbsp;Reminder</td>
         <td colspan="2">
            <input name="Reminder" type=text size=35 value="<?=$Reminder?>"/>
         </td>
      </tr>
      <tr>  
         <td>Type of Account</td>
         <td>
            <select name="Account">
               <option value="Guest" <?=($Account=='Guest'?' Selected':'')?>>Guest</option>
               <option value="Helper" <?=($Account=='Helper'?' Selected':'')?>>Helper</option>
               <option value="Helper" <?=($Account=='Host'?' Selected':'')?>>Host</option>
            </select>
         </td>
         <td align=right>
            <input name="Submit" type=button value="Register"
               onclick="document.Login.PageMode.value = 'Register'; document.Login.submit();"/>
         </td>
      </tr>
   </table>
</div>
</DIV>
