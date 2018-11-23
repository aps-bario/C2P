<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home.php">Home</a> | 
<b>Gatekeeper</b>
</div>
<H3>GATE KEEPER Home Page</H3>
<H4>Welcome back <?=$FirstName;?> - you have <?=$Status;?> access</h4>
<p>This is the home page for the Gatekeeper section of this web-site. 
    Please feel free to propose what information you would like displayed here.</p>
<p align="center">
<table style="width:100%;text-align:center;padding:20;">
   <tr>
      <td style="text-align: center;padding:20;">
   <input type="button" onclick="window.location.href='../gatekeeper/myplaces';" 
          style="height:50px;width:300px;" value="Update my places" >
        
      </td>
      <td>&nbsp;</td>
      <td style="text-align: center;padding:20;">
   <input type="button" onclick="window.location.href='../gatekeeper/myreferrals';" 
          style="height:50px;width:300px;" value="Review my referrals  ">
      </td>
   </tr>
</table>
</p>
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