<script type="text/javascript">

	jQuery(document).ready(function() {

		function hide_unhide_media() {

			jQuery("#media_import_box").toggle(!jQuery("#skip_media").is(':checked'));

		}

		jQuery("#skip_media").bind('click', hide_unhide_media);

		hide_unhide_media();

	});

</script>

<?php

$data = get_option('cmshelplive_j2woptions');

$path = plugin_dir_url(__FILE__);

//print_r($plugin_options);

?>



<div class="ocrb-Pro-bootsratp joomla-to-worpdress">

  <div class="ocrb-pro-bootsratp-main">

 <div class="container" style="width:100%;">

  

 

    

    <div class="row">

     <div class="col-md-12">

      <h2 class="ocrb-Pro-bootsratp-hedding">

        <?php print $data['title'] ?>

      </h2>

      <p class="ocrb-Pro-bootsratp-ptex">

        <?php print $data['description'] ?>

      </p>

      </div>

    </div>

    

    <div class="row frm" id="sf0">

        <div class="col-md-8 col-md-offset-2">

        <div class="form-group cmshelplivej2w_message"></div>

        <div class="form-group"><p class="ocrb-Pro-bootsratp-ptex">Check this box if you want to start all over clean (It will delete existing imported content) <input type="checkbox" value="yes" name="again_start_importer" id="again_start_importer"></p></div>

          <div class="form-group"> 

            <div class="ocrb-Pro-bootsratp-butten-div">

            <!-- back2 unique class name  -->

            <button class="btn btn-primary" type="button" onClick="remove_previous_post()">Next</button>

            <!-- open2 unique class name -->

            <!--<button class="btn btn-primary open0" type="button">Skip <span class="fa fa-arrow-right"></span></button>-->

            </div>

          </div>

          

          </div>

          </div>

         

    <!-- step 1 -->

     <div class="row frm" id="sf1" style="display:none;">

   
        
        <div class="col-md-8 col-md-offset-2">
		
    <form role="form" action="" method="post" class="form-horizontal" data-toggle="validator">

       <div class="form-group cmshelplivej2w_message"></div>

          <div class="form-group">

            <label for="url" class="col-sm-4 control-label">

              <?php _e('Your Joomla URL (beginning with http://)', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="url" name="url" class="form-control" type="text"  value="<?php echo $data['url']; ?>" required/>

            </div>

          </div>

          <div class="form-group">

            <label for="hostname" class="col-sm-4 control-label">

              <?php _e('Hostname', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="hostname" name="hostname" class="form-control" type="text"  value="<?php echo $data['hostname']; ?>" />

          </div>

          </div>

          <div class="form-group">

            <label for="port" class="col-sm-4 control-label">

              <?php _e('Port', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="port" name="port" class="form-control" type="text" value="<?php echo $data['port']; ?>" />

          </div>

          </div>

          <div class="form-group">

            <label for="database" class="col-sm-4 control-label">

              <?php _e('Database', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="database" name="database" class="form-control" type="text"  value="<?php echo $data['database']; ?>"  required/>

          </div>

          </div>

          <div class="form-group">

            <label  for="username" class="col-sm-4 control-label">

              <?php _e('Username', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="username" name="username" class="form-control" type="text"  value="<?php echo $data['username']; ?>" />

          </div>

          </div>

          <div class="form-group">

            <label for="password" class="col-sm-4 control-label">

              <?php _e('Password', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="password" name="password" class="form-control" type="password" value="<?php echo $data['password']; ?>" />

          </div>

          </div>

          <div class="form-group">

            <label for="prefix" class="col-sm-4 control-label">

              <?php _e('Joomla Table Prefix', 'j2wpcmshelplive'); ?>

            </label>

            <div class="col-sm-8">

            <input id="prefix" name="prefix" class="form-control" type="text"  value="<?php echo $data['prefix']; ?>" />

          </div>

          </div>

          

          <div class="form-group" style="text-align:center;"> 

            

            <!-- back2 unique class name  -->

            <button class="btn btn-primary" type="button" onClick="test_connection()">Submit</button>

            <!-- open2 unique class name -->
<!--
            <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button>
-->
          </div>

        

        </form>

        </div>
        
        

      </div>

      <!-- step 2 -->

      

      <div class="row frm" id="sf2" style="display:none;">
      

        <div class="col-md-8 col-md-offset-2">
<div class="form-group cmshelplivej2w_message"></div>
          <div class="form-group">

             <label class="col-sm-4 control-label" style="padding-left:0;">

              <?php _e('Where does Introtext Goes?:', 'j2wpcmshelplive'); ?>

            </label><br>

             <div class="radio">

            <label>

            <input id="introtext_in_excerpt" name="introtext" type="radio" value="in_excerpt" <?php checked($data['introtext'], 'in_excerpt'); ?> />

            <label for="introtext_in_excerpt" class="mind-label" title="<?php _e("The text before the «Read more» split will be imported into the excerpt.", 'j2wpcmshelplive'); ?>"><?php _e('to the excerpt', 'j2wpcmshelplive'); ?></label>

            </label>

            &nbsp;&nbsp;

            <label>

			<input id="introtext_in_content" name="introtext" type="radio" value="in_content" <?php checked($data['introtext'], 'in_content'); ?> /> 

            <label for="introtext_in_content" class="mind-label" title="<?php _e("The text before the «Read more» split will be imported into the post content with a «read more» link.", 'j2wpcmshelplive'); ?>"><?php _e('to the content', 'j2wpcmshelplive'); ?>

            </label>

            </label>

            &nbsp;&nbsp;

            <label>

			<input id="introtext_in_excerpt_and_content" name="introtext" type="radio" value="in_excerpt_and_content" <?php checked($data['introtext'], 'in_excerpt_and_content'); ?> />

            <label for="introtext_in_excerpt_and_content" class="mind-label" title="<?php _e("The text before the «Read more» split will be imported into both the excerpt and the post content.", 'j2wpcmshelplive'); ?>"><?php _e('to both', 'j2wpcmshelplive'); ?>

            </label>

            </label>

            </div>

          </div>

          

          <div class="form-group">

            <label class="col-sm-4 control-label" style="padding-left:0;">

              <?php _e('What about archived posts?', 'j2wpcmshelplive'); ?>

            </label>
            <br>

            <div class="radio">

            <label>

            <input id="archived_posts_not_imported" name="archived_posts" type="radio" value="not_imported" <?php checked($data['archived_posts'], 'not_imported'); ?> /> 

            <label for="archived_posts_not_imported" class="mind-label" title="<?php _e("Do not import archived posts", 'j2wpcmshelplive'); ?>"><?php _e('Skip', 'j2wpcmshelplive'); ?></label></label>&nbsp;&nbsp;

            

            <label>

            <input id="archived_posts_drafts" name="archived_posts" type="radio" value="drafts" <?php checked($data['archived_posts'], 'drafts'); ?> /> 

            <label for="archived_posts_drafts" class="mind-label" title="<?php _e("Import archived posts as drafts", 'j2wpcmshelplive'); ?>"><?php _e('Turn them into WordPress Drafts', 'j2wpcmshelplive'); ?></label></label>&nbsp;&nbsp;

            

			<label>

            <input id="archived_posts_published" name="archived_posts" type="radio" value="published" <?php checked($data['archived_posts'], 'published'); ?> /> 

            <label for="archived_posts_published" class="mind-label" title="<?php _e("Import archived posts as published posts", 'j2wpcmshelplive'); ?>"><?php _e('Turn them into WordPress Posts', 'j2wpcmshelplive'); ?>

            </label></label>&nbsp;&nbsp;

            </div>

          </div>

          

          <div class="form-group">

          <div class="checkbox">

          <label>

          <input id="skip_media" name="skip_media" type="checkbox" value="1" style="margin-top:1px;" <?php checked($data['skip_media'], 1); ?> />

            <label for="skip_media" style="padding-left:0; font-weight:bold;">

             <?php _e('Don\'t import multimedia', 'j2wpcmshelplive'); ?>

            </label>

            </label>

            </div>

            </div>

         

            <div class="form-group">

            <div class="radio" id="media_import_box">
            
           
            
             <label class="col-sm-6 control-label" style="padding-left:0; font-weight:bold;">

						<?php _e('I want to use first image in every Joomla Article as:', 'j2wpcmshelplive'); ?>

          </label><br>
              <div class="radio">
            <label>

            <input id="first_image_as_is" name="first_image" type="radio" value="as_is" <?php checked($data['first_image'], 'as_is'); ?> />

            <label for="first_image_as_is" class="mind-label" title="<?php _e('The first image will be kept in the post content', 'j2wpcmshelplive'); ?>"><?php _e('As first image in WordPress Post', 'j2wpcmshelplive'); ?></label></label>&nbsp;&nbsp;

            

			<label>

            <input id="first_image_as_featured" name="first_image" type="radio" value="as_featured" <?php checked($data['first_image'], 'as_featured'); ?> /> 

            <label for="first_image_as_featured" class="mind-label" title="<?php _e('The first image will be removed from the post content and imported as the featured image only', 'j2wpcmshelplive'); ?>"><?php _e('As Featured Image in WordPress', 'j2wpcmshelplive'); ?></label></label>&nbsp;&nbsp;

						

            <label>

            <input id="first_image_as_is_and_featured" name="first_image" type="radio" value="as_is_and_featured" <?php checked($data['first_image'], 'as_is_and_featured'); ?> /> <label for="first_image_as_is_and_featured"  class="mind-label" title="<?php _e('The first image will be kept in the post content and imported as the featured image', 'j2wpcmshelplive'); ?>"><?php _e('Use as Both', 'j2wpcmshelplive'); ?></label></label>&nbsp;&nbsp;
            </div>
            </div>

       
            <div class="form-group" style="display:none;">

           <div class="checkbox">

           <label>

		  <input id="import_external" name="import_external" style="margin-top:1px;" type="checkbox" value="1" <?php checked($data['import_external'], 1); ?> /> 

          <label for="import_external" style="padding-left:0; font-weight:bold;"><?php _e('Import external media', 'j2wpcmshelplive'); ?></label></label>

						

                        <br />

           <label>             

		 <input id="import_duplicates" name="import_duplicates" style="margin-top:1px;" type="checkbox" value="1" <?php checked($data['import_duplicates'], 1); ?> /> <label for="import_duplicates" style="padding-left:0; font-weight:bold;" title="<?php _e('Checked: download the media with their full path in order to import media with identical names.', 'j2wpcmshelplive'); ?>"><?php _e('Import media with duplicate names', 'j2wpcmshelplive'); ?></label></label>

		                

                        <br />

         <label> 

		<input id="force_media_import" name="force_media_import" style="margin-top:1px;" type="checkbox" value="1" <?php checked($data['force_media_import'], 1); ?> /> 

        <label for="force_media_import" style="padding-left:0; font-weight:bold;" title="<?php _e('Checked: download the media even if it has already been imported. Unchecked: Download only media which were not already imported.', 'j2wpcmshelplive'); ?>" ><?php _e('Force media import. Keep unchecked except if you had previously some media download issues.', 'j2wpcmshelplive'); ?></label></div>

        

		   <label>

		   <label style="padding-left:0; font-weight:bold;">

		   <?php _e('Timeout for each media:', 'j2wpcmshelplive'); ?>

           </label>

		   <input id="timeout" name="timeout" type="text" size="5" value="<?php echo $data['timeout']; ?>" /> 

		   <?php _e('seconds', 'j2wpcmshelplive'); ?>

           </label>             

		   </div>

           

            </div>

          

						

           

         

          <div class="form-group">

            <label>

            <input id="meta_keywords_in_tags" style="margin-top:1px;" name="meta_keywords_in_tags" type="checkbox" value="1" <?php checked($data['meta_keywords_in_tags'], 1); ?> />

            <label for="meta_keywords_in_tags" style="padding-left:0; margin-bottom:0; font-weight:bold;" ><?php _e('Turn Metakeywords into tags', 'j2wpcmshelplive'); ?></label></label>

          </div>

          

          <div class="form-group">

           <label>

           <input id="import_as_pages" name="import_as_pages" style="margin-top:1px;" type="checkbox" value="1" <?php checked($data['import_as_pages'], 1); ?> />

           <label for="import_as_pages" style="padding-left:0; margin-bottom:0; font-weight:bold;" ><?php _e('Import as pages instead of blog posts (without categories)', 'j2wpcmshelplive'); ?></label>

          </div>

         

          

          <div class="form-group"> 

            

            <!-- back2 unique class name  -->

            <!--<button class="btn btn-primary back1" type="button">Back</button>

            <button class="btn btn-primary" type="button" onClick="save_setting()">Save Setting</button>
-->
            <!-- open2 unique class name -->

            <button class="btn btn-primary" type="button" onClick="import_content()" id="import_button_txt">Start Import</button>

          </div>

        </div>

      </div>

    

  

     

     <!-- step 3 -->

    <div class="row frm" id="sf3" style="display:none; text-align:center;">

        <div class="col-md-8 col-md-offset-2">

        <div class="form-group cmshelplivej2w_message"></div>

          <div class="form-group">

      

          <p>During the migration, prefixes have been added to the categories slugs to avoid categories duplicates. This button will remove these prefixes which are useless after the migration.	

</p>

</div>

<div class="form-group">

		<button class="btn btn-primary" type="button" onclick="remove_cat_prefix()">Remove categories prefixes</button>

        <button class="btn btn-primary open3" type="button">Skip</button>

          </div>

          </div>

          </div>

    

        

            <!-- step 4 -->

            

           <div class="row frm" id="sf4" style="display:none; text-align:center;">

        <div class="col-md-8 col-md-offset-2">

        <div class="form-group cmshelplivej2w_message"></div>

          <div class="form-group">

          <p><?php _e('If you have links between articles, you need to modify internal links.', 'j2wpcmshelplive'); ?></p>

          </div>

          

          <div class="form-group">

		<button class="btn btn-primary" type="button" onclick="modify_internal_links()">Modify Internal Links</button>

        <button class="btn btn-primary open4" type="button">Skip</button>

          </div>

          

          </div>

          </div>

           

           <!-- step 5 -->

          

          <div class="row frm" id="sf5" style="display:none; text-align:center;">

        <div class="col-md-8 col-md-offset-2">

        <div class="form-group cmshelplivej2w_message"></div>

          <div class="form-group">

         

          </div>

       

          

          </div>

          </div>

    

  <div class="cler"></div>

  </div>

  <div class="cler"></div>

  </div>

  <div class="cler"></div>

</div>

<script>

	function test_connection() {

		jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');

		var hostname = jQuery('#hostname').val();

		var database = jQuery('#database').val();

		var username = jQuery('#username').val();

		var password = jQuery('#password').val();

		var prefix = jQuery('#prefix').val();

		var port = jQuery('#port').val();

			

			jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=test_joomla_connction&cookie=encodeURIComponent(document.cookie)', {

			'hostname':hostname,

			'username':username,

			'password':password,

			'port':port,

			'database':database

            },

            function (data) {

				if (data.indexOf("Connection Successfull") >= 0)
					{
						jQuery('.cmshelplivej2w_message').html(data);
						jQuery(".frm").hide(500);
						jQuery("#sf2").show(500);
					}
					else
					{
						jQuery('.cmshelplivej2w_message').html(data);
					}

            });	

		

	}

</script> 

<script>

	function import_content() {

		jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');
		jQuery('#import_button_txt').html('Now importing. Please wait for the process to finish.');

		var hostname = jQuery('#hostname').val();

		var database = jQuery('#database').val();

		var username = jQuery('#username').val();

		var password = jQuery('#password').val();

		var prefix = jQuery('#prefix').val();

		var port = jQuery('#port').val();

		var url = jQuery('#url').val();

		var introtext = jQuery('input:radio[name=introtext]:checked').val();

		var archived_posts = jQuery('input:radio[name=archived_posts]:checked').val();

		

		if(jQuery("#skip_media").is(':checked')) var skip_media = jQuery("#skip_media").val(); else var skip_media = 0;

		var first_image = jQuery('input:radio[name=first_image]:checked').val();

		if(jQuery("#import_external").is(':checked')) var import_external = jQuery("#import_external").val(); else var import_external = 0;

		if(jQuery("#import_duplicates").is(':checked')) var import_duplicates = jQuery("#import_duplicates").val(); else var import_duplicates = 0;

		if(jQuery("#force_media_import").is(':checked')) var force_media_import = jQuery("#force_media_import").val(); else var force_media_import = 0;

		

		var timeout = jQuery('#timeout').val();

		if(jQuery("#meta_keywords_in_tags").is(':checked')) var meta_keywords_in_tags = jQuery("#meta_keywords_in_tags").val(); else var meta_keywords_in_tags = 0;

		if(jQuery("#import_as_pages").is(':checked')) var import_as_pages = jQuery("#import_as_pages").val(); else var import_as_pages = 0;

			

			jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=j2wimportcontent&cookie=encodeURIComponent(document.cookie)', {

			'hostname':hostname,

			'username':username,

			'password':password,

			'port':port,

			'database':database,

			'prefix':prefix,

			'url':url,

			'introtext':introtext,

			'archived_posts':archived_posts,

			'skip_media':skip_media,

			'first_image':first_image,

			'import_external':import_external,

			'import_duplicates':import_duplicates,

			'force_media_import':force_media_import,

			'timeout':timeout,

			'meta_keywords_in_tags':meta_keywords_in_tags,

			'import_as_pages':import_as_pages

			

            },

            function (data) {

				jQuery('.cmshelplivej2w_message').append(data);
				
				remove_cat_prefix();

				/*jQuery(".frm").hide(500);

        		jQuery("#sf3").show(500);*/
				

				

            });	

		

	}

</script> 



<script>

	function save_setting() {

		jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');

		var hostname = jQuery('#hostname').val();

		var database = jQuery('#database').val();

		var username = jQuery('#username').val();

		var password = jQuery('#password').val();

		var prefix = jQuery('#prefix').val();

		var port = jQuery('#port').val();

		var url = jQuery('#url').val();

		var introtext = jQuery('input:radio[name=introtext]:checked').val();

		var archived_posts = jQuery('input:radio[name=archived_posts]:checked').val();

		

		if(jQuery("#skip_media").is(':checked')) var skip_media = jQuery("#skip_media").val(); else var skip_media = 0;

		var first_image = jQuery('input:radio[name=first_image]:checked').val();

		if(jQuery("#import_external").is(':checked')) var import_external = jQuery("#import_external").val(); else var import_external = 0;

		if(jQuery("#import_duplicates").is(':checked')) var import_duplicates = jQuery("#import_duplicates").val(); else var import_duplicates = 0;

		if(jQuery("#force_media_import").is(':checked')) var force_media_import = jQuery("#force_media_import").val(); else var force_media_import = 0;

		

		var timeout = jQuery('#timeout').val();

		if(jQuery("#meta_keywords_in_tags").is(':checked')) var meta_keywords_in_tags = jQuery("#meta_keywords_in_tags").val(); else var meta_keywords_in_tags = 0;

		if(jQuery("#import_as_pages").is(':checked')) var import_as_pages = jQuery("#import_as_pages").val(); else var import_as_pages = 0;

			

			jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=j2wsavesetting&cookie=encodeURIComponent(document.cookie)', {

			'hostname':hostname,

			'username':username,

			'password':password,

			'port':port,

			'database':database,

			'prefix':prefix,

			'url':url,

			'introtext':introtext,

			'archived_posts':archived_posts,

			'skip_media':skip_media,

			'first_image':first_image,

			'import_external':import_external,

			'import_duplicates':import_duplicates,

			'force_media_import':force_media_import,

			'timeout':timeout,

			'meta_keywords_in_tags':meta_keywords_in_tags,

			'import_as_pages':import_as_pages

			

            },

            function (data) {

				jQuery('.cmshelplivej2w_message').html(data);

            });	

		

	}

</script> 

<script>

function remove_cat_prefix()

{

/*	jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');
*/
	jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=j2wremovecatprefix&cookie=encodeURIComponent(document.cookie)', {

		

		 },

            function (data) {

				jQuery('.cmshelplivej2w_message').append(data);
				
				modify_internal_links();

				/*jQuery(".frm").hide(500);

        		jQuery("#sf4").show(500);*/

            });	

}



function modify_internal_links()

{

/*	jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');
*/
	jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=j2wmodifylinks&cookie=encodeURIComponent(document.cookie)', {

		 },

            function (data) {
				jQuery('.cmshelplivej2w_message img').hide();
				jQuery('.cmshelplivej2w_message').append(data);
				jQuery('.cmshelplivej2w_message').append('<div class="updated"><p><?php _e('All Done.', 'j2wpcmshelplive'); ?></p></div>');

				jQuery(".frm").hide(500);

        		jQuery("#sf5").show(500);

            });		

}



function remove_previous_post()
{
	if(jQuery('#again_start_importer').is(':checked'))
	{
		
	jQuery('.cmshelplivej2w_message').html('<img src="<?php echo $path;?>images/loading.gif" />');

	jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=j2wremoveprecontent&cookie=encodeURIComponent(document.cookie)', {

		'empty_action':'newposts'

		 },

            function (data) {

				jQuery('.cmshelplivej2w_message').html(data);

				jQuery(".frm").hide(500);

        		jQuery("#sf1").show(500);

            });	
	}
	else
	{
		jQuery(".frm").hide(500);

        jQuery("#sf1").show(500);
	}
}

</script>

<script type="text/javascript">

jQuery().ready(function() {

 

  // Binding next button on first step

  jQuery(".open1").click(function() {

        jQuery(".frm").hide(500);

        jQuery("#sf2").show(500);

   });

   // Binding next button on first step

  jQuery(".open0").click(function() {

        jQuery(".frm").hide(500);

        jQuery("#sf1").show(500);

   });

   

   jQuery(".open3").click(function() {

        jQuery(".frm").hide(500);

        jQuery("#sf4").show(500);

   });

   jQuery(".open4").click(function() {

        jQuery(".frm").hide(500);

        jQuery("#sf5").show(500);

   });

    jQuery(".back1").click(function() {

        jQuery(".frm").hide(500);

        jQuery("#sf1").show(500);

   });

 

 

   

    });
	
</script>