<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<a href="/mobile/gatekeeper">Gatekeeper</a> | 
<b>My Places</b>
</div>
<div data-role="collapsible">    
<H4>List My Places</H4>
<p>These are places that you have some connection.</p>
</div>
<p><b style="color:red;"><?=(isset($Message)?$Message:'');?></b></p>
<fieldset>
<form name="myplaceslist" action="/mobile/myplaceslist"method="post">
<input name="PageMode" type="Hidden" value="Entry"/>
<div data-role="collapsible">    
<H4>How to find a place</H4>
<p>In order to be as precise as possible, a place is defined as a city, postcode 
    or adminstrative district. It is easier to locate these if you identify the 
    country and province, as this will reduce the number of other options listed.
    It usually helps to start with the country and work down, but if you have a 
    city, district or postcode, then you can go select that first and the other 
    values will be filled in for you.</p>
<p><b>Chinese Postcodes</b> cover large areas and only those that relate to adminstrative 
    disticts will be listed, so if you have a full 6 digit postcode, then simply find the 
    nearest match.</p>
<p>NOTE: As the dropdown lists are limited by the other fields you select, then you
    will need to RESET the fields if you make a mistake or want to start again.</p>
</div>
<div data-role="collapsible">    
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
<div data-role="collapsible">    
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
    <select name="Postcode" onchange="this.form.submit();" placeholder="Postcode">
        <option value=""></option><?php
if(isset($Postcodes)){
    foreach($Postcodes as $postcode){?>
        <option value="<?=$postcode['Name'];?>" <?=($postcode['Name']==(isset($Postcode)?$Postcode:'#')?' Selected':'');?>><?=$postcode['Name'];?></option><?php
    }
}?>
    </select>
<!--    <input id="Postcode" name="postcode" type="number" placeholder="Postcode eg. 860000" length="6">--> 
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

<?php foreach($results as $row):?>
<div class="ui-field-contain" id="<?=$row['PlaceID'];?>">
    <label value="<?=$row['Country'];?>"/>
    <label value="<?=$row['Province'];?>"/>
    <label value="<?=$row['City'];?>"/>
    <label value="<?=$row['Postcode'];?>"/>
    <label value="<?=$row['District'];?>"/>
    <button value="Edit" onclick="if(this.value=='Delete'){
            this.form.PlaceID.value = '<?=$row['PlaceID'];?>'; 
            this.form.NewStatus.value = this.value;
            this.form.PageMode.value = 'Update';
            this.form.submit();}"/>
</div>        
<?php endforeach;?>



<div class="ui-field-contain">
    <label for="Returnee">I know a Antother Returnee</label>
    <input type="checkbox" name="Returnee" <?=(isset($Returnee) and $Returnee?'Checked':'');?>/>
    
    <label for="Contact">I know a Christian Contact</label>
    <input type="checkbox" name="Contact" <?=(isset($Contact) and $Contact?'Checked':'');?>/>
    <label for="Group">I know a Fellowship Group</label>
    <input type="checkbox" name="Group" <?=(isset($Group) and $Group?'Checked':'');?>/>
    <label for="Church">I know a Good Local Church</label>
    <input type="checkbox" name="Church" <?=(isset($Church) and $Church?'Checked':'');?>/>
    <label for="Nearby">Nearby a Contact I know</label>
    <input type="checkbox" name="Nearby" <?=(isset($Nearby) and $Nearby?'Checked':'');?>/>
    <input id="Submit" name="Submit" type=submit value="Submit"
    onclick="this.form.action='/mobile/myplacessave';
    this.form.PageMode.value = 'Insert'; 
    this.form.submit();"/> 

</div>
</DIV>

