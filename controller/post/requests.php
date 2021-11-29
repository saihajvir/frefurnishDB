<?php
if(
    isset(
        $_POST['listing_id'],
        $_POST['fuid'],
        $_POST['status']
    )
) {
    AddRequest(
        $_POST['listing_id'],
        $_POST['fuid'],
        $_POST['status']
    );
    
    echo 'added requests!';
}

?>