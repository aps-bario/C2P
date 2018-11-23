<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<b>Member</b>
</div>
<H4>Welcome back <?=$FirstName;?> - your member status is currently: <b><?=$Status;?></b></h4>
<p>
    As a member of the C2P network you now have access to various information 
    about helping those returning home to countries like China.</p>
<p>
    Please review the <a href="../member/security">security guidelines</a> about 
    how to protect the identity of friends overseas and what not to put in emails.</P>   
<p>
    If you place your mouse over the <b>My Account</b> menu item above, you will 
    see all the member related pages you may access.</p>
<p>
    There are various access levels within this system, 
    to find out more <a href="../member/accesslevels">click here</a>.</p><?php
if($Status=='Member' or $Status=='SysAdmin') {?>
<p>
    <b>To enter your first returnee referral request 
    <a href="../sponsor/addreturnee">click here</a></b>.</p><?php
} else {?>
    <p>To review or enter more returnee referral requests please use the 
        <b>Returnee</b> menu item above.</p><?php   
}?>
<p>
    This system is continually being added to and improved, 
    so please give us your <a href="../c2p/feedback">feedback</a>.</p>
</DIV> <!-- Content -->
