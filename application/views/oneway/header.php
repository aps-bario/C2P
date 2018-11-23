<html>
    <head>
      <title>ONEWAY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
        <meta name="description" content="Helping to connect Chinese Christians going home"/>
        <meta name="keywords" content="Chinese, Returnee, China, Home, Contacts, Churches, Fellowship"/>
       <base href="<?=$_SERVER['HTTP_HOST']."/"?>"><!--[if IE]></base><![endif]-->
  <!-- <link rel="stylesheet" href="../../styles/onewaynew.css" type="text/css">
      <link rel="stylesheet" href="/application/styles/pack6.css<?=date('YmdHis');?>" type="text/css">-->
 <!-- <link rel="stylesheet" href="/application/styles/standard.css" type="text/css">
      <link rel="stylesheet" href="/application/styles/layout.css" type="text/css">
      <link rel="stylesheet" href="/application/styles/site.css" type="text/css">-->
        <link type="text/css" rel="stylesheet" href="/application/styles/onewaynew.css?<?=date('YmdHis');?>">
        <script type="text/javascript" src="/application/scripts/JQuery.js?<?=date('YmdHis');?>"></script>
        <script type="text/javascript" src="/application/scripts/onewaycss.js?<?=date('YmdHis');?>"></script>
    </head>
    <script type="JavaScript">
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
    <body>
 <!--   <body onLoad="moveTopMenu();" onScroll="moveTopMenu();">-->
        <DIV class="paper">
            <DIV class="header">
               <div style="position:abolute; top:0px; float:left">
                   <img id="logo" src="/application/images/Transparent_yellowhandR.png"      >
               </div>
                 <div id="sidemenuicon" style="position:absolute; top:2px; left:2px;">
                    <a href="/mobile/home"><img alt="hand" src="/application/images/onewaymenuicon.jpg" ></a>
                </div>
               <div style="position:relative; top:0; float:left;">
                    <H1 style="margin-top:0px;margin-bottom:0px;">ONEWAY</h1>
                    <h2 style="margin-top:0px;margin-bottom:0px;">helping to connect Chinese Christians going home</h2>
                </div>
            </div>
                <div data-role="panel" id="sidemenu" data-display="overlay" data-theme='b' style="display:none;">
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
         <!--  <div id="navigation-and-content">-->

