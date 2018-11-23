<DIV class="content">
<div class="breadcrumb">
<a href="/c2p/home">Home</a> | 
<a href="/c2p/gatekeeper">Gatekeeper</a> | 
<b>My Old Places</b>
</div>
<form id="myplaces" name="myplaces" action="/mobile/ajaxplaces"method="post">
<input name="PageMode" type="Hidden" value="List"/>
<!--<input id="PlaceID" name="PlaceID" type="Hidden" value="<?=(isset($PlaceID)?$PlaceID:'');?>"/>-->
<fieldset id="Filter"><legend>Find / Filter My Old Places </legend>
    <i>This is the OLD (Original) version of the 'My Places' page that has been superceded by a new 'My Places' page. 
    Data is the same behind both pages so feel free to use this version if you find it easier / more familiar.</i>
    <br/>You will need to select a district before you can update it.    
    <table>
    <tr>
        <td>Country</td>
        <td>Province</td>
        <td>City</td>
        <td>Postcode</td>
        <td>District</td>
        <td></td>
    </tr>
    <tr>    
        <td><select id="Country" name="Country" placeholder="Country" style="width:100px;"></select></td>    
        <td><select id="Province" name="Province" placeholder="Province" style="width:150px;"></select></td>
        <td><select id="City" name="City" placeholder="City" style="width:150px;"></select></td>
        <td><select id="Postcode" name="Postcode"  placeholder="Postcode"  style="width:150px;"></select></td>
        <td><select id="District" name="District" placeholder="District" style="width:250x;"></select></td>
        <td><input type="Button" id="ResetFilter" value="Reset Filter"/></td>
    </tr>
    </table>
</fieldset> 
<fieldset><legend>My Places List</legend>   
    Select one of your existing places to update the details.
    <select id="PlaceID" name="PlaceID" placeholder="PlaceID" required ></select>    
</fieldset>   
<fieldset name="Update" id="Update"><legend>Update Place Details</legend>   
</fieldset>    
<p><b style="color:red;" id="Message"><?=(isset($Message)?$Message:'');?></b></p>
</form>    


<fieldset><legend>How to find a place</legend>
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
</fieldset>
<fieldset><legend>Adding and editing places</legend>
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
</FIELDSET>

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
    //var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
    //    +'&Province='+($("#Province").val()===null?'':$("#Province").val())
    //    +'&City='+($("#City").val()===null?'':$("#City").val())
    //    +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
    //    +'&District='+($("#District").val()===null?'':$("#District").val());
    //alert(QueryString);
    QueryString =  'Country=China';
    loadSelectOptions('Country','GetCountryOptions',QueryString);
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
 //   $('#Filter').triggerHandler('expand',function(){
 //       var QueryString =  'Country='+$('Country').val()+'&Province='+$('Province').val()
 //          +'&City='+$('City').val()+'&Postcode='+$('Postcode').val()
 //          +'&District='+$('District').val();
 //       loadSelectOptions('Country','GetCountryOptions',QueryString);
 //       loadSelectOptions('Province','GetProvinceOptions',QueryString);
 //       loadSelectOptions('City','GetCityOptions',QueryString);
 //       loadHTML('Update','GetMyPlacesFieldSet',QueryString);
 //   });        
 //  loadSelectOptions('Country','GetCountryOptions','Country=&Province=&City=&Postcode=&District=');
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
 //       QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
 //           +'&Province='+($("#Province").val()===null?'':$("#Province").val())
 //           +'&City='+($("#City").val()===null?'':$("#City").val())
 //           +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
 //           +'&District='+($("#District").val()===null?'':$("#District").val())
 //           +'&PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val());
 ////       loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
 //       loadHTML('Update','GetMyPlacesFieldSet','PlaceID='+$('PlaceID').val());
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
        //alert('Submit');
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
        var form = $('#myplaces');
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
      //      alert(xmlhttp.responseText);
      //      $("#"+obj).val(xmlhttp.responseText);
            objstr = "#"+obj+" option[value="+xmlhttp.responseText+"]";
            alert(objstr);
            $(objstr).attr('selected','selected');
   //         alert($("#"+obj)').val());
   //         $('#'+obj).trigger("create"); 
     
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
            //$('#'+obj).html(xmlhttp.responseText).selectmenu("refresh");
            $('#'+obj).html(xmlhttp.responseText).trigger("create");
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
        if(obj.val()==='Y'){
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

