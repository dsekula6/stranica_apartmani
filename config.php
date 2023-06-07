<?php
    require_once "stripe_1.14.6/vendor/stripe/stripe-php/init.php";

    $stripeDetails = array(
        "publishableKey"=>"pk_test_51N8iGcJP99waCG4ijvYy5OrysFUawIHQi7i9SHcUQ0lUCXJjNMMOoDqHMZKNqprKuCZWCHC5OWAFevYitecNo3lZ00iq8pdfTC",
        "secretKey"=>""
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);

?>