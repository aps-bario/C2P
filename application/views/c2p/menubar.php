<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/application/views/scripts/sticky.js"></script>
<script>    
// Sticky Plugin v1.0.0 for jQuery - http://stickyjs.com/
// Requires the file sticky.js 
$(function(){
    $("#menubar").sticky({topSpacing:0});
});
</script>
<!-- <img style="height:15px;" id="logo" 
                 src="/application/images/Transparent_yellowhandR.png"> -->
<div id="menubar">
    <ul class="menu-level-1">
        <li class="<?=(($Menu=='c2p' and $NextPage!='c2p/login')?'active':'');?>">
            <a href="/c2p/home">HOME</a>
            <ul class="menu-level-2">
                <li class="<?=($NextPage=='c2p/home'?'active':'');?>"> 
                    <a href="/c2p/home">Welcome</a> 
                </li>
                <li class="<?=($NextPage=='c2p/forreturnees'?'active':'');?>">
                    <a href="/c2p/forreturnees">Returnee</a>  
                </li>
                <li class="<?=($NextPage=='c2p/forsponsors'?'active':'');?>">
                    <a href="/c2p/forsponsors">Sponsor</a>   
                </li>
                <li class="<?=($NextPage=='c2p/faith'?'active':'');?>">
                    <a href="/c2p/faith">Our Beliefs</a>  
                </li>
                <li class="<?=($NextPage=='c2p/gdpr'?'active':'');?>">
                    <a href="/c2p/gdpr">Data Protection</a>  
                </li>
                <li class="<?=($NextPage=='c2p/feedback'?'active':'');?>">
                    <a href="/c2p/feedback">Feedback</a>
                </li>
                <li class="<?=($NextPage=='c2p/newmember'?'active':'');?>">
                    <a href="/c2p/newmember">Register</a>
                </li>
            </ul>
        </li><?php  
if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns' 
        or $Status=='Sponsor' or $Status=='Gatekeeper'
        or $Status=='Watchman' or $Status=='SysAdmin')){?>
        <li class="<?=($Menu=='member'?'active':'');?>">
            <a href="/member/member">My Account</a>
            <ul class="menu-level-2"><?php
            if(isset($Status) and ($Status=='Member')){?>
                <li class="<?=($NextPage=='member/addreturnee'?'active':'');?>">
                    <a href="/sponsor/addreturnee">My 1st Returnee</a>
                </li><?php
            }?>
                <li class="<?=($NextPage=='member/sysupdate'?'active':'');?>">
                    <a href="/member/sysupdate">System Updates</a>
                </li>
                <li class="<?=($NextPage=='member/security'?'active':'');?>">
                    <a href="/member/security">Security Warning</a>
                </li>
                <li class="<?=($NextPage=='member/accesslevels'?'active':'');?>">
                    <a href="/member/accesslevels">Access Levels</a>
                </li>                <?php  
    if(isset($Status) and ($Status=='Registered' or $Status=='Verified'
        or $Status=='Member' or $Status=='Concerns'  
        or $Status=='Sponsor' or $Status=='Gatekeeper'
        or $Status=='Watchman' or $Status=='SysAdmin')){?>  
                <li class="<?=($NextPage=='member/editmember'?'active':'');?>">
                    <a href="/member/editmember">Edit My Details</a>
                </li>
                <li class="<?=($NextPage=='member/newpassword'?'active':'');?>">
                    <a href="/member/newpassword">Change Password</a>
                </li>
                <li class="<?=($NextPage=='member/newreference'?'active':'');?>">
                    <a href="/member/newreference">Add Reference</a>
                </li>
                <?php
    }?>
            </ul>
        </li><?php  
} else {?>
        <li></li><?php
}
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='Watchman' or $Status=='SysAdmin')){?>
        <li class="<?=($Menu=='sponsor'?'active':'');?>">
            <a href="/sponsor/sponsor">Returnees</a>
            <ul class="menu-level-2"><?php 
    if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?>     
                 <li class="<?=($NextPage=='sponsor/myreturnees'?'active':'');?>">
                    <a href="/sponsor/myreturnees">My Returnees</a>
                </li>
                <li class="<?=($NextPage=='sponsor/addreturnee'?'active':'');?>">
                    <a href="/sponsor/addreturnee">Add Returnee</a>
                </li>
                <li class="<?=($NextPage=='sponsor/networks'?'active':'');?>">
                    <a href="/sponsor/networks">Other Networks</a>
                </li>
               <!--
                <li class="<?=($NextPage=='sponsor/newreturnee'?'active':'');?>">
                    <a href="/sponsor/newreturnee">New Returnee</a>
                </li>-->
                
                <?php  
    }?>     </ul>
        </li><?php  
} else {?>
        <li></li><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' or $Status=='Watchman' 
        or $Status=='SysAdmin')){?>
        <li class="<?=($Menu=='gatekeeper'?'active':'');?>">
            <a href="/gatekeeper/gatekeeper">Gatekeepers</a>
            <ul class="menu-level-2">
                <li class="<?=($NextPage=='gatekeeper/allchurches'?'active':'');?>">
                    <a href="/gatekeeper/allchurches">Churches</a>
                </li>              
                <li class="<?=($NextPage=='gatekeeper/myplaces'?'active':'');?>">
                    <a href="/gatekeeper/myplaces">My Places</a>                   
                </li>
                <li class="<?=($NextPage=='gatekeeper/addplaces'?'active':'');?>">
                    <a href="/gatekeeper/addplaces">Add Places</a>              
                </li>
                <!--<li class="<?=($NextPage=='gatekeeper/oldplaces'?'active':'');?>">
                    <a href="/gatekeeper/oldplaces">Old Places</a>                   
                </li>-->
                <li class="<?=($NextPage=='gatekeeper/myreferrals'?'active':'');?>">
                    <a href="/gatekeeper/myreferrals">My Referrals</a>
                </li>
            </ul>
        </li><?php  
} else {?>
        <li></li><?php  
}/*
 * 
 * City Watch has been removed re. concerns about GDPR 3rd Party hidden data transfer.
 * 
 */
if(FALSE and isset($Status) and ($Status=='CityWatch' or $Status=='SysAdmin')){?>
        <li class="<?=($Menu=='citywatch'?'active':'');?>">
            <a href="/citywatch/citywatch">CityWatch</a>
            <ul class="menu-level-2">
                <li class="<?=($NextPage=='citywatch/cityreferrals'?'active':'');?>">
                    <a href="/citywatch/cityreferrals">City Referrals</a>
                </li>
            </ul>
        </li><?php  
} else {?>
        <li></li><?php  
}
if(isset($Status) and ($Status=='Gatekeeper' or $Status=='Watchman' 
        or $Status=='SysAdmin')){?>
        <li class="<?=($Menu=='reports'?'active':'');?>">
            <a href="/reports/reports">Reports</a>
            <ul class="menu-level-2"><!--
                <li class="<?=($NextPage=='sysadmin/allmembers'?'active':'');?>">
                    <a href="/sysadmin/allmembers">Members</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/membertree'?'active':'');?>">
                    <a href="/sysadmin/membertree">Member Tree</a>  
                </li>-->
                <li class="<?=($NextPage=='reports/progbylocs'?'active':'');?>">
                    <a href="/reports/progbylocs">By Location</a>  
                </li>
                <li class="<?=($NextPage=='reports/progbyspon'?'active':'');?>">
                    <a href="/reports/progbyspon">By Sponsor</a>  
                </li>
                <li class="<?=($NextPage=='reports/progbygate'?'active':'');?>">
                    <a href="/reports/progbygate">By Gatekeeper</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allreturnees'?'active':'');?>">
                    <a href="/sysadmin/allreturnees">Returnees</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allreferrals'?'active':'');?>">
                   <a href="/sysadmin/allreferrals">Referrals</a>  
                </li><!--
                <li class="<?=($NextPage=='sysadmin/allchurches'?'active':'');?>">
                    <a href="/sysadmin/allchurches">Churches</a>
                </li>-->
            </ul>
        </li><?php  
} else {?>
        <li></li><?php  
}
if(isset($Status) and ($Status=='SysAdmin')){?>
        <li class="<?=($Menu=='sysadmin'?'active':'');?>">
            <a href="/sysadmin/sysadmin">Admin</a>
            <ul class="menu-level-2">
                <li class="<?=($NextPage=='sysadmin/allmembers'?'active':'');?>">
                    <a href="/sysadmin/allmembers">Members</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/membertree'?'active':'');?>">
                    <a href="/sysadmin/membertree">Member Tree</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/refereetree'?'active':'');?>">
                    <a href="/sysadmin/refereetree">Referee Tree</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allplaces'?'active':'');?>">
                    <a href="/sysadmin/allplaces">Places</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allreturnees'?'active':'');?>">
                    <a href="/sysadmin/allreturnees">Returnees</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allreferrals'?'active':'');?>">
                   <a href="/sysadmin/allreferrals">Referrals</a>  
                </li>
                <li class="<?=($NextPage=='sysadmin/allchurches'?'active':'');?>">
                    <a href="/sysadmin/allchurches">Churches</a>
                </li>
            </ul>
        </li><?php  
} else {?>
        <li></li><?php  
}?>    
        <li class="<?=($NextPage=='c2p/login'?'active':'');?>">
            <a href="/c2p/logout"><?=(!isset($Status) or $Status=='')?'Login':'Logout';?></a>
        </li>
    </ul>    
</div> 
<style>   
/* Menu Styles */
#menubar {
    //font: 14px Arial, Helvetica, sans-serif;
    font-family: Georgia, "Liberation Serif", serif;
    
    font-size: 12px;
    width:100%;
    padding: 0;
    margin: 0;
    color: #FFFFFF;
    background: #440000;
} 
ul.menu-level-1 {
    list-style: none;
    padding: 0;
    margin: 0;
    color: #FFFFFF;
    background: #440000;  
    text-align: center;
}
ul.menu-level-1 > li {
    position: relative;
    float: left;
    height: 25px;
    width: 120px;
    margin: 0;
    color: #FFFFFF;
    font-weight: normal;
    background: #440000;
    padding: 0;
    //padding: 0 0 0 4px;
    //line-height: 25px;  
    vertical-align: middle;
    text-align: left;
}
ul.menu-level-2 {
    position: absolute;
    top: 25px;
    left: 0;
    width: 120px;
    list-style: none;
    padding: 0;
    margin: 0;
    display: none;
    border-width:1px;
    border-style: solid;
    border-color: #440000;
    
}
ul.menu-level-2 > li {
    position: relative;
    height: 25px;
    margin: 0;
    padding: 0 0 0 4px;
    padding: 0;
    color: #FFFFFF;
    font-weight: normal;
    background: #440000;
    //background: transparent;
    
    padding: 0;
    vertical-align: middle;
    text-align: center;
}
ul.menu-level-3 {
    position: absolute;
    top: 0;
    right: -120px;
    width: 120px;
    list-style: none;
    padding: 0 0 0 4px; 
    padding: 0;
    display: none;
}
ul.menu-level-3 > li {
    height: 25px;
    color: #FFFFFF;
    font-weight: normal;
    background: #440000;
      background: transparent;
    vertical-align: middle;
    text-align: left;
}
// Menu Link Styles
/* Apply to all links inside the multi-level menu */
ul.menu-level-1 > li > a {
    /* Make the link cover the entire list item-container */
    display: block;
    //line-height: 25px;
    text-decoration: none;
    font-family: Georgia, "Liberation Serif", serif;
    background: #440000;
    color: #FFFFFF;
    min-width: 120px;
}
ul.menu-level-2 > li > a {
    display: block;
    //line-height: 25px;
    text-decoration: none;
    font-family: Georgia, "Liberation Serif", serif;
    background: #440000;
    color: #FFFFFF;
}
    
/*
ul.menu-level-1 > li.active {color: #FFFFFF; background: #c93e3c;}
ul.menu-level-2 > li.active {color: #FFFFFF; background: #c93e3c;}
ul.menu-level-3 > li.active {color: #FFFFFF; background: #c93e3c;}
ul.menu-level-1 > li:hover {color: #FFFF00; background: #c93e3c; font-weight: bold;}
ul.menu-level-2 > li:hover {color: #FFFF00; background: #c93e3c; font-weight: bold;}
ul.menu-level-3 > li:hover {color: #FFFF00; background: #c93e3c; font-weight: bold;}

ul.menu-level-1 > li.active {color: #FFFFFF; background: inherit;}
ul.menu-level-2 > li.active {color: #FFFFFF; background: #inherit;}
ul.menu-level-3 > li.active {color: #FFFFFF; background: #inherit;}
ul.menu-level-1 > li:hover {color: #FFFF00; background: #inherit; font-weight: bold;}
ul.menu-level-2 > li:hover {color: #FFFF00; background: #inherit; font-weight: bold;}
ul.menu-level-3 > li:hover {color: #FFFF00; background: #inherit; font-weight: bold;}


ul.menu-level-1 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-2 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-3 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-1 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}
ul.menu-level-2 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}
ul.menu-level-3 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}
*/

/* On hover, display the next level's menu */
ul.menu-level-1 li:hover > ul { display: inline;}
/* Ensure that anchor links use the colour from the LI tag they sit in */
ul.menu-level-1 > li > a {
    color: inherit; 
    height: 16px;
    background: inherit; 
    text-decoration: none; 
    
    border-radius: 5px;
    -moz-border-radius: 5px;
    border-width:1px;
    border-style: solid;
    border-color: #FFFFFF;
    padding: 1px 1px 1px 1px;
    
    text-align:center;
    display:inline-block;
    
    width:110px;
    min-width:110px;
    
    font-family: Georgia, "Liberation Serif", serif;
    font-weight:normal;
    font-size:12px;
    vertical-align: middle;
}

ul.menu-level-2 > li > a {
    color: inherit; 
    height: 16px;
    background: inherit; 
    text-decoration: none; 
    
    border-radius: 5px;
    -moz-border-radius: 5px;
    border-width:1px;
    border-style: solid;
    border-color: #FFFFFF;
    padding: 1px 1px 1px 1px;
    
    min-width: 110px;
    width: 110px;
    
    font-family: Georgia, "Liberation Serif", serif;
    font-weight:normal;
    font-size:12px;
    vertical-align: middle;
    
}
ul.menu-level-1 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-2 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-3 > li.active > a {color: #000000; background: #FFFFFF;}
ul.menu-level-1 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}
ul.menu-level-2 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}
ul.menu-level-3 > li > a:hover {color: #000000; background: #FFFF00; font-weight: bold;}

/* Can a class be changed when an item is selected ?? */
ul.menu-level-1 li:active {class:current;}
/* Sticky menu floating to top of screen */
div.menubar.fixed {position: fixed;top: 0px;bottom: auto;}
div.menubar.fixed-bottom {position: absolute;z-index: auto;bottom: 0px;top: auto;}
</style>



