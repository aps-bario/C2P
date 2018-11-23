<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home.php">Home</a> | 
<b>City Watch</b>
</div>
<H3>CITY WATCH Home Page</H3>
<H4>Welcome back <?=$FirstName;?> - you have <?=$Status;?> access</h4>
<p>This is the home page for the Gatekeeper section of this website. 
    Please feel free to propose what information you would like displayed here.</p>
<p>You will notice that the lefthand menu has now changed giving your more 
    options and functionality</p>
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