<!DOCTYPE html>
<html>
    <head>
        <title>Connecting2People</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"><!-- Block Robots -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Christians returning home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
        <base href="/"><!--[if IE]></base><![endif]-->
        <link type="text/css" rel="stylesheet" href="/application/views/styles/c2p.css?<?=date('YmdHis');?>"/>
        <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
        <script type="text/javascript" src="/application/views/scripts/jquery-1.10.2.min.js"></script>
        <!--<script type="text/javascript" src="/application/scripts/JQuery.js?<?=date('YmdHis');?>"></script>-->
        <script type="text/javascript" src="/application/views/scripts/c2p.js?<?=date('YmdHis');?>"></script>
    </head>

    <!--
    <script type="JavaScript">
        if (screen.width <= 800) {
            window.location = "https://www.connecting2people.net/mobile/home";
        }

        function moveTopMenu(){
            var el = document.getElementById("cssmenu");
      var height = el.offsetHeight;
	 var paddingTop = parseInt(el.style.paddingTop)
	 var paddingBottom = parseInt(el.style.paddingBottom)
  	 var borderTop = parseInt(el.style.borderTop)
	 var borderBottom = parseInt(el.style.borderBottom)
		 
	
	var contentHeight = height - paddingTop - paddingBottom - borderTop - borderBottom;
	//Test
	alert(contentHeight)
	
	return contentHeight;

}
    </script>-->
        <style type="text/css">
<!--
//#cookiepolicy { display:none }
#cookiepolicy { display:block; background-color: yellow; text-align: center;}
-->
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
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
<?php
if(!isset($_COOKIE['cookiepolicy'])) { ?>
<div id="cookiepolicy" class="paper" margin="5px">
    <h4>This site uses cookies. Please review our <a href="/c2p/cookiepolicy" id="more">privacy policy</a> &nbsp; - &nbsp;
     <a onclick="SetCookie('cookiepolicy','cookiepolicy',365*10); $('#cookiepolicy').hide();">OK<!--Got&nbsp;it--></a></h4>
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
            
 <!--   <body onLoad="moveTopMenu();" onScroll="moveTopMenu();">-->
        <DIV class="paper">           
            <DIV class="header">
                <div style="position:abolute; top:0px; float:left">
                   <img id="logo" src="/application/views/images/Transparent_yellowhandR.png"      >
               </div>
                 <div id="sidemenuicon" style="position:absolute; top:2px; left:2px;">
                    <a href="/mobile/home"><img alt="hand" src="/application/views/images/onewaymenuicon.jpg" ></a>
                </div>
               <div style="position:relative; top:0; float:left;">
                    <H1 style="margin-top:0px;margin-bottom:0px;">Connecting<font size="7">2</font>People.net</h1>
                    <h2 style="margin-top:0px;margin-bottom:0px;">&nbsp;A network of people helping to connect Christians returning home</h2>
                </div>
            </div>
<!--            
                <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='b' style="display:none;">
        <ul data-role="listview" >
            <li><a href="/c2p/home" data-icon="home">HOME</a>
                <ul data-role="listview" class="submenu">
                    <li><a href="c2p/forreturnees">Returnee</a></li>
                    <li><a href="c2p/forsponsors">Sponsor</a></li>
                    <li><a href="c2p/faith">Christian</a></li>
                    <li><a href="c2p/feedback">Feedback</a></li>
                    <li ><a href="c2p/logout">Login</a></li>
                </ul>
            </li>
            <li><a href="/member/memberhome">MEMBER</a>
               <ul data-role="listview" class="submenu">
                    <li><a href="/member/sysupdate">System Update</a></li>
                    <li><a href="/member/editmember">Edit Details</a></li>
                    <li><a href="/member/newpassword">New Password</a></li>
                    <li><a href="/member/newreference">New Reference</a></li>
                </ul>
            </li>
            <li><a href="/sponsor/sponsorhome">SPONSOR</a>
                <ul data-role="listview" class="submenu">
                    <li><a href="/sponsor/newreturnee">New Returnee</a></li>
                    <li><a href="/sponsor/myreturnees">My Returnees</a></li>
                </ul>
            </li>
            <li><a href="/gatekeeper/gatekeeperhome">GATEKEEPER</a>
                <ul data-role="listview"  class="submenu">
                    <li><a href="/gatekeeper/allchurches">Churches</a></li>
                    <li><a href="/gatekeeper/mygroups">Groups</a></li>
                    <li><a href="/gatekeeper/mycontacts">Contacts</a></li>
                    <li><a href="/gatekeeper/mydistricts">Districts</a></li>
                    <li><a href="/gatekeeper/myreferrals">Referrals</a></li>
                </ul>
            </li>
            <li><a href="/sysadmin/systemhome">SYSTEM</a>
                <ul data-role="listview"   class="submenu">
                    <li><a href="/sysadmin/allmembers">Members</a></li>
                    <li><a href="/sysadmin/allcontacts">Contacts</a></li>
                    <li><a href="/sysadmin/allchurches">Churches</a></li>
                    <li><a href="/sysadmin/allgroups">Groups</a></li>
                    <li><a href="/sysadmin/allreturnees">Returnees</a></li>
                    <li><a href="/sysadmin/allreferrals">Referrals</a></li>
                </ul>
            </li>
        </ul>
    </div>-->
         <!--  <div id="navigation-and-content">-->

