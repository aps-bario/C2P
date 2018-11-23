<!DOCTYPE html>
<html lang="en">
    <head>
        <title>C2P Mobile</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"><!-- Block Robots -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Chinese Christians going home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
        <!--<base href="<?=$_SERVER['HTTP_HOST']."/"?>"><!--[if IE]></base><![endif]-->
        <base href="/"><!--[if IE]></base><![endif]-->
        <!-- JQuery Standard -->
        <!--<script type="text/javascript" src="/application/scripts/JQuery.js"></script>-->
        <!--<script type="text/javascript" src="../../scripts/jquery-1.10.2.min.js"></script>-->
        <!-- The Order of Script files is important 1. JQuery, 2.Custom, 3.JQM Mobile-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <!--<script type="text/javascript" src="/application/views/scripts/C2PMobile.js?<?=date('YmdHis');?>"></script>-->
        <script type="text/javascript" src="https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        <!--<script type="text/javascript" src="/application/views/scripts/jquery.mobile-1.4.2.min.js"></script>-->
        <link type="text/css" rel="stylesheet" href="/application/views/styles/jquery.mobile-1.4.5.min.css"/>
        <!--<link type="text/css" rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>-->
        <link type="text/css" rel="stylesheet" href="/application/views/styles/C2PMobile.min.css"> <!--?<?=date('YmdHis');?>">-->
    </head><style type="text/css">
<!--
//#cookiepolicy { display:none }
#cookiepolicy { display:block; background-color: yellow; text-align: center;}
-->
</style>
    <?php
if(!isset($_COOKIE['cookiepolicy'])) { ?>
<script type="text/javascript">
function SetCookie(c_name,value,expiredays) {
var exdate=new Date()
exdate.setDate(exdate.getDate()+expiredays)
document.cookie=c_name+ "=" +escape(value)+";path=/"+((expiredays==null) ? "" : ";expires="+exdate.toUTCString())
}
</script>
<?php } ?>
<body>

        <DIV data-role="page" data-theme="c">
            <?php
if(!isset($_COOKIE['cookiepolicy'])) { ?>
<div id="cookiepolicy" class="paper" margin="5px">
    This site uses cookies. See <a href="/mobile/cookie" id="more">details</a>. <a onclick="SetCookie('cookiepolicy','cookiepolicy',365*10); $('#cookiepolicy').hide();">Got&nbsp;It</a>
</div>
<script type="text/javascript">
if(document.cookie.indexOf("cookiepolicy") ===-1){
    $("#cookiepolicy").show();
//    SetCookie('cookiepolicy','cookiepolicy',365*10)
//} else {
//    $("#cookiepolicy").remove();
}
//$("#cookiepolicy").remove();
</script>
<?php } ?> 
            <DIV data-role="header">
                <a href="#sidemenu" class="ui-btn ui-icon-bars ui-btn-icon-left">Menu</a>
                <H1>C2P Mobile</h1>
                <a href="/c2p/home" class="ui-btn-icon-right" style="padding:0; margin:0;">
                    <img id="logo" src="/application/views/images/onewayicon.jpg" style="padding:0; margin:0;">
                </a>
            </div>
            <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='c'>
                <ul data-role="listview" >
                    <li><a href="/mobile/home" class="ui-btn ui-icon-home ui-btn-icon-left">Home</a></li><?php  
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
                    <li><a href="/mobile/newreference" data-icon="arrow-r">New Reference</a></li><?php
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