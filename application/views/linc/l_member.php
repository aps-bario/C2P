<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/linc/home.php">Home</a> | 
<b>Member</b>
</div>
    <H4>Welcome back <?=$FirstName;?></h4>
    <h5>Current user status: <b><?=$Status;?></b></h5>
<p>There are various levels of user access in this system. This is in order 
    to keep the system as secure as possible. Before registration visitor access 
    is limited to the HOME menu. As various security stages are passed
    a user progresses up through various levels of membership. There is a brief 
    summary below, but if you need help or clarification please use the Feedback option
    on the HOME menu.</p>
<fieldset>
    <legend> Membership Level Summary</legend>
<style>
table, tr, th, td, input, select{font-size:x-small;}
td, th {padding:5px; vertical-align: top; text-align: left;}
</style>    
    <table>
        <tr>
            <th>Status</th>
            <th>Description</th>
            <th>Requirement</th>
            <th>Privileges</th>
        </tr>
        <tr>
            <td valign="top"><b>Registered</b></td>
            <td>New user waiting for email address and identity verification.</td>
            <td>Completed all fields on the registration form, but has not yet 
                replied to the request to confirm their email address.</td>
            <td>Next step is to provide details of a Reference to confirm their identity.</td>
        </tr>
        <tr>
            <td valign="top"><b>Verified</b></td>
            <td>Email address has been verified, waiting for response from a reference.</td>
            <td>Has confirmed email address by clicking link in email sent.</td>
            <td>May now request enter details of a reference to be allowed member access.</td>
        </tr>
        <tr>
            <td valign="top"><b>Member</b></td>
            <td>Someone whose identity has been confirmed.</td>
            <td>A reference has confirmed identity and suitability to use this service.</td>
            <td>May now made a referral request by entering details of a New Returnee.</td>
        </tr>
        <tr>
            <td valign="top"><b>Sponsor</b></td>
            <td>Someone who submits details of Returnees and can monitor progress.</td>
            <td>At least one Returnee request has been submitted.</td>
            <td>Has access to 'My Returnees' in order to monitor referral progress.</td>
        </tr>
        <tr>
            <td valign="top"><b>Gatekeeper</b></td>
            <td>Someone who has a list of contacts or groups in Returnee home countries.</td>
            <td>Have been approved and upgraded by a System Administrator.</td>
            <td>Able to enter contact and group locations, and monitor their referrals.</td>
        </tr>
        <tr>
            <td valign="top"><b>CityWatch</b></td>
            <td>Gatekeepers who has a special responsibility to monitor returnee
                referrals to a specific city or location.</td>
            <td>Have been approved and upgraded by a System Administrator.</td>
            <td>Receive copies of initial referral requests for places for 
                which they have been given responsibility.</td>
        </tr>
        <tr>
            <td valign="top"><b>SysAdmin</b></td>
            <td>Website and member administration.</td>
            <td>Have been granted access by another member with SysAdmin privileges.</td>
            <td>Can grant privileges and monitor progress of all referrals.</td>
        </tr>
        <tr>
            <td valign="top"><b>Concerns</b></td>
            <td>Concerns have been expressed.</td>
            <td>Security concerns have been raised by another member, about the 
                way you, or someone your introduced to the site, have used or 
                communicated about information regarding returnees or contact.
                Contact the system administrator.</td>
            <td>AlL access removed except for entering a new reference.</td>
        </tr>
    </table>
</fieldset>
</DIV> <!-- Content -->
