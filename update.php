<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Register File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Registration Page";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
if(!isset($_SESSION['userType'])){header("Location:register.php");}
    //declare all variables
    if(isset($_SESSION))
    {
        $login = $_SESSION['userID'];
        $password = '';
        $confirmPass = '';
        $salutation = $_SESSION['salutation'];
        $firstname = $_SESSION['firstName'];
        $lastname = $_SESSION['lastName'];
        $userType = $_SESSION['userType'];
        $email = $_SESSION['emailAddress'];
        $streetAddress1 = $_SESSION['streetAddress1'];
        $streetAddress2 = $_SESSION['streetAddress2'];
        $city = $_SESSION['city'];
        $province = $_SESSION['province'];
        $postalCode = $_SESSION['postalCode'];
        $primaryPhone = $_SESSION['primaryPhoneNumber'];
        $secondaryPhone = $_SESSION['secondaryPhoneNumber'];
        $faxNumber = $_SESSION['faxNumber'];
        $contactMethod = $_SESSION['userID'];
        $error = "";
        $output = "";
    }
    if(isPost())
    {
        //trim the user input
		$login = trim($_POST["login"]);
		$password = trim($_POST["pass"]);
        $confirmPass = trim($_POST["cpass"]);
        $salutation = trim($_POST["salutations"]);
        $firstname = trim($_POST["first_name"]);
        $lastname = trim($_POST["last_name"]);
        $email = trim($_POST["email_address"]);
        $streetAddress1 = trim($_POST["street_address1"]);
        $streetAddress2 = trim($_POST["street_address2"]);
        $city = trim($_POST["city"]);
        $province = trim($_POST["provinces"]);
        $postalCode = trim($_POST["postal_code"]);
        $primaryPhone = cleanPhoneNumber(trim($_POST["primary_phone"]));
        $secondaryPhone = cleanPhoneNumbner(trim($_POST["secondary_phone"]));
        $faxNumber = cleanPhoneNumber(trim($_POST["fax_number"]));
        $contactMethod = trim($_POST["preferred_contact_method"]);
        //check if everything was entered
		if ($login == "") $error .= "<br/>No user ID entered";
		//if an existing record has the same id
        elseif (userExists($login))
		{
            $error .= "<br/>A user with that ID already exists";
            $login = "";
        }
        else
        {
            $error .= LengthValidation("id",$login);
			if(LengthValidation("id",$login) <> "") $login = "";
        }
		if ($password == "") $error .= "<br/>No user password entered";
        else
		{
			$error .= LengthValidation("pass",$password);
		}
		if (strcmp($confirmPass, $password) <> 0) $error .= "<br/>Your two password entries do not match";

		if ($firstname == "") $error .= "<br/>You did not enter your first name";
        elseif (is_numeric($firstname))
        {
            $error .= "<br/>First name cannot be a number";
            $firstname = "";
        }
        else
        {
            $error .= LengthValidation("fname",$firstname);
			// if length was not validated, reset variable
			if(LengthValidation("fname",$firstname) <> "") $firstname = "";
        }
        if ($lastname == "") $error .= "<br/>You did not enter your last name";
        elseif (is_numeric($lastname))
        {
            $error .= "<br/>Last name cannot be a number";
            $lastname = "";
        }
        else {
            $error .= LengthValidation("lname",$lastname);
			if(LengthValidation("lname",$lastname) <> "") $lastname = "";
        }
        if ($email == "") $error .= "<br/>You did not enter your email address";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error .= "<br/>Email address is not valid";
            $email = "";
        }
        else
		{
			$error .= LengthValidation("email",$email);
			if(LengthValidation("email",$email) <> "") $email = "";
		}
        if  ($primaryPhone == "") $error .= "<br/>You did not enter your primary phone number";
        else
        {
            $error .= LengthValidation("phone",$primaryPhone);
            if(LengthValidation("phone",$primaryPhone) <> "") $primaryPhone = "";
        }

        //if no errors
        if($error === "")
        {
            $password = md5($password);
            $today = date("Y-m-d",time());
            $conn = db_connect();
            if(isset($_POST["IsAgent"]) == true)
            {
                $userType = "a";
            }
            else
            {
                $userType = "c";
            }
            //create thwe username and password
            $sql = "INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access)
            VALUES ('".$login."','".$password."','".$userType."','".$email."', '".$today."', '".$today."')";
            $result = pg_query($conn, $sql);

            $personsSql = "INSERT INTO persons(user_id, salutation, first_name, last_name , street_address1, street_address2, city, province, postal_code, primary_phone_number, secondary_phone_number, fax_number, preferred_contact_method)
            VALUES ('".$login."','".$salutation."','".$firstname."','".$lastname."','".$streetAddress1."','".$streetAddress2."','".$city."','".$province."','".$postalCode."','".$primaryPhone."','".$secondaryPhone."','".$faxNumberx."','".$contactMethod."')";
            $perosonsResult = pg_query($conn,$personsSql);

            $output .= "Registration complete";
            header("Location:login.php");
            ob_flush();
        }
    }
?>
  <!-- start of main page content -->
  <div class="container">
    <div class="row" style="margin-top:75px">
      <div class="col"></div>
      <div class="col-8">
          <br/>
          <?php echo $error; ?>
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">User information for <?php echo $login ?></h5>
                  <hr/>
                  <form method="post" action="<?php sticky();?>" >

                      <!--personal information section-->
                      <div class="form-group">
                          <label> Email </label>
                          <input type="text" class="form-control" name="email_address" value="<?php echo $email; ?>" placeholder="Enter Email Address">
                          <!--Insert Salutation -->
                          <br/>
                          <label>Salutation:</label>
                          <?php echo (build_simple_dropdown("salutations","$salutation"));?>
                          <br/>
                          <!-- <label>First Name</label> -->
                          <input type="text" class="form-control" name="first_name" value="<?php echo $firstname; ?>" placeholder="Enter First Name" id="halfBoxL">

                          <!-- <label>Last Name</label> -->
                          <input type="text" class="form-control" name="last_name" value="<?php echo $lastname; ?>" placeholder="Enter Last Name" id="halfBoxR">
                          <br/>
                          <!--Ins Address -->
                          <label>Address Information</label>
                          <input type="text" class="form-control" name="street_address1" value="<?php echo $streetAddress1; ?>" placeholder="Street Address #1">
                          <br/>
                          <input type="text" class="form-control" name="street_address2" value="<?php echo $streetAddress2; ?>" placeholder="Street Address #2">
                          <br/>
                          <label>City</label>
                          <?php echo (build_dropdown("city","$city"));?>
                          <div style="width:200px; display:inline-block;"></div>
                          <label>Province</label>
                          <?php echo (build_simple_dropdown("provinces","$province"));?>
                          <br/>
                          <input type="text" class="form-control" name="postal_code" value="<?php echo $postalCode; ?>" placeholder="Postal Code">
                          <!--Contact Information-->
                          <br/>
                          <input type="text" class="form-control" name="primary_phone" value="<?php echo $primaryPhone; ?>" placeholder="Primary phone number" id="halfBoxL">
                          <input type="text" class="form-control" name="secondary_phone" value="<?php echo $secondaryPhone; ?>" placeholder="Secondary phone number" id="halfBoxR">
                          <input type="text" class="form-control" name="fax_number" value="<?php echo $faxNumber; ?>" placeholder="Fax Number">
                          <br/>
                          <?php echo(build_radio("preferred_contact_method","$contactMethod")); ?>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Register</button>
                          <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                      </div>
                  </form>
              </div>
          </div>

          <br/>
      </div>
      <div class="col"></div>
    </div>
  </div>
  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
