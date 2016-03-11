<?php
//create "session" to store variables after page refresh
session_start();
?>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-2.1.4.min.js"> </script>
<script src="script.js"></script>
<h1>
Log into the website
</h1>

        <form name='form2' method='post' id='form2'>
            <input type='text' name='username2' id='username2' placeholder='Username'>
            <input type='password' name='password3' id='password3' placeholder='Password'>
        </form>





 <button onclick='signin()' > Sign In! </button>


















<?php
global $home;
$home = 'home';
require "functions.php";



session_destroy();
?>









