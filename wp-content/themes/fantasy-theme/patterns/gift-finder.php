<?php
/**
 * Title: WonderWish gift finder
 * Slug: fantasy-theme/gift-finder
 * Categories: featured
 * Description: Accessible three-choice gift finder using native WooCommerce catalogue filters.
 */
defined( 'ABSPATH' ) || exit;
$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$finder_tags = array();
foreach ( get_terms( array( 'taxonomy' => 'product_tag', 'hide_empty' => true ) ) as $tag ) $finder_tags[$tag->slug] = $tag->term_id;
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ww-gifts","layout":{"type":"default"},"metadata":{"name":"Find Your Perfect Gift"}} -->
<section class="wp-block-group alignfull ww-gifts">
<!-- wp:html --><div class="ww-world-glitter ww-gift-glitter" aria-hidden="true"><canvas class="ww-world-canvas"></canvas><span>✦</span><span>✧</span><span>✦</span><span>✧</span><span>✦</span><span>✧</span></div><!-- /wp:html -->
<!-- wp:paragraph {"className":"ww-gifts-eyebrow"} --><p class="ww-gifts-eyebrow">THOUGHTFUL LITTLE WONDERS</p><!-- /wp:paragraph -->
<!-- wp:heading {"className":"ww-gifts-title"} --><h2 class="wp-block-heading ww-gifts-title">Find Your Perfect Gift</h2><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-gifts-subtitle"} --><p class="ww-gifts-subtitle">A few little clues. A whole world of possibilities.</p><!-- /wp:paragraph -->
<!-- wp:html -->
<div class="ww-gift-finder" data-tags="<?php echo esc_attr( wp_json_encode( $finder_tags ) ); ?>" data-endpoint="<?php echo esc_url( rest_url( 'wc/store/v1/products' ) ); ?>" data-shop="<?php echo esc_url( $shop ); ?>">
  <div class="ww-gift-story">
    <div class="ww-gift-art" aria-hidden="true">
      <span class="ww-gift-star ww-gift-star-one">✦</span><span class="ww-gift-star ww-gift-star-two">✧</span><span class="ww-gift-star ww-gift-star-three">✦</span>
      <svg class="ww-gift-box" viewBox="0 0 360 360" fill="none" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="180" cy="310" rx="106" ry="13" fill="#9BC3EA" opacity=".16"/>
        <g class="ww-gift-lid">
          <path d="M77 153C77 147 82 142 88 142H272C278 142 283 147 283 153V178H77V153Z" fill="#76B9F0"/>
          <path d="M180 142H272C278 142 283 147 283 153V178H180V142Z" fill="#4093D7"/>
          <path d="M163 142H197V178H163V142Z" fill="#F6D88C"/>
          <path d="M180 139C146 130 111 103 132 87C153 71 177 105 180 139Z" fill="#FFF0C7" stroke="#4C86CE" stroke-width="3"/>
          <path d="M180 139C214 130 249 103 228 87C207 71 183 105 180 139Z" fill="#FFF0C7" stroke="#4C86CE" stroke-width="3"/>
          <circle cx="180" cy="136" r="12" fill="#F9FCFF" stroke="#4C86CE" stroke-width="3"/>
        </g>
        <ellipse cx="180" cy="177" rx="94" ry="14" fill="#174D78"/>
        <defs><clipPath id="ww-gift-contents"><rect x="80" y="0" width="215" height="177"/></clipPath></defs>
        <g clip-path="url(#ww-gift-contents)"><g class="ww-gift-characters">
        <image class="ww-gift-box-olaf" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/gift-finder/olaf.webp' ); ?>" x="91" y="48" width="108" height="219" preserveAspectRatio="xMidYMin meet"/>
        <image class="ww-gift-box-puss" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/gift-finder/puss-in-boots.webp' ); ?>" x="178" y="44" width="110" height="230" preserveAspectRatio="xMidYMin meet"/>

        </g></g>
        <path d="M86 176H274V288C274 299 265 307 254 307H106C95 307 86 299 86 288V176Z" fill="#65ADE7"/>
        <path d="M180 176H274V288C274 299 265 307 254 307H180V176Z" fill="#287CBF"/>
        <path d="M163 176H197V307H163V176Z" fill="#F6D88C"/>
        <path d="M102 196V276" stroke="#B8D7FF" stroke-width="3" stroke-linecap="round"/>
        <g class="ww-gift-magic" fill="#E3AD50"><path d="M180 64L184 76L196 80L184 84L180 96L176 84L164 80L176 76Z"/><circle cx="137" cy="65" r="3"/><circle cx="223" cy="61" r="4"/></g>
      </svg>
      <svg class="ww-gift-mini" viewBox="0 0 90 100" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="12" y="40" width="66" height="52" rx="7" fill="#DFEFFF" stroke="#7CA9D9"/><rect x="7" y="31" width="76" height="18" rx="4" fill="#8EC3EC"/><path d="M40 32H51V92H40V32Z" fill="white"/><path d="M45 31C20 31 18 7 30 9C40 10 45 31 45 31ZM45 31C70 31 72 7 60 9C50 10 45 31 45 31Z" fill="#EFF7FF" stroke="#7CA9D9" stroke-width="2"/></svg>
    </div>
    <p class="ww-gift-story-kicker">SMALL GIFT. BIG FEELING.</p>
    <h3>A little magic,<br>picked for them.</h3>
    <p class="ww-gift-story-copy">Choose who you’re celebrating, their favorite world, and the moment you want to make special.</p>
    <p class="ww-gift-art-credit">Preview art: <a href="https://pngimg.com/image/86867">Olaf · PNGimg</a> &amp; <a href="https://pnggallery.com/puss-in-boots">Puss in Boots · PNG Gallery</a>. <a href="https://creativecommons.org/licenses/by-nc/4.0/">CC BY-NC 4.0</a>; images resized to WebP.</p>
  </div>
  <div class="ww-gift-interactive">
    <form class="ww-gift-form">
      <fieldset><legend><span>01</span> Who’s the lucky one?</legend>
        <div class="ww-gift-options ww-gift-recipients">
          <label><input type="radio" name="recipient" value="kids" required><span>Kids</span></label>
          <label><input type="radio" name="recipient" value="friends"><span>Friends</span></label>
          <label><input type="radio" name="recipient" value="family"><span>Family</span></label>
          <label><input type="radio" name="recipient" value="yourself"><span>Myself</span></label>
        </div>
      </fieldset>
      <fieldset><legend><span>02</span> Which world makes them smile?</legend>
        <div class="ww-gift-options">
          <label><input type="radio" name="world" value="disney" required><span>Disney</span></label>
          <label><input type="radio" name="world" value="dreamworks"><span>DreamWorks</span></label>
        </div>
      </fieldset>
      <fieldset><legend><span>03</span> What’s the occasion?</legend>
        <div class="ww-gift-options">
          <label><input type="radio" name="occasion" value="birthday" required><span>Birthday</span></label>
          <label><input type="radio" name="occasion" value="celebration"><span>Celebration</span></label>
          <label><input type="radio" name="occasion" value="just-because"><span>Just because</span></label>
        </div>
      </fieldset>
      <div class="ww-gift-actions"><button type="submit" class="ww-gift-submit">Find my gift <span aria-hidden="true">✦</span></button><button type="reset" class="ww-gift-reset">Start again</button></div>
      <p class="ww-gift-status" role="status" aria-live="polite"></p>
    </form>
    <noscript><p>Enable JavaScript to use the gift finder, or <a href="<?php echo esc_url( $shop ); ?>">explore the shop</a>.</p></noscript>
  </div>
  <div class="ww-gift-results" hidden>
    <p class="ww-gift-result-eyebrow">A LITTLE MAGIC, REVEALED</p>
    <h3 class="ww-gift-result-title" tabindex="-1"></h3>
    <p class="ww-gift-result-copy"></p>
    <div class="ww-gift-matches"></div>
    <a class="ww-gift-browse" href="<?php echo esc_url( $shop ); ?>">Explore the shop <span aria-hidden="true">↗</span></a>
  </div>
</div>
<!-- /wp:html -->
</section><!-- /wp:group -->
