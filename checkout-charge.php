<?php
    include("config.php");
    include("ajax-val.php");

    if ($valid=='1') {
        include("get_price.php");

        $token = $_POST["stripeToken"];
        $token_card_type = $_POST["stripeTokenType"];
        // $contact_name = $_POST["c_name"];
        $email = $_POST["stripeEmail"];
        // $amount = $_POST["amount"];
        // $amount = '100,00';
        $checkInDate = $_POST["checkInDate"];
        $checkOutDate = $_POST["checkOutDate"];
        $ppl_count = $_POST["num-people"];
        
        $charge = \Stripe\Charge::create([
            'amount'=>str_replace(",", "", $price)*100,
            'description'=>"$checkInDate, $checkOutDate",
            'currency'=>'eur',
            'source'=>$token,
        ]);
        // $amount = '100';
    
    
        if ($charge) {
            header("Location:success.php?amount=$price");
        }
        else {
            header("Location:fail.php");
            exit; 
        }
        
    }
    else {
    header("Location:fail.php");
    exit; 
}
    


?>