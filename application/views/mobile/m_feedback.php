<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home.php">Home</a> | 
<b>Feedback</b>
</div> 
<div data-role="collapsible">    
<H4>Feedback</h4>
<p>The C2P web-site is still being developed, and therefore you may notice 
    things that change or appear to stop working. Your patience and cooperation
    is appreciated. Any suggestions you make to help this service work more efficiently 
    will be gratefully received. So please let us have your have any ideas or comments 
    on things that you think might make things easier for other users.</p>
</div>
<a href="#myFeedback" data-rel="popup" class="ui-btn ui-btn-inline">Show Feedback Form</a>
<div data-role="popup" id="myFeedback" class="ui-content" data-theme="a">
    <div data-role="header"><h4>Feedback Form</h4></div>
    <form name="feedback" action="/c2p/feedbacksave" method="POST">
        <div class="ui-field-contain">   
    <label for="Name">Name</label>
    <input name="Name" value="" type="text" size="30" data-mini="true"
        value="<?=(isset($FirstName)?$FirstName:'').' '.(isset($LastName)?$LastName:'');?>"
        placeholder="First & Last Name" data-clear-btn="true" required/>

    <label for="Email">Email Address</label>
    <input name="Email" value="" type="email" size="30"  data-mini="true"
        value="<?=(isset($Email)?$Email:'');?>"
        placeholder="Email address" data-clear-btn="true" required/> 
    <label for="Phone">Phone / Mobile</label>
    <input name="Phone"  type="text" size="30" accept=""  data-mini="true"
       value="<?=(isset($Phone)?$Phone:'');?>"
       placeholder="Phone (incl.code)" data-clear-btn="true" required/>

    <label for="Type">Feedback Topic</label>
    <select name="Type"  data-mini="true" required>
        <option value="">Please select message topic</option>
        <option value="Design">Page Design</option>
        <option value="Enquiry">General Enquiry</option>
        <option value="Process">Referral Process</option>
        <option value="Errors">Errors Encountered</option>
        <option value="Security">Security Concerns</option>
        <option value="Concerns">Other Concerns</option>
        <option value="Concerns">Any Suggestions</option>
     </select>
     <label for="Subject">Message Subject</label>
     <input name="Subject"  data-mini="true"
        value="<?=(isset($Subject)?$Subject:'');?>" type="text" size="30"
        placeholder="Email Subject" data-clear-btn="true" required/>
    <label for="EmailBody">Message Text</label>
    <textarea type="text" name="EmailBody" cols="45" rows="10"  data-mini="true"
        placeholder="Please provide as much information as possible" data-clear-btn="true" 
        required><?=(isset($Emailbody)?$EmailBody:'');?></textarea>
    <?=(isset($Message)?$Message:'');?> 
    <label for="Submit"></label>
    <input name="Submit" type="Submit" value="SEND Message"  data-mini="true"/>
    
    </div>    
    </form>
    <div data-role="footer"><h6>[Please complete all fields]</h6></div>
</div>
<p>All referral emails sent from this web-site are sent out automatically, and 
 therefore the system administrators do not have a copy of any particular email 
 your may have receive. So if you need to highlight an issue with an email you received, 
 please forward a copy of the email to the site developer 
<a href="mailto:aps@lifespeak.co.uk">aps@lifespeak.co.uk</a></p>
</div> <!-- Content -->
