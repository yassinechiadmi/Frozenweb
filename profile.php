<?php require('include/head.php');?>
<head>
<link rel="stylesheet" href ="static/register.css"/>
</head>
<body>

<?php
	require("include/nav.php");
	require('include/connect_db.php');
    require('backend/interactDB.php');
	if(isset($_SESSION['username'])){
?>

    <div class="text-background">
        <h4>Highest scores :</h4>
        <ul role="list">
            <li>Easy : </li>
            <li>Medium : </li>
            <li>Hard : </li>
        </ul>
        <br>
        <form method="post" id="edit-username-form" class="dropdown-form" 
            action="<?php edit_username();?>">

            <label>Change username - current : <?php  echo $_SESSION['username']; ?></label>  
            <input name="username" class="dropdown-input" type="text"> 
        </form>
        <form method="post" id="edit-password-form" class="dropdown-form"
            action="<?php edit_password();?>">
            <label>Change Password : </label>
            <input type="password" name="password" class="dropdown-input"> 
        </form>
    </div>

<?php
    }
	
	if (!$connexion) {
		echo "Error while logging in".mysqli_connect_errno();
		die();
	}
	
?>

 

</body>
</html>