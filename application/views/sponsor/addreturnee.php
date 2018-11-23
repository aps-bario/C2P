<DIV class="content">
<div class="breadcrumb">
<a href="/c2p/home">Home</a> | 
<a href="/sponsor/sponsor">Sponsor</a> | 
<b>Add Returnee</b>
</div>
<fieldset><legend>Add Returnee Referral Request</legend>
<form name="newreturnee" action="/sponsor/newreturneesave" method="post">
<input name="PageMode" type="Hidden" value="Insert"/>
<H4>Add A New Returnee Referral Request</H4>
</legend> 
<p> 
   Provide basic information about the location the person is 
   returning to, when that is likely to be, and a name (or alias) that both 
   you and any contacts found will be able to use to identify this referral 
   in future.
   <span id="AjaxWarning"><br/><br/>
   <B style="color:Red;">WARNING: Your browser is not updating drop-down lists.</b></span>
</p>
<table>
    <tr>
        <th>Returnee Name</th>
        <td><input type="text" name="Returnee" style="width:250px;" 
        placeholder="Returnee name or alias" value="<?php
        if(isset($Returnee) AND $Returnee==''?(isset($Returnee)?$Returnee:''):'');?>" required>
        </td>
        <td width="50px"></td>
        <td style="font-size: small">Enter a name (or alias) so that you can identify this returnee</td>
    </tr>
    <tr>
        <th>Return&nbsp;Month</th>
        <td><select name="ReturnMonth" placeholder="Month" required><?php 
    $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    foreach($Months as $m){?>
        <option value="<?=$m;?>" <?=($m==(isset($ReturnMonth)?$ReturnMonth:'#')?' Selected':'');?>><?=$m;?></option><?php
    }?> 
    </select>&nbsp;<select name="ReturnYear" placeholder="Year" required><?php
    $Years = array('2014','2015','2016','2017','2018','2019','2020');
    foreach($Years as $y){?>
        <option value="<?=$y;?>" <?=($y==(isset($ReturnYear)?$ReturnYear:'#')?' Selected':'');?>><?=$y;?></option><?php
    }?> 
    </select>
        </td>
        <td></td>
        <td style="font-size: small">Enter the month and year person will/did return home</td>
        </tr>
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
        <td colspan="2" align="right"><input type="Button" id="ResetFilter" value="Reset Filter"/></td>   
         <td></td> <td></td>
    </tr>
    <tr>
        <th>Details</th>
            <td colspan="3">
            <input type="textarea" name="Details" size=90 rows=2
           placeholder="Brief description of Returnee - NO CONTACT DETAILS" 
           value="<?=(isset($Details)?$Details:'');?>" required>    
        </td>
    </tr>
    <tr>
        <td colspan="3"><b style="color:red;"><?=(isset($Message)?$Message:'');?></b>
        <td align="right">
            <input id="Submit" name="Submit" type=submit value="Submit" 
                   style="font-size: xx-large; font-weight: bolder;"
                   accept=""onclick="this.form.action='/sponsor/newreturneesave';
            this.form.PageMode.value = 'Insert'; 
            this.form.submit();"/> 
        </td>
    </tr>
</table>    

</form> 
</fieldset>
</DIV>
<SCRIPT>
// New Returnee Script      
$(document).ready(function(){
    // By default start by listing all places
    //var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
    //    +'&Province='+($("#Province").val()===null?'':$("#Province").val())
    //    +'&City='+($("#City").val()===null?'':$("#City").val())
    //    +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
    //    +'&District='+($("#District").val()===null?'':$("#District").val());
    // In order to test if AJAX scripting is working, remove default Warning message on page
    loadHTML('AjaxWarning','AjaxCheck','');
    // Now replaced by Red warning message that disappears if page is refressed. 
    QueryString =  'Country=China';
    loadSelectOptions('Country','GetCountryOptions',QueryString);
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
 //   $('#Filter').triggerHandler('expand',function(){
 //       var QueryString =  'Country='+Country.value+'&Province='+Province.value
 //          +'&City='+City.value+'&Postcode='+Postcode.value
 //          +'&District='+District.value;
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
        //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
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
        //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
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
        //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
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
        //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
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
        //loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);
        UpdateMessage('District selected');
    });
    $('#PlaceID').on('change',function(){    
        var QueryString = 'PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);         
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('My Place selected');
    });
    $('#ResetFilter').click(function(){
//        $('#Country').val('China');
//        $('#Province').val(''); 
//        $('#City').val(''); 
//        $('#Postcode').val('');
//        $('#District').val('');
//        $('#Country').selectmenu("refresh");
//        $('#Province').selectmenu("refresh");
//        $('#City').selectmenu("refresh");
//        $('#Postcode').selectmenu("refresh");
//        $('#District').selectmenu("refresh");
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
        loadHTML('Message','SetMyPlaceDetails',QueryString);
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
   //         alert($("#"+obj).val());
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


