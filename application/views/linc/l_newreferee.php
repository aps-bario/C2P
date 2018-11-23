<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/linc/home">Home</a> | 
<a href="/linc/member">Member</a> | 
<b>New Reference</b>
</div>
<div data-role="collapsible">
<H4>Member References</H4>
<p>Although we wish to make the process of referring those returning to China as 
   easy as possible we are also committed to protecting the personal details of 
   those already there, as well as of those returning.</p><p> For that reason we need 
   to ensure that everyone using this service is well known by at least one other 
   member, who can provide a reference that will give others confidence in sharing
   details about others they know in China.</p>
</div>
<div data-role="collapsible">
<H4>Reference Details</H4>
<p>Please provide the reference contact details, (name, email and phone number of the person
   who told you about this service. If they are already a member an automated email
   will be sent to them to request confirmation that they know who you are, and that
   they would be happy to refer contacts that you send them.</p><p> If the reference details 
   you supply are not to the system then an email will be sent to a system administrator, 
   who will then contact your reference personally, before upgrading your member account.</p>
</div>
<fieldset>
<form name="newreference" action="/linc/newreferencesave"method="post">
   <input name="PageMode" type="Hidden" value="NewReference"/>
<div class="ui-field-contain"> 
    <label for="RefFirstName">First&nbsp;Name</label>
    <input id="RefFirstName" name="RefFirstName" type=text size=25 
           placeholder="First Name"
           value="<?=(isset($RefFirstName)?$RefFirstName:'');?>"/>
</div>
<div class="ui-field-contain"> 
    <label for="RefLastName"><td>Last&nbsp;Name</label>
    <input id="RefLastName" name="RefLastName" type=text size=25
           placeholder="Last Name"
           value="<?=(isset($RefLastName)?$RefLastName:'');?>"/>
</div>
 
<div class="ui-field-contain"> 
    <label for="FirstName">Email&nbsp;Address</label>
    <input id="RefEmail" name="RefEmail" type=text size=25 
           placeholder="Email Address"
           value="<?=(isset($RefEmail)?$RefEmail:'');?>"/>
</div>
<div class="""ui-field-contain"> 
    <label for="FirstName">Mobile/Phone</label>
    <input id="RefPhone" name="RefPhone" type=text size=25 
           placeholder="Mobile / Phone"
           value="<?=(isset($RefPhone)?$RefPhone:'');?>"/>
</div>
<div data-role="collapsible">
<H4>Reference Reminder</H4>
<p>If your reference may not easily recognise you from your contact details, 
    then it may be a good idea to give them some context or background 
    information, how you know them or why you are asking for a reference. 
    Please add this below.</p>
</div>
<textarea id="RefDetails" name="RefDetails" type=textbox cols=70 rows="5"
          placeholder="Reminder to Reference"/><?php
            echo (isset($RefDetails)?$RefDetails:'');?></textarea>
<b style="color:red;"><?php echo (isset($Message)?$Message:'');?></b>
<input id="Submit" name="Submit" type=submit value="Submit"/>
</form>
</fieldset>
</DIV>
