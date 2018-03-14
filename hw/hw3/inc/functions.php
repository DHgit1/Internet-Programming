<?php    
    session_start();
    if (!isset($_SESSION["fail"])) {
        $_SESSION["fail"] = 0;
    }
    if(isset($_POST['submit'])){
        $error = false;
        $nameErr = $emailErr = $pswErr = $pswrepeatErr = $pineappleErr = $selectErr= "";
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $error = true;
        } else {
            test_name($_POST["name"]);
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $error = true;
        } else {
            test_email($_POST["email"]);
        }
        if (empty($_POST["psw"])) {
            $pswErr = "Password is required";
            $error = true;
        }
        if (empty($_POST["psw-repeat"])) {
            $pswrepeatErr = "Repeated Password is required";
            $error = true;
        }
        if (empty($_POST["pineapple"])) {
            $pineappleErr = "An answer is required";
            $error = true;
        }
        if (empty($_POST["select"])) {
            $selectErr = "Please choose a topping";
            $error = true;
        }
        if($_POST["psw-repeat"] != $_POST["psw"]){
            $pswrepeatErr = $pswErr = "Passwords do not match";
            $error = true;
        } else {
            if (strlen($_POST["psw"]) < 8){
                $pswrepeatErr = $pswErr = "Password must be at least 8 characters long";
                $error = true;
            } 
        }
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['psw'] = $_POST['psw'];
        $_SESSION['psw-repeat'] = $_POST['psw-repeat'];
        $_SESSION['remember'] = $_POST['remember'];
        $_SESSION['pineapple'] = $_POST['pineapple']; 
        $_SESSION['select'] = $_POST['select'];
    }
    $select = array();
    array_push($select,
    "Choose One","Pepperoni","Sausage","Ham",
    "Chicken","Anchovies","Sardines","Pineapple",
    "Green Peppers","Olives","Coriander");
    function test_name($name){
        global $nameErr;
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
            $error = true;
        }
    }
    function test_email($email){
        global $emailErr;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $error = true;
        }
    }
    function no_errors($check) {
        global $error;
        if (!$error)
            return true;
        if($check == true)
            $_SESSION["fail"]++;
        return false;
    }
    function fails() {
        if($_SESSION['fail'] > 0) {
            echo "It took you ". $_SESSION['fail']." failed attempt(s) to signup!";
            $_SESSION['fail'] = 0;
        }
    }
    function display() {
        global $select;
        if(isset($_POST['submit'])) {
            if (no_errors(true)) {
                echo "<div id='complete'>";
                echo "<h1>Welcome ".$_SESSION['name']."!</h1>";
                echo "<p>We hope you'll enjoy The Daily Slice of pizza related news, 
                including the best recipes for ". $select[$_SESSION['select']]." Pizza!</p>";
                if($_SESSION['pineapple'] == 'yes') {
                    echo "<p>Thank you for not being a pineapple hater.
                     We here at The Daily Slice love a classic Hawaiin pizza ourselves!</p>";
                }
                else {
                    echo "<p>We'll remember not to send any pizza news with pineapples just for you!</p>";
                }
                echo "</div><br />";
            }
        }
    }
?>