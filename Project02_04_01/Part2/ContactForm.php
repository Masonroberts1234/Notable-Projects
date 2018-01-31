<html>

<head>
    <!--
      Project 02_04_01

      Author: Mason Roberts
      Date:   11/20/17

      Filename: ContactForm.php
   -->
    <title>Contact Form</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <?php
    //variables
    $showForm = true;
    $errorCount = 0;
    $sender = "";
    $email = "";
    $subject = "";
    $message = "";
    //Validateinput function that will validate the required input. 
    function validateInput($data, $fieldName){
        global $errorCount;
        if(empty($data)){
            echo "\"$fieldName\" is a required field.<br>\n";
            ++$errorCount;
            $retval = "";
        }
        else{
            //takes out the space in front and takes out the slashes\
            $retval = trim($data);
            $retval = stripcslashes($retval);
        }
        return $retval;
    }
    //validate the email 
    function validateEmail($data, $fieldName) {
        global $errorCount;
        if(empty($data)){
            echo "\"$fieldName\" is a required field.<br>\n";
            ++$errorCount;
            $retval = "";
        }
        else{
            //takes out the space in front and takes out the slashes\
            $retval = trim($data);
            $retval = stripcslashes($retval);
            //that weird pattern code that defines wether or not the email is valid.
            $pattern = "/^[\w-]+(\.[\w-]+)*@" . "[\w-]+(\.[\w-]+)*"."(\.[a-z]{2,})$/i";
            if(preg_match($pattern, $retval) == 0){
                echo"\"$fieldName\" is not a valid e-mail address.<br>\n";
                ++$errorCount;
            }
        }
        return $retval;
    }
    // display form function that will display the form initially, and if there are error in the data
    function displayForm($sender,$email,$subject,$message){
    ?>
<!--   HTML to print when displayForm is called   -->
   <h2 style="text-align: center">Contact ME</h2>
   <form name="contact" action="ContactForm.php" method="post">
       <p>Your name:<br> <input type="text" name="Sender" value="<?php echo $sender;?>"></p>
       <p>Your E-mail:<br> <input type="text" name="Email" value="<?php echo $email;?>"></p>
       <p>Subject:<br> <input type="text" name="Subject" value="<?php echo $subject;?>"></p>
       <p>Message:<br> <textarea name="message"><?php echo $message;?></textarea></p>
       <p><input type="reset" value="Clear Form">&nbsp;&nbsp;<input type="submit" name="Submit" value="Send Form"></p>
   </form>
   
    <?php
    }
    //displayForm($sender,$email,$subject,$message);//debug
    //if the submit button was clicked, and the server recieved it, 
    if(isset($_POST['Submit'])){
        //validate each of the input fields
        $sender = validateInput($_POST['Sender'],"Your Name");
        $email = validateEmail($_POST['Email'],"Your E-mail");
        $subject = validateInput($_POST['Subject'],"Subject");
        $message = validateInput($_POST['message'],"Message");
        //if the error count is 0, don't show errors.
        if($errorCount == 0){
            $showForm = false;
        }
        else{
            $showForm = true;
        }
    }
    if($showForm){
        //if showform is true,and there is an error, print an error message.
        if($errorCount > 0){
            echo "<p>Please re-enter the following information below:</p>\n";    
        }
        displayForm($sender, $email,$subject, $message);
    }
    else {
        $senderAddress = "$sender <$email>";
        $headers = "From: $senderAddress\nCC:$senderAddress";
        $result = mail("masonrobertsaz@gmail.com",$subject, $message, $headers);
        if($result) {
            echo "<p>Your Message has been sent. Thank you, ". $sender ."</p>\n";
        }
        else {
            echo "<p>There was an error sending your message,".$sender."</p>\n";
        }
    }
    ?>
</body>

</html>
