<nav data-role="navbar" data-theme="a" id="main-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
   <a class="ui-btn topmenuitem <?=($NextPage=='oneway/home'?'ui-btn-active':'');?>" 
      href="oneway/home" data-page-url="oneway/home">ONEWAY</a>
   <a class="ui-btn topmenuitem <?=($NextPage=='oneway/home'?'ui-btn-active':'');?>" 
      href="oneway/home" data-page-url="member/home">MEMBER</a>
   <a class="ui-btn topmenuitem <?=($NextPage=='oneway/home'?'ui-btn-active':'');?>" 
      href="oneway/home" data-page-url="oneway/home">SPONSOR</a>
   <a class="ui-btn topmenuitem <?=($NextPage=='oneway/home'?'ui-btn-active':'');?>" 
      href="oneway/home" data-page-url="oneway/home">GATEKEEPER</a>
   <a class="ui-btn topmenuitem <?=($NextPage=='oneway/home'?'ui-btn-active':'');?>" 
      href="oneway/home" data-page-url="oneway/home">SYSTEM</a>
</nav> 

   
   
<nav data-role="navbar" data-theme="a" id="main-menu" 
   class="topmenu ui-mini ui-btn-inline ui-corner-all clear-both">
   
	<ul id="secondary-navigation">
      <li class="<?=($NextPage=='oneway/home'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a > 
               <div class="title rendered-link-content">HOME</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li>
      <li class="<?=($NextPage=='oneway/forreturnees'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/forreturnees" data-page-url="oneway/forreturnees"> 
               <div class="title rendered-link-content">Returnee</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/forsponsors'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/forsponsors" data-page-url="oneway/forsponsors"> 
               <div class="title rendered-link-content">Sponsor</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/faith'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/faith" data-page-url="oneway/faith"> 
               <div class="title rendered-link-content">Christian</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/feedback'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/feedback" data-page-url="oneway/feedback"> 
               <div class="title rendered-link-content">Feedback</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/newmember'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/newmember" data-page-url="oneway/newmember"> 
               <div class="title rendered-link-content">Registration</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li>
      <li class="<?=($NextPage=='oneway/login'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/logout" data-page-url="oneway/logout"> 
               <div class="title rendered-link-content">Login</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      </ul>
</nav>

	</div>
	<div id="after-secondary-navigation"></div>
</div>
</div>

<!--<div id="secondary-navigation-wrapper">
    <div id="before-secondary-navigation"></div>
	<div id="secondary-navigation-container">
<nav>
	<ul id="secondary-navigation">
      <li class="<?=($NextPage=='oneway/home'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/home" data-page-url="oneway/home"> 
               <div class="title rendered-link-content">HOME</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li>
      <li class="<?=($NextPage=='oneway/forreturnees'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/forreturnees" data-page-url="oneway/forreturnees"> 
               <div class="title rendered-link-content">Returnee</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/forsponsors'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/forsponsors" data-page-url="oneway/forsponsors"> 
               <div class="title rendered-link-content">Sponsor</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/faith'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/faith" data-page-url="oneway/faith"> 
               <div class="title rendered-link-content">Christian</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/feedback'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/feedback" data-page-url="oneway/feedback"> 
               <div class="title rendered-link-content">Feedback</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='oneway/newmember'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/newmember" data-page-url="oneway/newmember"> 
               <div class="title rendered-link-content">Registration</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li>
      <li class="<?=($NextPage=='oneway/login'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="oneway/logout" data-page-url="oneway/logout"> 
               <div class="title rendered-link-content">Login</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      </ul>
</nav>

	</div>
	<div id="after-secondary-navigation"></div>
</div>
</div>-->