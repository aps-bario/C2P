<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LINC Mobile</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Chinese Christians going home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
        <base href="<?=$_SERVER['HTTP_HOST']."/"?>"><!--[if IE]></base><![endif]-->
        <!-- JQuery Standard -->
        <!--<script type="text/javascript" src="/application/scripts/JQuery.js"></script>-->
        <!--<script type="text/javascript" src="../../scripts/jquery-1.10.2.min.js"></script>-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <!-- JQuery Mobile -->
        <script type="text/javascript" src="https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        <!--<script type="text/javascript" src="../../scripts/jquery.mobile-1.4.2.min.js"></script>-->
        <!--<link type="text/css" rel="stylesheet" href="../../scripts/jquery.mobile-1.4.2.min.css"/>-->
        <link type="text/css" rel="stylesheet" href="https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css"/>
        <link type="text/css" rel="stylesheet" href="/application/styles/C2PMobile.min.css?<?=date('YmdHis');?>">
    </head>
    <body>
        <DIV data-role="page" data-theme="l">
            <DIV data-role="header">
                <a href="#sidemenu" class="ui-btn ui-icon-bars ui-btn-icon-left">Menu</a>
                <H1>LINC Ministries</h1>
                <a href="http://www.lincministries.org.uk/" class="ui-btn-icon-right" style="padding:0; margin:0;">
                    <img id="logo" src="/application/images/linclogo.jpg" style="height:30px; padding:0; margin:0;">
                </a>
            </div>
            <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='l'>
                <ul data-role="listview" >
                    <li><a href="/linc/home" class="ui-btn ui-icon-home ui-btn-icon-left">C2P</a></li><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
    or $Status=='Member' or $Status=='Concerns' 
    or $Status=='Sponsor' or $Status=='Gatekeeper'
    or $Status=='SysAdmin')){?>
                    <li><a href="/linc/forreturnees">Returnee</a></li>
                    <li><a href="/linc/forsponsors">Sponsor</a></li>
                    <li><a href="/linc/faith">Christian</a></li><?php
                   } else {?>
                    <li><a href="/linc/login" data-icon="arrow-r">Login</a></li>
                    <li><a href="/linc/newmember" data-icon="arrow-r">Register</a></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                    <li><a href="/linc/member">MEMBER</a></li>
                    <li><a href="/linc/sysupdate" data-icon="arrow-r">System Update</a></li>
                    <li><a href="/linc/editmember" data-icon="arrow-r">Edit Details</a></li>
                    <li><a href="/linc/newpassword" data-icon="arrow-r">New Password</a></li>
                    <li><a href="/linc/newreference" data-icon="arrow-r">New Reference</a></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                    <li><a href="/linc/sponsor">SPONSOR</a></li>
                    <li><a href="/linc/newreturnee">New Returnee</a></li>  
                    <!--<li><a href="/linc/myreturnees" data-icon="arrow-r">My Returnees</a></li>--><?php
                        }
if(isset($Status) and ($Status=='Gatekeeper' OR $Status=='SysAdmin')){?>
                    <li><a href="/linc/gatekeeper">GATEKEEPER</a></li>
<!--                    <li><a href="/linc/allchurches" data-icon="arrow-r">Churches</a></li>
                    <li><a href="/linc/mygroups" data-icon="arrow-r">Groups</a></li>
                    <li><a href="/linc/mycontacts" data-icon="arrow-r">Contacts</a></li>
                    <li><a href="/linc/mydistricts" data-icon="arrow-r">Districts</a></li>
                    <li><a href="/linc/myreferrals" data-icon="arrow-r">Referrals</a></li>--><?php
}
if(isset($Status) and ($Status=='SysAdmin')){?>
                    <li><a href="/linc/sysadmin">SYSADMIN</a></li>
<!--                    <li><a href="/linc/allmembers" data-icon="arrow-r">Members</a></li>
                    <li><a href="/linc/allcontacts" data-icon="arrow-r">Contacts</a></li>
                    <li><a href="/linc/allchurches" data-icon="arrow-r">Churches</a></li>
                    <li><a href="/linc/allgroups" data-icon="arrow-r">Groups</a></li>
                    <li><a href="/linc/allreturnees" data-icon="arrow-r">Returnees</a></li>
                    <li><a href="/linc/allreferrals" data-icon="arrow-r">Referrals</a></li>--><?php
}                
if(isset($Status) and ($Status=='Registered' or $Status=='Verified' or $Status=='Concerns' 
    or $Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                   <li><a href="/linc/feedback" data-icon="arrow-r">Feedback</a></li>
                   <li><a href="/linc/logout" data-icon="arrow-r">Logout</a></li><?php
}?>             </ul>
            </div>