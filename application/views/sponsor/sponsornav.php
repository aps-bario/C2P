<div  id="secondary-navigation-wrapper">
    <div id="before-secondary-navigation"></div>
	<div id="secondary-navigation-container">
	<ul id="secondary-navigation">
      <li class="<?=($NextPage=='sponsor/sponsorhome'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sponsor/sponsorhome" data-page-url="sponsor/sponsorhome"> 
               <div class="title rendered-link-content">SPONSOR</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div> 
      </li><?php  
if(isset($Status) and ($Status=='Sponsor' or $Status=='Gatekeeper' 
        or $Status=='SysAdmin')){?>
      <li class="<?=($NextPage=='sponsor/newreturnee'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sponsor/newreturnee" data-page-url="sponsor/newreturnee"> 
               <div class="title rendered-link-content">New Returnee</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li>
      <li class="<?=($NextPage=='sponsor/myreturnees'?'current-page ':'');?>rendered-link" > 
         <div class="link-content"> 
            <a href="sponsor/myreturnees" data-page-url="sponsor/myreturnees"> 
               <div class="title rendered-link-content">My Returnees</div> 
               <div class="separator rendered-link-content"></div> 
            </a>
         </div>
      </li><?php  
}?>
      </ul>
	</div>
	<div id="after-secondary-navigation"></div>
</div>
</div>

