<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db="profile";


	$name=$_POST['fullname'];
	$emailAdd=$_POST['emailAdd'];
	$phone=$_POST['phone'];
	$bday=$_POST['bday'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];



    if (empty($_POST["fullname"])) {  
        $nameErr = "Name is required";   
   }  else{  
       $name = $_POST["fullname"];  
           if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
        $nameErr = "Only alphabets and white space are allowed";  
           }  
   }  
     
   //Email Validation   
   if (empty($_POST["emailAdd"])) {  
        $emailErr = "Email is required";   
   } else {  
           $email = $_POST["emailAdd"];   
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";   
           }  
    }  
   
   //Number Validation  
   if (empty($_POST["phone"])) {  
    $mobilenoErr = "Mobile no is required";  
   } else {  
           $mobileno = $_POST["phone"];   
           if (!preg_match ("/^[0-9]*$/", $mobileno) ) {  
            $mobilenoErr = "Only numeric value is allowed.";  
           }   
       if (strlen ($mobileno) != 10) {  
           $mobilenoErr = "Mobile no must contain 10 digits.";  
           }  
    
   } 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=profile", $username, $password);


        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO profileDetails(fullname,email,contact,bday,age,gender)
          VALUES ('$name','$emailAdd','$phone','$bday','$age','$gender')";

        $conn->exec($sql);
        echo json_encode(array("statusCode"=>200));
        
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        echo json_encode(array("statusCode"=>201));
      }
      
        $conn = null;
 
   
   
    
	
    
?>
 