<?php
require_once 'connection.php';
// Define variables to store user input
$FIRST_NAME = $LAST_NAME = $email = $CONTACT = $PASSWORD = $CONFIRM_PASSWORD = '';

// Define variables to store error messages
$FIRST_NAME_error = $LAST_NAME_error = $email_error = $CONTACT_error = $PASSWORD_error = $CONFIRM_PASSWORD_error = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
     $FIRST_NAME = test_input($_POST['FIRST_NAME']);
     $LAST_NAME = test_input($_POST['LAST_NAME']);
     $email = test_input($_POST['email']);
     $CONTACT = test_input($_POST['CONTACT']);
     $PASSWORD = test_input($_POST['PASSWORD']);
     $CONFIRM_PASSWORD = test_input($_POST['CONFIRM_PASSWORD']);
     // Validate first name
     if (empty($FIRST_NAME)) 
     {
         $FIRST_NAME_error = "Name is required";
     } 
     else 
     {
         $FIRST_NAME = test_input($_POST["FIRST_NAME"]);
         // Check if name contains only letters and whitespace
         
     }
     //Validate last name
     if (empty($LAST_NAME)) 
     {
         $LAST_NAME_error = "";
     } 
     else 
     {
         $LAST_NAME = test_input($_POST["LAST_NAME"]);
         // Check if name contains only letters and whitespace
         
     }
     // Validate email
     if (empty($email)) 
     {
         $email_error = "Email is required";
     } 
     else 
     {
        $email = test_input($_POST["email"]);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $email_error = "Invalid email format";
        }
     }
     //Validate Contact
     if(empty($CONTACT))
     {
        $LAST_NAME_error = "";
     }
     else
     {
        $CONTACT = test_input($_POST["CONTACT"]);
        $valid_number = filter_var($CONTACT, FILTER_SANITIZE_NUMBER_INT);
        if(strlen($CONTACT)>11)
        {
            $CONTACT_error = 'Mobile number must have ten integers';
        }
     }
    
     $PASSWORD_hash = password_hash($PASSWORD, PASSWORD_DEFAULT);
     // Validate password
     if (empty($PASSWORD)) 
     {
         $PASSWORD_error = "Password is required";
     } 
     else 
     {
         $PASSWORD = test_input($_POST["PASSWORD"]);
         if (strlen($PASSWORD)>9) 
         {
             $PASSWORD_error = 'Password must be at least 9 characters';
         }
     }
     $CONFIRM_PASSWORD_hash = password_hash($CONFIRM_PASSWORD, PASSWORD_DEFAULT);

     // Validate confirm password
     if (empty($CONFIRM_PASSWORD)) 
     {
         $CONFIRM_PASSWORD_error = "Password is required";
     } 
     else 
     {
         $CONFIRM_PASSWORD = test_input($_POST["CONFIRM_PASSWORD"]);
         // Check if passwords match
         if($_POST["PASSWORD"] != $_POST["CONFIRM_PASSWORD"])
         {
            $CONFIRM_PASSWORD_error = 'Password do not match';
         }
     }
     if (empty($FIRST_NAME_error) && empty($LAST_NAME_error) &&  empty($email_error) && empty($CONTACT_error) && empty($PASSWORD_error) && empty($CONFIRM_PASSWORD_error))
     {
        $query = "INSERT INTO user_details (FIRST_NAME, LAST_NAME, CONTACT, email, PASSWORD, CONFIRM_PASSWORD) 
               VALUES (:FIRST_NAME, :LAST_NAME, :CONTACT, :email, :PASSWORD, :CONFIRM_PASSWORD)";
     $stmt = $con->prepare($query);
     $result = $stmt->execute([
         ':FIRST_NAME' => $FIRST_NAME,
         ':LAST_NAME' => $LAST_NAME,
         ':CONTACT' => $CONTACT,
         ':email' => $email,
         ':PASSWORD' => $PASSWORD,
         ':CONFIRM_PASSWORD' => $CONFIRM_PASSWORD]);
         if ($result) {
             echo "You have registered successfully";
         } else {
             echo "Some error occurred.";
         }
 }
      
         else 
         {
        
            // Display error messages
            echo "Sorry, there was an error in submitting the form.<br>";
            echo $FIRST_NAME_error . "<br>";
            echo $LAST_NAME_error . "<br>";
            echo $CONTACT_error . "<br>";
            echo $email_error. "<br>";
            echo $PASSWORD_error. "<br>";
            echo $CONFIRM_PASSWORD_error. "<br>";
        
        } 
    header("location: success.php");
    exit();
 }
       
  //Function to sanitize input data
 function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }

?>