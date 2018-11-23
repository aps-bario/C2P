<DIV data-role="main" data-theme="a" class="ui-content">
<div style="position:relative; float:right; top:0;"><a href="#help">Help</a></div>    
<div class="breadcrumb"><a href="/mobile/home">Home</a> | 
<a href="/mobile/gatekeeper">Gatekeeper</a> | <b>My Places</b>
</div>
<form id="myplaces" name="myplaces" action="/mobile/ajaxplaces"method="post">
<input name="PageMode" type="Hidden" value="List"/>
<p>You will need to select a district before you can update it.</p>    
<div id="Filter" data-role="collapsible" data-collapsed="true">    
<H4>Find / Filter My Places </H4>
<fieldset data-role="controlgroup" data-mini="true">        
    <select id="Country" name="Country" placeholder="Country" required></select>    
    <select id="Province" name="Province" placeholder="Province" required>
    </select>
    <select id="City" name="City" placeholder="City" required>
    </select>
    <select id="Postcode" name="Postcode"  placeholder="Postcode">
    </select>
    <select id="District" name="District" placeholder="District">
    </select>
    <label for="Reset"></label>
    <input type="Button" id="ResetFilter" value="Reset Filter"/>
</fieldset> 
</div>
<div data-role="collapsible" data-collapsed="false"> 
    <H4>My Places List </H4>   
    <fieldset data-role="controlgroup" data-mini="true" id="MyPlacesList" name="MyPlacesList" >
        <select id="PlaceID" name="PlaceID" placeholder="PlaceID" required >
        </select>    
    </fieldset>   
</div>
<div data-role="collapsible" data-collapsed="true" name="Detail" id="Detail"> 
    <H4>Update Place Details </H4>
    <fieldset name="Update" id="Update" data-role="controlgroup" data-mini="true">
    </fieldset>    
</div>
<p><b style="color:red;" id="Message"><?=(isset($Message)?$Message:'');?></b></p>
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
    QueryString =  'Country=China';
    loadSelectOptions('Country','GetCountryOptions',QueryString);
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
    $('#Country').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val());
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Country selected');
    });
    $('#Province').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);    
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Province selected');
    });
    $('#City').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('City selected');
    });
    $('#Postcode').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val())
            +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Postcode selected');
    });
    $('#District').on('change',function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val())
            +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
            +'&District='+($("#District").val()===null?'':$("#District").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);
        UpdateMessage('District selected');
    });
    $('#PlaceID').on('change',function(){    
        var QueryString = 'PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);         
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('My Place selected');
    });
    $('#ResetFilter').click(function(){
        var QueryString =  'Country=China';
        loadSelectOptions('Country','GetCountryOptions',QueryString);
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);
        loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Filter reset');
    });
//    $("#Returnee").on("click, change, mouseover",function(){
//        alert('clicked');
//    });
//    $(".ui-checkbox").on("change",function(){
//    });
    $('input#SubmitDetails').click(function(){
        alert('Submit');
         var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val())
            +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
            +'&District='+($("#District").val()===null?'':$("#District").val())
            +'&PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val())
           +'&Returnee='+($('#Returnee').prop('checked')?'Y':'N')
           +'&Contact='+($('#Contact').prop('checked')?'Y':'N')
           +'&Fellowship='+($('#Fellowship').prop('checked')?'Y':'N')
           +'&Church='+($('#Church').prop('checked')?'Y':'N')
           +'&Nearby='+($('#Nearby').prop('checked')?'Y':'N');
        loadHTML('Message','SetMyPlaceDetails',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet','PlaceID='+$('PlaceID').val());
    });
 });   
function UpdateMessage(text){
    $('#Message').innerHTML=text;
    $('#Message').html(text).trigger("create");
}
function SubmitUpdate(obj){
    var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
        +'&Province='+($("#Province").val()===null?'':$("#Province").val())
        +'&City='+($("#City").val()===null?'':$("#City").val())
        +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
        +'&District='+($("#District").val()===null?'':$("#District").val())
        +'&PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val())
        +'&Returnee='+($('#Returnee').prop('checked')?'Y':'N')
        +'&Contact='+($('#Contact').prop('checked')?'Y':'N')
        +'&Fellowship='+($('#Fellowship').prop('checked')?'Y':'N')
        +'&Church='+($('#Church').prop('checked')?'Y':'N')
        +'&Nearby='+($('#Nearby').prop('checked')?'Y':'N');
    loadHTML('Message','SetMyPlaceDetails',QueryString);
};

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
         //   alert(xmlhttp.responseText);
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
      //      alert($("#".obj).val());
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
            //alert(xmlhttp.responseText);
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

