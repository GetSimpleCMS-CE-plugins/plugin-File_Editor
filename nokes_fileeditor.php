<?php

// -- gs settings
$thisfile = basename(__FILE__, '.php');
add_action( 'settings-sidebar','createSideMenu',array( $thisfile, 'File Editor' ) );

register_plugin(
	$thisfile, 									
	'File Editor',									
	'1.0.33', 										
	'Nico Hemkes', 								
	'http://www.nokes.de/', 					
	'A simple .htaccess and robots.txt file editor.', 
	'settings',									
	'file_editor_window'							
);

// -- file_editor window
function file_editor_window() {
	
	// -- file paths
	$path_htaccess		= GSROOTPATH . '.htaccess';
	$path_robots		= GSROOTPATH . 'robots.txt';
	
	// -- check .htaccess
	if( file_exists( $path_htaccess ) ){
		
		// -- if send then write
		if( $_POST['send_options'] == 1 ) {		
			file_put_contents( $path_htaccess, $_POST['htaccess'] );				
		}
		
		// -- read htaccess
		$htaccess_content = file_get_contents( $path_htaccess );
		
	}else{	
		// -- if htaccess not exists then error
		$warning_htaccess = '<strong>ERROR:</strong> .htaccess not found!';	
	}
	
	// -- check robots.txt
	if( file_exists( $path_robots ) ){
		
		// -- if send then write
		if( $_POST['send_options'] == 1 ) {			
			file_put_contents( $path_robots, $_POST['robots'] );		
		}
		
		// -- rad robots.txt
		$robots_content = file_get_contents( $path_robots );
		
	}else{	
		// -- if robots.txt not exists then error
		$warning_robots = '<strong>ERROR:</strong> robots.txt not found!';	
	}

	// -- no F5 reload
	if( $_POST['send_options'] == 1){
		
		header( 'Location: load.php?id=nokes_fileeditor&save=1 ' );		
		exit;

	}
	
	// -- html start
	?>
	
	<h3>File Editor</h3>	
	
	<?php
	if( $_GET['save'] == 1 ){
	?>
	<div class="updated">
		<p>Your changes have been saved.</p>
	</div>
	<?php
	}
	?>
	
	<form method="post" action="<?php echo basename($_SERVER['REQUEST_URI']); ?>" >
	<div id="metadata_window">	
		
		<?php
		// -- if htaccess not exists
		if( !empty($warning_htaccess) ){			
			echo $warning_htaccess;				
		}else{			
		?>
			<label for="code">.htaccess</label>
			<textarea name="htaccess" style="height: 200px; font-size: 12px;" ><?php echo $htaccess_content; ?></textarea>
			<br/>
			<br/>	
		<?php
		}
		
		// -- if robots.txt not exists
		if( !empty($warning_robots) ){			
			echo $warning_robots;				
		}else{			
		?>
			<label for="code">robots.txt</label>
			<textarea name="robots" style="height: 200px; font-size: 12px;" ><?php echo $robots_content; ?></textarea>
			<br/>
			<br/>
		<?php
		}
		?>	
		
		<input  class="submit"  type="submit" value="Update" />				
		<input type="hidden" name="send_options" value="1" />		
			
	</div>
	</form>
	<br/>
	<div id="metadata_window">
		<p>
			<b>useful links</b><br/>			
			<a target="_blank" href="http://en.wikipedia.org/wiki/.htaccess" title="wikipedia .htaccess">- [.htaccess] wikipedia.org: .htaccess</a>
			<br/>		
			<a target="_blank" href="http://slideshare.net/arcful/some-of-important-htaccess-codes-every-one-should-known" title="Some of Important .htaccess Codes Everyone Should Known">- [.htaccess] slideshare.net: Some of Important .htaccess Codes Everyone Should Known</a>
			<br/>
			<a target="_blank" href="http://devcheatsheet.com/tag/htaccess/" title=".htaccess Cheat Sheets">- [.htaccess] devcheatsheet.com: .htaccess Cheat Sheets</a>
			<br/>
			<a target="_blank" href="https://support.google.com/webmasters/answer/6062608?hl=en" title="google about robots.txt">- [robots.txt] support.google.com: Learn about robots.txt files</a>
			<br/>
			<a target="_blank" href="http://searchengineland.com/a-deeper-look-at-robotstxt-17573" title="depper look at robots.txt">- [robots.txt] searchengineland.com: A Deeper Look At Robots.txt</a>
		</p>
		<p>
			<b>credits</b><br/>			
			plugin by <a target="_blank" href="http://www.nokes.de/" title="Nico Hemkes">Nico Hemkes</a>
			<br/>
			any problems? contact me: <a href="mailto:getsimple@hemk.es" >getsimple@hemk.es</a>
		</p>
	</div>
	
<?php	
} // -- end function file_editor_window
?>