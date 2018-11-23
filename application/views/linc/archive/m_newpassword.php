<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<b>Change Password</b>
</div>
<div data-role="collapsible">    
<H3>Change Password</H3>
<p>In order to set a new password, please first provide your old password. Then 
    enter your new password twice and provide a new reminder/hint.</p> 
<p>Please complete all fields.</p>
</div>
<fieldset>
<form id="newpassword" name="newpassword" action="/mobile/newpasswordsave" method="post">
   <input name="PageMode" type="Hidden" value="NewPassword"/>
<div class="ui-field-contain"> 
    <label for="OldPassword">Old Password</label>
    <input id="OldPassword" name="OldPassword" type=password 
           placeholder="Enter old password" size=25"/>
</div>
<div class="ui-field-contain"> 
    <label for="Password">New Password</label>
    <input id="Password" name="Password" type=password 
           placeholder="Enter new password" size=25 />
</div>
<div class="ui-field-contain"> 
    <label for="Confirm">Confirm Password</label>
    <input id="Confirm" name="Confirm" type=password 
                placeholder="Confirm new password" size=25 />
</div>
<div class="ui-field-contain"> 
    <label for="Confirm">Password Hint</label>
    <input id ="Reminder" name="Reminder" type=text 
           placeholder="Reminder / Hint" size=25 />
</div>
<input id="Submit" name="Submit" type=submit value="Submit"/>
<b><?=$Message?></b>
</fieldset>
</DIV>
