<?php error_reporting(E_ALL);
ini_set('display_errors', '1');?>

<title>Spices : Cinnamon</title>

<!-- Stylesheet & Favicon -->
<link rel="shortcut icon" href="/favicon.ico" />

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Droid+Serif:regular,bold' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:regular,bold' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2'></script>

<style type="text/css">
			div.wrapper { width: 940px; margin: 0 auto; padding: 0 30px 36px; position: relative; }
			div#header { background: #f5f5f5; height: 72px; border-bottom: 1px solid #eee; margin: 0; }
			div#header h4 { float: left; position: absolute; top: 24px; left: 145px; border-left: 1px solid #ddd; padding-left: 14px; }
			div#header h4 small { font-size: 14px; font-weight: normal; }
			div#header h4 a, div#header h4 a:visited { font-weight: normal; }
			
			div.page-header { padding: 0 0 8px; margin: 18px 0; border-bottom: 1px solid #ddd; }
			div.page-header h1 { padding: 0; margin: 0; font-size: 24px; line-height: 27px; letter-spacing: 0; }
			

.greydiv {
	width:770px;	
	background-color:#d6d6d6;
	border: 1px solid #a5a5a5;
	padding: 5px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	margin: 10px;
}
			
.awesome, .awesome:visited {
	background: #222 url(/images/alert-overlay.png) repeat-x; 
	display: inline-block; 
	padding: 5px 10px 6px; 
	color: #fff; 
	text-decoration: none;
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px;
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	border-bottom: 1px solid rgba(0,0,0,0.25);
	position: relative;
	cursor: pointer;
}

	.awesome:hover							{ background-color: #91bd09; color: #fff; }
	.awesome:active							{ top: 1px; }
	.small.awesome, .small.awesome:visited 			{ font-size: 11px; padding: ; }
	.awesome, .awesome:visited,
	.medium.awesome, .medium.awesome:visited 		{ font-size: 13px; font-weight: bold; line-height: 1; text-shadow: 0 -1px 1px rgba(0,0,0,0.25); }
	.large.awesome, .large.awesome:visited 			{ font-size: 14px; padding: 8px 14px 9px; }
	
	.green.awesome, .green.awesome:visited		{ background-color: #91bd09; }
	.green.awesome:hover						{ background-color: #749a02; }
	.blue.awesome, .blue.awesome:visited		{ background-color: #2daebf; }
	.blue.awesome:hover							{ background-color: #007d9a; }
	.red.awesome, .red.awesome:visited			{ background-color: #e33100; }
	.red.awesome:hover							{ background-color: #872300; }
	.magenta.awesome, .magenta.awesome:visited		{ background-color: #a9014b; }
	.magenta.awesome:hover							{ background-color: #630030; }
	.orange.awesome, .orange.awesome:visited		{ background-color: #ff5c00; }
	.orange.awesome:hover							{ background-color: #d45500; }
	.yellow.awesome, .yellow.awesome:visited		{ background-color: #ffb515; }
	.yellow.awesome:hover							{ background-color: #fc9200; }
	.grey.awesome, .grey.awesome:visited		{ background-color: #999999; }
	.grey.awesome:hover							{ background-color: #555555; }
		</style>

<script type="text/javascript" charset="utf-8">
jQuery(function($){
	$(document).ready(function(){
		$('.opacity').css('opacity',1).hover(
		function() {
			$(this).fadeTo(250,0.5);},
		function() {
			$(this).fadeTo(600,1);
		} );
	// sliding links
		slide(".sub-menu", 20, 15, 10, .5);
		slide(".footer-box", 5, 0, 150, .8);
	// superFish
	$('ul.sf-menu').supersubs({
		minWidth:    18, // minimum width of sub-menus in em units
		maxWidth:    40, // maximum width of sub-menus in em units
		extraWidth:  1 // extra width can ensure lines don't sometimes turn over
     })
    	.superfish(); // call supersubs first, then superfish
	});
});
</script>



</head>

<body class="page page-id-61 page-template-default logged-in admin-bar">
<div id="wrap">
	<div id="header">

    	<div id="logo">
           	<h2><a href="/" title="Cinnamon" rel="home">Cinnamon Spices</a></h2>
        </div>
        <!-- END logo -->
	</div><!-- END header -->

        <div id="navigation">
			<div>
                <ul class="sf-menu">
                    <li class="menu-item-object-category"><a href="/">Home</a></li>
                    <li class="menu-item-object-category <?php if("themes" == $this->uri->segment(1, 0)){?>current-menu-item<?php }?>"><?=anchor("themes", "Themes")?></li>
                    <li class="menu-item-object-category <?php if("applets" == $this->uri->segment(1, 0)){?>current-menu-item<?php }?>"><?=anchor("applets", "Applets")?></li>
                    <li class="menu-item-object-category <?php if("desklets" == $this->uri->segment(1, 0)){?>current-menu-item<?php }?>"><?=anchor("desklets", "Desklets")?></li>
                    <li class="menu-item-object-category <?php if("extensions" == $this->uri->segment(1, 0)){?>current-menu-item<?php }?>"><?=anchor("extensions", "Extensions")?></li>
                </ul>
            </div>
        </div>
<!-- END navigation -->
