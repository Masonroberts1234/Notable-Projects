<html>

<head>
    <!--
      Project 02_03_01

      Author: Mason Roberts
      Date:   11/06/17

      Filename: ValidateLocalAddress.php
   -->
    <title>Validate Local Address</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Validate Local Address</h2>
    <?php
    $email = array("jsmith123@example.org",
                  "john.smith.mail@example.org",
                  "john.smmith@example.org",
                  "john.smith@example",
                  "jsmith123@mail.example.org");
    foreach ($email as $emailAddress){
        echo "The email address     &ldquo;" . $emailAddress . "&rdquo; ";
        //if this long string equals 1 when $email address is put through it,
        if(preg_match("/^(([A-Za-z]+\d+)|" . "([A-Za-z]+\.[A-Za-z]+))" . "@((mail\.)?)example\.org$/i",$emailAddress) == 1 ) {
            echo " is a valid e-mail address.<br>";
        }
        else {
            " is not a valid email address.<br>";
        }
    }
    ?>
</body>

</html>
