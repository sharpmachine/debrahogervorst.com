<div id="featured-content" class="flex-container loading <?php brunelleschi_banner_class(); ?>">
	<div class="flexislider">
		<ul class="slides">
		<?php
		$myposts = get_posts( array('meta_key' => 'brunelleschi_featured_post_checkbox', 'meta_value' => 'on', 'post_type' => array('post','page')) ); ?>
			<?php foreach( $myposts as $post ) : setup_postdata($post); ?>
				<li class="slide-cell wraplink clearfix" onclick="window.open('<?php the_permalink(); ?>','_self'); event.stopPropagation();">
					<?php if (has_post_thumbnail( $post->ID ) && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) ){
						$header_image_width = (HEADER_IMAGE_WIDTH < 960) ? 960 : HEADER_IMAGE_WIDTH;
						echo get_the_post_thumbnail( $post->ID, array( $header_image_width, HEADER_IMAGE_HEIGHT ), array( 'class' => 'featured-banner' ) );
					} else {
						echo '<img alt="" src="data:image/gif;base64,R0lGODlhwAPGAIAAAP///wAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo2NjIzNkM2NUJFN0ExMUUwOTQzMEJCOTA0MTc5MDZGOCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo2NjIzNkM2NkJFN0ExMUUwOTQzMEJCOTA0MTc5MDZGOCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjY2MjM2QzYzQkU3QTExRTA5NDMwQkI5MDQxNzkwNkY4IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjY2MjM2QzY0QkU3QTExRTA5NDMwQkI5MDQxNzkwNkY4Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAQAAAAAsAAAAAMADxgAAAv+Ej6nL7Q+jnLTai7PevPsPhuJIluaJpurKtu4Lx/JM1/aN5/rO9/4PDAqHxKLxiEwql8ym8wmNSqfUqvWKzWq33K73Cw6Lx+Sy+YxOq9fstvsNj8vn9Lr9js/r9/y+/w8YKDhIWGh4iJiouMjY6PgIGSk5SVlpeYmZqbnJ2en5CRoqOkpaanqKmqq6ytrq+gobKztLW2t7i5uru8vb6/sLHCw8TFxsfIycrLzM3Oz8DB0tPU1dbX2Nna29zd3t/Q0eLj5OXm5+jp6uvs7e7v4OHy8/T19vf4+fr7/P3+//DzCgwIEECxo8iDChwoUMGzp8CDGixIkUK1q8iDGjxo3/HDt6/AgypMiRJEuaPIkypcqVLFu6fAkzpsyZNGvavIkzp86dPHv6/Ak0qNChRIsaPYo0qdKlTJs6fQo1qtSpVKtavYo1q9atXLt6/Qo2rNixZMuaPYs2rdq1bNu6fQs3rty5dOvavYs3r969fPv6/Qs4sODBhAsbPow4seLFjBs7fgw5suTJlCtbvow5s+bNnDt7/gw6tOjRpEubPo06terVrFu7fg07tuzZtGvbvo07t+7dvHv7/g08uPDhxIsbP448ufLlzJs7fw49uvTp1Ktbv449u/bt3Lt7/w4+vPjx5MubP48+vfr17Nu7fw8/vvz59Ovbv48/v/79/Pv7jf8PYIACDkhggQYeiGCCCi7IYIMOPghhhBJOSGGFFl6IYYYabshhhx5+CGKIIo5IYokmnohiiiquyGKLLr4IY4wyzkhjjTbeiGOOOu7IY48+/ghkkEIOSWSRRh6JZJJKLslkk04+CWWUUk5JZZVWXollllpuyWWXXn4JZphijklmmWaeiWaaaq7JJgwFAAA7" width="', HEADER_IMAGE_WIDTH, '" height="', HEADER_IMAGE_HEIGHT,'" />';
					}
					if(get_post_meta($post->ID, 'brunelleschi_featured_post_image-only', true) !== 'on'): ?>
					<div onclick="window.open('<?php the_permalink(); ?>','_self'); event.stopPropagation();" class="content-preview <?php
						switch(get_post_meta($post->ID, 'brunelleschi_featured_post_width', true)){
							case __('1/4 Width','brunelleschi') :
								echo 'threecol ';
								break;
							case __('1/3 Width','brunelleschi'):
								echo 'fourcol ';
								break;
							case __('1/2 Width','brunelleschi'):
								echo 'sixcol ';
								break;
							case __('Full Width','brunelleschi'):
								echo 'twelvecol ';
								break;
							default:
								echo 'threecol ';
								break;
						}
						echo get_post_meta($post->ID, 'brunelleschi_featured_post_position', true); ?>">
						<h1><?php the_title(); ?></h1>
						<hr />
							<?php if(strlen(get_post_meta($post->ID, 'brunelleschi_featured_post_description', true)) > 0 ){
									echo '<p>',brunelleschi_featured_content_link_filter(stripslashes(get_post_meta($post->ID, 'brunelleschi_featured_post_description', true))),'</p>';
								}else{
									echo the_excerpt();
								}
							?>
					</div>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>