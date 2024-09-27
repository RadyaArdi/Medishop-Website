<?php
	session_start();
    if(isset($_POST['login'])){

        include 'database.php';
    
        // Cek username dan password di database
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    
        $query_select = "SELECT * FROM users WHERE ussername = '$username' AND password = '$password'";
        $run_query_select = mysqli_query($conn, $query_select);
    
        if(mysqli_num_rows($run_query_select) > 0){
            $d = mysqli_fetch_object($run_query_select);
            
            // Buat session
            $_SESSION['uid'] 	= $d->user_id;
            $_SESSION['uname'] 	= $d->ussername;
            $_SESSION['role']   = $d->role; // Pastikan kamu memiliki kolom role di database
    
            // Jika role adalah admin, redirect ke halaman admin
            if($d->role == 'admin'){
                header('location:admin/index.php');
            } else {
                header('location:indexm.php'); // Redirect ke halaman user jika bukan admin
            }
            exit;
    
        } else {
            echo 'Username atau password salah';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Medical Shop</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap');
		* {
			padding:0;
			margin:0;
		}
		body {
			font-family: 'Nunito Sans', sans-serif;
			background-color: #d4f1f4;
		}
		a {
			color: inherit;
			text-decoration: none;
		}
		.container {
			width: 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.card-login {
			border:1px solid #d4f1f4;
			background-color: #189ab4;
			width: 300px;
			padding: 25px 15px;
			box-sizing: border-box;
			border-radius: 5px;
		}
		.card-login h2 {
			margin-bottom: 10px;
		}
		.input-control {
			width: 100%;
			display: block;
			padding: 0.5rem 1rem;
			box-sizing: border-box;
			font-size: 1rem;
			margin-bottom: 8px;
		}
		.btn {
			display: block;
			width: 100%;
			padding: 0.5rem 1rem;
			cursor: pointer;
			font-size: 1rem;
		}
	</style>
</head>
<body>

	<!-- login -->
	<div class="container">
		<div class="card-login">
			
			<h2>Login</h2>
			<form action="" method="post">
				<input type="text" name="username" placeholder="username" class="input-control">
				<input type="password" name="password" placeholder="password" class="input-control">
				<select name="role" class="input-control">
                    <option value="" disabled selected>Select Role</option>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="login" class="btn">Login</button>
            </form >


			<?php

				// cek jika tombol login di tekan
				if(isset($_POST['login'])){

					include 'database.php';

					// cek data login
					$query_select = 'select * from users
					where ussername = "'.mysqli_real_escape_string($conn, $_POST['username']).'"
					and password = "'.mysqli_real_escape_string($conn, md5($_POST['password'])).'" ';

					$run_query_select = mysqli_query($conn, $query_select);
					$d = mysqli_fetch_object($run_query_select);

					if($d){
						
						// buat session
						$_SESSION['uid'] 	= $d->user_id;
						$_SESSION['uname'] 	= $d->ussername;

						header('location:indexm.php');

					}else{
						echo 'Username atau password salah';
					}

				}
			?>
		</div>
	</div>

</body>
</html>