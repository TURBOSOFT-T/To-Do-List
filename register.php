<?php

$json_data = json_encode( array( 'name', 'surname', 'mail' ) );

setcookie( 'user_key', 'my_value', time()+60*60*24*15 );

echo __DIR__ ;