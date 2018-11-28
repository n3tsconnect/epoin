<?php
	include ('koneksi.php');
	include ('../logger.php');
	// Proses masuk.
	// Ribet banget ini codenya wkwk.
	if(isset($_POST['masuk'])){
		$username 		= esc_trim($_POST['username']);
		$password 		= esc_trim($_POST['katasandi']);
		// Cek username dari database.
		$cek 			= $koneksi->query("SELECT * FROM tb_pengguna WHERE (username_pengguna = '".$username."' OR surel_pengguna = '".$username."')");
		$pelajar 		= $koneksi->query("SELECT * FROM tb_pelajar WHERE nis_pelajar = '".$username."'");
		$data 			= $cek->num_rows;
		$pljr 			= $pelajar->num_rows;

		if($data  == 1){
			$row = $cek->fetch_assoc();
			// Meriksa password dari database.
			if(password_verify($password, $row['pass_pengguna'])){
				$id_pelogin				= $row['id_pengguna'];
				$level_pelogin			= $row['level_pengguna'];
				session_start();
				$_SESSION['id']			= $id_pelogin;
				$_SESSION['level'] 		= $level_pelogin;
				// Mengambil waktu last login.
				$setting    			= new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
				$waktu					= $setting->format('Y-m-d H:i:s');
				$_SESSION['masuk']		= $waktu;
				// Diberi waktu 30 x 60 detik. ( 30 Menit ).
				$_SESSION['habis'] 		= 30 * 60;
			// Jika password cocok dengan yang di database.
			// Cek level.
				action("LOGIN", array("id" => $id_pelogin), "Username: ".$username);
			if($level_pelogin == 'Admin'){
					header('location:../index.php');
				}elseif($level_pelogin == 'Guru'){
					header('location:../index.php');
					}
				}else{
            // Jika password dan username tidak cocok dengan yang di database.
				echo "<script type='text/javascript'>alert('Username atau password salah!'); window.location.href='../masuk.php';</script>";
				}
			// Jika username dan password tidak cocok dengan $data
			// Maka cek lagi di $pljr mungkin yang login pelajar.
			}elseif($pljr  == 1){
					$x = $pelajar->fetch_assoc();
					// Meriksa password dari database.
					if(password_verify($password, $x['pass_pelajar'])){
						$id_pelajar				= $x['id_pelajar'];
						$level_pelajar			= $x['level_pelajar'];
						session_start();
						$_SESSION['id']			= $id_pelajar;
						$_SESSION['level'] 		= $level_pelajar;
						// Mengambil waktu last login.
						$setting    			= new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
						$waktu					= $setting->format('Y-m-d H:i:s');
						$_SESSION['masuk']		= $waktu;
						// Diberi waktu 30 x 60 detik. ( 30 Menit ).
						$_SESSION['habis'] 		= 30 * 60;
					// Jika password cocok dengan yang di database.
					// Cek level.
					if($level_pelajar == 'Pelajar'){
							header('location:../pelajar/index.php');
						}
					}elseif($x['pass_pelajar'] == null){ // Cek apa pelajar sudah punya password
						session_start();
						$_SESSION['id_pending'] = $x['id_pelajar'];
						echo "<script type='text/javascript'>alert('Password tidak ada!'); window.location.href='../pelajar/passbaru.php';</script>";
					}else{
					// Jika password dan username tidak cocok dengan yang di database.
						echo "<script type='text/javascript'>alert('Username atau password salah!'); window.location.href='../masuk.php';</script>";
						}
				}else{
					// Jika password dan username tidak cocok dengan yang di database.
						echo "<script type='text/javascript'>alert('Username atau password salah!'); window.location.href='../masuk.php';</script>";
				}
			}else{
            // Jika password dan username tidak cocok dengan yang di database.
                echo "<script type='text/javascript'>alert('Username atau password salah!'); window.location.href='../masuk.php';</script>";
        }
	
?>