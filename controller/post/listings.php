<?php
if(
    isset(
        $_POST['fuid'],
        $_POST['listingName'],
        $_POST['listingDescription'],
        $_POST['listingCondition'],
        $_POST['listingDate'],
        $_POST['listingLocation'],
        $_POST['pickup'],
        $_POST['image'],
        $_POST['status'],
        $_POST['details']
    )
) {
    echo json_encode(AddListing(
        $_POST['fuid'],
        $_POST['listingName'],
        $_POST['listingDescription'],
        $_POST['listingCondition'],
        $_POST['listingDate'],
        $_POST['listingLocation'],
        $_POST['pickup'],
        $_POST['image'],
        $_POST['status'],
        $_POST['details']
    ));
    
    //echo 'added listing!';
}

?>