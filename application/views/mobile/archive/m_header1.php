<!DOCTYPE html>
<html lang="en">
    <head>
        <title>C2P Mobile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Chinese Christians going home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
    <!--    <base href="/">
        <!-- JQuery Standard -->
        <script type="text/javascript" src="/application/scripts/JQuery.js"></script>
        <!-- JQuery Mobile -->
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
        <!-- C2P Standard -->
        <!--<script type="text/javascript" src="/application/scripts/onewaycss.js<?=date('YmdHis');?>"></script>-->
        <!--<link rel="stylesheet" href="/application/styles/onewaynew.css<?=date('YmdHis');?>" type="text/css">-->
        <!-- C2P Mobile -->
        <!--<script type="text/javascript" src="/application/scripts/onewaymobile.js<?=date('YmdHis');?>"></script>
        <link rel="stylesheet" href="/application/styles/onewaymobile.css?<?=date('YmdHis');?>" type="text/css">-->
    </head>
    <body>
        <DIV data-role="page" data-theme="a">
            <DIV data-role="header">
                <a href="#sidemenu" class="ui-btn ui-icon-bars ui-btn-icon-left">Menu</a>
                <H1>C2P</h1>
                <a href="/oneway/home" class="ui-btn-icon-right" style="padding:0; margin:0;">
                    <img id="logo" src="/application/images/onewayicon.jpg" style="padding:0; margin:0;">
                </a>
            </div>
            <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='a'>
                <ul data-role="listview" >
                    <li><a href="/mobile/home" class="ui-btn ui-icon-home ui-btn-icon-left">C2P</a></li><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
    or $Status=='Member' or $Status=='Concerns' 
    or $Status=='Sponsor' or $Status=='Gatekeeper'
    or $Status=='SysAdmin')){?>
                    <li><a href="/mobile/forreturnees">Returnee</a></li>
                    <li><a href="/mobile/forsponsors">Sponsor</a></li>
                    <li><a href="/mobile/faith">Christian</a></li><?php
                   } else {?>
                    <li><a href="/mobile/login" data-icon="arrow-r">Login</a></li>
                    <li><a href="/mobile/newmember" data-icon="arrow-r">Register</a></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                    <li><a href="/mobile/member">MEMBER</a></li>
                    <li><a href="/mobile/sysupdate" data-icon="arrow-r">System Update</a></li>
                    <li><a href="/mobile/editmember" data-icon="arrow-r">Edit Details</a></li>
                    <li><a href="/mobile/newpassword" data-icon="arrow-r">New Password</a></li>
                    <li><a href="/mobile/newreferee" data-icon="arrow-r">New Referee</a></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                    <li><a href="/mobile/sponsor">SPONSOR</a></li>
                    <li><a href="/mobile/newreturnee">New Returnee</a></li>  
                    <!--<li><a href="/mobile/myreturnees" data-icon="arrow-r">My Returnees</a></li>--><?php
                        }
if(isset($Status) and ($Status=='Gatekeeper' OR $Status=='SysAdmin')){?>
                    <li><a href="/mobile/gatekeeper">GATEKEEPER</a></li>
<!--                    <li><a href="/mobile/allchurches" data-icon="arrow-r">Churches</a></li>
                    <li><a href="/mobile/mygroups" data-icon="arrow-r">Groups</a></li>
                    <li><a href="/mobile/mycontacts" data-icon="arrow-r">Contacts</a></li>
                    <li><a href="/mobile/mydistricts" data-icon="arrow-r">Districts</a></li>
                    <li><a href="/mobile/myreferrals" data-icon="arrow-r">Referrals</a></li>--><?php
}
if(isset($Status) and ($Status=='SysAdmin')){?>
                    <li><a href="/mobile/sysadmin">SYSADMIN</a></li>
<!--                    <li><a href="/mobile/allmembers" data-icon="arrow-r">Members</a></li>
                    <li><a href="/mobile/allcontacts" data-icon="arrow-r">Contacts</a></li>
                    <li><a href="/mobile/allchurches" data-icon="arrow-r">Churches</a></li>
                    <li><a href="/mobile/allgroups" data-icon="arrow-r">Groups</a></li>
                    <li><a href="/mobile/allreturnees" data-icon="arrow-r">Returnees</a></li>
                    <li><a href="/mobile/allreferrals" data-icon="arrow-r">Referrals</a></li>--><?php
}                
if(isset($Status) and ($Status=='Registered' or $Status=='Verified' or $Status=='Concerns' 
    or $Status=='Member' or $Status=='Sponsor' or $Status=='Gatekeeper' or $Status=='SysAdmin')){?>
                   <li><a href="/mobile/feedback" data-icon="arrow-r">Feedback</a></li>
                   <li><a href="/mobile/logout" data-icon="arrow-r">Logout</a></li><?php
}?>             </ul>
            </div>