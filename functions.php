<?php

//To show all error messages remove the next line
//error_reporting(0);


if (isset($_GET['checkout']) && $_SESSION['username'] != null) {

checkout();
}
function checkout () {

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "DELETE FROM cart WHERE Username='" . $_SESSION['username'] . "'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";

        runMyFunction();
        header('Location: home.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}




global $home;

if ( $_SESSION['username'] != null) {
        check();
}


if (isset($_GET['do']) && $_SESSION['username'] == null) {
    header('Location: ' . $home . '.php');
}

if (isset($_GET['user'])) {
    echo "Logged out";
    global $name;
    global $pass;
    $_POST['username2'] = 0;
    $_POST['password3'] = 0;
    $_SESSION['username'] = null;
    $_SESSION['varname'] = 0;
    header('Location: ' . $home . '.php');

}




if ( ! empty($_POST['username2'])){
    $name = ($_POST['username2']);
    checkPass();
}
if (empty($_POST['username2'])){
    echo "<script type='text/javascript'>
reslogin();
 </script>";
}

if ( $_SESSION['username'] != null) {

    global $name;
    $name = $_SESSION['username'];

    echo "<script type='text/javascript'>
document.getElementById('signin0').innerHTML = 'You are logged in as ' +  $name + '<br>' +  var2;
 </script>";
}




function checkPass () {

    $username = "root";
    $password = "root";
    $dbname = "mydb";
    $servername = "localhost";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $usrn = $row["Username"];
            $name = ($_POST['username2']);
            $pass = ($_POST['password3']);
            switch ($usrn) {
                case ($usrn == $name):
                    $pass2= $row["Password"];

                    global $used;
                    $used = "Your Username was accepted!";
                    if ($pass2 == $pass) {
                        global $used3;
                        $used3 = "Your Password accepted.";
                        global $name;
                        $_SESSION['username'] = $name;
                        echo "<script type='text/javascript'>
document.getElementById('signin0').innerHTML = 'You are logged in as ' +  $name ;
 </script>";

                        runMyFunction();

                        //header('Location: ' . $home . '.php');

                    }
                    else {global $used3;$used3 = "<br> Your Password was denied.";}
                    break;
                case ($usrn != $name):
                    global $used;
                    if ($used == "Your Username was accepted!") {}
                    else {$used = "Your Username is incorrect.";}
                    break;

            }

        }
    }
    else {
       // echo "No results found in table.";
    }
}
$conn->close();







function insertInfo2 () {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";


    //$_SESSION['checkout2']++;


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "UPDATE cart SET Amount='" . $_SESSION['checkout2'] . "' WHERE Username='" . $_SESSION['username'] . "' AND Item='" . $_SESSION['checkout'] . "'";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        //global $home;
        //header('Location: ' . $home . '.php');
    } else {
        //global $error;
        //$error = "Error: " . $sql . "<br>" . $conn->error;
    }



}



function check () {

    $link = new PDO("mysql:host=localhost;dbname=mydb",'root','root');

    $statement = $link->prepare("SELECT username FROM stPatrick WHERE username = :name AND password = :password");
    $statement->bindParam(':name', $_POST['username2']);
    $statement->bindParam(':password', $_POST['password3']);
    $statement->execute();
    if($statement->rowCount() > 0){










       echo "You have logged in successfully.";








    }
    else {
        echo "You're username or password is incorrect!";
    }
    //header('Location: home.php');

}


function insertInfo () {
    $dbhost = "localhost";
    $dbname = "mydb";
    $dbusername = "root";
    $dbpassword = "root";


    $link = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword);

    $statement = $link->prepare("INSERT INTO stPatrick (username, password)
    VALUES(:fname, :sname)");
    $statement->execute(array(
        "fname" => $_POST['username'],
        "sname" => $_POST['password']
    ));


    runMyFunction();
}




//check the amount of items in a cart
function runMyFunction () {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM cart WHERE Username='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // if it find an item has already been made, up date it.
            //echo "Amount = " . $row['Amount'] . ",";


            $_SESSION['checkout2'] = $row['Amount'];
            // echo $_SESSION['checkout2'];

            $_SESSION['foof'] = $_SESSION['foof'] + $_SESSION['checkout2'];
            //echo "foof = " . $_SESSION['foof'] . ",";

        }
        $_SESSION['varname'] = $_SESSION['foof'];
        $_SESSION['foof'] = 0;
    }
    else {
        $_SESSION['varname'] = 0;
    }
    global $home;
    //header('Location: ' . $home . '.php');
}


$conn->close();
//session_destroy();
 ?>