<?php
require "header.php";

DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

if(!isset($_SESSION)){
    session_start();
}

if (isset($_POST['submit']))
{
    $user = trim ($_POST['uname']);
    $passwd = trim ($_POST['pword']);
    $errorMessage = "";

    $dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if(mysqli_connect_errno())
    {
        echo "<p>Error creating database connection: </p>";
        exit;
    }

    //SELECT email, pass, privilege FROM users WHERE email= 'DATABASE_EMAIL' AND pass=sha1('DATABASE_PASSWORD2') AND active='yes'a045b7efa463c6ed195c644163f4168952fbd34a;"

    $sql = "SELECT email, pass, privilege FROM users WHERE email = '$user' AND pass=sha1('$passwd') AND active = 'yes'";
    $result = $dbcn->query( $sql );

    if(!$result)
    {
        echo( "<p>Unable to query database at this time.</p>" );
        exit();
    }
    $numRows = $result->num_rows;
    if($numRows > 0)
    {
        $row = $result->fetch_assoc();
        if($row['privilege'] == "admin")
        {
            $_SESSION['loggedIn'] = "adminIN";
            header("Location: index.php");
            $errorMessage = "";

        }
        else if($row['privilege'] == "user")
        {
            $_SESSION['loggedIn'] = "userIN";
            header("Location: index.php");
            $errorMessage = "";
        }
    }
    else
        $errorMessage = "User name or password is incorrect";
}
?>

    <head>
        <link href="css/login_style.css" rel="stylesheet" type="text/css">
    </head>
    <div id="container">
        <div id="loginDiv">
                <form action="" method="post" name="myForm">
                    <fieldset id="field">
                        <legend>Login</legend>
                        <span id='errorMessage'><br/><?php echo (isset($errorMessage));?><br /></span>
                        <label>Email:</label>
                        <input id="user" type="text" name="uname" /><br />
                        <label>Password:</label>
                        <input id="password" type="password" name="pword" /><br />
                        <input id="sub" type="submit" value="Submit" name="submit" />

                        <div id="forgot-links">
                            <a href="forgot_password.php">Forgot Password</a> |
                            <a href="register.php">Create Account</a>
                        </div><br />
                    </fieldset>
                </form>
        </div>
    </div>
<?php
require "footer.php";
?>