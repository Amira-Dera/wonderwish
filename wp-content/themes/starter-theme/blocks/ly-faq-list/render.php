<?php
/** Dynamic FAQ list; the question and answer are edited on .LY FAQ posts. */

$faq_posts = get_posts( array(
	'post_type'      => 'ly_faq',
	'post_status'    => 'publish',
	'posts_per_page' => 50,
	'orderby'        => 'title',
	'order'          => 'ASC',
) );

usort( $faq_posts, static function ( $a, $b ) {
	$a_order = function_exists( 'get_field' ) ? (int) get_field( 'ly_faq_position', $a->ID ) : 0;
	$b_order = function_exists( 'get_field' ) ? (int) get_field( 'ly_faq_position', $b->ID ) : 0;
	return ( $a_order ?: 999 ) <=> ( $b_order ?: 999 );
} );

$items = array();
foreach ( $faq_posts as $faq_post ) {
	$answer = function_exists( 'get_field' ) ? get_field( 'ly_faq_answer', $faq_post->ID ) : '';
	if ( ! trim( wp_strip_all_tags( (string) $answer ) ) ) {
		continue;
	}
	$items[] = array( 'question' => $faq_post->post_title, 'answer' => $answer );
}

if ( $items ) {
	echo '<div ' . get_block_wrapper_attributes( array( 'class' => 'ly-faq-grid' ) ) . '>';
	for ( $column = 0; $column < 2; $column++ ) {
		echo '<div class="ly-faq-column">';
		for ( $index = $column; $index < count( $items ); $index += 2 ) {
			$item = $items[ $index ];
			echo '<details class="ly-faq-item"><summary><span class="ly-faq-question">' . esc_html( $item['question'] ) . '</span><span class="ly-faq-chevron" aria-hidden="true"></span></summary><div class="ly-faq-answer">' . wp_kses_post( $item['answer'] ) . '</div></details>';
		}
		echo '</div>';
	}
	echo '</div>';
} elseif ( is_admin() ) {
	echo '<p ' . get_block_wrapper_attributes() . '>Add and publish entries under .LY FAQs to display them here.</p>';
}
