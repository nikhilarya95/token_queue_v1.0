<?php
//     include('connectivity.php');
// $firstname=$_POST['sign_firstname'];
// $lastname=$_POST['sign_lastname'];
// $mobile=$_POST['sign_mobile'];
// $email=$_POST['sign_email'];
// $password=$_POST['sign_password'];
// $company=$_POST['sign_companyname'];
// $insertQuery= "INSERT INTO client_detail VALUES('$firstname','$lastname','$mobile','$email','$password','$company')";
// $insertedata= mysqli_query($con,$insertQuery);
// if($insertedata)
// {
//    
    
// }
?>

<?php

if(isset($_POST['cus_submitbtn']))
{
    //$tokenno= $_POST['cus_tokenno'];
    //echo $tokenno;

    $firstname=$_POST['cus_firstname'];
    $lastname=$_POST['cus_lastname'];
    $mobile=$_POST['cus_mobile'];
    $email=$_POST['cus_email'];
    $formname=$_POST['cus_formname'];
    if(!empty($firstname)||!empty($lastname)||!empty($mobile)||!empty($email)||!empty($formname))   
    {
        $host = "localhost";
        $DB_USER = "root";
        $DB_PASS = "";
        $DB_NAME = "tokenqueue";
        $con = new mysqli($host,$DB_USER,$DB_PASS,$DB_NAME);
        // Check connection
        if (mysqli_connect_error())
        {
            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        else
        {
            $tokenselect = "SELECT token_no FROM token_detail WHERE token_no = ? LIMIT 1";
            $inserttokenQuery= "INSERT INTO token_detail ( first_name, last_name, mobile, email, form_name) VALUES(?,?,?,?,?)";
            $stmt = $con->prepare($tokenselect);
            $stmt ->bind_param("s",$tokenno);
            $stmt ->execute();
            $stmt ->bind_result($tokenno);
            $stmt ->store_result();
            $rnum =$stmt->num_rows;
            if($rnum==0)
            {
                $stmt->close();
                $stmt = $con->prepare($inserttokenQuery);
                $stmt -> bind_param("sssss", $firstname, $lastname, $mobile, $email, $formname);
                $stmt ->execute();
                echo "<script>alert('Token Created')</script>";
            }
            else
            {
                echo "alert('You account is already created')";
            }
            $firstname="";
            $lastname="";
            $mobile="";
            $email="";
            $formname="";
            $stmt -> close();
            $con -> close();
    // $insertedata1= mysqli_query($con,$insertQuery1);
        }

    }
    
}
include("User.php");
exit();
?>