<?php

if ($_GET['size'])
		$dir = "screens_".$_GET['size'];
	else
		$dir = "screens";

function getScreens($dir)
{
	$handle=opendir ($dir);
	while ($f = readdir ($handle)) {
	 if ($f != '.' && $f != '..') $screens[] = $f;
	}
	closedir($handle);
	return $screens;
}
?>
<html>
<head>
	<title>Presenter</title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		var act_screen;
		var screens = new Array( <?php foreach(getScreens($dir) as $screen): ?><?php if ($i++ != 0): ?>,<?php endif ?>"<?= $screen; ?>"<?php endforeach ?> );
		screens.sort();

		console.log(screens.length-1);

		for (var i = 0; i <= screens.length-1; i++) {
			img = '<img src="<?= $dir ?>/' + screens[i] + '" id="screen_' + i + '">';
			$("#container").html($("#container").html() + img);
		};
		$("img").hide();
		$("#screen_0").fadeIn();
		$("img").each(function(index){
			$(this).click(function(){
				if (index == screens.length-1)
				{
					$(this).hide();
					$("#screen_0").fadeIn();
					
				}
				else
				{
					$(this).hide();
					$(this).next().fadeIn();
				}
			});
		});
	});
	</script>
	<style type="text/css">
		* { margin: 0; padding: 0; }
		#container { height: 100%; width: 100%; background: url(loading.gif) center center no-repeat; text-align: center; }
		img { max-width: 100%; <?php if ($_GET['scale'] == 'full'): ?>height: 100%;<?php endif ?> }
		#container:hover { cursor: pointer; }
	</style>
</head>
<body>
<div id="container"></div>
</body>
</html>