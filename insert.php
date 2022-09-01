<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['gender']) && isset($_POST['email']) &&
        isset($_POST['phoneCode']) && isset($_POST['phone'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phoneCode = $_POST['phoneCode'];
        $phone = $_POST['phone'];
        if (!empty($username)|| !empty($password) || !empty($gender) || !empty($email)|| !empty($phonecode) || !empty($phone))
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "youtube";
    
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if (mysqli_connect_error()) {
            die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)";
        
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $rnum = $stmt->num_rows;
           
            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssii",$username, $password, $gender, $email, $phoneCode, $phone);
                $stmt->execute();
                echo "registration successfully completed.";
                
            }else {
            
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
            
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>
<p>New <a href="login.php">login</a> or <a herf="register.php">register</a></p>
