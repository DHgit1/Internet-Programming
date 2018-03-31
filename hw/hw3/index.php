<?php
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Pizza Newsletter</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="title">
            <img class="floatLeft" src="img/slice1.png" />
            <img class="floatRight" src="img/slice.png" />
            <h1 id="title1" class="logoHeader">The Daily Slice</h1>
        </div>
        <hr> <br />
        <?php
            display();
        ?>
        <form id="mainform" method="POST">
          <div class="container">
            <h1>Sign Up</h1>
            <span class="error"> <?php if(no_errors(false)) { fails(); } ?></span>
            <p>Please fill in this form to create an account and sign up for our daily newsletter.</p>
            <hr>
            <label for="name"><b>Name</b></label>
            <span class="error">* <?php echo $nameErr;?></span>
            <input type="text" placeholder="Enter Name" name="name" 
            value="<?php echo $_SESSION['name'];?>"> <br>
            <label for="email"><b>Email</b></label>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="text" placeholder="Enter Email" name="email" 
            value="<?php echo $_SESSION['email'];?>"> <br>
            <label for="psw"><b>Password</b></label>
            <span class="error">* <?php echo $pswErr;?></span>
            <input type="password" placeholder="Enter Password" name="psw" 
            value="<?php echo $_SESSION['psw'];?>"> <br>
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <span class="error">* <?php echo $pswrepeatErr;?></span>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" 
            value="<?php echo $_SESSION['psw-repeat'];?>"> <br>
            <label>
              <input type="checkbox" name="remember"
              <?php if(isset($_SESSION['remember'])) echo "checked='checked'";?>> Remember me
            </label> <br>
            <legend>Should pineapple go on a pizza? <span class="error">* <?php echo $pineappleErr;?></span></legend>
            <input id="yes" type="radio" name="pineapple" value="yes"
            <?php if($_SESSION['pineapple'] == "yes") { echo "checked=\"checked\""; } ?>>
            <label for="yes">Yes</label><br>
            <input id="no" type="radio" name="pineapple" value="no"
            <?php if($_SESSION['pineapple'] == "no") { echo "checked=\"checked\""; } ?>>
            <label for="no">No</label><br><br>
            <label for="favcity">Choose your favorite topping:</label>
            <select id="favtop" name="select">
                <?php
                    for($i=0;$i<count($select);$i++){
                        if($i==0 && isset($_SESSION['select']))
                            echo "<option value='$i'>".$select[$_SESSION["select"]]."</option>";
                        else
                            echo "<option value='$i'>$select[$i]</option>";
                    }
                ?>
            </select>
            <span class="error"> * <?php echo $selectErr;?></span> <hr>
            <p>By creating an account you agree to our Terms & Privacy Policy.</p>
            <div class="clearfix">
              <button type="reset" class="cancelbtn" name="reset" value="Reset">Cancel</button>
              <button type="submit" class="signupbtn" name="submit">Sign Up</button>
            </div>
          </div>
        </form>
        <br /> <br /> <hr>
        <div id="foot">
            <footer>
                <br /><strong>CST336 Internet Programming. By: Devin Hight</strong><br />
                <strong>This is not a real newsletter</strong>
                <br />
                <img id="otter" src="../../img/otter.png" alt="CSUMB Logo" />
            </footer>
        </div>
    </body>
</html>