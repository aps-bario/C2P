<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<b>New Member</b>
</div> 
<div data-role="collapsible">  
<H1>Member Registration</H1>
<p>In order to access information on this site, or even to refer a person returning to China, 
we first need to know a little about you; just enough to be able to be able to contact you 
and also to check your references in order to verify your identity. Your personal details 
and any other information you supply with be held securely, it will not be passed to any third party, and 
you will be able to edit it, or remove it, at any time.</p>
</div>
<fieldset>
<form id="newmember" name="newmember" action="/mobile/newmembersave" method="post">
   <input name="PageMode" type="Hidden" value="NewMember"/>
   <input name="Account" type="Hidden" value="Registered"/>
<div class="ui-field-contain">
    <lablel for="FirstName">First&nbsp;Name</label>
    <input id="FirstName" name="FirstName" type="text"
           placeholder="First Name" 
           value="<?=(isset($FirstName)?$FirstName:'');?>" required/>
</div>
<div class="ui-field-contain">
    <label for="LastName">Last&nbsp;Name</label>
    <input id="LastName" name="LastName" type="text" 
           placeholder="Last Name" 
           value="<?=(isset($LastName)?$LastName:'');?>" required/>
</div>
<div class="ui-field-contain">
    <label for="Email">Email&nbsp;Address</label>
    <input id="Email" name="Email" type="Email" 
           placeholder="Email Address" 
           value="<?=(isset($Email)?$Email:'');?>" required/>
</div>
<div class="ui-field-contain">
    <label for="C2P_Mobile">Mobile/Phone</label>
    <input id="C2P_Mobile" name="C2P_Mobile" type="text" 
           placeholder="Phone or Mobile" 
           value="<?=(isset($C2P_Mobile)?$C2P_Mobile:'');?>" required/>
</div>
<div class="ui-field-contain">
    <label for="Password">New&nbsp;Password</label>
    <input id="Password" name="Password" type="password"
           placeholder="Enter Password" required/>
</div>
<div class="ui-field-contain">
    <label for="Repeat">Repeat&nbsp;Password</label>
    <input id="Confirm" name="Confirm" type="password" 
           placeholder="Repeat Password" required/>
</div>
<div class="ui-field-contain">
    <label for="Reminder">Password&nbsp;Hint</LABEL>
    <input id ="Reminder" name="Reminder" type="text"  
           placeholder="Password Hint" 
           value="<?=(isset($Reminder)?$Reminder:'');?>" required/>
</div>
<input id="Submit" name="Submit" type="Submit" value="Submit"/>
<h6><?=$Message?></h6>
</form>
</fieldset>
</DIV>
