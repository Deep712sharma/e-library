<?php
session_start();
require_once 'connection.php';
$email = $PASSWORD = '';
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Get the submitted email and password
        $email = $_POST['email'];
        $PASSWORD = $_POST['PASSWORD'];

        try
        {
            // Retrieve user details from the database based on the provided email
            $query = $con->prepare("SELECT * FROM user_details WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            // Fetch the user record as an associative array
            $stmt = $query->fetch(PDO::FETCH_ASSOC);
            
            if ($stmt && $PASSWORD == $stmt['PASSWORD']) 
            {
                // Successful login - set up a session and redirect to a secure page
                $_SESSION["login"] = true;
                $_SESSION["email"] = $stmt['email'];
                echo <<<HTML
                <script src = "login_success.js">  </script>
                HTML;
                exit;
            } 
            else 
            {
                // Incorrect password - show an error message
                echo <<<HTML
                <script src = "invalid_alert.js">  </script>
                HTML;
            }
        }
        catch (PDOException $e) 
        {
			die("Error: " . $e->getMessage());
        }   
    }
?>