<DIV class="content">
<div class="breadcrumb">
<a href="../oneway/home">Oneway</a> | 
<b>New Member</b>
</div>    
<H4>New Member - Registration</H4>
<p>In order to access information on this site, or even to refer a person returning to China, 
we first need to know a little about you; just enough to be able to be able to contact you 
and also to check your references in order to verify your identity. Your personal details 
and any other information you supply with be held securely, it will not be passed to any third party, and 
you will be able to edit it, or remove it, at any time.</p>
<div align=center>
<fieldset>
<legend> New Member</legend>   
<form id="newmember" name="newmember" action="../member/NewMemberSave" method="post">
   <input name="PageMode" type="Hidden" value="NewMember"/>
   <input name="Account" type="Hidden" value="Member"/>
   <table class="loginbox" cellpadding=2>
      <tr><td colspan=3><b><?=$LoginMessage?></b></td></tr>
      <tr>  
         <td>First&nbsp;Name</td>
         <td colspan="2">
            <input id="FirstName" name="FirstName" type=text size=25 value="<?=$FirstName;?>"/>
         </td>
         <td>Last&nbsp;Name</td>
         <td colspan="2">
            <input id="LastName" name="LastName" type=text size=25 value="<?=$LastName;?>"/>
         </td>
      </tr>
     <tr>  
         <td>Email&nbsp;Address</td>
         <td colspan="2">
            <input id="Email" name="Email" type=text size=25 value="<?=$Email;?>"/>
	</td>
         <td>Mobile/Phone</td>
         <td colspan="2">
            <input id="Mobile" name="Mobile" type=text size=25 value="<?=$Mobile;?>"/>
         </td>
      </tr>
      <tr>  
         <td>New&nbsp;Password</td>
         <td colspan="2">
            <input id="Password" name="Password" type=password size=25 />
         </td>
         <td>Repeat&nbsp;Passwd</td>
         <td colspan="2">
            <input id="Confirm" name="Confirm" type=password size=25 />
         </td>
      </tr>
      <tr>  
         <td>Password Reminder</td>
         <td colspan="2">
            <input id ="Reminder" name="Reminder" type=text size=25 value="<?=$Reminder?>"/>
         </td>
         <td colspan="2"><!--Type of User</td>
         <td>
            <select id="Account" name="Account">
               <option value="Sponsor" <?=($Account=='Sponsor'?' Selected':'')?>>Sponsor</option>
               <option value="Gatekeeper" <?=($Account=='Gatekeeper'?' Selected':'')?>>Gatekeeper</option>
            </select>-->
         </td>
         <td align=right>
            <input id="Submit" name="Submit" type=submit value="Submit"/>
         </td>
      </tr>
   </table>
   </form>
   </fieldset>   
</div>
</DIV>
