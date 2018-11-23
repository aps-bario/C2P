<DIV data-role="main" data-theme="a" class="ui-content">
<div style="position:relative; float:right; top:0;"><a href="#help">Help</a></div>    
<div class="breadcrumb"><a href="/mobile/home">Home</a> | 
<a href="/mobile/gatekeeper">Gatekeeper</a> | <b>My Places</b>
</div>
<form id="myplaces" name="myplaces" action="/mobile/ajaxplaces"method="post">
<input name="PageMode" type="Hidden" value="List"/>
<!--<input id="PlaceID" name="PlaceID" type="Hidden" value="<?=(isset($PlaceID)?$PlaceID:'');?>"/>-->
<p><b style="color:red;" id="Message"><?=(isset($Message)?$Message:'');?></b></p>
<p>You will need to select a district before you can update it.</p>    
<div id="Filter" data-role="collapsible" data-collapsed="true">    
<H4>Find / Filter My Places </H4>
<fieldset data-role="controlgroup" data-mini="true">        
    <!--<label for="Country">Country</label>-->
    <select id="Country" name="Country" placeholder="Country" required><!--
            <option value="">[ Select Country ]</option><?php
    if(isset($Countries)){
        foreach($Countries as $country){?>
            <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
        }
    }?>
       --> </select>    

     <!--   <label for="Province">Province</label>-->
        <select id="Province" name="Province" placeholder="Province" required>
        </select>
        <!--<label for="City">City</label>-->
        <select id="City" name="City" placeholder="City" required>
        </select>
        <!-- <label for="Postcode">Postcode</label>-->
        <select id="Postcode" name="Postcode"  placeholder="Postcode">
        </select>
        <!--<label for="District">District</label>-->
        <select id="District" name="District" placeholder="District">
        </select>
        <label for="Reset"></label>
        <input type="Button" id="ResetFilter" value="Reset Filter"/>
   <!-- </div>-->
</fieldset> 
</div>
<div data-role="collapsible" data-collapsed="false"> 
    <H4>My Places List </H4>
    <fieldset data-role="controlgroup" data-mini="true" name="MyPlacesList" id="MyPlacesList" >
    </fieldset>   
        
</div>
<?php
//if(!myplaces.PlaceID.value==''/*or ($Country<>'' AND $Province<>'' AND $City<>'' AND $Postcode<>'' AND $District<>'')*/){?>
<div data-role="collapsible" data-collapsed="false">    
    <H4>Update Place Details </H4>
    <fieldset name="Update" id="Update" data-role="controlgroup" data-mini="true"><!--
    <input type="checkbox" name="Returnee" id="Returnee" <?=((isset($Returnee)?$Returnee:'N')=='Y'?' Checked':'');?>/>
    <label for="Returnee">Another Returnee</label>
    <input type="checkbox" name="Contact" id="Contact" <?=((isset($Contact)?$Contact:'N')=='Y'?' Checked':'');?>/>
    <label for="Contact">A Christian Contact</label>
    <input type="checkbox" name="Fellowship" id="Fellowship" <?=((isset($Fellowship)?$Fellowship:'N')=='Y'?' Checked':'');?>/>
    <label for="Fellowship">A Fellowship Group</label>
    <input type="checkbox" name="Church" id="Church" <?=((isset($Church)?$Church:'N')=='Y'?' Checked':'');?>/>
    <label for="Church">A Good Local Church</label>
    <input type="checkbox" name="Nearby" id="Nearby" <?=((isset($Nearby)?$Nearby:'N')=='Y'?' Checked':'');?>/>
    <label for="Nearby">A Christian Nearby</label>
        <input id="Submit" name="Submit" type=submit value="Submit"
        onclick="this.form.action='/mobile/myplaces';
        this.form.PageMode.value = 'Save'; 
        this.form.submit();"/> 
           <label for="Submit"></label>
   -->
    </fieldset>    
<!--        
        
    <div class="ui-field-contain"> 
        
    <select name="Returnee" onload='toggglecolor(this);' onchange='togglecolor(this);'>
        <option value="N">No other returnees</option>
        <option value="Y"<?=((isset($Returnee)?$Returnee:'N')=='Y'?' Selected':'');?>>Another Returnee</option>
    </select>
    <select name="Contact">
        <option value="N">No Christian contacts</option>
        <option value="Y"<?=((isset($Contact)?$Contact:'N')=='Y'?' Selected':'');?>>A Christian contact</option>
    </select>
    <select name="Fellowship">
        <option value="N">No fellowship groups</option>
        <option value="Y"<?=((isset($Fellowship)?$Fellowship:'N')=='Y'?' Selected':'');?>>A fellowship group</option>
    </select>
    <select name="Church">
        <option value="N">No local churches</option>
        <option value="Y"<?=((isset($Church)?$Church:'N')=='Y'?' Selected':'');?>>A good local church</option>
    </select>
    <select name="Nearby">
        <option value="N">No contacts nearby</option>
        <option value="Y"<?=((isset($Nearby)?$Nearby:'N')=='Y'?' Selected':'');?>>A Christian nearby</option>
    </select>
        <label for="Submit"></label>
        <input id="Submit" name="Submit" type=submit value="Submit"
        onclick="this.form.action='/mobile/myplaces';
        this.form.PageMode.value = 'Save'; 
        this.form.submit();"/> 
</div>
-->

</div><?php
//}else{?>
<!--<b>You need to select a district before you can update it - click on one of the above.</b>--><?php    
//}?>
</form>    
</DIV>
<div data-role="panel" id="help" data-display="push" data-position="right">  
<b>My Places</b>
<p>Places are where you have a connection.</p>
<div data-role="collapsible" data-mini="true">   
<H4>How to find a place</H4>
<p>If you have no places listed, or need to limit the size of the list, first 
    expand the <b>Find / Filter My Places </b></p>
<p> In order to be as precise as possible, a place is defined as a city, postcode 
    or administrative district. It is easier to locate these if you identify the 
    country and province, as this will reduce the number of other options listed.
    It usually helps to start with the country and work down, but if you have a 
    city, district or postcode, then you can go select that first and the other 
    values will be filled in for you.</p>
<p><b>Chinese Postcodes</b> cover large areas and only those that relate to administrative 
    districts will be listed, so if you have a full 6 digit postcode, then simply find the 
    nearest match.</p>
<p>NOTE: As the drop-down lists are limited by the other fields you select, then you
    will need to RESET the fields if you make a mistake or want to start again.</p>
</div>
<div data-role="collapsible" data-mini="true">    
<H4>Adding and editing places</H4>
<p>As you refine your filter, you will see all the places with which you claim a 
    connection listed below. So if you find that you already have a place listed, 
    then edit that entry rather than add a new one. When you have refined your search
    to the point where you have either only one entry or none, then you will be able to 
    edit that entry or add that place to your list. </p>
<p>For each place you select you will be asked to tick a series of options relating 
    to this place. This is the only information that the system will hold about that
    place in relation to you. The more options that you are able to kick, the more
    likely you to be have a returnee referred to you. It is assumed that you know  
    either a returnee or other Christian contact in each place. If you untick all 
    the options then a record will be deleted (or not created). </p>
<p>You will see drop-down lists for country, province, city, postcode and district.
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
</div>
<div data-role="collapsible" data-mini="true">    
<H4>About place statistics</H4>
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p>
<p>As you make each selection other lists will limited and location statistics
    will be updated: <br/>
    STATS:<br/><small>
    Dist: Distinct districts listed within area selected.<br/>
    Plac: Number of places where members have contacts.<br/>
    Cont: Number of people who have a contact in this area.
    Chur: Number of Amity (registered) churches in the area.<br/>
    Grou: Number of fellowship groups known by contacts in area.</small></p> 
</div>
<div data-role="field-contain">[<small> STATS: &nbsp;
            Dist:<?=(isset($Stats['Dist'])?$Stats['Dist']:'0');?> &nbsp;
            Plac:<?=(isset($Stats['Plac'])?$Stats['Plac']:'0');?> &nbsp;
            Cont:<?=(isset($Stats['Cont'])?$Stats['Cont']:'0');?> &nbsp; 
            Chur:<?=(isset($Stats['Chur'])?$Stats['Chur']:'0');?> &nbsp; 
            Grou:<?=(isset($Stats['Grou'])?$Stats['Grou']:'0');?> </small>]
</div>

        
        
</DIV>
<SCRIPT>
// MyPlacesPage Script      
$(document).ready(function(){
   // By default start by listing all places
    var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
    loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
    $('#List').collapsible('expand');
    $('#Filter').triggerHandler('expand',function(){
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
    });        
 
    loadSelectOptions('Country','GetCountryOptions','Country=&Province=&City=&Postcode=&District=');
    $('#Country').change(function(){
        $('#Postcode').hide(0);
        $('#District').hide(0);
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    $('#Province').change(function(){
        $('#Postcode').show(0);
        $('#District').show(0);
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
//        loadValue('Country','GetPlaceCountry',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);    
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    $('#City').change(function(){
        $('#Postcode').show(0);
        $('#District').show(0);
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
//        loadValue('Country','GetPlaceCountry',QueryString);
//        loadValue('Province','GetPlaceProvince',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    $('#Postcode').change(function(){
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
 //       loadValue('Country','GetPlaceCountry',QueryString);
 //       loadValue('Province','GetPlaceProvince',QueryString);
 //       loadValue('City','GetPlaceCity',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    $('#District').on('change',function(){
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value;
//        loadValue('Country','GetPlaceCountry',QueryString);
//        loadValue('Province','GetPlaceProvince',QueryString);
//        loadValue('City','GetPlaceCity',QueryString);
//        loadValue('Postcode','GetPlacePostcode',QueryString);
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    $("label.ui-radio").click(function(){
        alert('Div Clicked');
    }); 
    $(".MyPlacesList").click(function(){
        alert('Checked');
    });       
    $(".MyPlaceRadio").click(function(){
        alert('Checked');
//        loadValue('Country','GetPlaceCountry','PlaceID='+PlaceID.value);
//        loadValue('Province','GetPlaceProvince','PlaceID='+PlaceID.value);
//        loadValue('City','GetPlaceCity','PlaceID='+PlaceID.value);
//        loadValue('Postcode','GetPlacePostcode','PlaceID='+PlaceID.value);
//        loadValue('District','GetPlaceDistrict','PlaceID='+PlaceID.value);
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value+'&PlaceID='+PlaceID.value;
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
        loadHTML('Update','GetMyPlacesFieldSet','PlaceID='+PlaceID.value);
    });
    $('#ResetFilter').click(function(){
        $('#Country').val('China');
        $('#Province').val(''); 
        $('#City').val(''); 
        $('#Postcode').val('');
        $('#District').val('');
        $('#Country').selectmenu("refresh");
        $('#Province').selectmenu("refresh");
        $('#City').selectmenu("refresh");
        $('#Postcode').selectmenu("refresh");
        $('#District').selectmenu("refresh");
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
    });
    
    $('#SubmitDetails').click(function(){
        alert('Submit');
        var QueryString =  'Country='+Country.value+'&Province='+Province.value
           +'&City='+City.value+'&Postcode='+Postcode.value
           +'&District='+District.value+'&PlaceID='+PlaceID.value
           +'&Returnee='+Returnee.value+'&Contact='+Contact.value
           +'&Fellowship='+Fellowship.value+'&Church='+Church.value
           +'&Nearby='+Nearby;
        sendValues('Message','SetMyPlaceDetails',QueryString);
        loadHTML('MyPlacesList','GetMyPlacesRadioList',QueryString);
        loadHTML('Update','GetMyPlacesFieldSet','PlaceID='+PlaceID.value);
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
      //             $('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
     $('#'+obj).html(xmlhttp.responseText).trigger("create"); 
        
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}
function loadValue(obj,fn,query){
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
            //document.getElementById(obj).val(xmlhttp.responseText);
            alert(xmlhttp.responseText);
            $("#".obj).val(xmlhttp.responseText);
            alert($("#".obj).val());
//            var Values = new Array();
//            Values[0] = xmlhttp.responseText;
//            document.getElementById(obj).val(Values);
 
//            var selectedValues = new Array();
//    selectedValues[0] = "a";
//    selectedValues[1] = "c";

//$(".getValue").click(function() {
//    alert($(".leaderMultiSelctdropdown").val());
//});
//$(".setValue").click(function() {
//   $(".Books_Illustrations").val(selectedValues);
//});
            
            $('#'+obj).html(xmlhttp.responseText).trigger("refresh");
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}

function loadSelectOptions(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            $('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
            //$('#'+obj).html(xmlhttp.responseText).trigger("create");
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
    //alert(location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query);
}
    
</script>
<SCRIPT>
/*   

    
function ajaxcall(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            $('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
        }
    };
    // http://css-tricks.com/example/index.html
    // window.location.protocol = "http:"
    // window.location.host = "css-tricks.com"
    // window.location.pathname = "example/index.html"
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
    //alert(location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query); 
}
function loadSelectOptions(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            //$('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
            $('#'+obj).html(xmlhttp.responseText).trigger("create");
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
    //alert(location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query);
}
function loadListItems(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            //$('#MyPlacesList').html('<li>Test</li>');
            //$('#MyPlacesList').re
            $('#'+obj).html(xmlhttp.responseText).trigger("create");
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}
function togglecolor(obj){
        if(obj.value==='Y'){
            obj.style="color:#ffff88;";
        } else {
            obj.style="color:#88ffff;";
        }
    }
   $(document).ready(function(){
        // Grab a select field
        var el = $('#YOUR_SELECT_FIELD');
        // Select the relevant option, de-select any others
        el.val('some value').attr('selected', true).siblings('option').removeAttr('selected');
        // Initialize the selectmenu
        el.selectmenu();
        // jQM refresh
        el.selectmenu("refresh", true);
    }); 
  
    $(document).ready(function(){
        togglecolor($('Returnee'));
        togglecolor($('Contact'));
        togglecolor($('Fellowship'));
        togglecolor($('Church'));
        togglecolor($('Nearby'));
    });
/*   

    
function ajaxcall(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            $('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
        }
    };
    // http://css-tricks.com/example/index.html
    // window.location.protocol = "http:"
    // window.location.host = "css-tricks.com"
    // window.location.pathname = "example/index.html"
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
    //alert(location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query); 
}
    */
/*
function loadListItems(obj,fn,query){
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
            document.getElementById(obj).innerHTML=xmlhttp.responseText;
            //document.getElementById(obj)('Refresh');
            //$('#MyPlacesList').html('<li>Test</li>');
            //$('#MyPlacesList').re
            $('#'+obj).html(xmlhttp.responseText).trigger("create");
        }
    };
    xmlhttp.open("GET",location.protocol+'//'+location.host+"/ajax/"+fn+"?"+query,true);
    xmlhttp.send();
}
*/

   
</script>

