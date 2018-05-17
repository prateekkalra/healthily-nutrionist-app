<?php
require_once('lib/FatSecretAPI.php');
require_once('lib/config.php');

$API = new FatSecretAPI(API_KEY, API_SECRET);

$token;
$secret;
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutritionist_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$login_error ="";
if(isset($_POST["submit_signup"])) {


    $email_signup = $_POST["email_signup"];
    $password_signup = $_POST["password_signup"];
    $cpassword_signup = $_POST["cpassword_signup"];
    $name_signup = $_POST["name_signup"];

    //CREATING PROFILE FS

    try{
        $API->ProfileCreate($email_signup, $token, $secret);
        $API->ProfileGetAuth($email_signup, $token2, $secret2);

//        print '<div>Success</div>';
    }
    catch(Exception $ex)
    {
        print '<div>Error: ' . $ex->getCode() . ' - ' . $ex->getMessage() . '</div>';
    }

    //DB



    $signup_sql = "INSERT INTO users(email,name,password,auth_token,auth_secret) VALUES ('$email_signup','$name_signup','$password_signup','$token2','$secret2')";
    $conn->query($signup_sql);






}
if(isset($_POST["submit_login"])){
    $email_login = $_POST["email_login"];
    $password_login = $_POST["password_login"];



    $login_sql = "SELECT userid,name,password,auth_token,auth_secret from users where email='$email_login'";
    $result = $conn->query($login_sql);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        if($row["password"]==$password_login){
//          header("Location: mainpage.php");
            $name = $row["name"];

          $auth = array('user_id'=>$email_login,'token'=>$row["auth_token"],'secret'=>$row["auth_secret"]);
//          $auth = array('user_id'=>$email_login);
          $sessionKey;

          $API->ProfileRequestScriptSessionKey($auth, null, null, null, true, $sessionKey);
//          setCookie("fatsecret_session_key", $sessionKey);
            setCookie("fatsecret_session_key", $sessionKey);
            setcookie('fname',$name);
                      header("Location: mainpage.php");

//            print $sessionKey;







        }
        else{
            $login_error="Invalid Password";
        }






    }
    else{
        $login_error="No user registered with this email";
    }











}
?>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Healthily-Your Personal Nutionist</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<!--    <link rel="stylesheet" href="css/bootstrap.css">-->
<!--    <link rel="stylesheet" href="css/bootstrap-grid.css">-->
<!--    <link rel="stylesheet" href="css/bootstrap-reboot.css">-->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<div>
    <h1 style="text-align: center;">Healthily- Your Personal Nutrionist</h1>
</div>
<div class="login-box">
    <div class="lb-header">
        <a href="#" class="active" id="login-box-link">Login</a>
        <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    <form class="email-login" method="post"  style="margin-top: 10%;">
        <div class="u-form-group">
            <input type="email" placeholder="Email" name="email_login" required/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password" name="password_login" required/>
        </div>
        <div class="u-form-group">
            <button type="submit" name="submit_login">Log in</button>
        </div>
        <div class="u-form-group">
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>
        <div class="u-form-group">
            <h5 style="color: red"><?php echo $login_error;?></h5>
        </div>

    </form>
    <form class="email-signup" method="post">
        <div class="u-form-group">
            <input type="email" placeholder="Email" name="email_signup" required/>
        </div>
        <div class="u-form-group">
            <input type="text" placeholder="Full Name" name="name_signup" required/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password" name="password_signup" required/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Confirm Password" name="cpassword_signup" required/>
        </div>
        <div class="u-form-group">
            <button type="submit" name="submit_signup">Sign Up</button>
        </div>
    </form>
</div>


<!--<script src="js/bootstrap.js"></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>




</body>

</html>

