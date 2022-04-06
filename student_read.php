<?php
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    require_once "sp_connect.php";
    
    $sql = "SELECT * FROM student_info WHERE ID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["ID"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $FirstName = $row["FirstName"];
                $MiddleName = $row["MiddleName"];
                $LastName = $row["LastName"];
                $Birthday = $row["Birthday"];
                $Address_1 = $row["Address_1"];
                $Address_2 = $row["Address_2"];
            } else{
                header("Error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    header("Error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>First Name</label>
                        <p><b><?php echo $row["FirstName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>MiddleName</label>
                        <p><b><?php echo $row["Middlename"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>LastName</label>
                        <p><b><?php echo $row["LastName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <p><b><?php echo $row["Birthday"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Region</label>
                        <p><b><?php echo $row["Address_1"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <p><b><?php echo $row["Address_2"]; ?></b></p>
                    </div>
                    <p><a href="main_interface.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>