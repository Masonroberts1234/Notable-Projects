<html>

<head>
    <!--
      Project 02_05_01

      Author: Mason Roberts
      Date:   12/08/17

      Filename: ShowUsers.php
   -->
    <title>Show Users</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Show Users</h2>
    <hr>
    <?php
    $dir = "./users";//set the path to comments
    if(is_dir($dir)){
        $fileName = "userInfo.txt";
        $fileHandle = fopen($dir . "/" . $fileName, "rb");
                    if ($fileHandle === false) {
                echo "There was an error reading file \"$fileName\".<br>\n";
            }
        else{
            while(!feof($fileName)){
                $name = fgets($fileHandle);
                echo "Name: " . htmlentities($name) ."<br>\n"; //but you can put them there if you really have to.
                $password = fgets($fileHandle);//each time this is called the pointer goes to the next line
                echo "Password: " . htmlentities($password) ."<br>\n"; 
                $username = fgets($fileHandle);
                echo "Username: " . htmlentities($username). "<br>\n";
                $email = fgets($fileHandle);
                echo "Email: " . htmlentities($email). "<br>\n";
                $age = fgets($fileHandle);
                echo "Age: " . htmlentities($age). "<br>\n";
                $screenName = fgets($fileHandle);
                echo "Screenname: " . htmlentities($screenName). "<br>\n";
                $comment = fgets($fileHandle);
                while($comment !== ""){ //while pointer not at the end of file
                    $comment .= fgets($fileHandle);//adds the fgets to $comment
                }
                echo htmlentities($comment);
                //echo "Message: ".htmlentities($comment[3]);
                echo "<hr>\n";
            }
        }
        fclose($fileHandle);
    }
    ?>
</body>

</html>
