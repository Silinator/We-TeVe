<?php

    session_start();

    require_once 'google/google-api-php/vendor/autoload.php';

    $id_token = $_POST['idtoken'];


    $client = new Google_Client(['client_id' => $CLIENT_ID]);

    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
      $userid = $payload['sub'];
      // If request specified a G Suite domain:
      //$domain = $payload['hd'];
    } else {
      // Invalid ID token
    }

?>
