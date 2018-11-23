<DIV class="content">
<div class="breadcrumb">
<a href="/c2p/home">Home</a> | 
<a href="/gatekeeper/gatekeeper">Gatekeeper</a> | 
<b>My Places</b>
</div>
   <fieldset><legend>All Gatekeeper Places</legend>
   <b style="color:red;" id="Message"><?=(isset($Message)?$Message:'');?></b>
   <B id="AjaxWarning" style="color:Red;">WARNING: Your browser is not updating drop-down lists.</b><br/>
   <table class="report" width="60">
       <tr><td colspan="3"><b>Your list of places where you can assist returnees.</b> </td>
           <td colspan="8">[Key: Rt-Returnee, Xn-Christian, Fw-Fellowship, Ch-Church, Nb-Nearby]</td>
       </tr>
       <tr><td colspan="11"></tr>
      <tr>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Country');">Country</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Province');">Province</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('City');">City</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('District');">District</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Returnee');" alt="Returnee">Rt</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Contact');" alt="Contact">Xn</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Fellowship');" alt="Fellowship">Fw</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Church');" alt="Church">Ch</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Nearby');" alt="Nearby">Nb</th>
         <th style="cursor:pointer;" onclick="$('#ListOrder').val('Reminder');" alt="Reminder">Reminder</th>
      </tr>
      <form id="filter" name="filter" method="post">
      <input id="ListOrder" name="ListOrder" type="hidden" value="<?=$ListOrder;?>" onchange="this.form.submit();" />
      <tr>
          
         <td>
            <select name="Country" onchange="this.form.submit();" style="width:100px;">
               <option value=""></option><?php
            if(isset($Countries)){
               foreach($Countries as $country){?>
               <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="Province" onchange="this.form.submit();"  style="width:100px;">
               <option value=""></option><?php
            if(isset($Provinces)){
               foreach($Provinces as $province){?>
               <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td>
            <select name="City" onchange="this.form.submit();"  style="width:100px;">
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td nowrap>
            <select name="District" onchange="this.form.submit();"  style="width:100px;">
               <option value=""></option><?php
            if(isset($Districts)){
               foreach($Districts as $district){?>
               <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
               }
            }?>
            </select>
         </td>
         <td><?php $checked=""; if(isset($Returnee) and $Returnee=="Y") {$checked=" checked='checked'";}?>
            <input name="Returnee" type="Checkbox" value="Y" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($Contact) and $Contact=="Y") {$checked=" checked='checked'";}?>
            <input name="Contact" type="Checkbox" value="Y" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($Fellowship) and $Fellowship=="Y") {$checked=" checked='checked'";}?>
            <input name="Fellowship" type="Checkbox" value="Y" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($Church) and $Church=="Y") {$checked=" checked='checked'";}?>
            <input name="Church" type="Checkbox" value="Y" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($Nearby) and $Nearby=="Y") {$checked=" checked='checked'";}?>
            <input name="Nearby" type="Checkbox" value="Y" <?=$checked;?>>
         </td>
         <td nowrap><input name="Reminder" type="Text" value="<?=(isset($Reminder)?$Reminder:'')?>" 
                onchange="this.form.submit();">
         <!--</td>
         <td>-->
           <input type="button" value="Reset Filter" onclick="{
                this.form.Country.value='China'; 
                this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.District.value='';
                this.form.Returnee.value=''; 
                this.form.Contact.value=''; 
                this.form.Fellowship.value=''; 
                this.form.Church.value='';
                this.form.Nearby.value='';
                this.form.Reminder.value='';
                this.form.submit();}"/>
         </td>
      </tr>
      </form>


<?php foreach($results as $row):?>
      <tr>
         <form id="Place<?=$row['PlaceID'];?>"><input type="Hidden" name="PlaceID" value="<?=$row['PlaceID'];?>">
         <td nowrap><?=$row['Country'];?></td>
         <td nowrap><?=$row['Province'];?></td>
         <td nowrap><?=$row['City'];?></td>
         <td nowrap><?=$row['District'];?></td>
         <td><?php $checked=""; if(isset($row['Returnee']) and $row['Returnee']=="Y") {$checked=" checked='checked'";}?>
            <input id="Returnee<?=$row['PlaceID'];?>" name="Returnee" type="Checkbox" 
                value="Y" onchange="SubmitUpdate(<?=$row['PlaceID'];?>);" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($row['Contact']) and $row['Contact']=="Y") {$checked=" checked='checked'";}?>
             <input id="Contact<?=$row['PlaceID'];?>" name="Contact" type="Checkbox" 
                value="Y" onchange="SubmitUpdate(<?=$row['PlaceID'];?>);" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($row['Fellowship']) and $row['Fellowship']=="Y") {$checked=" checked='checked'";}?>
            <input id="Fellowship<?=$row['PlaceID'];?>" name="Fellowship" type="Checkbox" 
                value="Y" onchange="SubmitUpdate(<?=$row['PlaceID'];?>);" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($row['Church']) and $row['Church']=="Y") {$checked=" checked='checked'";}?>
            <input id="Church<?=$row['PlaceID'];?>" name="Church" type="Checkbox" 
                value="Y" onchange="SubmitUpdate(<?=$row['PlaceID'];?>);" <?=$checked;?>>
         </td>
         <td><?php $checked=""; if(isset($row['Nearby']) and $row['Nearby']=="Y") {$checked=" checked='checked'";}?>
            <input id="Nearby<?=$row['PlaceID'];?>" name="Nearby" type="Checkbox" 
                value="Y" onchange="SubmitUpdate(<?=$row['PlaceID'];?>);" <?=$checked;?>>
         </td>
         <td><input id="Reminder<?=$row['PlaceID'];?>" name="Reminder" type="Text" 
                style="width:200px" value="<?=(isset($row['Reminder'])?$row['Reminder']:'')?>" 
                onchange="SubmitUpdate(<?=$row['PlaceID'];?>);">
         </td>
         </form>
      </tr>
<?php endforeach;?>
   </table>
   </fieldset>
   <fieldset><legend>Editing your places</legend>
<p>Above is a list of the places that you have contacts. 
    You can edit the type of contact you have in each location by clicking on check boxes. </p>
    <p>BE AWARE that if you un-check all the boxes for a location, 
    you are indicating that you have no relevant links in this location and so it will be deleted.</p>
    <p>There is a new <i>Reminder</i> field that allows you to keep an alias, or hint of who your 
    contact is in each location. </p>
<p>If you wish to add a new location use the 'Add Places' page. </p>
</FIELDSET>

    
<!--    
    
    
    
<form id="myplaces" name="myplaces" action="/mobile/ajaxplaces"method="post">
<input name="PageMode" type="Hidden" value="List"/>
<fieldset id="Filter"><legend>Find / Filter My Places </legend>
You will need to select a district before you can update it.    
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
<fieldset><legend>About place statistics</LEGEND>
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
</fieldset>
<div data-role="field-contain">[<small> STATS: &nbsp;
            Dist:<?=(isset($Stats['Dist'])?$Stats['Dist']:'0');?> &nbsp;
            Plac:<?=(isset($Stats['Plac'])?$Stats['Plac']:'0');?> &nbsp;
            Cont:<?=(isset($Stats['Cont'])?$Stats['Cont']:'0');?> &nbsp; 
            Chur:<?=(isset($Stats['Chur'])?$Stats['Chur']:'0');?> &nbsp; 
            Grou:<?=(isset($Stats['Grou'])?$Stats['Grou']:'0');?> </small>]
</div>

        
-->        
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
    loadHTML('AjaxWarning','AjaxCheck','');
    QueryString =  'Country=China';
    loadSelectOptions('Country','GetCountryOptions',QueryString);
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    //loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
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
        loadFilter(QueryString);
    //    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    //    loadSelectOptions('City','GetCityOptions',QueryString);
    //    loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
    //    loadSelectOptions('District','GetDistrictOptions',QueryString);
    //    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    //    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Country selected');
    });
    $('#Province').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val());
        loadFilter(QueryString);
    //    loadSelectOptions('Country','GetCountryOptions',QueryString);
    //    loadSelectOptions('City','GetCityOptions',QueryString);    
    //    loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
    //    loadSelectOptions('District','GetDistrictOptions',QueryString);
    //    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    //    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Province selected');
    });
    $('#City').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val());
    loadFilter(QueryString);
    //    loadSelectOptions('Country','GetCountryOptions',QueryString);
    //   loadSelectOptions('Province','GetProvinceOptions',QueryString);
    //    loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
    //    loadSelectOptions('District','GetDistrictOptions',QueryString);
    //    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    //    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('City selected');
    });
    $('#Postcode').change(function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val())
            +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val());
    loadFilter(QueryString);
    //    loadSelectOptions('Country','GetCountryOptions',QueryString);
    //    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    //    loadSelectOptions('City','GetCityOptions',QueryString);
    //    loadSelectOptions('District','GetDistrictOptions',QueryString);
    //    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
    //    loadHTML('Update','GetMyPlacesFieldSet',QueryString);
        UpdateMessage('Postcode selected');
    });
    $('#District').on('change',function(){
        var QueryString =  'Country='+($("#Country").val()===null?'':$("#Country").val())
            +'&Province='+($("#Province").val()===null?'':$("#Province").val())
            +'&City='+($("#City").val()===null?'':$("#City").val())
            +'&Postcode='+($("#Postcode").val()===null?'':$("#Postcode").val())
            +'&District='+($("#District").val()===null?'':$("#District").val());
    loadFilter(QueryString);
    //    loadSelectOptions('Country','GetCountryOptions',QueryString);
    //    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    //    loadSelectOptions('City','GetCityOptions',QueryString);
    //    loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
    //    loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);
        UpdateMessage('District selected');
    });
    $('#PlaceID').on('change',function(){    
        var QueryString = 'PlaceID='+($("#PlaceID").val()===null?'':$("#PlaceID").val());
        loadSelectOptions('Country','GetCountryOptions',QueryString);         
        loadSelectOptions('Province','GetProvinceOptions',QueryString);
        loadSelectOptions('City','GetCityOptions',QueryString);
        //loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
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
        //loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
        loadSelectOptions('District','GetDistrictOptions',QueryString);
        //loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);
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
        //loadSelectOptions('PlaceID','GetMyPlacesSelect',QueryString);    
        loadHTML('Update','GetMyPlacesFieldSet','PlaceID='+$('PlaceID').val());
    });
 });   
/* 
$('input:checkbox').change(function(){
    
    SubmitUpdate(this.form.name, this.form.PlaceID.value);
})
$('input:text').change(function(){
    SubmitUpdate(this.form.name, this.form.PlaceID.value);
})
*/
function loadFilter(QueryString){
    loadSelectOptions('Country','GetCountryOptions',QueryString);         
    loadSelectOptions('Province','GetProvinceOptions',QueryString);
    loadSelectOptions('City','GetCityOptions',QueryString);
    //loadSelectOptions('Postcode','GetPostcodeOptions',QueryString);
    loadSelectOptions('District','GetDistrictOptions',QueryString);
    //loadHTML('Update','GetMyPlacesFieldSet',QueryString);
}

function UpdateMessage(text){
    $('#Message').innerHTML=text;
    $('#Message').html(text).trigger("create");
}
function SubmitUpdate($PlaceID){
    var QueryString ='PlaceID='+$PlaceID
       +'&Returnee='+($('#Returnee'+$PlaceID).prop('checked')?'Y':'N')
       +'&Contact='+($('#Contact'+$PlaceID).prop('checked')?'Y':'N')
       +'&Fellowship='+($('#Felowship'+$PlaceID).prop('checked')?'Y':'N')
       +'&Church='+($('#Church'+$PlaceID).prop('checked')?'Y':'N')
       +'&Nearby='+($('#Nearby'+$PlaceID).prop('checked')?'Y':'N')
       +'&Reminder='+$('#Reminder'+$PlaceID).val();
    loadHTML('Message','SetMyPlaceDetails',QueryString);
};
/*
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
*/
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
