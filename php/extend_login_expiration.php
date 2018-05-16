<?php

function wpak_custom_expiration_time( $expiration_time, $user_id, $app_id ) {
$expiration_time = DAY_IN_SECONDS * 365;
return $expiration_time;
}

add_filter( 'wpak_auth_connection_expiration_time', 'wpak_custom_expiration_time', 10, 3 );

?>