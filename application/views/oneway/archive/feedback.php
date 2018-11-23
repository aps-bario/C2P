<div class="content">
<div class="breadcrumb">
<a href="../oneway/home.php">Oneway</a> | 
<b>Feedback</b>
</div>    
<H4>Feedback</h4>
<p>The ONEWAY web-site is still being developed, and therefore you may notice 
    things that change or appear to stop working. Your patience and cooperation
    is appreciated. Any suggestions you make to help this service work more efficiently 
    will be gratefully received. So please let us have your have any ideas or comments 
    on things that you think might make things easier for other users.</p>
<fieldset>
<legend>Feedback Form</legend>  
<form name="feedback" action="oneway/feedbacksave" method="POST">
<table>
<tr>
    <td>Your name *</td>
    <td align="left" colspan="3"><input name="Name" value="" type="text" size="30" 
        value="<?=(isset($FirstName)?$FirstName:'').' '.(isset($LastName)?$LastName:'');?>"/></td>
</tr>
<tr>
    <td>Your Email *</td>
    <td align="left" colspan="3">
        <input name="Email" value="" type="email" size="30" 
            value="<?=(isset($Email)?$Email:'');?>"/></td>  
</tr>
<tr>
    <td>Your Phone</td>
    <td align="left" colspan="3">
        <input name="Phone"  type="text" size="30" accept=""
            value="<?=(isset($Phone)?$Phone:'');?>"/>
    </td>
</tr>
<tr>
    <td>Message Type *</td>
    <td align="left" colspan="3">
	<select name="Type">
            <option value="Design">Page Design</option>
            <option value="Enquiry">General Enquiry</option>
            <option value="Process">Referral Process</option>
            <option value="Errors">Errors Encountered</option>
            <option value="Security">Security Concerns</option>
            <option value="Concerns">Other Concerns</option>
            <option value="Concerns">Any Suggestions</option>
       </select>
    </td>
</tr>
<tr>
    <td>Subject *</td>
    <td align="left" colspan="3">
         <input name="Subject" value="<?=(isset($Subject)?$Subject:'');?>" type="text" size="30"/>
    </td>
</tr>
<tr>
    <td valign="top">Message *</td>
    <td align="left" colspan="3">
        <textarea type="text" name="EmailBody" cols="45" rows="10">
            <?=(isset($Emailbody)?$EmailBody:'');?>
        </textarea>
    </td>
</tr>
<tr>
    <td nowrap colspan="3">[Please complete all fields marked * ]</td>
    <td align="right"><input name="Submit" type="Submit" value="SEND Message"/></td>
</tr>
<tr>
    <td align="left" colspan="4">
        <?=(isset($Message)?$Message:'');?>
        </textarea>
    </td>
</tr>
</table>
</form>
</fieldset>
<p></p>
<p>All referral emails sent from this web-site are sent out automatically, and 
 therefore the system administrator do not have a copy of any particular email 
 your may receive. So if you need to highlight an issue with an email you received, 
 please forward a copy of the email to the site developer 
<a href="mailto:aps@lifespeak.co.uk">aps@lifespeak.co.uk</a></p>
</div> <!-- Content -->
