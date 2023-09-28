<?php 
$offid='';
$ville='';
$adresse='';
$telephone='';
$type='';
$prix='';
$chambre='';
$salon='';
$surface='';
$booked='';
$owner_id='';



$db = new mysqli('localhost','root','','yh');

if($db->connect_error){
	echo "Error connecting database";
}

if(isset($_POST['add_property'])){
	add_property();
}

if(isset($_POST['owner_update'])){
	owner_update();
}


function add_property(){

	global $offid,$ville,$adresse,$telephone,$type,$prix,$chambre,$salon,$surface,$owner_id,$booked,$db;



	
	$ville=validate($_POST['ville']);
	$adresse=validate($_POST['adresse']);
	$telephone=validate($_POST['telephone']);
	//$type=validate($_POST['type']);
	$prix=validate($_POST['prix']);
	$chambre=validate($_POST['chambre']);
	$salon=validate($_POST['salon']);
	$surface=validate($_POST['surface']);
   	$booked='No';
   	$u_email=$_SESSION['email'];
        $sql1="SELECT * from owner where email='$u_email'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($rowss=mysqli_fetch_assoc($result1)){
            $owner_id=$rowss['owner_id'];

   	$sql = "INSERT INTO offres(ville,adresse,telephone,type,prix,chambre,salon,surface,owner_id) VALUES('$ville','$adresse','$telephone','$type','$prix','$chambre','$salon','$surface','$owner_id')";
		$query=mysqli_query($db,$sql);

		$offid = mysqli_insert_id($db);
		$countfiles = count($_FILES['p_photo']['name']);
	
		for($i=0;$i<$countfiles;$i++){
		$paths = $_FILES['p_photo']['tmp_name'][$i];
			  if($paths!="")
				{
					$path="product-photo/" . $_FILES['p_photo']['name'][$i];
					if(move_uploaded_file($paths, $path)) {
					$sql2 = "INSERT INTO images(p_photo,offid) VALUES('$path','$offid')";
					$query=mysqli_query($db,$sql2);
	
				}}
	 
	 }
			if(!empty($query)){
				
		
			
?>

<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Product has been uploaded.</strong></center>
</div></div>


<?php
		}
		else{
			echo "error";
		}

}
}}

function owner_update(){
	global $owner_id,$full_name,$email,$password,$phone_no,$address,$id_type,$id_photo,$errors,$db;
	$owner_id=validate($_POST['owner_id']);
	$full_name=validate($_POST['full_name']);
	$email=validate($_POST['email']);
	$phone_no=validate($_POST['phone_no']);
	$address=validate($_POST['address']);
	//$id_type=validate($_POST['id_photo']);
	$password = md5($password); // Encrypt password
		$sql = "UPDATE owner SET full_name='$full_name',email='$email',phone_no='$phone_no',address='$address',id_photo='$id_type' WHERE owner_id='$owner_id'";
		$query=mysqli_query($db,$sql);
		if(!empty($query)){
			?>

<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Information has been updated.</strong></center>
</div></div>


<?php
	}
}


function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}




 ?>