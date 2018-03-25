<?php
/*
 * @desc Add custom data to what is returned by the web services. All custom data will be available to the JS API.
 * @param $post_data
 * @param $post
 * @param $component
 */
function wpak_add_custom_data( $post_data, $post, $component ) {
    
    // Add subhead. Expected as a post custom field.
    // Usage in app's templates: <%= post.subhead %>
    $post_data['subhead'] = get_post_meta($post->ID, 'subhead', true);
	$post_data['adresse'] = get_post_meta($post->ID, 'adresse', true);
	$post_data['zusatz'] = get_post_meta($post->ID, 'zusatz', true);
	$post_data['next_bus1'] = get_post_meta($post->ID, 'next_bus1', true);
	$post_data['busverkehr1'] = get_post_meta($post->ID, 'busverkehr1', true);
	$post_data['next_bus2'] = get_post_meta($post->ID, 'next_bus2', true);
	$post_data['busverkehr2'] = get_post_meta($post->ID, 'busverkehr2', true);
	
	$post_data['next_bus2_entfernung'] = get_post_meta($post->ID, 'next_bus2_entfernung', true);
	$post_data['next_bus1_entfernung'] = get_post_meta($post->ID, 'next_bus1_entfernung', true);
	
	
    // Add post thumbnail caption.
    // Usage in app's templates: <%= post.thumbnail.caption %>
    $thumbnail_id = get_post_thumbnail_id( $post->ID );
	if ( $thumbnail_id ) {
		$image_post = get_post( $thumbnail_id );
		if ( $image_post ) {
			if ( !empty( $post_data['thumbnail'] ) ) {
				$post_data['thumbnail']['caption'] = $image_post->post_excerpt;
			}
		}
	}
	
	$taxonomy = 'category'; // We search for categories
    $terms = get_the_terms( $post->ID, $taxonomy ); // Get the post categories
    $cat_list = wp_list_pluck( $terms, 'slug' ); // Get an array of slugs only
    // Add category list to post data returned by the web service
    $post_data['categories'] = $cat_list;

    
	
    return $post_data; // Return the modified $post_data

	
	
	
}

add_filter( 'wpak_post_data', 'wpak_add_custom_data', 10, 3 );





?>