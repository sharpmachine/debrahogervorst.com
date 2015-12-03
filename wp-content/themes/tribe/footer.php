<?php

echo '</div><!-- end .content-sidebar-wrap --></div><!-- end #inner --><div class="clear-pre-footer"></div><footer><div class="wrap">';

do_action( 'tribe_footer' );

echo '</div></footer>';

wp_footer(); 

do_action( 'tribe_after_footer' );

echo '</div><!-- end #wrap --></body>
</html>';
