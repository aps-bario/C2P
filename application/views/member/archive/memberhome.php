<DIV class="content">
<small>
<a href="../oneway/home.php">Oneway</a> | 
<b>Member</b>
<H4>Welcome back <?=$FirstName;?> - your member status is currently: <b><?=$Status;?></b></h4>
<p>There are various levels of user access in the C2P system. This is in order 
    to keep the system as secure as possible. Before registration visitor access 
    is limited to the C2P menu. As various security stages are passed
    a user progresses up through various levels of membership. There is a brief 
    summary below, but if you need help or clarification please use the Feedback option
    on the C2P menu.</p>
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
            <td>Next step is to provide details of a Referee to confirm their identity.</td>
        </tr>
        <tr>
            <td valign="top"><b>Verified</b></td>
            <td>Email address has been verified, waiting for response from a referee.</td>
            <td>Has confirmed email address by clicking link in email sent.</td>
            <td>May now request enter details of a referee to be allowed member access.</td>
        </tr>
        <tr>
            <td valign="top"><b>Member</b></td>
            <td>Someone whose identity has been confirmed.</td>
            <td>A referee has confirmed identity and suitability to use this service.</td>
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
            <td valign="top"><b>SysAdmin</b></td>
            <td>Website and member administration.</td>
            <td>Have been granted access by another member with SysAdmin privileges.</td>
            <td>Can grant privileges and monitor progress of all referrals.</td>
        </tr>
        <tr>
            <td valign="top"><b>Concerns</b></td>
            <td>Concerns have been expressed.</td>
            <td>You may have had access to this system previously, but another member 
                has expressed concerns about your identity, access privileges or 
                someone else you have entered into the system and are therefore 
                responsible for. Contact the system administrator to determine what
                what has triggered this status to be set.</td>
            <td>AlL access removed except for entering a new referee.</td>
        </tr>
    </table>
</fieldset>
</DIV> <!-- Content -->
