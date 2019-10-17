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
    <title>Registration</title>

</head>
<style>
    #info-para{
        margin-top: 50px;
    }
    #form{
        margin-left: 10%;
        margin-right: 10%;
        margin-bottom: 70px;
    }
    #btnsubmit{
        position: center;
    }

</style>
<body>
<?php
class formHandling{
    public $firstName;
    public $lastName;
    public $email;
    public $cnic;
    public $password;
    public $confirmPassword;
    public $address;
    public $firstNameErr;
    public $lastNameErr;
    public $emailErr;
    public $cnicErr;
    public $passwordErr;
    public $addressErr;

    public function __construct(){
        $this->firstName=$this->lastName=$this->email=$this->password=$this->confirmPassword=$this->address=null;
        $this->firstNameErr=$this->lastNameErr=$this->emailErr=$this->passwordErr=$this->confirmPasswordErr=$this->addressErr=null;

    }
    function getFormData(){
        $this->firstName=$_POST["fname"];
        $this->lastName=$_POST["lname"];
        $this->email=$_POST["email"];
        $this->cnic=$_POST["cnic"];
        $this->password=$_POST["password"];
        $this->confirmPassword=$_POST["cpassword"];
        $this->address=$_POST["address"];

    }
    function validateName($name){
    if (preg_match("/^[a-zA-z]+$/",$name)){
      return true;
    }
    return false;
  }

  //validating cnic
  function validateCnic(){
    if (preg_match("/\d{5}-\d{7}-\d{1}/",$this->cnic)){
      return true;
    }
    return false;
  }

  //validating password
  function validatePassword(){
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$this->password)){
      return true;
    }
    return false;
  }

  //validating if password and confirm password matches
  function matchPasswordAndConfirmPassword(){
    if ($this->password===$this->confirmPassword){
      return true;
    }
    return false;
  }

  //validating email address
  function validateEmail(){
    if(filter_var($this->email,FILTER_VALIDATE_EMAIL)){
      return true;
    }
    return false;
  }
  /////Insersion Data into DataBase
  public function insertData()
  {
      if(!$this->validateName($this->firstName)){
          $this->firstNameErr="First Name is not valid";
          return;
      }
      if(!$this->validateName($this->lastName)){
          $this->lastNameErr="Last Name is not valid";
          return;
      }
      if(!$this->validateCnic()){
          $this->cnicErr="CNIC is not valid";
          return;
      }
      if(!$this->validatePassword()){
          $this->passwordErr="Password is not Valid";
          return;
      }
      if(!$this->matchPasswordAndConfirmPassword()){
          $this->passwordErr="Confirm Password does Not Match";
          return;
      }
      if(!$this->validateEmail()){
          $this->emailErr="Email is not valid";
          return;
      }

      $servername="localhost";
      $username="root";
      $password="";
      $dbName="library_management_system";
      $conn=new mysqli($servername,$username,$password,$dbName);

      if($conn->connect_error){
          die("Connection Failed: ".$conn->connect_error);
      }
      $sql="INSERT INTO `userregistration`(`firstName`,`lastName`,`email`,`cnic`,`password`,
      `address`,`forgotPasswordCode` ) VALUES('$this->firstName','$this->lastName','$this->email',
      '$this->cnic','$this->password','$this->address','0')"; 
      if($conn->query($sql)==TRUE){
          echo "Registred Successfully";
      }
      else{
          echo"ERROR: " .$sql."<br>".$conn->error;
      }
      $conn->close();
      header("location:Home.php");
  }



}
/////End Of FormClass
$formhandling=new formHandling();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $formhandling->getFormData();
    $formhandling->insertData();
}
?>
     <div class="fluid_container">
        <div class="col-xs-12 text-center text-primary" id="info-para">
        <h2>Want to Register with the Library</h2>
        <p>Please Enter the following Information</p>
      </div >
      <form  id="form" class="registration-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
      method="post">
            <div class="form-group">
                <label for="fname">First Name:</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->firstNameErr;?></span>
                <input 
                type="text" 
                class="form-control" 
                value="<?php echo $formhandling->firstName; ?>"
                id="fname" 
                placeholder="First Name" 
                name="fname"
                required>
                


            </div>
            <div class="form-group">
                <label>Second Name:</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->lastNameErr;?></span>
                <input 
                type="text" 
                class="form-control" 
                id="lname" 
                value="<?php echo $formhandling->lastName; ?>"
            
                placeholder="Second Name" 
                name="lname" 
                required>
                </div>
            <div class="form-group">
                <label>Email:</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->emailErr;?></span>
                <input type="email" 
                class="form-control" 
                id="email" 
                value="<?php echo $formhandling->email; ?>"
            
                placeholder="Email" 
                name="email" 
                required>
                
                 <small id="emailHelp" class="form-text text-muted"
            >We'll never share your email with anyone else.</small>
           
            </div>
            
            <div class="form-group">
                <label>CNIC:</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->cnicErr;?></span>
                <input type="text" 
                class="form-control" value="<?php echo $formhandling->cnic; ?>"
            
                id="cnic" 
                placeholder="CNIC" 
                name="cnic" 
                required>
                 <small id="emailHelp" class="form-text text-muted"
            >We'll never share your CNIC with anyone else. Format should be
            xxxxx-xxxxxxx-x</small
          >
            </div>
            <div class="form-group">
                <label>Password:</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->passwordErr;?></span>
                <input type="password" 
                class="form-control" 
                id="password" value="<?php echo $formhandling->password; ?>"
            
                placeholder="Password" 
                name="password" required>
                <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>

                
          <span class="error text-danger">
           <?php echo $formhandling->passwordErr;?></span>
                <input type="password" 
                class="form-control" 
                id="cpassword" value="<?php echo $formhandling->confirmPassword; ?>"
            
                placeholder="Confirm Password" 
                name="cpassword" 
                required>
                 <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
            </div>
            
            <div class="form-group">
                <label>Address</label>
                
          <span class="error text-danger">
           <?php echo $formhandling->addressErr;?></span>
                <input type="text" 
                class="form-control" 
                id="address" 
                value="<?php echo $formhandling->address; ?>"
            
                placeholder="Address" 
                name="address" 
                required>
                <small id="emailHelp" class="form-text text-muted"
            >Don't worry, Your address will only be used for book shipping
            purpose</small
          >
            </div>
            <div id="btnsubmit">
                <button type="submit" class="btn btn-primary  btn-block">submit</button>
            </div>

        
        </form>
    </div>
    <?php 
      include("footer.php");
      ?>
   
</body>
</html>