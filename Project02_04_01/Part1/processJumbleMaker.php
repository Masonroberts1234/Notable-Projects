<html>

<head>
    <!--
      Project 02_04_01

      Author: Mason Roberts
      Date:   11/20/17

      Filename: processJumbleMaker.php
   -->
    <title>Process Jumble Maker</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <?php
    //globals
    $errorCount = 0;
    $words = array();
    //handle the error messages
    function displayError($fieldName, $errorMsg){
        global $errorCount;
        echo "Error for \"$fieldName\": $errorMsg<br>\n";
        ++$errorCount;
    }
    //clean up and return the word validity data
    function validateWord($data, $fieldName){
        global $errorCount;
        $retval = "";
        if(empty($data)){
            //if the $data is empty, display error.
            displayError($fieldName, "This field is required");
            ++$errorCount;
            $retval = "";
        }
        else {
            $retval = trim($data);
            $retval = stripcslashes($retval);
            //must be a word between 4 and 7 char in length
            if (strlen($retval) < 4 || strlen($retval) > 7) {
                displayError($fieldName, "Words must be between 4 and 7 characters in length");
            }
            if(preg_match("/^[A-Za-z]+$/i", $retval) == 0){
                displayError($fieldName, "words must consist only of letters");
            }
        }
        //make the string uppercase, and shuffle it.
        $retval = strtoupper($retval);
        $retval = str_shuffle($retval);
        return $retval;
    }
    //add the validity of words 1-4 to $words 
    $words[] = validateWord($_POST['word1'],"Word 1");
    $words[] = validateWord($_POST['word2'],"Word 2");
    $words[] = validateWord($_POST['word3'],"Word 3");
    $words[] = validateWord($_POST['word4'],"Word 4");
    //display validity
    if($errorCount > 0){
        echo "Please use the \"Back\" button to re-enter any missing data.<br>\n";
    }
    else{
        $wordNum = 0;
        foreach($words as $word){
            echo "Word ". ++$wordNum . ":$word<br>\n";
        }
    }
    ?>
</body>

</html>
