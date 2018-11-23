<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> |
<a href="../sysadmin/sysadminhome">SysAdmin</a> | 
<b>Amity Spider</b>
</div>
<fieldset><legend>Amity Archive Spider</legend>
    <div id="ExternalContent"></div>
   
</fieldset>
</DIV> <!-- content -->
<SCRIPT>
var targetURL = 'http://www.amitynewsservice.org/page.php?page=1233' 
$("#ExternalContent").append(targetURL);
$(function(){
    $("#ExternalContent").load(targetURL,
    function(responseTxt, statusTxt, xhr){
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
});


function loadHTML(obj,fn,query){
    var xmlhttp;
    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState===4 && xmlhttp.status===200){
            if(document.getElementById(obj)){
                document.getElementById(obj).innerHTML=xmlhttp.responseText;
            }
         //   alert(xmlhttp.responseText);
      //             $('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
     $('#'+obj).html(xmlhttp.responseText).trigger("create"); 
        
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}
    
    
    
    
    
</SCRIPT>