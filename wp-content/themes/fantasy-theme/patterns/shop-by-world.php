<?php
/**
 * Title: WonderWish Shop by World
 * Slug: fantasy-theme/shop-by-world
 * Categories: featured
 * Description: Editable franchise cards with local development character previews.
 */
defined( 'ABSPATH' ) || exit;
$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ww-worlds","layout":{"type":"default"},"metadata":{"name":"Shop by World"}} -->
<section class="wp-block-group alignfull ww-worlds">
<!-- wp:html --><div class="ww-world-glitter" aria-hidden="true"><canvas class="ww-world-canvas"></canvas><span>✦</span><span>✧</span><span>✦</span><span>✧</span><span>✦</span><span>✧</span></div><!-- /wp:html -->
<!-- wp:group {"className":"ww-worlds-intro","layout":{"type":"default"}} -->
<div class="wp-block-group ww-worlds-intro">
<!-- wp:paragraph {"className":"ww-worlds-eyebrow"} --><p class="ww-worlds-eyebrow">A WORLD OF WONDER</p><!-- /wp:paragraph -->
<!-- wp:heading {"className":"ww-worlds-title"} --><h2 class="wp-block-heading ww-worlds-title">Shop by World</h2><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-worlds-description"} --><p class="ww-worlds-description">Different worlds. The same little spark of magic.</p><!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-world-grid","layout":{"type":"default"}} -->
<div class="wp-block-group ww-world-grid">
<?php foreach ( array(
 array( 'disney', 'Disney', 'Stitch', 'A little mischief. A lot of heart.', 'Tropical blues &amp; cosmic wonder', 'Explore Disney' ),
 array( 'dreamworks', 'DreamWorks', 'Po', 'Find your inner awesome.', 'Jade skies &amp; golden possibilities', 'Explore DreamWorks' ),
) as $world ) : ?>
<!-- wp:group <?php echo wp_json_encode( array( 'tagName' => 'article', 'className' => 'ww-world-card ww-world-' . $world[0], 'layout' => array( 'type' => 'default' ), 'metadata' => array( 'name' => $world[1] . ' world' ) ) ); ?> -->
<article class="wp-block-group ww-world-card ww-world-<?php echo esc_attr( $world[0] ); ?>">
<!-- wp:group {"className":"ww-world-art","layout":{"type":"default"},"metadata":{"name":"Character artwork — development preview"}} -->
<div class="wp-block-group ww-world-art">
<?php $character = 'disney' === $world[0] ? 'stitch' : 'po'; $width = 'stitch' === $character ? 498 : 500; ?>
<!-- wp:image <?php echo wp_json_encode( array( 'sizeSlug' => 'full', 'linkDestination' => 'none', 'className' => 'ww-world-character' ) ); ?> -->
<figure class="wp-block-image size-full ww-world-character"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/characters/' . $character . '-hq-wave-still.webp' ); ?>" alt="<?php echo esc_attr( 'stitch' === $character ? 'Stitch raising his hand to say hello' : 'Po from Kung Fu Panda raising a paw to say hello' ); ?>" width="<?php echo absint( $width ); ?>" height="<?php echo 'stitch' === $character ? 498 : 500; ?>" loading="lazy" decoding="async" /></figure><!-- /wp:image -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-world-copy","layout":{"type":"default"}} -->
<div class="wp-block-group ww-world-copy">
<!-- wp:heading {"level":3,"className":"ww-world-name"} --><h3 class="wp-block-heading ww-world-name"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logos/' . $world[0] . '.svg' ); ?>" alt="<?php echo esc_attr( $world[1] ); ?>" width="<?php echo 'disney' === $world[0] ? 700 : 512; ?>" height="<?php echo 'disney' === $world[0] ? 294 : 46; ?>" loading="lazy" decoding="async" /></h3><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-world-mood"} --><p class="ww-world-mood"><?php echo wp_kses_post( $world[4] ); ?></p><!-- /wp:paragraph -->
<!-- wp:buttons {"className":"ww-world-actions"} -->
<div class="wp-block-buttons ww-world-actions">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( add_query_arg( 'filter_franchise', $world[0], $shop ) ); ?>"><?php echo esc_html( $world[5] ); ?> <span aria-hidden="true">↗</span></a></div><!-- /wp:button -->
</div><!-- /wp:buttons -->
</div><!-- /wp:group -->
</article><!-- /wp:group -->
<?php endforeach; ?>
</div><!-- /wp:group -->
<!-- wp:paragraph {"className":"ww-world-license"} -->
<p class="ww-world-license">Local development preview · Character animations; commercial usage rights unverified. Clear or replace these assets before launch.</p><!-- /wp:paragraph -->
</section><!-- /wp:group -->
