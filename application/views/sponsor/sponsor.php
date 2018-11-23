<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home.php">Home</a> | 
<b>Sponsor</b>
</div>
<H3>RETURNEE SPONSORS Page</H3>
<H4>Welcome back <?=$FirstName;?> - you have <?=$Status;?> access</h4>
<p>
    Your current member status permits you to act as a sponsor for returnees.</p>
<p>
    Returnees are not allowed to use this referral service themselves as we 
    do not want to have their contact details on-line, nor do we want to give
    access to any part of this system to people who have not been verified and
    approved by one of our partner organisations.</P>
<p>
    The system does not hold personal details about returnees,
    but in order to be able to find a contact back home
    it is necessary to know precisely where they are returning to,
    when they are returning (or they arrived home), 
    and a brief note that might help find an appropriate contact. </p>
<p>
    If you place your mouse over the <b>Returnees</b> menu item above, you will 
    see all the returnee related pages you may access. A couple of quick links
    have been added below. </p
<p align="center">
<table style="width:100%;text-align:center;padding:20;">
   <tr>
      <td style="text-align: center;padding:20;">
   <input type="button" onclick="window.location.href='../sponsor/addreturnee';" 
          style="height:50px;width:300px;" value="Enter New Returnee" >
        
      </td>
      <td>&nbsp;</td>
      <td style="text-align: center;padding:20;">
   <input type="button" onclick="window.location.href='../sponsor/myreturnees';" 
          style="height:50px;width:300px;" value="List My Returnees">
      </td>
   </tr>
</table>
</p>
<p>Please feel free to propose other information you would like displayed here.</p>
<!-- The following code adds a copy of latest system updates to the bottom of the page -->
<div id="Updates">
</div>
<script>
$(function(){
    $("#Updates").load("https://www.connecting2people.net/member/sysupdate #Updates",
    function(responseTxt, statusTxt, xhr){
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
});
</script>
</DIV> <!-- Content -->