<html>

<head>
    <!--
      Project 02_04_02

      Author: Mason Roberts
      Date:   11/21/17

      Filename: Paycheck.php
   -->
    <title>Weekly Paycheck</title>
    <script src="modernizr.custom.65897.js"></script>
    <style>
        * {
            text-align: center;
        }

    </style>
</head>

<body>
    <h2>Paycheck Form</h2>
    <?php
    //debug
//    foreach($_POST as $key => $data){
//        echo "$key: $data<br>";
//    }
    // using Hours, Wage, and Submit as inputs
    //global variables
    $overtime = 0;
    $showPaycheck = true;
    $hours = 0;
    $wage = 0;
    $errorCount = 0;
    //validate input
    function validateInput ($input, $fieldName){
        global $showPaycheck;
        global $errorCount;
        if(empty($input)){
            echo "Error: \"$fieldName\" field is empty.<br>";
            $retVal = "";
            $errorCount++;
            $showPaycheck = false;
        }
        else{
            $retVal = trim($input);
        }
        return $retVal;
    }
    //calculate and validate the hours and pay
    function calculatePay($hours, $wage){
        global $errorCount;
        global $overtime;
        if($hours > 168){
            echo "You can't work more than 168 hours in a week.<br>";
            $errorCount++;
            $hours = 168;
        } else if($hours > 100){
            //if they are working more than 100 hours a week, they need sleep.
            echo "You need sleep.<br>";
        }
        $overtime = $hours - 40;
        $pay = $hours * $wage;
        if($overtime >= 0){
            $pay += $overtime * $wage/2;
        }
        $pay = round($pay,2);
        $pay = number_format($pay,2);
        return $pay;
    }
    // make sure submit button was clicked
    if(isset($_POST['Submit'])){
        //validations
        $wage = validateInput($_POST['Wage'],'Wage');
        $hours = validateInput($_POST['Hours'],'Hours');
        $pay = calculatePay($hours,$wage);
        //make sure there's no errors and we want to show the paycheck,
        if($showPaycheck && $errorCount == 0){
            //if there is overtime, show the overtime.
            if($overtime > 0){
    ?>
        <p> Overtime:
            <?php echo "$overtime hours"?>
        </p>
        <?php
            }
    ?>
            <p>Hours Entered This Week:
                <?php echo "$hours hours";?>
            </p>
            <p>Wage Entered:
                <?php echo "\$$wage/hour";?>
            </p>
            <p>Paycheck:
                <?php echo "\$$pay";?>
            </p>
<!--      hyperlink to enter more paychecks      -->
            <a href="Paycheck.html"><u>Enter More paychecks</u></a>
            <?php
        }
        else{
    ?>
                <p>Go back and re-enter your hourly wage and hours worked.</p>
                <p> We can't pay you if you don't fill out this form.</p>
                <a href="Paycheck.html"><u>Try again</u></a>
                <?php
        }
    }
    else{
    ?>
                    <p>Please use paycheck.html instead of paycheck.php</p>
                    <a href="Paycheck.html"><u>Go to paycheck.html</u></a>
                    <?php
    }
    ?>
</body>

</html>
