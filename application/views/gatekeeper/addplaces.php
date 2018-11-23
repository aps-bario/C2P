<DIV class="content">
<div class="breadcrumb">
<a href="/c2p/home">Home</a> | 
<a href="/gatekeeper/gatekeeper">Gatekeeper</a> | 
<b>Add Places</b>
</div>
<form id="myplaces" name="myplaces" action="/mobile/ajaxplaces"method="post">
<!--<input id="PlaceID" name="PlaceID" type="Hidden" value="<?=(isset($PlaceID)?$PlaceID:'');?>"/>-->
<input name="PageMode" type="Hidden" value="Entry"/>
<fieldset id="Filter"><legend>Add Gatekeeper Places</legend>
<p> 
   Each Gatekeeper maintains a list of places where they know people (or have information) 
   that could be of help to returnees.  It is most helpful if these locations can be as
   specific as the local district of a city, to help match people as closely as possible, 
   but a location with a district will also be used where a returnee only knows the city.
   <br/><B id="AjaxWarning" style="color:Red;">WARNING: Your browser is not updating drop-down lists.</b>
</p>
<table>
    <tr>
        <th>Country</th>
        <td><select id="Country" name="Country" placeholder="Country" style="width:250px;">
            <option value=""></option><?php
            if(isset($Countries)){
                foreach($Countries as $country){?>
            <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
                }
            }?>
            </select>
        </td>
         <td></td>
        <td>The lists below will be updated as you make selections</td>
    </tr>
    <tr>
        <th>Province</th>
        <td><select id="Province" name="Province" placeholder="Province" style="width:250px;">
            <option value=""></option><?php
            if(isset($Provinces)){
                foreach($Provinces as $province){?>
            <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
                }
            }?>
        </select></td>
         <td></td>
        <td>If you don't know the Province, pick the city first.</td>
    </tr>
    <tr> 
        <th>City</th>
        <td><select id="City" name="City" placeholder="City" style="width:250px;">
            <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
            <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>    
        </select></td>
         <td></td>
        <td>Select the city and then the district or postcode.</td>
    </tr>
    <tr>     
        <th>District</th>
        <td><select id="District" name="District" placeholder="District" style="width:250px;"></select>
        </td>
         <td></td>
        <td>Providing a precise district, will help find a local contact.</td>
    </tr>
   <tr>     
        <th>Postcode</th>
        <td><select id="Postcode" name="Postcode"  placeholder="Postcode"  style="width:250px;"></select></td>
         <td></td>
        <td>If you don't know the district, pick the nearest postcode</td>
    </tr>
    <tr>     
        <td><input type="Button" id="ResetFilter" value="Reset Filter"/></td> 
        <td><b style="color:red;" id="Message"><?=(isset($Message)?$Message:'');?></b></td>
         <td></td> <td></td>
    </tr>
</table>
<div name="Update" id="Update"><div>
</fieldset>



</form>
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
    loadHTML('AjaxWarning','AjaxCheck','');
    //$("#PlaceID").val($PlaceID);
    //alert(QueryString);
    QueryString =  'Country=China';
    loadSelectOptions('Country','GetCountryOptions',QueryString);
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    loadHTML('Update','GetMyPlaceDetails',QueryString);
 //   $('#Filter').triggerHandler('expand',function(){
 //       var QueryString =  'Country='+$('Country').val()+'&Province='+$('Province').val()
 //          +'&City='+$('City').val()+'&Postcode='+$('Postcode').val()
 //          +'&District='+$('District').val();
 //       loadSelectOptions('Country','GetCountryOptions',QueryString);
 //       loadSelectOptions('Province','GetProvinceOptions',QueryString);
 //       loadSelectOptions('City','GetCityOptions',QueryString);
 //       loadHTML('Update','GetMyPlaceDetails',QueryString);
 //   });        
 //  loadSelectOptions('Country','GetCountryOptions','Country=&Province=&City=&Postcode=&District=');
    $('#Country').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val());
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlaceDetails',QueryString);
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
        loadHTML('Update','GetMyPlaceDetails',QueryString);
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
        loadHTML('Update','GetMyPlaceDetails',QueryString);
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
        loadHTML('Update','GetMyPlaceDetails',QueryString);
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
        loadHTML('Update','GetMyPlaceDetails',QueryString);
 //       QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
 //           +'&Province='+($("#Province").val()===null?'':$("#Province").val())
 //           +'&City='+($("#City").val()===null?'':$("#City").val())
 //           +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
 //           +'&District='+($("#District").val()===null?'':$("#District").val())
 //           +'&PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val());
 ////       loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
 //       loadHTML('Update','GetMyPlaceDetails','PlaceID='+$('PlaceID').val());
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
        loadHTML('Update','GetMyPlaceDetails',QueryString);
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
            +'&Reminder='+($("#Reminder").val()===null?'':$("#Reminder").val())
            +'&Nearby='+($('#Nearby').prop('checked')?'Y':'N');
        loadHTML('Message','SetMyPlaceDetails',QueryString);
        loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlaceDetails','PlaceID='+$('PlaceID').val());
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
           +'&Reminder='+$('#Reminder').val()
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
            if(document.getElementById(obj)){
                document.getElementById(obj).innerHTML=xmlhttp.responseText;
            }
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
  