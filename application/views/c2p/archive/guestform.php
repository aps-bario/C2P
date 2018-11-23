<DIV class="content">
<small>
<a href="../public/home.php">Home</a> | 
<a href="../public/forguests.php">For Guests</a> | 
<b>Registration Form</b>
</small>
<H4>Guest Registration Form</h4>

<p>In order to match guests with hosts we need to know a little about you, 
please complete the profile below. You will be able to come back later and 
update what you have entered. We will only use the information provided to 
help us match you with hosts who are willing to offer the hospitality  to 
international students.</p>
<p>PLEASE NOTE: This page is for new student registrations only. If you have 
   completed a form before, then please login to the web-site and review your
   profile that you will find under the Guest menu called 'My Profile'.</p>
<DIV>
   <form name="GuestForm" action="guestform" method="post">
   <fieldset>
      <legend>Personal Information</legend>
      <table width="100%">
      <tr>
         <td>Last (Family) Name</td>
         <td><input type="text" name="LastName" tabindex="1" value=""/></td>
         <td>Title</td>
         <td nowrap>
            <select name="Title" tabindex="6" >
               <option value=""></option>
               <option value="Rev">Rev</option>
               <option value="Dr">Dr</option>
               <option value="Mr">Mr</option>
               <option value="Mrs">Mrs</option>
               <option value="Ms">Ms</option>
               <option value="Miss">Miss</option>
            </select>
         </td>
      </tr>
      <tr>
      <tr>
         <td>First (Given) Name</td>
         <td><input type="text" name="FirstName" tabindex="2" value=""/></input></td>
         <td>Gender</td>
         <td>
            <select name="Gender" tabindex="7" >
               <option value=""></option>
               <option value="F">Female</option>
               <option value="M">Male</option>
            </select>
         </td>
      </tr>
      <tr>
         <td>Preferred Name</td>
         <td><input name="PrefName" type="text" tip="How you like to be called" tabindex="3" value=""/></input></td>
         <td>Age Range</td>
         <td>
             <select name="AgeRange" tabindex="8" >
               <option value=""></option>
               <option value="18-21">18-21</option>
               <option value="22-25">22-25</option>
               <option value="26-30">26-30</option>
               <option value="31-40">31-40</option>
               <option value="41-50">41-50</option>
               <option value="50+">50+</option>
            </select> 
         </td>
</tr>
      <tr>
         <td>Nationality</td>
         <td>
            <input type="text" name="Nationality" tabindex="4" value=""/>
         </td>
         <td><input type="checkbox" name="Married" tabindex="9" value="1"/>Married</td>
         <td><input type="checkbox" name="PartnerUK" tabindex="10" value="1"/>Partner (in UK)</td>
         
      </tr>
      <tr>
         
         <td>Language spoken at home</td>
         <td>
            <input type="text" name="MotherTongue" size="20" tabindex="5" value=""></input>
         </td>
         <td >No. Children <input type="text" name="Children" size="2" tabindex="11" value="0"/></td>
         <td>What ages <input type="text" name="ChildDetails" size="5" tabindex="12" value=""/>   </td>
      </tr>
   </table></fieldset><br/>
   <fieldset>
   <legend>UK Contact Information</legend>
   <table width="100%">
         
      <tr><th colspan="4"><br/></th></tr>   
      <tr>
         <td>Address 1</td>
         <td><input type="text" name="Address1" size=40 value=""/></td>
         <td>Email Address</td>
         <td><input type="email" name="GuestEmail" value=""/></td>
      </tr>   
      <tr><td>Address 2</td>
         <td><input type="text" name="Address2" size="40" value=""/></td>
         <td>Email (Secondary)</td>
         <td><input type="email" name="Email2" value=""/></td>
      <tr>
         <td>City</td>
         <td><input type="text" name="City" value=""/></td>
         <td>Mobile Phone</td>
         <td><input type="text" name="Mobile" value=""/></td>
      </tr>   
      <tr>
         <td>County</td>
         <td><input type="text" name="County" value=""/></td>
         <td>Postcode</td>
         <td><input type="text" name="Postcode"  value=""/></td>
      </tr>   
   </table></fieldset><br/>
   <fieldset>
      <legend>Information on your stay in the UK</legend>
      <table width="100%">
       <tr>
         <td>Course</td>
         <td>
            <input type="text" name="Course" size="30" value=""></input>
         </td>
         <td>Degree</td>
         <td><select name="Degree">
               <option value=""></option>
               <option value="PhD">PhD</option>
               <option value="MBA">MBA</option>
               <option value="MSc">MSc</option>
               <option value="MA">MA</option>
               <option value="BSc">BSc</option>
               <option value="BA">BA</option>
            </select>
         </td>
      </tr>
        <tr>
         <td>University/College</td>
         <td nowrap>
            <select name="University">
               <option value=""></option>
               <option value="Coventry">University of Coventry</option>
               <option value="Warwick">University of Warwick</option>
            </select>
         <td>Year of Study</td>
         <td><select name="StudyYear">
               <option value=""></option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4+">4+</option>
            </select>
         </td>
      </tr>
      <tr>
         <td>Country of Origin</td>
         <td>
            <input type="text" name="HomeCountry" size="30" value=""></input>
         </td>
         <td>Arrived UK</td>
         <td><input type="date" name="Arrived" size="12" value=""></td>
       </tr>   
      <tr>
         <td>Languages Spoken</td>
         <td>
            <input type="text" name="Languages" size="30" value=""></input>
         </td>
         <td>Scheduled UK Departure</td>
         <td><input type="date" name="Departing" size="12"  value=""/></td>
     </tr>        
   </table></fieldset><br/>
   <fieldset>
   <legend>My Preferences</legend>
     <table width="100%">
     <tr>
        <td colspan="4">Please tick all the boxes below that apply to you, </br>
           as this will help us match you with appropriate hosts.</br></br></td>
     </tr>
     <tr>
        <td colspan="4">
            <input type="checkbox" name="OnlyOne" value="1"/>If necessary, would be happy to be the only guest invited by a host.<br>
            <input type="checkbox" name="SameSex" value="1"/>I would prefer the host, and other guests, to all be of my own gender.<br>
            <input type="checkbox" name="Kids" value="1"/>I would prefer a host happy for me to bring my children with me.<br>
            <input type="checkbox" name="Pets" value="1"/>I am happy to visit a home with animals and have no problem with either cats or dogs.<br>
            <input type="checkbox" name="Vegetarian" value="1"/>I am a vegetarian and would prefer a host willing to cook vegetarian food.<br>
            <input type="checkbox" name="Smoker" value="1"/>I am a smoker [Please be aware that smoking is not permitted in many UK homes].<br>
<!--            <input type="checkbox" name="Lifts" value="1"<?=($Car==0?' Checked':'');?>/>I am unable to travel by myself and will need a lift. <br>-->
            </br>
        </td>
     </tr>
     <tr>
         <td colspan="4">If you have friends or a partner that you would like to be with, 
         please ask them to register, then list their names and email addresses below;<br/>
         <textarea name="FriendsEmails" cols="70" rows="2"></textarea></td>
      </tr>
   </table></fieldset><br/>
   <fieldset>
      <legend>Invitation Preferences</legend>
      <table width="100%">
      <tr>
         <td colspan="4">
            Please select the types of invitation that you would like to receive, 
            the mailing list is for any other special events that may be organised.
         </td>
      </tr>
      <tr>
         <td width="25%"><input type="checkbox" name="Meal" value="1"/>Meal anytime</td>   
         <td width="25%"><input type="checkbox" name="Christmas" value="1"/>Christmas meal</td>
         <td width="25%"><input type="checkbox" name="Easter" value="1"/>Easter meal</td>   
         <td width="25%"><input type="checkbox" name="Party" value="1"/>Party / Group</td>   
      </tr>
      <tr>      
         <td width="25%"><input type="checkbox" name="Walk" value="1"/>Local Walk</td>   
         <td width="25%"><input type="checkbox" name="Trip" value="1"/>Day Trip</td>   
         <td width="25%"><input type="checkbox" name="Weekend" value="1"/>Weekend Away</td>   
         <td width="25%"><input type="checkbox" name="Mailing" value="1"/>Mailing List</td>
      </tr>   
      <tr>
         <td colspan="4">
            <p>Please use the space below to tell us of any special needs of which we
            should be aware (e.g. any disability or special food requirements). Please 
            add anything else you would like to tell us about yourself. <small>(Max 500 chars - about 5 lines)</small></p>
            <textarea name="GuestDetails" cols="70" rows="5" maxlength="500"></textarea>
            <p>You are free to update or modify your profile when ever you like, we may 
               also remind you to revisit and check it once a year. If you would like to be removed
               from the system please email admin@cwisw.org.uk</p>
         </td>
            
      </tr> 
   </table></fieldset><br/>
   <fieldset>
      <legend>Login Details</legend>
      <table width="100%">
      <tr>
        <td colspan="3">
            <p>In order to be able to protect your details and also to allow you
            to get back into this web-site you will need to login next time. You
            will be asked for email address and a password, that we would like
            you to set below. Enter the same password twice, and also a clue or 
            reminder that will help you remember which password you used, as we
            have no access to passwords and will not be able to tell you what it 
            is if you forget it. </p>
         </td>
      </tr>
      <tr>  
         <td>New&nbsp;Password</td>
         <td colspan="2">
            <input name="Password" type=password size=35 />
         </td>
      </tr>
      <tr>  
         <td>Confirm&nbsp;Password</td>
         <td colspan="2">
            <input name="Confirm" type=password size=35 />
         </td>
      </tr> 
      <tr>  
         <td>Password&nbsp;Reminder</td>
         <td colspan="2">
            <input name="Reminder" type=text size=35 value=""/>
         </td>
      </tr>
      <tr>
        <td colspan="3">
            <p>When you submit this form, you will be sent an email, to the email
               address that you provided. In that email will be a link which you 
               will need to click on that will tell the web-site that you received 
               the email and therefore to activate your account. You will not be 
               able to login to this web-site until you have responded to that email.</p>
         </td>
      </tr>

   </table></fieldset>  <br/>       
  <fieldset><table width="100%">         
      <tr>
         <td></td>
         <td align="RIGHT"><input name="Submit" type="Button" value="Submit" onclick="checkGuest(this.form);"></td>
      </tr>
   </table></fieldset>         
   </form>
</DIV>
</DIV> <!-- Content -->

<SCRIPT>
function checkGuest(form){
   var fldList = '';

   if(form.FirstName.value==''){ fldList+='First Name\n';}
   if(form.LastName.value==''){ fldList = fldList + 'Last Name\n';}
   if(form.PrefName.value==''){ fldList+='Preferred Name\n';}   
   if(form.Nationality.value==''){ fldList+='Nationality\n';}
   if(form.MotherTongue.value==''){ fldList+='Language\n';}
   
   if(form.Title.value==''){ fldList+='Title\n';}
   if(form.Gender.selectedIndex==0){ fldList+='Gender\n';}
   if(form.AgeRange.value==''){ fldList = fldList + 'Age Range\n';}
 
   if(form.Address1.value==''){ fldList+='Address 1\n';}
//   if(form.Address2.value==''){ fldList = fldList + 'Address 2\n';}
   if(form.City.value==''){ fldList+='City\n';}   
//   if(form.County.value==''){ fldList = fldList + 'County\n';}
   if(form.GuestEmail.value==''){ fldList+='Email\n';}
   if(form.Mobile.value==''){ fldList = fldList + 'Mobile\n';}
   if(form.Postcode.value==''){ fldList = fldList + 'Postcode\n';}

   if(form.Course.value==''){ fldList+='Course\n';}
   if(form.Degree.value==''){ fldList+='Degree\n';}
   if(form.University.value==''){ fldList = fldList + 'University\n';}
   if(form.StudyYear.value==''){ fldList+='Year of Study\n ';}
   if(form.HomeCountry.value==''){ fldList = fldList + 'Home Country\n';}
   if(form.Arrived.value==''){ fldList+='Date Arrived\n';}

   if(form.Password.value==''){ fldList = fldList + 'Password\n';}
   if(form.Reminder.value==''){ fldList = fldList + 'Reminder\n';}
   if(form.Confirm.value!=form.Password.value){ fldList = fldList 
         + '\n\nYour passwords so not match, please try again. ';}

   if(fldList!='') alert('Please enter a value in the following fields;\n\n'+fldList);
   else {form.submit();}
}
</SCRIPT>
