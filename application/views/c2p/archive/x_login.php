<DIV class="content">
<div class="breadcrumb">
<a href="/mobile/home">Oneway</a> | 
<b>Login</b>
</div>    
<H4>Member Login</H4>
<p>Some general information useful to those returning China is has been made available in the 
	public areas of this web-site. No information about individuals in China is held by this system,
	but in order to be referred to people who have such connections you will first need to be a 
	registered member of this service. </p>
  
<!--<div align=center>-->
    <fieldset max-width="400px"><legend>Member Login</legend>
    <form name="Login" action="../oneway/login"method="post">
    <input name="PageMode" type="Hidden" value="Login" />
    <table style="border-color:#000000; border-size:1px;">
    <!--<tr><td colspan=3>LOGIN - for registered users</td></tr>-->
    <tr>  
         <td align="left">Email&nbsp;Address</td>
         <td align="left" colspan=2>
            <input name="Email" type=text size=35 placeholder="Your email address"
            value="<?=$Email?>"/></td>
    </tr>
    <tr>  
         <td align="left">Password</td>
         <td align="left"><input name="Password" type=Password size=20/
            placeholder="<?=(isset($Reminder)?'Hint: '.$Remninder:'Enter Password');?>"></td>
         <td align="left"><input name="Submit" type=Submit value="Login"/></td>
    </tr>
   <tr>
         <td colspan=3 class="highlight"><?=(isset($Reminder)?'Hint: '.$Remninder:'Enter Password');?></td>
      </tr>
    
    <tr>
         <td colspan=3 class="highlight"><?=(isset($Message)?$Message:'');?></td>
      </tr>
   </table><br/>
    	<p>If you have not already registered please do so 
	<a href="oneway/newmember">here</a>.</p>
  
<!--</div>-->
</fieldset>
</div>
