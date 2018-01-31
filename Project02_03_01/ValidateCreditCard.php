<html>

<head>
    <!--
      Project 02_03_01

      Author: Mason Roberts
      Date:   11/06/17

      Filename: ValidateCreditCard.php
   -->
    <title>Validate Credit Card</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Validate Credit Card</h2>
    <?php
        //array with an empty string, a valid card, and an invalid card.
        $creditCard = array("","8910-1234-5678-6543","OOOO-9123-4567-0123");
        //for each value in $creditCard as $indexnumber increases to $cardNumber
        foreach($creditCard as $indexNumber => $cardNumber){
            if(empty($cardNumber)){
                echo "<p>Credit Card Number $indexNumber is invalid because it contains an empty string.</p>";
            }
            else{
                $creditCardNumber = $cardNumber;
                //new variable creditCardNumber, which we will change.
                $creditCardNumber = str_replace("-","",$creditCardNumber);
                $creditCardNumber = str_replace(" ","",$creditCardNumber);
                echo "<p>Credit Card Number $indexNumber $creditCardNumber removed dashes and spaces.</p>";
                if(!is_numeric($creditCardNumber)){
                    echo "<p>Credit Card Number $indexNumber $creditCardNumber is invalid because it contains a non-numeric character.</p>";
                }
                else{
                    echo "<p>Credit Card Number $indexNumber $creditCardNumber is a valid credit card number.</p>";
                }
            }
        }
    ?>
</body>

</html>
