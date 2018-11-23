<DIV class="content">
<div class="breadcrumb">
<a href="/c2p/home">Home</a> | 
<a href="/sponsor/sponsor">Sponsor</a> | 
<b>New Returnee</b>
</div>
<fieldset><legend>New Returnee Referral Request</legend>
<p>Please provide basic information about the location the person returnee is 
   returning to, then that is likely to be and a name (or alias) that a both 
   you and any contacts found will be able to use to identify this referral 
   in future.</p>


<form name="newreturnee" action="/sponsor/newreturnee" method="post">
<input name="PageMode" type="Hidden" value="Insert"/>
<H4>Returnee Destination</H4>
</legend> 
<p>In order to best connect returnees it is important to have 
an detailed location to which they are returning. Cities are large 
and travelling times long, so it is most helpful to identify an accurate
postcode / administration district. 
You will see drop-down lists for country, province, city and district.</p>
<p>
   <span id="AjaxWarning">
       <B style="color:Red;">Warning your browser configuration does not appear support 
           dynamic updating of drop-down lists - you will not therefore be able to 
           select postcodes or districts and there will be no checks that you have matched 
           province and city correctly.</b><br/><br/></span>
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
<table>
    <tr>
        <td>Country</td>
        <td>Province</td>
        <td>City</td>
        <td>Postcode</td>
        <td>District</td>
        <td align="right"><input type="Button" id="ResetFilter" value="Reset Filter"/></td>
    </tr>
    <tr>    
        <td><select id="Country" name="Country" placeholder="Country" style="width:100px;">
            <option value=""></option><?php
            if(isset($Countries)){
                foreach($Countries as $country){?>
            <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
                }
            }?>
            </select>
        </td>    
        <td><select id="Province" name="Province" placeholder="Province" style="width:150px;">
            <option value=""></option><?php
            if(isset($Provinces)){
                foreach($Provinces as $province){?>
            <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
                }
            }?>
        </select></td>
        <td><select id="City" name="City" placeholder="City" style="width:150px;">
            <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
            <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>    
        </select></td>
        <td><select id="Postcode" name="Postcode"  placeholder="Postcode"  style="width:150px;"></select></td>
        <td colspan="2"><select id="District" name="District" placeholder="District" style="width:250x;"></select></td>
        
    </tr>
</table>

<!--
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p>
<p>As you make each selection other lists will limited and location statistics
    will be updated: <br/>
STATS:<small>
        <table>
            <tr>
                <td><?=(isset($Stats['Locations'])?$Stats['Locations']:'0');?></td>
                <td>Distinct districts listed within area selected</td>
            </tr>
            <tr>
                <td><?=(isset($Stats['Contacts'])?$Stats['Contacts']:'0');?></td>
                <td>Number of people who have a contact in this area</td>
            </tr>
            <tr>
                <td><?=(isset($Stats['Churches'])?$Stats['Churches']:'0');?></td>
                <td>Number of Amity (registered) churches in the area</td>
            </tr>
            <tr>
                <td><?=(isset($Stats['Groups'])?$Stats['Groups']:'0');?></td>
                <td>Number of fellowship groups known by contacts in area.</td>
            </tr>
        </table></small>   
  
</p>
<table>
    <tr>
        <td>Country</td>
        <td>
            <select name="Country" onchange="this.form.submit();" placeholder="Country" required>
        <option value=""></option><?php
if(isset($Countries)){
    foreach($Countries as $country){?>
        <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
    }
}?>
            </select></td>
            <td>&nbsp;</td>
            <td><input type="Button" value="Reset" 
       onclick="{
                this.form.Country.value='China'; this.form.Province.value=''; 
                this.form.City.value=''; this.form.District.value='';
                this.form.Postcode.value=''; this.form.submit();}"/>
            </td>
    </tr>
    <tr>
        <td>Province</td>
        <td><select name="Province" onchange="this.form.submit();" placeholder="Province" required>
        <option value=""></option><?php
if(isset($Provinces)){
    foreach($Provinces as $province){?>
        <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
    }
}?>
        </select>
        </td>
        <td>City</td>
        <td><select name="City" onchange="this.form.submit();" placeholder="City" required>
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Postcode</td>
        <td><input id="Postcode" name="postcode" type="number" placeholder="Postcode eg. 860000" length="6"></td>
        <td>District</td>
        <td><select name="District" onchange="this.form.submit();">
        <option value=""></option><?php
if(isset($Districts)){
    foreach($Districts as $district){?>
        <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
    }
}?>
    </select></td>
    </tr>
</table>-->
<H4>Basic Returnee Details</H4>
    <p>Please provide basic information about the person going home. The month 
        they are due to return and a name or alias to sufficient for you to be
        able to identify this referral in future and when communicating with 
        others who may be dealing with several others in the same location.</p>
    <table>
        <tr>
        <td>Returnee Alias</td>
        <td><input type="text" name="Returnee" size="25" 
        placeholder="Returnee name or alias" value="<?php
        if(isset($Returnee) AND $Returnee==''?(isset($Returnee)?$Returnee:''):'');?>" required>
        </td>
        <td>Return&nbsp;Month</td>
        <td><select name="ReturnMonth" placeholder="Month" required><?php 
    $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    foreach($Months as $m){?>
        <option value="<?=$m;?>" <?=($m==(isset($ReturnMonth)?$ReturnMonth:'#')?' Selected':'');?>><?=$m;?></option><?php
    }?> 
    </select>
        </td>
        <td>Return&nbsp;Year</td>
        <td><select name="ReturnYear" placeholder="Year" required><?php
    $Years = array('2014','2015','2016','2017','2018','2019','2020');
    foreach($Years as $y){?>
        <option value="<?=$y;?>" <?=($y==(isset($ReturnYear)?$ReturnYear:'#')?' Selected':'');?>><?=$y;?></option><?php
    }?> 
    </select>
        </td>
        </tr>
        <tr>
        <td>Returnee Notes</td>
            <td colspan="5">
    <input type="text" name="Details" size=80 
           placeholder="Brief description of Returnee - NO CONTACT DETAILS" 
           value="<?=(isset($Details)?$Details:'');?>" required>    
            </td>
        </tr>
    </table>
    
    
<p><b style="color:red;"><?=(isset($Message)?$Message:'');?></b></p>
<input id="Submit" name="Submit" type=submit value="Submit"
    onclick="this.form.action='/sponsor/newreturneesave';
    this.form.PageMode.value = 'Insert'; 
    this.form.submit();"/> 
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


