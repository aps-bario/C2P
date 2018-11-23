<DIV data-role="main" data-theme="a" class="ui-content">
<div style="position:relative; float:right; top:0;"><a href="#help">Help</a></div>    
<div class="breadcrumb">
<a href="/mobile/home">Home</a> | 
<a href="/mobile/gatekeeper">Gatekeeper</a> | 
<b>My Places</b>
</div>
<h4>1. Select a place</h4>
<form id="myplaces" name="myplaces" action="/mobile/myplaces"method="post">
<input name="PageMode" type="Hidden" value="List"/>
<input id="PlaceID" name="PlaceID" type="Hidden" value="<?=(isset($PlaceID)?$PlaceID:'');?>"/>

<div class="ui-field-contain"> 
    <!--<label for="Country">Country</label>-->
    <select id="Country" name="Country" 
        onchange="if(this.value===''){
                    this.form.Province.value=''; 
                this.form.City.value=''; 
                this.form.Postcode.value=''; 
                this.form.District.value='';}
                this.form.submit();" placeholder="Country" required>
        <option value="">[ Select Country ]</option><?php
if(isset($Countries)){
    foreach($Countries as $country){?>
        <option value="<?=$country['Name'];?>" <?=($country['Name']==(isset($Country)?$Country:'#')?' Selected':'');?>><?=$country['Name'];?></option><?php
    }
}?>
    </select>    

 <!--   <label for="Province">Province</label>-->
    <select id="Province" name="Province" 
        onchange="if(this.value===''){
            this.form.City.value=''; 
            this.form.Postcode.value=''; 
            this.form.District.value='';}
            this.form.submit();"
        placeholder="Province" required>
        <option value="">[ Select Province ]</option><?php
if(isset($Provinces)){
    foreach($Provinces as $province){?>
        <option value="<?=$province['Name'];?>" <?=($province['Name']==(isset($Province)?$Province:'#')?' Selected':'');?>><?=$province['Name'];?></option><?php
    }
}?>
    </select>
    <!--<label for="City">City</label>-->
    <select id="City" name="City"
        onchange="if(this.value===''){
            this.form.Postcode.value=''; 
            this.form.District.value='';}
            this.form.submit();"
        placeholder="City" required>
        <option value="">[ Select City ]</option><?php
if(isset($Cities)){
    foreach($Cities as $city){?>
        <option value="<?=$city['Name'];?>" <?=($city['Name']==(isset($City)?$City:'#')?' Selected':'');?>><?=$city['Name'];?></option><?php
    }
}?>
    </select>
   <!-- <label for="Postcode">Postcode</label>-->
    <select id="Postcode" name="Postcode"
        onchange="if(this.value===''){
            this.form.District.value='';}
            this.form.submit();"
        placeholder="Postcode">
        <option value="">[ Select Postcode ]</option><?php
if(isset($Postcodes)){
    foreach($Postcodes as $postcode){?>
        <option value="<?=$postcode['Name'];?>" <?=($postcode['Name']==(isset($Postcode)?$Postcode:'#')?' Selected':'');?>><?=$postcode['Name'];?></option><?php
    }
}?>
    </select>
    <!--<label for="District">District</label>-->
    <select id="District" name="District"
        onchange="this.form.submit();"
        placeholder="District">
        <option value="">[ Select District ]</option><?php
if(isset($Districts)){
    foreach($Districts as $district){?>
        <option value="<?=$district['Name'];?>" <?=($district['Name']==(isset($District)?$District:'#')?' Selected':'');?>><?=$district['Name'];?></option><?php
    }
}?>
    </select>
    <label for="Reset"></label>
    <input type="Button" value="Reset" 
       onclick="{
                this.form.Country.value='China'; this.form.Province.value=''; 
                this.form.City.value=''; this.form.District.value='';
                this.form.Postcode.value=''; this.form.submit();}"/>
</div> 
<p><b style="color:red;"><?=(isset($Message)?$Message:'');?></b></p>

<?php 
$Places = 0;
if(isset($results) and sizeof($results)>0){?>
<h4>2. Select a place and click on it</h4>
<ul><?php 
foreach($results as $row):?>
<li class="ui-btn" onclick="{
    myplaces.PlaceID.value = '<?=$row['PlaceID'];?>'; 
    myplaces.Country.value = '<?=$row['Country'];?>';
    myplaces.Province.value = '<?=$row['Province'];?>';
    myplaces.City.value = '<?=$row['City'];?>';
    myplaces.Postcode.value = '<?=$row['Postcode'];?>';
    myplaces.District.value = '<?=$row['District'];?>';
    myplaces.submit();}">
    <?=($row['Province'].', '.$row['City'].', '.$row['Postcode'].', '.$row['District']);?>
</li>    
<?php 
   $Places++;       
endforeach;?>
</ul><?php
}?>
<SCRIPT>

    function togglecolor(obj){
        if(obj.value==='Y'){
            obj.style="color:#ffff88;";
        } else {
            obj.style="color:#88ffff;";
        }
    }
 /*   $(document).ready(function(){
        // Grab a select field
        var el = $('#YOUR_SELECT_FIELD');
        // Select the relevant option, de-select any others
        el.val('some value').attr('selected', true).siblings('option').removeAttr('selected');
        // Initialize the selectmenu
        el.selectmenu();
        // jQM refresh
        el.selectmenu("refresh", true);
    }); 
  */  
    $(document).ready(function(){
        togglecolor($('Returnee'));
        togglecolor($('Contact'));
        togglecolor($('Fellowship'));
        togglecolor($('Church'));
        togglecolor($('Nearby'));
    });

   
</script>
<?php
if($Places<=1 /*or ($Country<>'' AND $Province<>'' AND $City<>'' AND $Postcode<>'' AND $District<>'')*/){?>
<div class="ui-field-contain"> 
<h4>3. In this place I know ... </h4>
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
</div><?php
}else{?>
<b>You need to select a district before you can update it - click on one of the above.</b><?php    
}?>
</form>    
</DIV>
<div data-role="panel" id="help" data-display="push" data-position="right">  
<b>My Places</b>
<p>Places are where you have a connection.</p>
<div data-role="collapsible">    
<H4>How to find a place</H4>
<p>In order to be as precise as possible, a place is defined as a city, postcode 
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

        
        
</DIV>

