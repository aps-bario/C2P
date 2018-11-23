<DIV class="content">
<div class="breadcrumb">
<a href="../c2p/home">Home</a> | 
<b>Login</b>
</div>    
<H4>Member Login</H4>
<!--<p>Some general information useful to those returning home has been made 
    available in the public areas of this web-site. No information about those 
    in returnee home countries is held by this system, but in order to be 
    connected to people who have such connections, you will first need to be a 
    registered member of this service. </p>-->
<fieldset max-width="400px"><legend>Member Login</legend>
    <form name="Login" action="/c2p/login" method="post">
    <input name="PageMode" type="Hidden" value="Login" />   
    <table style="border-color:#000000; border-size:1px;">
    <tr>  
         <td align="left">User&nbsp;Email</td>
         <td align="left" colspan=2>
            <input id="Email" name="Email" type="email" size=35 
                   placeholder="Your email address"
            value="<?=(isset($Email)?$Email:'');?>"/></td>
    </tr>
    <tr>  
         <td align="left">Password</td>
         <td align="left"><input id="Password" name="Password" 
            placeholder="<?=$Reminder?>"
            type=Password size=20/></td>
         <td align="left"><input name="Submit" type=Submit value="Login"/></td>
    </tr>   
    <tr>  
         <td align="left"></td>
         <td align="left" colspan=2><?=$Reminder?></td>
      </tr>
      <tr>
         <td colspan=3 class="highlight"><?=(isset($Message)?$Message:'');?></td>
      </tr>
   </table><br/>
    	<p>If you have not already registered as a member please do so 
	<a href="../c2p/newmember">here</a>.</p>
  
</fieldset>
</div>
