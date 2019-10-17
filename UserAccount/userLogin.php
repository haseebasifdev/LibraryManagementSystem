<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>User Login</title>
    <style>
        #btnsubmit{
            width: 25%;
            margin-left: 38%;
        }
        .fluid-container{
            margin-top: 10%; 
        }
        .form-group{
            margin-left: 20%;
            margin-right:20%;
        }
        .media-body{
            margin-top: 1%;
            text-align: center
        }
    </style>
</head>
<body>
    
    <?php
    class LoginHandler{
        private $email;
        private $password;
        public $error;

        public function __construct(){
            $this->email=null;
            $this->password=null;
            $this->error=null;
        }
        public function getFormData(){
            $this->email=$_POST["email"];
            $this->password=$_POST["password"];
        }
        public function validateCredentials(){
            $servername="localhost";
            $username="root";
            $password="";
            $dbName="library_management_system";
            $conn=new mysqli($servername,$username,$password,$dbName);

            if($conn->connect_error){
                die("Connection Failed: ".$conn->connect_error);
            }
            $sql="SELECT * FROM `userregistration` WHERE `email`='$this->email' and `password`='$this->password'";
            $result=$conn->query($sql);
            $conn->close();
            if(!$result){
                echo"Null Object";
            }
            if($result->num_rows>0){
                
                $_SESSION["email"]=$this->email;
                
                echo "Registered";
            }
            else{
                
                $_SESSION["email"]=null;
                echo "Email Not Registered";
            }
        }

    }
    $loginHandle=new LoginHandler();

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $loginHandle->getFormData();
    $loginHandle->validateCredentials();
  }
    
    ?>
    <div class="fluid-container">
         <div class="col-xs-12 text-center text-primary" id="info-para">
        <h2>Login Here</h2>
      </div >
      <form class="login" method="post" action="<?php 
      echo htmlspecialchars($_SERVER["PHP_SELF"])
      
      ?>">
      <div class="form-group" >
          <label for="inoutemail" >Enter Your Email</label>
      <input
      type="email"
      name="email"
      class= "form-control"
      id="useremail"
      placeholder="Email"
      require
      /> 
      </div>
      
      <div class="form-group" >
      <label for="inputemail" >Enter Your Password</label></label>
      <input
      type="password"
      name="password"
      class= "form-control"
      id="useremail"
      placeholder="Password"
      require
      /> 
      </div>
        </div>
      
        <div id="btnsubmit" class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
      
      <div class="media position-relative">
            <div class="media-body">
              <a href="#" class="stretched-link">Forgot Password</a>
             </div>
      </div>
      <div class="media position-relative">
            <div class="media-body">
              <a href="userregistration.php" class="stretched-link">Not Registred Yet</a>
             </div>
      </div>
      </form>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</body>
</html>