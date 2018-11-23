<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<a href="/mobile/sponsor">Sponsor</a> | 
<b>New Returnee</b>
</div>
<div data-role="collapsible">    
<H4>New Returnee Referral Request</H4>
<p>Please provide basic information about the location the person returnee is 
   returning to, then that is likely to be and a name (or alias) that a both 
   you and any contacts found will be able to use to identify this referral 
   in future.</p>
</div>
<p><b style="color:red;"><?=(isset($Message)?$Message:'');?></b></p>
<fieldset>
<form name="newreturnee" action="/mobile/newreturnee"method="post">
<input name="PageMode" type="Hidden" value="Entry"/>
<div data-role="collapsible">    
<H4>Returnee Destination</H4>
<p>In order to best connect returnees it is important to have 
an detailed location to which they are returning. Cities are large 
and travelling times long, so it is most helpful to identify an accurate
postcode / administration district</p>
<p>You will see drop-down lists for country, province, city and district.
   Each list will be updated as other fields define or limit the scope of your
   best match for a location. Obviously, the more precise you can be the more 
   likely it is that that a contact is known in that location.</p>
<p>As you narrow your search you will see the number of contacts reduce. This number
   is the number of members who say they know someone in that location, and is not
   therefore a reflection on the actual number of Christians in a location, as one
   contact may be know by several members or a member may know many people in a single 
   location.</p><p>As you make each selection other lists will limited and location statistics
    will be updated: <br/>
    NOTES:<br/><small>
    Loc: Distinct districts listed within area selected.<br/>
    Cnt: Number of people who have a contact in this area.<br/>
    Chu: Number of Amity (registered) churches in the area.<br/>
    Grp: Number of fellowhips groups known by contacts in area.</small></p> 
</div>
<div data-role="field-contain">[<small> STATS: &nbsp;
            Loc:<?=(isset($Stats['Locations'])?$Stats['Locations']:'0');?> &nbsp; 
            Cnt:<?=(isset($Stats['Contacts'])?$Stats['Contacts']:'0');?> &nbsp; 
            Chu:<?=(isset($Stats['Churches'])?$Stats['Churches']:'0');?> &nbsp; 
            Grp:<?=(isset($Stats['Groups'])?$Stats['Groups']:'0');?> </small>]
</div>
<input type="Button" value="Reset" 
       onclick="{
                this.form.Country.value='China'; this.form.Province.value=''; 
                this.form.City.value=''; this.form.District.value='';
                this.form.Postcode.value=''; this.form.submit();}"/>
<div class="ui-field-contain"> 
    <label for="Country">Country</label>
    <select name="Country" onchange="this.form.submit();" placeholder="Country" required>
        <option value=""></option><?php
if(isset($Countries)){
    foreach($Countries as $country){?>
        <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
    }
}?>
    </select>    

    <label for="Province">Province</label>
    <select name="Province" onchange="this.form.submit();" placeholder="Province" required>
        <option value=""></option><?php
if(isset($Provinces)){
    foreach($Provinces as $province){?>
        <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
    }
}?>
    </select>

    <label for="City">City</label>
            <select name="City" onchange="this.form.submit();" placeholder="City" required>
               <option value=""></option><?php
            if(isset($Cities)){
               foreach($Cities as $city){?>
               <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
               }
            }?>
            </select>

    <label for="Postcode">Postcode</label>
    <input id="Postcode" name="postcode" type="number" placeholder="Postcode eg. 860000" length="6"> 
    <label for="District">District</label>
    <select name="District" onchange="this.form.submit();">
        <option value=""></option><?php
if(isset($Districts)){
    foreach($Districts as $district){?>
        <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
    }
}?>
    </select>
</div>    
<div data-role="collapsible">    
    <H4>Basic Returnee Details</H4>
    <p>Please provide basic information about the person going home. The month 
        they are due to return and a name or alias to sufficient for you to be
        able to identify this referral in future and when communicating with 
        others who may be dealing with several others in the same location.</p>
</div>
<div class="ui-field-contain">
    <label for="ReturnMonth">Return&nbsp;Month</label>
    <select name="ReturnMonth" placeholder="Month" required><?php 
    $Months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    foreach($Months as $m){?>
        <option value="<?=$m;?>" <?=($m==(isset($ReturnMonth)?$ReturnMonth:'#')?' Selected':'');?>><?=$m;?></option><?php
    }?> 
    </select>
    <label for="ReturnYear">Return&nbsp;Year</label>
    <select name="ReturnYear" placeholder="Year" required><?php
    $Years = array('2014','2015','2016','2017','2018','2019','2020');
    foreach($Years as $y){?>
        <option value="<?=$y;?>" <?=($y==(isset($ReturnYear)?$ReturnYear:'#')?' Selected':'');?>><?=$y;?></option><?php
    }?> 
    </select>
</div>
<div class="ui-field-contain">
    <label for="Return">Returnee Name/Alias</label>
    <input type="text" name="Returnee" size="25" 
        placeholder="Returnee name or alias" value="<?php
        if(isset($Returnee) AND $Returnee==''?(isset($Returnee)?$Returnee:''):'');?>" required>
</div>
<div class="ui-field-contain">
    <label for="Details">Returnee Notes</label>
    <input type="text" name="Details" size=80 
           placeholder="Brief description of Returnee - NO CONTACT DETAILS" 
           value="<?=(isset($Details)?$Details:'');?>" required>
</div>
<b style="color:red;"><?=(isset($Message)?$Message:'');?></b>
<input id="Submit" name="Submit" type=submit value="Submit"
    onclick="this.form.action='/mobile/newreturneesave';
    this.form.PageMode.value = 'Insert'; 
    this.form.submit();"/> 
</form> 
</fieldset>
</DIV>

