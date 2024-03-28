<?php
declare( strict_types = 1 );
namespace Monocle\BlockLibrary\CopyrightDate;

defined( 'ABSPATH' ) || exit;

$current_year = date( "Y" );

if ( ! empty( $attributes['startingYear'] ) && ! empty( $attributes['showStartingYear'] ) ) {
  $display_date = $attributes['startingYear'] . '–' . $current_year;
} else {
  $display_date = $current_year;
}

$output = esc_html( $display_date ) . ' ' . esc_html( $attributes['copyrightText'] );

$wrapper_attributes = \get_block_wrapper_attributes( [
	'class' => 'monocle-copyright-date',
] );

printf( '
	<p %s>
		&copy; %s
	</div>',
	$wrapper_attributes,
	$output
);