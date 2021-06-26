<?php 
$user= $_POST['user'];
$password = $_POST['password'];
$mobile= $_POST['mobile'];
$email = $_POST['email'];

if(!empty($user)|| !empty($password)|| !empty($mobile)|| !empty($email)){
$host="e-rakshak.com";
$dbUsername="erakshak_snehal";
$dbpassword="erakshak_snehal";
$dbname="erakshak_snehal";

//Create connection
$conn = new mysqli($host, $dbUsername, $dbpassword, $dbname);
if(mysqli_connect_error()){
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
}
else{
        $SELECT = "SELECT email From register where email = ? Limit 1";
        $INSERT = "INSERT Into register(user, password, mobile, email) VALUES (?, ?, ?, ?)";

   //Prepare statement
   $stmt = $conn->prepare($SELECT);
   $stmt->bind_param("s",$email);
   $stmt->execute();
   $stmt->bind_result($email);
   $stmt->store_result();
   $rnum=$stmt->num_rows;

 if($rnum==0) {
     $stmt->close();
   	
     $stmt = $conn->prepare($INSERT);
     $stmt->bind_param("ssis", $user, $password, $mobile, $email);
     $stmt->execute();
     echo "New record inserted successfully";
}
else{
        echo"Someone have already registered using this email";
}
$stmt->close();
$conn->close();
}
}else{
echo"All field are required";
die();
}
?>
