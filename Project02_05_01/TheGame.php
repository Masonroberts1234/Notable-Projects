<html>

<head>
    <!--
      Project 02_05_01

      Author: Mason Roberts
      Date:   12/06/17

      Filename: TheGame.php
   -->
    <title>The Game</title>
    <script src="modernizr.custom.65897.js"></script>
    <style>
        h2 {
            font-size: 30;
            text-align: center;
            color: black;
        }

        input {
            font-size: 30;
            width: 100%;
            border: 1px solid green;
        }

        input :focus {
            border: 10px solid gray;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: none;
        }

        body {
            background-color: azure;
        }

        label {
            color: black;
            font-size: 30;
        }

        input type=submit {
            padding-top: 20;
            color: chartreuse;
        }

    </style>
</head>

<body>
    <h2>The Game</h2>
    <?php
    $errormsg = "";
    $dir = "./users";
    if(is_dir($dir)){
        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['screenname']) || empty($_POST['age']))  {
            $errormsg .= "required fields left blank<br>\n";//minimal error catch. may increase later.
        }
        else {
            $string = stripslashes($_POST['name']) . "\n";
            $password = md5($_POST['password']);
            $string .= $password . "\n";
            $string .= stripslashes($_POST['username']) . "\n";
            $string .= stripslashes($_POST['email']) . "\n";
            $string .= stripslashes($_POST['age']) . "\n";
            $string .= stripslashes($_POST['screenname']) . "\n";
            $string .= stripslashes($_POST['comments']) . "\n";
            $string .= "\n";//end of file group
            $filename = "$dir/userInfo.txt";
            $filehandle = fopen($filename, "ab");//appends to the file in bits
            if($filehandle === false){
                $errormsg .= "There was an error creating $filename<br>\n";
            }
            else{
                if(flock($filehandle, LOCK_EX)) {
                    if(fwrite($filehandle, $string) > 0){
                        $errormsg .= "Successfully wrote to $filename<br>\n";
                    }
                    else{
                        $errormsg .= "there was an error writing to $filename<br>\n";
                    }
                    flock($filehandle, LOCK_UN);
                }
                else{
                    $errormsg .= "there was an error locking $filename<br>\n";
                }
                fclose($filehandle);
            }
        }   
    }
    else{
        echo "Directory does not exist. Will create the file when good input is submitted\n";
        mkdir($dir);
        chmod($dir,0777);//setting up permissions of the directory. it will go to 666 in my sandbox, unfortunatly.
    }
    if(!empty($_POST['submit'])){
        echo $errormsg;
    }
    ?>
        <form action="TheGame.php" method="post">
            <label for="username">Username</label><input type="text" id="username" name="username"><br>
            <label for="password">Password</label><input type="password" id="password" name="password"><br>
            <label for="name">Full Name</label><input type="text" id="name" name="name"><br>
            <label for="email">Email</label><input type="text" id="email" name="email"><br>
            <label for="age">Age</label><input type="number" id="age" name="age"><br>
            <label for="screenname">Screenname</label><input type="text" id="screenname" name="screenname"><br>
            <label for="comments">Comments</label><textarea id="comments" name="comments"></textarea><br>
            <input name="submit" value="submit" type="submit">
        </form>
</body>

</html>
