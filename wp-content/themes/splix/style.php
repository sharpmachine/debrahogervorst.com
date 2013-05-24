<?php include("style.css") //It include the header of this style sheet	?>
<?php
		if ($options['color_title']!='')	$color_title = $options['color_title'];
		else	$color_title = "F0F0F0";
		if ($options['color_description']!='')$color_description = $options['color_description'];
		else	$color_description = "BBBBBB";
		
		if ($options['color5']!='')	$color5 = $options['color5'];
		else	$color5 = "1D1D1D";
		if ($options['color6']!='')	$color6 = $options['color6'];
		else	$color6 = "0D0D0D";
		
		if ($options['color_ub1']!='')	$color_ub1 = $options['color_ub1'];
		else	$color_ub1 = "2E2D28";
		if ($options['color_ub2']!='')	$color_ub2 = $options['color_ub2'];
		else	$color_ub2 = "5C5B56";
		if ($options['color_ub3']!='')	$color_ub3 = $options['color_ub3'];
		else	$color_ub3 = "BDBDBD";
		
		if ($options['color_pg1']!='')	$color_pg1 = $options['color_pg1'];
		else	$color_pg1 = "1D1D1D";
		if ($options['color_pg2']!='')	$color_pg2 = $options['color_pg2'];
		else	$color_pg2 = "3A3934";
		
		if ($options['color_cat1']!='')	$color_cat1 = $options['color_cat1'];
		else	$color_cat1 = "F8F8F8";
		if ($options['color_cat2']!='')	$color_cat2 = $options['color_cat2'];
		else	$color_cat2 = "A7B522";
		
		if ($options['color_bg1']!='')	$color_bg1 = $options['color_bg1'];
		else	$color_bg1 = "E0E0E0";
		if ($options['color_bg2']!='')	$color_bg2 = $options['color_bg2'];
		else	$color_bg2 = "EEEEEE";
		
		if ($options['color4']!='')	$color4 = $options['color4'];
		else	$color4 = "A7B522";
		
		if ($options['color_cbg1']!='')	$color_cbg1 = $options['color_cbg1'];
		else	$color_cbg1 = "FFFFFF";
		if ($options['color_cbg2']!='')	$color_cbg2 = $options['color_cbg2'];
		else	$color_cbg2 = "F5F5F5";
		if ($options['color_text']!='')	$color_text = $options['color_text'];
		else	$color_text = "555555";
		
		function updateColor($color, $kRed = 35, $kGreen = 35, $kBlue = 35) {
			$red = hexdec(substr($color, 0, 2)) + $kRed;
			$green = hexdec(substr($color, 2, 2)) + $kGreen;
			$blue = hexdec(substr($color, 4, 2)) + $kBlue;
			
			if ($red > 255) $red = 255;
			else if ($red < 0) $red = 0;
			if ($green > 255) $green = 255;
			else if ($green < 0) $green = 0;
			if ($blue > 255) $blue = 255;
			else if ($blue < 0) $blue = 0;
			
			return (($red <= 15) ? "0" : "") . dechex($red) . (($green <= 15) ? "0" : "") . dechex($green) . (($blue <= 15) ? "0" : "") . dechex($blue);
		}
		
		function cbL($color) {return updateColor($color, 5, 5, 5);}
		function csL($color) {return updateColor($color, 10, 10, 10);}
		function cL($color) {return updateColor($color, 30, 30, 30);}
		function cbD($color) {return updateColor($color, -5, -5, -5);}
		function csD($color) {return updateColor($color, -10, -10, -10);}
		function cD($color) {return updateColor($color, -30, -30, -30);}
		
		function detColor($color) {
			$red = hexdec(substr($color, 0, 2));
			$green = hexdec(substr($color, 2, 2));
			$blue = hexdec(substr($color, 4, 2));
			
			$pivot = hexdec("7F");
			$med = ($red + $green + $blue) / 3;
			if ($med >= $pivot)	return cbD(csD($color));
			else return cbL(csL($color));
		}
		
		function detBgLD($URL, $h, $c1, $c2) {
			if (hexdec($c1) > hexdec($c2))
				return "url(" . $URL . "/gradient.php?height=" . $h . "&top=" . $c1 . "&bottom=" . $c2 . ") #" . $c1 . " repeat-x bottom";
			else
				return "url(" . $URL . "/gradient.php?height=" . $h . "&top=" . $c2 . "&bottom=" . $c1 . ") #" . $c2 . " repeat-x bottom";
		}
?>

/* static START */
body {
	margin: 0px;
	padding: 0px;
	color: #<?php echo $color_text ?>;
	background: #<?php echo $color_bg2 ?>;
}

a{
	color: #<?php echo cD($color4) ?>;
	text-decoration:none;
}
a:hover{
	text-decoration:underline;
}
	a img{
		border:none;
	}

blockquote, pre {
	border:1px solid #<?php echo cD($color_cbg2) ?>;
	background:#<?php echo $color_cbg2 ?> url(<?php echo $tmpURL ?>/img/bq.png) no-repeat left center;
	padding:10px 10px 10px 30px;
	margin:15px 35px;
	width:auto;
	color:#666;
	white-space:pre-wrap;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
}

.widget{
	width:280px;
	margin:45px 0px 5px 0px;
	border-top:1px solid #ccc;
	padding:10px;
	background:url(<?php echo $tmpURL ?>/gradient.php?height=75&top=<?php echo $color_cbg2 ?>&bottom=<?php echo $color_cbg1 ?>) #<?php echo $color_cbg1 ?> 0 -37px repeat-x;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
	.widget_title{
		width:auto;
		margin:0px 15px;
		padding:10px;
		position:relative;
		top:-36px;
		border-left:1px solid #ccc;
		border-right:1px solid #ccc;
		border-top:1px solid #ccc;
		font-family:Arial, Helvetica, sans-serif;
		font-size:14px;
		color:#666;
		background:url(<?php echo $tmpURL ?>/gradient.php?height=75&top=<?php echo $color_cbg2 ?>&bottom=<?php echo $color_cbg1 ?>) #<?php echo $color_cbg1 ?> top repeat-x;
	}
	.widget_content{
		overflow:hidden;
	}
	.widget ul{
			margin:0px;
			padding:0px;
		}
	.widget ul li{
		list-style:none;
		margin-top:5px;
		background:url(<?php echo $tmpURL ?>/img/icons/bullet_gray.png) no-repeat;
		padding-left:20px;
	}
	.widget #wp-calendar{
		margin:0px auto;
	}
/* static END */

/* header START */
#header{
	width:100%;
	margin:0px;
	padding:0px;
}
/* caption START */
#wrap_caption{
	min-width:930px;
	height:31px;
	padding:0px;
	margin:0px;
	overflow:auto;
	margin-bottom:-35px;
	position:relative;
	z-index: 100;
}
#caption{
	height:31px;
	width:920px;
	margin:0px auto;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#<?php echo $color_ub3 ?>;
	overflow:hidden;
}
	#caption span{
		padding: 8px;
		display: inline-block;
		margin: 2px 3px;
		vertical-align: text-top;
        overflow: visible;
	}
	#caption a{
		color: #<?php echo $color_ub3 ?>;
		padding: 0px 3px;
		margin: 4px 0px;
        overflow: visible;
		display: inline-block;
		border: 1px solid #<?php echo $color_ub2 ?>;
		background: #<?php echo $color_ub1 ?>;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
        height: 14px;
		line-height: 14px;
	}
	#caption a:hover{
		text-decoration:none !important;
		border: 1px solid #<?php echo cL($color_ub2) ?>;
		background: #<?php echo cL($color_ub1) ?>;
	}
	.metafield{
		height:30px;
		width:auto;
		margin: auto 0px;
		float:right;
	}
		
	.login{
		line-height:31px;
	}
		.login input{
			vertical-align:middle;
			margin-top:0px;
			margin-right:10px;
			padding: 2px;
            color:#<?php echo $color_ub3 ?>;
		}
		.login input[type="text"], .login input[type="password"], .login input[type="submit"], .login input[type="button"]{
			width:120px;
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size:14px;
			border:1px solid #<?php echo $color_ub2 ?>;
			background:#<?php echo $color_ub1 ?>;
			opacity:0.9;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
		}
		.login input[type="text"]:focus, .login input[type="password"]:focus, .login input[type="submit"]:focus, .login input[type="button"]:focus, .login input[type="text"]:hover, .login input[type="password"]:hover, .login input[type="submit"]:hover, .login input[type="button"]:hover{
			opacity:1 !important;
		}
		
		.login input[type="submit"], .login input[type="button"]{
			width:auto !important;
		}
/* caption END */

/* info START */
#wrap_info{
	min-width:930px;
	width:100%;
	padding:0px;
	margin:0px;
	background:url(<?php echo $tmpURL ?>/gradient.php?height=85&top=<?php echo $color5 ?>&bottom=<?php echo $color6 ?>) #<?php echo $color5 ?> repeat-x top;
}

#info{
	width:908px;
	height:85px;
	padding:0px;
	margin:0px auto 0px auto;
}

	#info .title, #info .title a, #info .title a:link, #info .title a:visited{
		font-family:Arial, Helvetica, sans-serif;
		font-size:48px;
		font-weight:bold;
		color:#<?php echo cL($color_title) ?>;
		text-decoration:none;
		line-height:85px;
		padding:0px;
		background-position:bottom;
		background-repeat:repeat-x;
	}
	#info .title a:hover{
	}
	#info .description{
		font-family:Arial, Helvetica, sans-serif;
		font-size:10px;
		font-weight:bold;
		color:#<?php echo $color_description ?>;
		line-height:85px;
		padding:0px;
		margin-left:10px;
	}
/* info END */

/* navigation START */
#wrap_pages, #wrap_cats{
	min-width:930px;
	width:100%;
	padding:0px;
	margin:0px;
}
#wrap_pages{
    border-bottom:1px solid #<?php echo cD($color_pg1) ?>;
    border-top:1px solid #<?php echo cL($color_pg1) ?>;
	background:<?php echo detBgLD($tmpURL, 26, detColor($color_pg1), $color_pg1) ?>;
	z-index:80;
}
	#wrap_pages .set_middle, #wrap_cats .set_middle{
		width:930px;
		margin:0px auto;
        padding:0px;
		overflow:visible;
		display:table;
	}
    #wrap_pages .pages, #wrap_cats .categories{
    	margin:0px;
		padding:0px;
		width:auto;
		font-family:Arial, Helvetica, sans-serif;
		font-size:10px;
		font-weight:bold;
    }
	#wrap_pages .pages{
		height:26px;
		line-height:26px;
		color:#<?php echo $color_pg2 ?>;
	}
    	#wrap_pages .pages a, #wrap_pages .pages a:visited, #wrap_pages .pages a:link, #wrap_cats .categories a, #wrap_cats .categories a:visited, #wrap_cats .categories a:link{
			display:block;
			padding-right:5px;
			padding-left:5px;
			text-decoration:none;
		}
		#wrap_pages .pages a, #wrap_pages .pages a:visited, #wrap_pages .pages a:link{
			color:#<?php echo cL($color_pg2) ?>;
			font-weight:bold;
		}
		#wrap_pages .pages a:hover{
			color:#<?php echo $color_pg2 ?>;
		}
		#wrap_pages .pages li, #wrap_cats .categories li{
			list-style:none;
			display:inline;
			padding:0px;
			float:left;
			position:relative;
			text-transform:uppercase;
		}
        #wrap_pages .pages ul, #wrap_cats .categories ul {
			position:absolute;
			display:none;
            left:4px;
		}
		#wrap_pages .pages ul {
			top:20px;
		}        
		#wrap_pages .pages li ul{
			background:#<?php echo csL($color_pg1) ?>;
			border:1px solid #<?php echo detColor($color_pg1) ?>;
			width:120px;
			padding:0px 3px 3px;
			z-index:100 !important;
		}
		#wrap_pages .pages li ul a, #wrap_cats .categories li ul a{
			width:97px;
			padding-top:2px;
			padding-right:16px !important;
			padding-bottom:2px;
			margin:3px 0px 0px;
			text-align:left;
			text-transform:none;
			font-family:Arial, Helvetica, sans-serif;
			font-size:10px;
			line-height:16px;
		}
        #wrap_pages .pages li ul a{
			border:1px solid #<?php echo csL($color_pg1) ?>;
        }
		#wrap_pages .pages li ul a:hover, #wrap_cats .categories li ul a:hover{
            border:1px solid #<?php echo $color4 ?>;
			background-color:#<?php echo cL($color4) ?>;
		}
		#wrap_pages .pages ul ul, #wrap_cats .categories ul ul{
			top:-1px; /* for matching the top border */
		}
		#wrap_pages .pages li ul ul, #wrap_cats .categories li ul ul{
			left:136px;
			margin:0px 0 0 -16px;
		}
		#wrap_pages li:hover ul ul, #wrap_pages li:hover ul ul ul, #wrap_pages li:hover ul ul ul ul, #wrap_cats li:hover ul ul, #wrap_cats li:hover ul ul ul, #wrap_cats li:hover ul ul ul ul{
			display:none;
		}
		#wrap_pages li:hover ul, #wrap_pages li li:hover ul, #wrap_pages li li li:hover ul, #wrap_pages li li li li:hover ul, #wrap_cats li:hover ul, #wrap_cats li li:hover ul, #wrap_cats li li li:hover ul, #wrap_cats li li li li:hover ul{
			display:block;
		}
		#wrap_pages li.home img{
			border:none;
			display:block;
			padding:5px;
			height:16px;
			width:16px;
		}
#wrap_cats{
    background:#<?php echo $color_cat1 ?>;
	z-index:40;
    
    border-top:1px solid #<?php echo cL($color_cat1) ?>;
    border-bottom:1px solid #<?php echo csD(detColor($color_cat1)) ?>;
}
	#wrap_cats .categories{
		height:22px;
		line-height:22px;
	}
		#wrap_cats .categories a, #wrap_cats .categories a:visited, #wrap_cats .categories a:link{
			color:#<?php echo $color4 ?>;
		}
		#wrap_cats .categories ul {
			top:18px;
		}
        #wrap_cats .categories li ul{
			background:#<?php echo csL($color_cat1) ?>;
			border:1px solid #<?php echo detColor($color_cat1) ?>;
			width:120px;
			padding:0px 3px 3px;
			z-index:100 !important;
		}
        #wrap_cats .categories li ul a{
			border:1px solid #<?php echo csL($color_cat1) ?>;
        }
        #wrap_cats .categories a {
        	color:#<?php echo $color_cat2 ?> !important;
		}
        #wrap_cats .categories a:hover {
        	color:#<?php echo cD($color_cat2) ?> !important;
		}
#wrap_pages li ul .more, #wrap_pages li ul .more:hover, #wrap_cats li ul .more, #wrap_cats li ul .more:hover{
	background-image:url(<?php echo $tmpURL ?>/img/icons/bullet_go.png);
}
#wrap_pages .more, #wrap_pages .more:hover, #wrap_cats .more, #wrap_cats .more:hover{
	background-image:url(<?php echo $tmpURL ?>/img/icons/bullet_arrow_down.png);
	background-position:center right;
	background-repeat:no-repeat;
	padding-right:16px !important;
}
/* navigation END */

/* header END */

/* wrapper START */
#wrap_wrapper{
	min-width:930px;
    border-top:1px solid #<?php echo cL($color_bg1) ?>;
	background:#<?php echo $color_bg2 ?> url(<?php echo $tmpURL ?>/gradient.php?height=120&top=<?php echo $color_bg1 ?>&bottom=<?php echo $color_bg2 ?>) 0 -30px repeat-x;
	overflow:auto;
}
#wrapper{
	width:930px;
	margin:0px auto;
	padding-top:15px;
	padding-bottom:0px;
	overflow:visible;
}

	/* content START */
	#content{
		width:616px;
		height:auto;
		padding: 0px;
		margin-right:10px;
		float:left;
		clear:none;
		background:#<?php echo $color_cbg1 ?>;
		border:1px solid #<?php echo cD($color_cbg2) ?>;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		color:#<?php echo $color_text ?>;
	}
		#content .msgbox, #content .msgerror{
			width:370px;
			margin:20px auto;
			padding:5px 5px 5px 26px;
            color:#<?php echo cL($color_text) ?>;
			border:1px solid #<?php echo cD($color_cbg2) ?>;
			background-color:#<?php echo $color_cbg2 ?>;
            background-position: 5px 4px;
            background-repeat: no-repeat;
            background-image:url(<?php echo $tmpURL ?>/img/icons/information.png);
		}
		#content .msgerror{
			text-align:center;
			font-size:14px;
			font-weight:bold;
			background-image:url(<?php echo $tmpURL ?>/img/icons/error.png) !important;
		}
		#content .box{
			border:1px solid #<?php echo cD($color_cbg2) ?>;
			background-color:#<?php echo $color_cbg2 ?>;
			padding:5px;
			margin-bottom:15px;
			overflow:auto;
			color:#<?php echo cL($color_text) ?>;
		}
		/* post START */
		#content div#post_path{
			background-color:#<?php echo cL(cL($color4)) ?>;
			margin:0px 0px 20px;
			width:auto;
			font-family:Arial, Helvetica, sans-serif;
			font-size:10px;
			text-transform:uppercase;
		}
		#content .post{
			margin-top:15px;
		}
			.post .title{
				height:20px;
				line-height:20px;
				padding:0px 5px 0px 50px;
				float:left;
				clear:left;
			}
			.title a {
                color:#<?php echo $color_text ?>;
                text-decoration:none;
            }
            .title a:hover {
                color:#<?php echo $color4 ?>;
                text-decoration:none;
            }
            .title h2{
                margin:0px;
                display:block;
                font-family:Verdana,"BitStream vera Sans";
                font-size:16px;
            }
            
			.post .info{
				height:38px;
				width:570px;
				background:#<?php echo $color_cbg2 ?>;
				border-top:1px solid #<?php echo cD($color_cbg2) ?>;
				border-bottom:1px solid #<?php echo cD($color_cbg2) ?>;
				float:left;
				clear:right;
				margin-bottom:10px;
			}
				.info .act{
					float:right;
					padding:0px 5px;
					height:40px;
				}
					.act span{
						padding-left:20px;
						height:16px;
						line-height:16px;
						display:block;
						float:left;
						font-size:12px;
						margin-left:10px;
						position:relative;
						top:50%;
						margin-top:-8px;
					}
					.act a:hover{
						text-decoration:underline;
					}
					.act .author{
						margin-left:20px;
					}
			.post .filler{ 
				width:46px;
				height:38px;
				background:#<?php echo $color_cbg2 ?>;
				border-top:1px solid #<?php echo cD($color_cbg2) ?>;
				border-bottom:1px solid #<?php echo cD($color_cbg2) ?>;
				float:left;
				clear:left;
			}
			.post .post-date{ 
				width:45px;
				height:39px;
				background:url(<?php echo $tmpURL ?>/img/bg_date_red.gif) top repeat-x;
				border-right:1px solid #<?php echo cD($color_cbg2) ?>;
				border-bottom:1px dotted #<?php echo cD($color_cbg2) ?>;
				float:left;
				clear:left;
			}
				.post-date .month{
					text-align:center;
					color:#fff;
					font-family:Verdana, Arial, Helvetica, sans-serif;
					font-weight:bold;
					font-size:10px;
					text-transform:uppercase;
					line-height:15px;
				}
				.post-date .day{
					text-align:center;
					color:#000;
					font-family:Georgia, "Times New Roman", Times, serif;
					font-size:18px;
					font-weight:bold;
					line-height:24px;
				}
			.entry{
				clear:both;
				padding:0px 10px;
				line-height:16px;
			}
                .entry h1{
                	margin-bottom:5px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:18px;
				}
				.entry h2{
                	margin-bottom:5px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:16px;
				}
                .entry h3{
                	margin-bottom:4px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:14px;
                }
                .entry h4{
                	margin-bottom:3px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:12px;
                }
                .entry h5{
                	margin-bottom:2px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:10px;
                }
                .entry h6{
                	margin-bottom:1px;
                    font-family:Verdana,"BitStream vera Sans";
                    font-size:8px;
                }
				li.linkcat{
					min-height:80px;
					list-style:none;
				}
					li.linkcat h2{
						width:100px;
						position:relative;
						right:-1px;
						margin-top:25px;
						padding:10px;
						border:1px solid #ccc;
						background:url(<?php echo $tmpURL ?>/gradient.php?height=75&top=<?php echo $color_cbg2 ?>&bottom=<?php echo $color_cbg1 ?>) #<?php echo $color_cbg1 ?> 0 -10px repeat-x;
						float:left;
						clear:left;
						font-family:Arial, Helvetica, sans-serif;
						font-size:14px;
						color:#666;
					}
					li.linkcat ul{
						width:454px;
						min-height:50px;
						margin:15px 0px;
						float:left;
						border:1px solid #ccc;
						padding:10px;
						background:url(<?php echo $tmpURL ?>/gradient.php?height=75&top=<?php echo $color_cbg2 ?>&bottom=<?php echo $color_cbg1 ?>) #<?php echo $color_cbg1 ?> 0 -30px repeat-x;
						clear:right;
					}
					li.linkcat li{
						background:url(<?php echo $tmpURL ?>/img/icons/bullet_gray.png) left no-repeat;
						display:inline;
						float:left;
						width:100px;
						position:relative;
						padding-left:22px;
						margin-right:25px;
					}
			.post .page_links{
				height:15px;
				line-height:15px;
				padding:7px 5px;
				margin: 10px 0px;
				background:#<?php echo $color4 ?>;
				border:1px solid #<?php echo cD($color4) ?>;
				color:#666;
				text-align:center;
				float:right;
				clear:right;
				position:relative;
				right:-1px;
			}
			.post .rating{				
				height:20px;
				line-height:20px;
				padding: 0px 5px;
				margin: 0px;
				/*background:#<?php echo $color_cbg2 ?>;
				border:1px solid #<?php echo cD($color_cbg2) ?>;*/
				float:right;
				clear:right;
			}
            
            .post .shr-bookmarks{
            	margin-bottom:0px !important;
            }
			.post .metadata{
				border-top:1px dotted #CCCCCC;
				padding: 2px 10px;
				margin-bottom:30px;
				clear:both;
				overflow:hidden;
			}
				.metadata div{
					padding-left:20px;
					margin-right:10px;
					margin-bottom:5px;
					line-height:16px;
					display:block;
					float:left;
					overflow:auto;
				}
				.metadata span{
					padding-left:18px;
					height:16px;
					line-height:16px;
					display:block;
					float:left;
					margin-right:9px;
					margin-bottom:5px;
				}
				.metadata .fixed{
					clear:left;
					float:none !important;		
				}
				.metadata a:hover{
					text-decoration:underline;
				}
		
			.wp-caption {
				padding:5px 0px 0px;
				margin-top:5px;
				margin-bottom:5px;
				border:1px solid #<?php echo cD($color_cbg2) ?>;
				background:#<?php echo $color_cbg2 ?>;
				text-align:center;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
			}
			.wp-caption-text{
				margin:5px 0px 0px;
				padding:5px 0px;
				width:100%;
				background:#<?php echo csD($color_cbg2) ?>;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
			}
		/* post END */
	
		/* comments START */
		#content h3.noonemore{
			padding:5px;
			border-bottom:1px dotted #<?php echo cD($color_cbg2) ?>;
		}
		#comments{
			margin:10px 0px 10px 0px;
		}
			#comments .commentlist{
				margin:0px;
				padding:5px;
				overflow:auto;
                list-style:none;
			}
				.commentlist li{
					overflow:hidden;
					width:604px;
					border:1px solid #<?php echo cbD($color_cbg2) ?>;
					margin-bottom:20px;
				}
					.commentlist li .info{
						float:left;
						padding:0px;
						height:40px;
						width:564px;
						clear:right;
						background-color:#<?php echo csD($color_cbg2) ?>;
						background-image:url(<?php echo $tmpURL ?>/img/says.gif);
						background-position:530px bottom;
						background-repeat:no-repeat;
					}
					.commentlist li.trackback .info{ /* IF IS A TRACKBACK */
						background-color:#<?php echo cL(cL($color4)) ?>;
						background-position:570px bottom;
						width:100% !important;
					}
					.commentlist li.pingback .info{ /* IF IS A PINGBACK */
						background-color:#<?php echo cL(cL($color4)) ?>;
						background-position:570px bottom;
						width:100% !important;
					}
					.commentlist li.alt .info{ /* Alternate BG */
						background-color:#<?php echo $color_cbg2 ?> !important;
					}
					.commentlist li.authcomment .comment{
						border-left:5px solid #<?php echo cL($color4) ?>;
						width:589px !important;
					}
						.info .commentmeta{
							height:30px;
							line-height:30px;
							padding:5px;
							float:left;
						}
							.commentlist .info .commentmeta span{
								padding-left:18px;
								margin-right:10px;
								height:16px;
								position:relative;
								top:50%;
								margin-top:-8px;
								line-height:16px;
								display:inline;
								font-size:12px;
								float:left;
							}
						.commentlist .info .mods{
							display:inline;
							float:right;
							background:#CC0000;
							border:1px solid #f9f9f9;
							margin:1px;
							padding:3px;
							color:#FFFFFF;
							text-align:center;
							text-transform:uppercase;
							line-height:10px;
							font-family:Arial, Helvetica, sans-serif;
							font-size:10px;
						}
						.commentlist .info .id{
							display:inline;
							float:right;
							height:30px;
							padding:3px 5px 7px 5px;
							margin-right:5px;
							text-align:center;
							line-height:30px;
							font-family:Georgia, "Times New Roman", Times, serif;
							font-size:18px;
						}
							.commentlist .info .id a{
								color:#999;
							}
							.commentlist .info .id a:hover{
								color:#666;
							}
				.commentlist .avatar{
					float:left;
				}
					.commentlist .avatar img {
						border:1px solid #ccc;
						background:#fff;
						padding:1px;
					}
				.commentlist .comment{
					width:614px;
					padding:5px;
					float:left;
					clear:both;
				}
		#commentform{
			width:530px;
			padding:0px 0px 10px 0px;
			margin:0px auto 15px;
		}
		#commentform input[type="text"], #commentform input[type="password"], #commentform textarea {
			border:1px solid #ddd;
			background:#fafafa;
			color:#666;
		}
		#commentform input[type="text"]:hover, #commentform input[type="password"]:hover, #commentform textarea:hover, #commentform input[type="text"]:focus, #commentform input[type="password"]:focus, #commentform textarea:focus {
			border:1px solid #E8EDF5;
			background:#fff;
		}
		#commentform input[type="text"], #commentform input[type="password"] {
			margin:0px;
		}
		#commentform textarea{
			width:530px;
			padding:0px;
			margin:0px;
			resize:none;
		}
		#commentform #undercomment{
			width:524px;
			height:15px;
			line-height:15px;
			margin-top:2px;
			padding:3px;
			background:#f0f0f0;
			border:1px solid #ddd;
			display:block;
		}
		#commentform input[type="submit"]{
			width:100px;
			height:35px;
			padding:0px;
			position:relative;
			left:50%;
			margin:5px 0px 5px -50px;
			line-height:35px;
			border:1px solid #<?php echo $color4 ?>;
			background:#<?php echo cL($color4) ?>;
			color:#<?php echo cL($color_cat1) ?>;
		}
		#commentform input[type="submit"]:hover{
			border:1px solid #<?php echo cD($color4) ?>;

			background:#<?php echo $color4 ?>;
			color:#<?php echo $color_cat1 ?>;
		}
		#commentform span{
			padding-left:22px;
			height:16px;
			line-height:16px;
			display:inline;
			float:right;
			font-size:12px;
		}
		/* comments END */
		
		/* scroller START */
		.scroller{
			width:556px;
			margin-top:20px;
			padding:10px 30px;
			overflow:auto;
			border-top:1px solid #<?php echo csD($color_cbg2) ?>;
			background:#<?php echo $color_cbg2 ?>;
		}
		.scroller.top{
			border-top:none;
			border-bottom:1px solid #ccc;
			margin-bottom:0px;
			margin-top:0px;
		}
			.scroller .newer a, .scroller .older a{
				width:auto;
				height:15px;
				padding:10px;
				border:1px solid #<?php echo cD($color_cbg2) ?>;
				margin:0px;
				background:#<?php echo cbD($color_cbg2) ?>;
				float:right;
				color:#666;
			}
            .scroller .newer a{
				float:right;
            }
			.scroller .older a{
            	float:left;
			}
			.scroller .newer a:hover, .scroller .older a:hover{
				border:1px solid #<?php echo cD($color_cbg2) ?>;
				background:#<?php echo cbL($color_cbg2) ?>;
				color:#999;
			}
		/* scroller END */
		
	/* content END */

	/* searchform START */
		#searchform input[type="text"]{
			vertical-align:middle;
			width:170px;
			height:17px;
			padding: 3px 2px;
			margin:0px;
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size:14px;
			border:1px solid #ddd;
			background:#fafafa;
		}
		#searchform input[type="text"]:hover, #searchform input[type="text"]:focus {
			border:1px solid #E8EDF5;
			background:#fff;
		}
		#searchform input[type="submit"]{
			vertical-align:middle;
			width:80px;
			height:25px;
			padding:0px;
			margin:0px;
			line-height:25px;
			border:1px solid #<?php echo cD($color4) ?>;
			background:#<?php echo $color4 ?>;
			color:#<?php echo cL($color_cat1) ?>;
		}
		#searchform input[type="submit"]:hover{
			border:1px solid #<?php echo $color4 ?>;
			background:#<?php echo cL($color4) ?>;
			color:#<?php echo $color_cat1 ?>;
		}
	/* searchform END*/

	/* sidebar START */
	#sidebar{
		width: 300px;
		padding:0px;
		margin:0px;
		height:auto;
		float:left;
        background:#<?php echo $color_cbg1 ?>;
		border:1px solid #<?php echo cD($color_cbg2) ?>;
	}
		.grip{
			width:280px;
			padding:10px;
			margin:0px auto;
			clear:both;
			text-align:center;
			background:#<?php echo $color_cbg2 ?>;
		}
			.grip.nobg{
				background:none;
			}
			.grip.top{
				border-bottom:1px solid #<?php echo cD($color_cbg2) ?>;
			}
			.grip.bottom{
				border-top:1px solid #<?php echo cD($color_cbg2) ?>;
			}
			.grip span{
				padding-left:22px;
				height:16px;
				line-height:16px;
				display:inline-block;
				font-size:12px;
				font-family:Verdana, Arial, Helvetica, sans-serif;
				text-align:left;
			}
	/* sidebar END */

/* wrapper END */

/* footer START */ 
#footer{
	width:908px;
	height:40px;
	line-height:20px;
	margin:10px auto;
	padding:10px;
	background:url(<?php echo $tmpURL ?>/gradient.php?height=75&top=<?php echo $color_cbg2 ?>&bottom=<?php echo $color_cbg1 ?>) #<?php echo $color_cbg1 ?> 0 -20px repeat-x;
	border:1px solid #ccc;
	clear:both;
	text-align:center;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	color:#999;
	font-size:12px;
}
	#footer span{
		padding-left:22px;
		height:16px;
		margin-right:15px;
		display:inline-block;
	}
	#bottom_widgets{
		width:930px;
		margin:10px auto 0px auto;
		clear:both;
		overflow:auto;
	}
		#bottom_widgets .cover{
			width:302px;
			margin-right:12px;
			overflow:auto;
			float:left;
			clear:none;
		}
		#bottom_widgets .cover.last{
			margin-right:0px !important;
		}
		#bottom_widgets .widget{
			border:1px solid #ccc;
		}
/* footer END */

/* icons START */
span.user{
	background:url(<?php echo $tmpURL ?>/img/icons/user.png) no-repeat;
}
span.logout{
	background:url(<?php echo $tmpURL ?>/img/icons/door_out.png) no-repeat;
}
span.login{
	background:url(<?php echo $tmpURL ?>/img/icons/door_in.png) no-repeat;
}
span.signin{
	background:url(<?php echo $tmpURL ?>/img/icons/user_add.png) no-repeat;
}
span.manage_pm{
	background:url(<?php echo $tmpURL ?>/img/icons/email.png) no-repeat;
}
span.add_post{
	background:url(<?php echo $tmpURL ?>/img/icons/pencil_add.png) no-repeat;
}
span.manage_draft{
	background:url(<?php echo $tmpURL ?>/img/icons/page_white_draft.png) no-repeat;
}
span.add_link{
	background:url(<?php echo $tmpURL ?>/img/icons/link_add.png) no-repeat;
}
span.add_file{
	background:url(<?php echo $tmpURL ?>/img/icons/drive_add.png) no-repeat;
}
span.manage_layout{
	background:url(<?php echo $tmpURL ?>/img/icons/layout.png) no-repeat;
}
span.manage_plugins{
	background:url(<?php echo $tmpURL ?>/img/icons/plugin.png) no-repeat;
}
span.user_online{
	background:url(<?php echo $tmpURL ?>/img/icons/user_go.png) no-repeat;
}
span.comment_edit{
	background:url(<?php echo $tmpURL ?>/img/icons/comment_edit.png) no-repeat;
}
span.date{
	background:url(<?php echo $tmpURL ?>/img/icons/date.png) no-repeat;
}
span.reply{
	background:url(<?php echo $tmpURL ?>/img/icons/comment_add.png) no-repeat;
}
span.author_comment{
	background:url(<?php echo $tmpURL ?>/img/icons/user_comment.png) no-repeat;
}
span.author_post{
	background:url(<?php echo $tmpURL ?>/img/icons/user_edit.png) no-repeat;
}
div#post_path{
	background-image:url(<?php echo $tmpURL ?>/img/icons/page_white_go.png);
	background-repeat:no-repeat;
	background-position:5px center;
	padding:5px 5px 5px 25px;
}
div.categories{
	background:url(<?php echo $tmpURL ?>/img/icons/folder.png) no-repeat;
}
div.tags{
	background:url(<?php echo $tmpURL ?>/img/icons/tag_green.png) no-repeat;
}
span.date{
	background:url(<?php echo $tmpURL ?>/img/icons/date.png) no-repeat;
}
span.time{
	background:url(<?php echo $tmpURL ?>/img/icons/time.png) no-repeat;
}
span.rss{
	background:url(<?php echo $tmpURL ?>/img/icons/feed.png) no-repeat;
}
span.addcomment{
	background:url(<?php echo $tmpURL ?>/img/icons/comment_add.png) no-repeat;
}
span.trackback{
	background:url(<?php echo $tmpURL ?>/img/icons/comment_trackback.png) no-repeat;
}
span.pingback{
	background:url(<?php echo $tmpURL ?>/img/icons/link_go.png) no-repeat;
}
span.posts{
	background:url(<?php echo $tmpURL ?>/img/icons/page_white_copy.png) no-repeat;
}
span.comments{
	background:url(<?php echo $tmpURL ?>/img/icons/comments.png) no-repeat;
}
span.editpost{
	background:url(<?php echo $tmpURL ?>/img/icons/page_white_edit.png) no-repeat;
}
span.sitemap{
	background:url(<?php echo $tmpURL ?>/img/icons/sitemap_color.png) no-repeat;
}
span.mini_rss{
	background:url(<?php echo $tmpURL ?>/img/icons/rss.png) no-repeat;
}
span.mini_css{
	background:url(<?php echo $tmpURL ?>/img/icons/css_valid.png) no-repeat;
}
span.mini_xhtml{
	background:url(<?php echo $tmpURL ?>/img/icons/xhtml_valid.png) no-repeat;
}
/* icons END */