<html>

<head>
    <!--
      Project 02_03_01

      Author: Mason Roberts
      Date:   11/06/17

      Filename: CompareStrings.php
   -->
    <title>Compare Strings</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Compare Strings</h2>
    <?php
        $firstString = "Geek2Geek";
        $secondString = "Geezer2Geek";
        //if niether the first string nor the second string is empty,
        if( !empty($firstString) && !empty($secondString)){
            if($firstString == $secondString){
                echo "<p>Both strings are the same.</p>";
            }
            else{
                echo "Both strings have " .
                    //similar_text counts the differences between the two strings. 
                    similar_text($firstString,$secondString) . 
                    " character(s) in common.</p>";
                echo "<p>You must change " . 
                    //levenshtein counts the differences in characters between the strings.
                    levenshtein($firstString, $secondString) . " character(s) to make the strings the same.</p>";
            }
        }
        else {
            echo "<p>Either the \$firstString variable or the \$secondString variable does not contain a value so the two strings cannot be compared</p>";
        }
    ?>
</body>

</html>
