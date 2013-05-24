<?php ob_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<title>{#media_dlg.title}</title>
    <?php
		include ('../../includes/tinymce_addon_scripts.php');
	?>
    <!--
	<script type="text/javascript" src="../../tinymce/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="../../tinymce/mctabs.js"></script>
	<script type="text/javascript" src="../../tinymce/validate.js"></script>
	<script type="text/javascript" src="../../tinymce/form_utils.js"></script>
	<script type="text/javascript" src="../../tinymce/editable_selects.js"></script>
    -->
	<script type="text/javascript" src="js/media.js"></script>
	<link href="css/media.css" rel="stylesheet" type="text/css" />
</head>
<body style="display: none" role="application">
<form onSubmit="Media.insert();return false;" action="#">
		<div class="tabs" role="presentation">
			<ul>
				<li id="general_tab" class="current" aria-controls="general_panel"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');Media.formToData();" onMouseDown="return false;">{#media_dlg.general}</a></span></li>
				<li id="advanced_tab" aria-controls="advanced_panel"><span><a href="javascript:mcTabs.displayTab('advanced_tab','advanced_panel');Media.formToData();" onMouseDown="return false;">{#media_dlg.advanced}</a></span></li>
				<li id="source_tab" aria-controls="source_panel"><span><a href="javascript:mcTabs.displayTab('source_tab','source_panel');Media.formToData('source');" onMouseDown="return false;">{#media_dlg.source}</a></span></li>
			</ul>
		</div>

		<div class="panel_wrapper">
			<div id="general_panel" class="panel current">
				<fieldset>
					<legend>{#media_dlg.general}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td><label for="media_type">{#media_dlg.type}</label></td>
								<td>
									<select id="media_type"></select>
								</td>
							</tr>
							<tr>
							<td><label for="src">{#media_dlg.file}</label></td>
								<td>
									<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input id="src" name="src" type="text" value="" class="mceFocus" onChange="Media.formToData();" /></td>
										<td id="filebrowsercontainer">&nbsp;</td>
									</tr>
									</table>
								</td>
							</tr>
							<tr id="linklistrow">
								<td><label for="linklist">{#media_dlg.list}</label></td>
								<td id="linklistcontainer"><select id="linklist"><option value=""></option></select></td>
							</tr>
							<tr>
								<td><label for="width">{#media_dlg.size}</label></td>
								<td>
									<table role="presentation" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td><input type="text" id="width" name="width" value="" class="size" onChange="Media.formToData('width');" onFocus="Media.beforeResize();" /> x <input type="text" id="height" name="height" value="" class="size" onFocus="Media.beforeResize();" onChange="Media.formToData('height');" /></td>
											<td>&nbsp;&nbsp;<input id="constrain" type="checkbox" name="constrain" class="checkbox" checked="checked" /></td>
											<td><label id="constrainlabel" for="constrain">{#media_dlg.constrain_proportions}</label></td>
										</tr>
									</table>
								</td>
							</tr>
					</table>
				</fieldset>

				<fieldset>
					<legend>{#media_dlg.preview}</legend>
					<div id="prev"></div>
				</fieldset>
			</div>

			<div id="advanced_panel" class="panel">
				<fieldset>
					<legend>{#media_dlg.advanced}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0" width="100%">
						<tr>
							<td><label for="id">{#media_dlg.id}</label></td>
							<td><input type="text" id="id" name="id" onChange="Media.formToData();" /></td>
							<td><label for="name">{#media_dlg.name}</label></td>
							<td><input type="text" id="name" name="name" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="align">{#media_dlg.align}</label></td>
							<td>
								<select id="align" name="align" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="top">{#media_dlg.align_top}</option>
									<option value="right">{#media_dlg.align_right}</option>
									<option value="bottom">{#media_dlg.align_bottom}</option>
									<option value="left">{#media_dlg.align_left}</option>
								</select>
							</td>

							<td><label for="bgcolor">{#media_dlg.bgcolor}</label></td>
							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input id="bgcolor" name="bgcolor" type="text" value="" size="9" onChange="updateColor('bgcolor_pick','bgcolor');Media.formToData();" /></td>
										<td id="bgcolor_pickcontainer">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="vspace">{#media_dlg.vspace}</label></td>
							<td><input type="text" id="vspace" name="vspace" class="number" onChange="Media.formToData();" /></td>
							<td><label for="hspace">{#media_dlg.hspace}</label></td>
							<td><input type="text" id="hspace" name="hspace" class="number" onChange="Media.formToData();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="video_options">
					<legend>{#media_dlg.html5_video_options}</legend>

					<table role="presentation">
						<tr>
							<td><label for="video_altsource1">{#media_dlg.altsource1}</label></td>
							<td>
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="video_altsource1" name="video_altsource1" onChange="Media.formToData();" style="width: 240px" /></td>
										<td id="video_altsource1_filebrowser">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="video_altsource2">{#media_dlg.altsource2}</label></td>
							<td>
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="video_altsource2" name="video_altsource2" onChange="Media.formToData();" style="width: 240px" /></td>
										<td id="video_altsource2_filebrowser">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="video_poster">{#media_dlg.poster}</label></td>
							<td>
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="video_poster" name="video_poster" onChange="Media.formToData();" style="width: 240px" /></td>
										<td id="video_poster_filebrowser">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="video_preload">{#media_dlg.preload}</label></td>
							<td>
								<select id="video_preload" name="video_preload" onChange="Media.formToData();">
									<option value="none">{#media_dlg.preload_none}</option> 
									<option value="metadata">{#media_dlg.preload_metadata}</option>
									<option value="auto">{#media_dlg.preload_auto}</option>
								</select>
							</td>
						</tr>
					</table>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="video_autoplay" name="video_autoplay" onChange="Media.formToData();" /></td>
										<td><label for="video_autoplay">{#media_dlg.play}</label></td>
									</tr>
								</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="video_muted" name="video_muted" onChange="Media.formToData();" /></td>
										<td><label for="video_muted">{#media_dlg.mute}</label></td>
									</tr>
								</table>
							</td>

							<td>
									<table role="presentation" border="0" cellpadding="0" cellspacing="0">
											<tr>
													<td><input type="checkbox" class="checkbox" id="video_loop" name="video_loop" onChange="Media.formToData();" /></td>
													<td><label for="video_loop">{#media_dlg.loop}</label></td>
											</tr>
									</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="video_controls" name="video_controls" onChange="Media.formToData();" /></td>
										<td><label for="video_controls">{#media_dlg.controls}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="embeddedaudio_options">
					<legend>{#media_dlg.embedded_audio_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="embeddedaudio_autoplay" name="audio_autoplay" onChange="Media.formToData();" /></td>
										<td><label for="audio_autoplay">{#media_dlg.play}</label></td>
									</tr>
								</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="embeddedaudio_loop" name="audio_loop" onChange="Media.formToData();" /></td>
										<td><label for="audio_loop">{#media_dlg.loop}</label></td>
									</tr>
								</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="embeddedaudio_controls" name="audio_controls" onChange="Media.formToData();" /></td>
										<td><label for="audio_controls">{#media_dlg.controls}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="audio_options">
					<legend>{#media_dlg.html5_audio_options}</legend>

					<table role="presentation">
						<tr>
							<td><label for="audio_altsource1">{#media_dlg.altsource1}</label></td>
							<td>
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="audio_altsource1" name="audio_altsource1" onChange="Media.formToData();" style="width: 240px" /></td>
										<td id="audio_altsource1_filebrowser">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="audio_altsource2">{#media_dlg.altsource2}</label></td>
							<td>
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="audio_altsource2" name="audio_altsource2" onChange="Media.formToData();" style="width: 240px" /></td>
										<td id="audio_altsource2_filebrowser">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="audio_preload">{#media_dlg.preload}</label></td>
							<td>
								<select id="audio_preload" name="audio_preload" onChange="Media.formToData();">
									<option value="none">{#media_dlg.preload_none}</option>
									<option value="metadata">{#media_dlg.preload_metadata}</option>
									<option value="auto">{#media_dlg.preload_auto}</option>
								</select>
							</td>
						</tr>
					</table>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="audio_autoplay" name="audio_autoplay" onChange="Media.formToData();" /></td>
										<td><label for="audio_autoplay">{#media_dlg.play}</label></td>
									</tr>
								</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="audio_loop" name="audio_loop" onChange="Media.formToData();" /></td>
										<td><label for="audio_loop">{#media_dlg.loop}</label></td>
									</tr>
								</table>
							</td>

							<td>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="audio_controls" name="audio_controls" onChange="Media.formToData();" /></td>
										<td><label for="audio_controls">{#media_dlg.controls}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="flash_options">
					<legend>{#media_dlg.flash_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td><label for="flash_quality">{#media_dlg.quality}</label></td>
							<td>
								<select id="flash_quality" name="flash_quality" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="high">high</option>
									<option value="low">low</option>
									<option value="autolow">autolow</option>
									<option value="autohigh">autohigh</option>
									<option value="best">best</option>
								</select>
							</td>

							<td><label for="flash_scale">{#media_dlg.scale}</label></td>
							<td>
								<select id="flash_scale" name="flash_scale" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="showall">showall</option>
									<option value="noborder">noborder</option>
									<option value="exactfit">exactfit</option>
									<option value="noscale">noscale</option>
								</select>
							</td>
						</tr>

						<tr>
							<td><label for="flash_wmode">{#media_dlg.wmode}</label></td>
							<td>
								<select id="flash_wmode" name="flash_wmode" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="window">window</option>
									<option value="opaque">opaque</option>
									<option value="transparent">transparent</option>
								</select>
							</td>

							<td><label for="flash_salign">{#media_dlg.salign}</label></td>
							<td>
								<select id="flash_salign" name="flash_salign" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="l">{#media_dlg.align_left}</option>
									<option value="t">{#media_dlg.align_top}</option>
									<option value="r">{#media_dlg.align_right}</option>
									<option value="b">{#media_dlg.align_bottom}</option>
									<option value="tl">{#media_dlg.align_top_left}</option>
									<option value="tr">{#media_dlg.align_top_right}</option>
									<option value="bl">{#media_dlg.align_bottom_left}</option>
									<option value="br">{#media_dlg.align_bottom_right}</option>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_play" name="flash_play" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="flash_play">{#media_dlg.play}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_loop" name="flash_loop" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="flash_loop">{#media_dlg.loop}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_menu" name="flash_menu" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="flash_menu">{#media_dlg.menu}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_swliveconnect" name="flash_swliveconnect" onChange="Media.formToData();" /></td>
										<td><label for="flash_swliveconnect">{#media_dlg.liveconnect}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table role="presentation">
						<tr>
							<td><label for="flash_base">{#media_dlg.base}</label></td>
							<td><input type="text" id="flash_base" name="flash_base" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="flash_flashvars">{#media_dlg.flashvars}</label></td>
							<td><input type="text" id="flash_flashvars" name="flash_flashvars" onChange="Media.formToData();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="quicktime_options">
					<legend>{#media_dlg.qt_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_loop" name="quicktime_loop" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_loop">{#media_dlg.loop}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_autoplay" name="quicktime_autoplay" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_autoplay">{#media_dlg.play}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_cache" name="quicktime_cache" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_cache">{#media_dlg.cache}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_controller" name="quicktime_controller" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_controller">{#media_dlg.controller}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_correction" name="quicktime_correction" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_correction">{#media_dlg.correction}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_enablejavascript" name="quicktime_enablejavascript" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_enablejavascript">{#media_dlg.enablejavascript}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_kioskmode" name="quicktime_kioskmode" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_kioskmode">{#media_dlg.kioskmode}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_autohref" name="quicktime_autohref" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_autohref">{#media_dlg.autohref}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_playeveryframe" name="quicktime_playeveryframe" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_playeveryframe">{#media_dlg.playeveryframe}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="quicktime_targetcache" name="quicktime_targetcache" onChange="Media.formToData();" /></td>
										<td><label for="quicktime_targetcache">{#media_dlg.targetcache}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="quicktime_scale">{#media_dlg.scale}</label></td>
							<td><select id="quicktime_scale" name="quicktime_scale" class="mceEditableSelect" onChange="Media.formToData();">
									<option value="">{#not_set}</option> 
									<option value="tofit">tofit</option>
									<option value="aspect">aspect</option>
								</select>
							</td>

							<td colspan="2">&nbsp;</td>
						</tr>

						<tr>
							<td><label for="quicktime_starttime">{#media_dlg.starttime}</label></td>
							<td><input type="text" id="quicktime_starttime" name="quicktime_starttime" onChange="Media.formToData();" /></td>

							<td><label for="quicktime_endtime">{#media_dlg.endtime}</label></td>
							<td><input type="text" id="quicktime_endtime" name="quicktime_endtime" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="quicktime_target">{#media_dlg.target}</label></td>
							<td><input type="text" id="quicktime_target" name="quicktime_target" onChange="Media.formToData();" /></td>

							<td><label for="quicktime_href">{#media_dlg.href}</label></td>
							<td><input type="text" id="quicktime_href" name="quicktime_href" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="quicktime_qtsrcchokespeed">{#media_dlg.qtsrcchokespeed}</label></td>
							<td><input type="text" id="quicktime_qtsrcchokespeed" name="quicktime_qtsrcchokespeed" onChange="Media.formToData();" /></td>

							<td><label for="quicktime_volume">{#media_dlg.volume}</label></td>
							<td><input type="text" id="quicktime_volume" name="quicktime_volume" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="quicktime_qtsrc">{#media_dlg.qtsrc}</label></td>
							<td colspan="4">
								<table role="presentation" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" id="quicktime_qtsrc" name="quicktime_qtsrc" onChange="Media.formToData();" /></td>
										<td id="qtsrcfilebrowsercontainer">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="windowsmedia_options">
					<legend>{#media_dlg.wmp_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_autostart" name="windowsmedia_autostart" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_autostart">{#media_dlg.autostart}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_enabled" name="windowsmedia_enabled" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_enabled">{#media_dlg.enabled}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_enablecontextmenu" name="windowsmedia_enablecontextmenu" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_enablecontextmenu">{#media_dlg.menu}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_fullscreen" name="windowsmedia_fullscreen" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_fullscreen">{#media_dlg.fullscreen}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_invokeurls" name="windowsmedia_invokeurls" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_invokeurls">{#media_dlg.invokeurls}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_mute" name="windowsmedia_mute" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_mute">{#media_dlg.mute}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_stretchtofit" name="windowsmedia_stretchtofit" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_stretchtofit">{#media_dlg.stretchtofit}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="windowsmedia_windowlessvideo" name="windowsmedia_windowlessvideo" onChange="Media.formToData();" /></td>
										<td><label for="windowsmedia_windowlessvideo">{#media_dlg.windowlessvideo}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="windowsmedia_balance">{#media_dlg.balance}</label></td>
							<td><input type="text" id="windowsmedia_balance" name="windowsmedia_balance" onChange="Media.formToData();" /></td>

							<td><label for="windowsmedia_baseurl">{#media_dlg.baseurl}</label></td>
							<td><input type="text" id="windowsmedia_baseurl" name="windowsmedia_baseurl" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="windowsmedia_captioningid">{#media_dlg.captioningid}</label></td>
							<td><input type="text" id="windowsmedia_captioningid" name="windowsmedia_captioningid" onChange="Media.formToData();" /></td>

							<td><label for="windowsmedia_currentmarker">{#media_dlg.currentmarker}</label></td>
							<td><input type="text" id="windowsmedia_currentmarker" name="windowsmedia_currentmarker" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="windowsmedia_currentposition">{#media_dlg.currentposition}</label></td>
							<td><input type="text" id="windowsmedia_currentposition" name="windowsmedia_currentposition" onChange="Media.formToData();" /></td>

							<td><label for="windowsmedia_defaultframe">{#media_dlg.defaultframe}</label></td>
							<td><input type="text" id="windowsmedia_defaultframe" name="windowsmedia_defaultframe" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="windowsmedia_playcount">{#media_dlg.playcount}</label></td>
							<td><input type="text" id="windowsmedia_playcount" name="windowsmedia_playcount" onChange="Media.formToData();" /></td>

							<td><label for="windowsmedia_rate">{#media_dlg.rate}</label></td>
							<td><input type="text" id="windowsmedia_rate" name="windowsmedia_rate" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="windowsmedia_uimode">{#media_dlg.uimode}</label></td>
							<td><input type="text" id="windowsmedia_uimode" name="windowsmedia_uimode" onChange="Media.formToData();" /></td>

							<td><label for="windowsmedia_volume">{#media_dlg.volume}</label></td>
							<td><input type="text" id="windowsmedia_volume" name="windowsmedia_volume" onChange="Media.formToData();" /></td>
						</tr>

					</table>
				</fieldset>

				<fieldset id="realmedia_options">
					<legend>{#media_dlg.rmp_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_autostart" name="realmedia_autostart" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_autostart">{#media_dlg.autostart}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_loop" name="realmedia_loop" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_loop">{#media_dlg.loop}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_autogotourl" name="realmedia_autogotourl" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_autogotourl">{#media_dlg.autogotourl}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_center" name="realmedia_center" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_center">{#media_dlg.center}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_imagestatus" name="realmedia_imagestatus" checked="checked" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_imagestatus">{#media_dlg.imagestatus}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_maintainaspect" name="realmedia_maintainaspect" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_maintainaspect">{#media_dlg.maintainaspect}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_nojava" name="realmedia_nojava" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_nojava">{#media_dlg.nojava}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_prefetch" name="realmedia_prefetch" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_prefetch">{#media_dlg.prefetch}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="realmedia_shuffle" name="realmedia_shuffle" onChange="Media.formToData();" /></td>
										<td><label for="realmedia_shuffle">{#media_dlg.shuffle}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">&nbsp;
								
							</td>
						</tr>

						<tr>
							<td><label for="realmedia_console">{#media_dlg.console}</label></td>
							<td><input type="text" id="realmedia_console" name="realmedia_console" onChange="Media.formToData();" /></td>

							<td><label for="realmedia_controls">{#media_dlg.controls}</label></td>
							<td><input type="text" id="realmedia_controls" name="realmedia_controls" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="realmedia_numloop">{#media_dlg.numloop}</label></td>
							<td><input type="text" id="realmedia_numloop" name="realmedia_numloop" onChange="Media.formToData();" /></td>

							<td><label for="realmedia_scriptcallbacks">{#media_dlg.scriptcallbacks}</label></td>
							<td><input type="text" id="realmedia_scriptcallbacks" name="realmedia_scriptcallbacks" onChange="Media.formToData();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="shockwave_options">
					<legend>{#media_dlg.shockwave_options}</legend>

					<table role="presentation" border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td><label for="shockwave_swstretchstyle">{#media_dlg.swstretchstyle}</label></td>
							<td>
								<select id="shockwave_swstretchstyle" name="shockwave_swstretchstyle" onChange="Media.formToData();">
									<option value="none">{#not_set}</option>
									<option value="meet">Meet</option>
									<option value="fill">Fill</option>
									<option value="stage">Stage</option>
								</select>
							</td>

							<td><label for="shockwave_swvolume">{#media_dlg.volume}</label></td>
							<td><input type="text" id="shockwave_swvolume" name="shockwave_swvolume" onChange="Media.formToData();" /></td>
						</tr>

						<tr>
							<td><label for="shockwave_swstretchhalign">{#media_dlg.swstretchhalign}</label></td>
							<td>
								<select id="shockwave_swstretchhalign" name="shockwave_swstretchhalign" onChange="Media.formToData();">
									<option value="none">{#not_set}</option>
									<option value="left">{#media_dlg.align_left}</option>
									<option value="center">{#media_dlg.align_center}</option>
									<option value="right">{#media_dlg.align_right}</option>
								</select>
							</td>

							<td><label for="shockwave_swstretchvalign">{#media_dlg.swstretchvalign}</label></td>
							<td>
								<select id="shockwave_swstretchvalign" name="shockwave_swstretchvalign" onChange="Media.formToData();">
									<option value="none">{#not_set}</option>
									<option value="meet">Meet</option>
									<option value="fill">Fill</option>
									<option value="stage">Stage</option>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_autostart" name="shockwave_autostart" onChange="Media.formToData();" checked="checked" /></td>
										<td><label for="shockwave_autostart">{#media_dlg.autostart}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_sound" name="shockwave_sound" onChange="Media.formToData();" checked="checked" /></td>
										<td><label for="shockwave_sound">{#media_dlg.sound}</label></td>
									</tr>
								</table>
							</td>
						</tr>


						<tr>
							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_swliveconnect" name="shockwave_swliveconnect" onChange="Media.formToData();" /></td>
										<td><label for="shockwave_swliveconnect">{#media_dlg.liveconnect}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_progress" name="shockwave_progress" onChange="Media.formToData();" checked="checked" /></td>
										<td><label for="shockwave_progress">{#media_dlg.progress}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>
			</div>

			<div id="source_panel" class="panel">
				<fieldset>
					<legend>{#media_dlg.source}</legend>
					<textarea id="source" style="width: 99%; height: 390px"></textarea>
				</fieldset>
			</div>
		</div>

		<div class="mceActionPanel">
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onClick="tinyMCEPopup.close();" />
		</div>
	</form>
</body>
</html>
