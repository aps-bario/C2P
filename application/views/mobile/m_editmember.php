<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<b>Edit Member</b>
</div> 
    <div data-role="collapsible">
<H3>Edit Your Details</H3>
<p>The information on this screen is what you entered when you registered.
Please also provide your password to confirm your identity. 
Please complete all fields.</p>
</div>
<fieldset>
<form id="newmember" name="newmember" action="  mobile/editmembersave" method="post">
   <input name="PageMode" type="Hidden" value="EditMember"/>
<div class="ui-field-contain"> 
    <label for="FirstName">First Name</label>
    <input id="FirstName" name="FirstName" type=text size=25 
           placeholder="First Name" value="<?=(isset($FirstName)?$FirstName:'');?>"/>
</div>
<div class="ui-field-contain"> 
    <label for="LastName">Last Name</label>
    <input id="LastName" name="LastName" type=text size=25 
           placeholder="Last Name"  value="<?=(isset($LastName)?$LastName:'');?>"/>
</div>
<div class="ui-field-contain"> 
    <label for="Email">Email Address</label>
    <input id="Email" name="Email" type=text size=25  
           placeholder="Email Address" value="<?=(isset($Email)?$Email:'');?>"/>
</div>
<div class="ui-field-contain"> 
    <label for="C2P_Mobile">Mobile Phone</label>
    <input id="C2P_Mobile" name="C2P_Mobile" type=text size=25 
           placeholder="Mobile / Phone" value="<?=(isset($C2P_Mobile)?$C2P_Mobile:'');?>"/>
</div>
<div class="ui-field-contain"> 
    <label for="OldPassword">Current Password</label>
    <input id="OldPassword" name="OldPassword" 
           placeholder="Current Password" type=password size=25"/>
</div>
<input id="Submit" name="Submit" type=submit value="Submit"/>
<b><?=$Message?></b>
</form>
</fieldset>
</DIV>
