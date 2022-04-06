<?php
require_once "sp_connect.php";
 
$FirstName = $MiddleName = $LastName = $Birthday_err = $Address_1 = $Address_2 = "";
$FirstName_err = $MiddleName_err = $LastName_err = $Birthday_err =  $Address_1_err = $Address_2_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate First Name
    $input_FirstName = trim($_POST["FirstName"]);
    if(empty($input_FirstName)){
        $FirstName_err = "Please enter the first name.";
    } elseif(!filter_var($input_FirstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $FirstName_err = "Please enter a valid input.";
    } else{
        $FirstName = $input_FirstName;
    }
    
    // Validate Middle Name
    $input_MiddleName = trim($_POST["MiddleName"]);
    if(empty($input_MiddleName)){
        $MiddleName_err = "Please enter the middle name.";
    } elseif(!filter_var($input_MiddleName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $MiddleName_err = "Please enter a valid input.";
    } else{
        $MiddleName = $input_MiddleName;
    }

    // Validate Last Name
    $input_LastName = trim($_POST["LastName"]);
    if(empty($input_LastName)){
        $LastName_err = "Please enter the last name.";
    } elseif(!filter_var($input_LastName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $LastName_err = "Please enter a valid input.";
    } else{
        $LastName = $input_LastName;
    }

    // Validate Birthday
    $input_Birthday = trim($_POST["Birthday"]);
    if(empty($input_Birthday)){
        $Birthday_err = "Please enter your birthday.";
    } else{
        $Birthday = $input_Birthday;
    }

    // Enter Region
    $input_Address_1 = trim($_POST["Address_1"]);
    if(empty($input_Address_1)){
        $Address_1_err = "Please enter your region.";     
    } else{
        $Address_1 = $input_Address_1;
    }
    
    // Enter City
    $input_Address_2 = trim($_POST["Address_2"]);
    if(empty($input_Address_2)){
        $Address_2_err = "Please enter your city.";     
    } else{
        $Address_2 = $input_Address_2;
    }
    
    if(empty($FirstName_err) && empty($MiddleName_err) && empty($LastName_err) && empty($Birthday_err) && empty($Address_1_err) && empty($Address_2_err)){
        $sql = "INSERT INTO student_info (FirstName, MiddleName, LastName, Birthday, Address_1, Address_2) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_FirstName, $param_MiddleName, $param_LastName, $param_Birthday, $param_Address_1, $param_Address_2);
            
            $param_FirstName = $FirstName;
            $param_MiddleName = $MiddleName;
            $param_LastName = $LastName;
            $param_Birthday = $Birthday;
            $param_Address_1 = $Address_1;
            $param_Address_2 = $Address_2;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: main_interface.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="FirstName" class="form-control <?php echo (!empty($FirstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $FirstName; ?>">
                            <span class="invalid-feedback"><?php echo $FirstName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="MiddleName" class="form-control <?php echo (!empty($MiddleName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $MiddleName; ?>">
                            <span class="invalid-feedback"><?php echo $MiddleName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="LastName" class="form-control <?php echo (!empty($LastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $LastName; ?>">
                            <span class="invalid-feedback"><?php echo $LastName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="date" name="Birthday" class="form-control <?php echo (!empty($Birthday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Birthday; ?>">
                            <span class="invalid-feedback"><?php echo $Birthday_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <input type="text" name="Address_1" class="form-control <?php echo (!empty($Address_1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Address_1; ?>">
                            <span class="invalid-feedback"><?php echo $Address_1_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="Address_2" class="form-control <?php echo (!empty($Address_2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Address_2; ?>">
                            <span class="invalid-feedback"><?php echo $Address_2_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <a href="main_interface.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>