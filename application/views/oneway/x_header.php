<html>
    <head>
        <title>ONEWAY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Chinese Christians going home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
  <!--     <base href="/">
  <!-- <link rel="stylesheet" href="../../styles/onewaynew.css" type="text/css">-->
  <!--  <link rel="stylesheet" href="/application/styles/standard.css" type="text/css">
      <link rel="stylesheet" href="/application/styles/layout.css" type="text/css">
      <link rel="stylesheet" href="/application/styles/site.css" type="text/css">-->
      <!-- Warwick Pack6 -->   
      <link rel="stylesheet" href="/application/styles/pack6.css" type="text/css">
      <!-- JQuery Standard -->
      <script type="text/javascript" src="/application/scripts/JQuery.js"></script>
      <!-- JQuery Mobile -->
      <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
      <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
      <!-- ONEWAY Standard -->
      <script type="text/javascript" src="/application/scripts/onewaycss.js<?=date('YmdHis');?>"></script>
      <link rel="stylesheet" href="/application/styles/onewaynew.css<?=date('YmdHis');?>" type="text/css">
      <!-- ONEWAY Mobile -->
      <script type="text/javascript" src="/application/scripts/onewaymobile.js<?=date('YmdHis');?>"></script>
      <link rel="stylesheet" href="/application/styles/onewaymobile.css?<?=date('YmdHis');?>" type="text/css">
        <script type="text/javascript">
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
        </script>
    </head>
    <body>
 <!--   <body onLoad="moveTopMenu();" onScroll="moveTopMenu();">-->
       <DIV class="paper"> 
            <DIV data-role="page">

                <DIV data-role="header" class="header" >
                   <div style="position:abolute; top:0; float:left;">
                       <img id="logo" src="/application/images/Transparent_yellowhandR.png"  >
                   </div>
                   <div id="sidemenuicon" style="position:absolute; top:0px; left:0px;">
                      <a href="#sidemenu"><img alt="hand" src="/application/images/onewaymenuicon.jpg" ></a>
                   </div>
                   <div style="position:relative; top:0; float:left;">
                      <H1>ONEWAY</h1><br/>
                      <h2>helping to connect Chinese Christians going home</h2>
                   </div>
                   <div class="clear-both"></div>
                </div>

                <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='b'>
                    <ul data-role="listview" >
                        <li><a href="/oneway/home" data-icon="home">HOME</a>
                            <ul data-role="listview" class="submenu">
                                <li><a href="/oneway/forreturnees">Returnee</a></li>
                                <li><a href="/oneway/forsponsors">Sponsor</a></li>
                                <li><a href="/oneway/faith">Christian</a></li>
                                <li><a href="/oneway/feedback">Feedback</a></li>
                                <li ><a href="/oneway/logout">Login</a></li>
                            </ul>
                        </li>
                        <li><a href="/member/memberhome">MEMBER</a>
                           <ul data-role="listview" class="submenu">
                                <li><a href="/member/sysupdate">System Update</a></li>
                                <li><a href="/member/editmember">Edit Details</a></li>
                                <li><a href="/member/newpassword">New Password</a></li>
                                <li><a href="/member/newreferee">New Referee</a></li>
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
                </div>

<!--<div data-role="panel" id="sidemenu"  data-display="overlay" class="slide-in-menu from-left" >
<ul data-role="listview" >
   <li data-role="list-divider" class="selected"><span>ONEWAY</span></li>
   <li class="open-submenu"><a href="#" class="open-submenu">::before ::after</a><a href="/oneway/home" data-icon="home">HOME</a>
         <ul data-role="listview" class="submenu">
            <li><a href="/oneway/forreturnees">Returnee</a></li>
            <li><a href="/oneway/forsponsors">Sponsor</a></li>
            <li><a href="/oneway/faith">Christian</a></li>
            <li><a href="/oneway/feedback">Feedback</a></li>
            <li ><a href="/oneway/logout">Login</a></li>
        </ul>
    </li>
   <li><a href="/member/memberhome">MEMBER</a>
       <ul data-role="listview" class="submenu">
            <li><a href="/member/sysupdate">System Update</a></li>
            <li><a href="/member/editmember">Edit Details</a></li>
            <li><a href="/member/newpassword">New Password</a></li>
            <li><a href="/member/newreferee">New Referee</a></li>
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
         <ul data-role="listview"  class="submenu">
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