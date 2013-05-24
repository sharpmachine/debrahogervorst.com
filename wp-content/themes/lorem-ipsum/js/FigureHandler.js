/*------------------------------------------------------------------------------
Function:       FigureHandler()
Author:         Aaron Gustafson (aaron at easy-designs dot net)
Creation Date:  28 August 2007
Version:        0.1
Homepage:       http://code.google.com/p/easy-designs/wiki/FigureHandler
License:        MIT License (see homepage)
Note:           If you change or improve on this script, please let us know by
                emailing the author (above) with a link to your demo page.
------------------------------------------------------------------------------*/
function FigureHandler(g,h){if(typeof(h)!=='object'){var h={'75-100':'full-col','67-75':'three-quarters-col','50-67':'two-thirds-col','34-50':'half-col','25-34':'third-col','0-25':'quarter-col'}}var i='div.figure';if(typeof(g)=='string')i='#'+g+' '+i;function init(){$$(i).each(function(a){var b=a.getElementsByTagName('img')[0].width;var c=parseInt($(a.parentNode).getStyle('width'));var d=Math.ceil(b/c*100);var e,col_class;for(var f in h){e=f.split('-');if(d>e[0]&&d<=e[1]){col_class=h[f];break}}a.addClassName(col_class);$A(a.getElementsByTagName('p')).each(function(p){p.style.width=b+'px'})})}init()}