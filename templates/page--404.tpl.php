<?php
/**
 * @file
 * Expressa's theme implementation to display a single Drupal page.
 */
?>
  <div id="content-wrap">
<div id="page-wrap" class="container">

	<header>
	
	  <div class="row">
	    <div class="span4">
	    
	      <!-- Begin "branding" wrapper that contains logo/site name/site slogan -->
	      <div id="branding">   
	        
	        <?php if (isset($page['branding'])) : ?>
			      <?php print render($page['branding']); ?>
			    <?php endif; ?>
	      
		      <?php if ($logo): ?>
		        <div id="site-logo">
				      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
				        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
				      </a>
		        </div>
			    <?php endif; ?>
			    
			    <?php if ($site_name || $site_slogan): ?>
			      <div id="name-and-slogan"<?php if ($disable_site_name && $disable_site_slogan) { print ' class="hidden"'; } ?>>
			
			        <?php if ($site_name): ?>
			          <h1 id="site-name"<?php if ($disable_site_name) { print ' class="hidden"'; } ?>>
			            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
			          </h1>
			        <?php endif; ?>
			
			        <?php if ($site_slogan): ?>
			          <div id="site-slogan"<?php if ($disable_site_slogan) { print ' class="hidden"'; } ?>>
			            <?php print $site_slogan; ?>
			          </div>
			        <?php endif; ?>
			
			      </div> <!-- /#name-and-slogan -->
			    <?php endif; ?>

	      </div>  
	      <!-- /branding --> 
	       
	    </div>
	    <div id="header-right" class="span8">
	    
	      <div class="row">
	        <div class="span8">
	        
	          <div style="float: right;">
	    
			      <?php if (isset($page['header_right_top_left'])) : ?>
					    <?php print render($page['header_right_top_left']); ?>
					  <?php endif; ?>
					  
	          </div>
	          <div style="float: right;">
	    
			      <?php if (isset($page['header_right_top_right'])) : ?>
					    <?php print render($page['header_right_top_right']); ?>
					  <?php endif; ?>
					  
	          </div>
					  
	        </div>  
	      </div>
	      
	      <div class="row">
	        <div class="span8">
	      
            <?php if (isset($page['header_right_bottom'])) : ?>
			        <?php print render($page['header_right_bottom']); ?>
			      <?php endif; ?>
			      
	        </div>
	      </div>    
			 
	    </div>
	  </div>
	  
	  <div class="row">
	    <div class="span12">    
		       
		
			  
			  <nav id="menu">
				  <?php if (isset($page['menu'])) : ?>
				    <?php print render($page['menu']); ?>
				  <?php endif; ?>
			  </nav>
	     
	    </div>
	  </div>  
	</header>
	
	  <div class="row">
	    <div class="span12">
	    
	      <?php print render($title_prefix); ?>
        <?php print render($title_suffix); ?>
       	 
       	<?php if ($tabs = render($tabs)): ?>
			    <div id="drupal_tabs" class="tabs bigpadding">
			      <?php print render($tabs); ?>
			    </div>
			  <?php endif; ?>
	      <?php print render($page['help']); ?>
	      <?php if ($action_links): ?>
	        <ul class="action-links">
	          <?php print render($action_links); ?>
	        </ul>
	      <?php endif; ?>
	      
	      <div id="breadcrumbs"><?php print $breadcrumb . $title; ?></div>
	      
	      <h1>THIS IS 404 TEMPLATE</h1>
	      
			  <?php if (isset($page['content'])) : ?>
			    <?php print render($page['content']); ?>
			  <?php endif; ?>  
	  
	    </div>
	  </div>  
	

</div>
  </div>
  <div id="footer-wrap">
	<footer>  
	
	  <div class="row">
	  
	    <div class="span3">
	      <?php if (isset($page['footer_col_1'])) : ?>
			    <?php print render($page['footer_col_1']); ?>
			  <?php endif; ?>
	    </div>
	    
	    <div class="span3">
	      <?php if (isset($page['footer_col_2'])) : ?>
			    <?php print render($page['footer_col_2']); ?>
			  <?php endif; ?>
	    </div>
	    
	    <div class="span3">
	      <?php if (isset($page['footer_col_3'])) : ?>
			    <?php print render($page['footer_col_3']); ?>
			  <?php endif; ?>
	    </div>
	    
	    <div class="span3">
	      <?php if (isset($page['footer_col_4'])) : ?>
			    <?php print render($page['footer_col_4']); ?>
			  <?php endif; ?>
	    </div>
	    
	  </div>  
	  
	  <div class="row">
	    <div class="span12">
	    
			  <?php if (isset($page['footer'])) : ?>
			    <?php print render($page['footer']); ?>
			  <?php endif; ?>
	  
	    </div>
	  </div>  
	</footer>
  </div>