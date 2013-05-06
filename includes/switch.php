<?php function expressa_style_switch() { global $root; ?>
	
<div id="slideout">
  <div id="slidecontent">
  
    <h6 class="switch_heading">Colors</h6>
      <div class="color_switch_wrap">
		    <ul id="color-nav">
		      <li class="<?php echo $root;?>/css/colors/default.css"><div class="switch_tile orange"></div></li>
		      <li class="<?php echo $root;?>/css/colors/dark-blue.css"><div class="switch_tile dark-blue"></div></li>
		      <li class="<?php echo $root;?>/css/colors/green.css"><div class="switch_tile green"></div></li>
		      <li class="<?php echo $root;?>/css/colors/light-blue.css"><div class="switch_tile light-blue"></div></li>
		      <li class="<?php echo $root;?>/css/colors/red.css"><div class="switch_tile red"></div></li>
		      <li class="<?php echo $root;?>/css/colors/brown.css"><div class="switch_tile brown"></div></li>
		      <li class="<?php echo $root;?>/css/colors/purple.css"><div class="switch_tile purple"></div></li>
		 		  <li class="<?php echo $root;?>/css/colors/black.css"><div class="switch_tile black"></div></li>
		    </ul>
      </div>
            
    <h6 class="switch_heading">Layout</h6>  
      <ul id="layout-nav">
        <li class="switch_wide"><a class="tiny secondary button">Wide</a></li>
        <li class="switch_boxed"><a class="tiny secondary button">Boxed</a></li>
      </ul>  

    <div class="bg_patterns_wrap">
	    <h6 class="switch_heading">Background Patterns</h6>
	    <ul class="bg-nav">
	      <li class="grunge-wall"><div class="switch_tile grunge-wall"></div></li>
	      <li class="brushed-alu"><div class="switch_tile brushed-alu"></div></li>
	      <li class="retina-wood"><div class="switch_tile retina-wood"></div></li>
	      <li class="noisy-grid"><div class="switch_tile noisy-grid"></div></li>
	      <li class="cartographer"><div class="switch_tile cartographer"></div></li>
	      <li class="dark-wood"><div class="switch_tile dark-wood"></div></li>
	      <li class="illusion"><div class="switch_tile illusion"></div></li>
	      <li class="nistri"><div class="switch_tile nistrig"></div></li>
	    </ul>
	   </div>
	  
	   <div class="bg_patterns_wrap">
	    <h6 class="switch_heading">Background Colors</h6>
	    <ul class="bg-nav">
	      <li class="blue-bg"><div class="switch_tile blue"></div></li>
	      <li class="black-bg"><div class="switch_tile black"></div></li>
	      <li class="green-bg"><div class="switch_tile green"></div></li>
	      <li class="orange-bg"><div class="switch_tile orange"></div></li>
	      <li class="red-bg"><div class="switch_tile red"></div></li>
	      <li class="teal-bg"><div class="switch_tile teal"></div></li>
	      <li class="purple-bg"><div class="switch_tile purple"></div></li>
	      <li class="yellow-bg"><div class="switch_tile yellow"></div></li>
	    </ul>
    </div>
    
  </div>

  <div id="clickme">
   <img src="<?php echo $root;?>/images/switch/edit.png" alt="switch">
  </div>

</div>
		
<?php } ?>