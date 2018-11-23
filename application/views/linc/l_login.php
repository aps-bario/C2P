<DIV data-role="main" data-theme="a" class="ui-content">
<div class="breadcrumb">
<a href="/linc/home">Home</a> | 
<b>Login</b>
</div>    
<H4>Member Login</H4>
<!--<p>Some general information useful to those returning China is has been made available in the 
	public areas of this web-site. No information about individuals in China is held by this system,
	but in order to be referred to people who have such connections you will first need to be a 
	registered member of this service. </p>-->
<fieldset max-width="400px">
<form name="Login" action="/linc/login"method="post">
<input name="PageMode" type="Hidden" value="Login" />
<div class="ui-field-contain">
    <label for="Email">Email&nbsp;Address</label>
    <input name="Email" type=email size=35 
        placeholder="Email Address" value=""/>
</div>
<div class="ui-field-contain">
    <label for="Password">Password</label> 
    <?=(isset($Reminder)?'Hint: '.$Reminder:'');?>
    <input name="Password" type=Password size=20/ 
           placeholder="<?=(isset($Reminder)?'Hint: '.$Reminder:'');?>">
</div>
<input name="Submit" type=Submit value="Login"/>
<?=(isset($Message)?$Message:'');?>
</form>
</fieldset>    
<p>If you need to register then	<a href="/linc/newmember">Click Here</a></p>
</DIV>
