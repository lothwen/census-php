<h2>Envio de Circulares</h2><br />

<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		width: "480"
	});
</script>
<!-- /TinyMCE -->

<form method="post" action="">
	<h3>Full featured example</h3>
	<p>
		This page shows all available buttons and plugins that are included in the TinyMCE core package.
		There are more examples on how to use TinyMCE in the <a href="http://wiki.moxiecode.com/examples/tinymce/">Wiki</a>.
	</p>

	<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
	<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 85%">
		&lt;p&gt;
		TinyMCE is a platform independent web based Javascript HTML &lt;strong&gt;WYSIWYG&lt;/strong&gt; editor control released as Open Source under LGPL by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances. TinyMCE is very easy to integrate into other Content Management Systems.
		&lt;/p&gt;
		&lt;p&gt;
		We recommend &lt;a href="http://www.getfirefox.com" target="_blank"&gt;Firefox&lt;/a&gt; and &lt;a href="http://www.google.com" target="_blank"&gt;Google&lt;/a&gt; &lt;br /&gt;
		&lt;/p&gt;
	</textarea>
	
	<br />
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
</form>

