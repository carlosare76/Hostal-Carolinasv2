<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">
        
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <title>Opciones Menu</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <!-- <div class="header__img">
                <img src="assets/img/admin.jfif" alt="Admin">
            </div> -->
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <div class="nav__list">
                    <a href="#" class="nav__link active tablink" onclick="openCity('Inicio', this, 'blue')" id="defaultOpen">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Inicio</span>
                    </a>

                    
                        <a href="#" class="nav__link tablink" onclick="openCity('personal_info', this, 'blue')">
                        <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Informacion Personal</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('room_booking', this, 'blue')">
                        <i class="iconify" data-icon="uil:calender" data-inline="false"></i>
                            <span class="nav__name">Numero Reserva</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('payment', this, 'blue')">
                        <i class="iconify" data-icon="fluent:payment-16-regular" data-inline="false"></i>
                            <span class="nav__name">Pago</span>
                        </a>
                        
                        <a href="reset-password.php" class="btn nav__link">
                    <i class="iconify icon:carbon:password icon-inline:false"></i>
                    <span class="nav__name">Resetear Contraseña</span>
                        </a>
                    </div>
                </div>
                
                <a href="logout.php" class="btn ml-3 nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Cerrar Sesion</span>
                </a>
                
            </nav>
        </div>

<!--Inicio Page  -->
<div id="Inicio" class="tabcontent">
    <div class="content">
<h1 class="my-5">Hola,  <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a nuestro sitio.</h1>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username=htmlspecialchars($_SESSION["username"]);
  $sql = "SELECT customer_id FROM customer where username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row==NULL){
  echo "Please Enter your personal details first to proceed further.";
}
else{
$customer_id = $row["customer_id"];
$sql = "SELECT payment_status FROM booking where customer_id=$customer_id";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

$status=$row["payment_status"]; 

if($status==1){
echo "Previous Booking Info";
$sql = "CALL customer_previous_booking_info_with_payment_done($customer_id)";
$result = $conn->query($sql);       
      
?>
  
<br>  
<table class="table table-striped table-dark table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Fecha de Check In</th>
                <th>Check-out-Fecha</th>
                <th>Dias Totales</th>
                <th>Caracteristicas</th>
                <th>Precio por Dia</th>
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['total_days'] ?></td>
                    <td><?php echo $r['features'] ?></td>
                    <td><?php echo $r['amount'] ?></td>
                   
                </tr>
            <?php endwhile; 
			?>
            </tbody>
        </table>
        <?php }
      else{
        echo "No Previous Booking";
      }}} ?>
  </div>
  
<!-- Informacion Personal Page-->
<div id="personal_info" class="tabcontent">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

$username=htmlspecialchars($_SESSION["username"]);
$sql = "SELECT customer_id FROM customer where username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row==NULL){
?>

    <div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="first_name">Primer Nombre</label>
    <input type="text" class="form-control" id="first_name"  placeholder="Primer Nombre" name="first_name">
  </div>
  <div class="form-group">
    <label for="last_name">Apellido</label>
    <input type="text" class="form-control" id="last_name" placeholder="Apellido" name="last_name">
  </div>
  <div class="form-group">
  <label for="gender">Genero:</label>
        <select name="gender" id="Gender">
    <option value="male">Hombre</option>
    <option value="female">Mujer</option>
    <option value="other">Otro</option>
  </select>
  </div>
  <div class="form-group">
    <label for="contact_no">Numero Contacto</label>
    <input type="text" class="form-control" id="contact_no" placeholder="Numero Contacto" name="contact_no">
  </div>
  <div class="form-group">
    <label for="email">Direccion de Correo</label>
    <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email">
  </div>
  <div class="form-group">
  <label for="nationality">Nacionalidad:</label>
        <select name="nationality" id="nationality">
    <option value="indian">El Salvador</option>
    <option value="non_indian">Non El Salvador</option>
  </select>
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['insertdata'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $email=$_POST['email'];
  $contact_no=$_POST['contact_no']; 
  $nationality=$_POST['nationality'];
  $username=htmlspecialchars($_SESSION["username"]);
     
   $query = "INSERT INTO customer (`first_name`,`last_name`,`gender`,`email`,`contact_no`,`nationality`,`username`) VALUES ('$first_name','$last_name','$gender','$email','$contact_no','$nationality','$username')";
   $query_run=mysqli_query($conn,$query);

  if($query_run){
      echo '<script> alert("Personal Information Added."); </script>';
      // header('Location:booking.php');
  }
  else{
       echo "<script> alert('$conn->error'); </script>" ;   
  }
}
?>

</div>

  <button type="submit" class="btn btn-primary"  value="submit" name="insertdata" >Enviar</button>
</form>
</div>
    
    <?php
  }
  elseif(isset($_POST['update'])){
    ?>
  
      <div class="container">
    <form action="booking.php" method="POST">
      <br>
    <div class="form-group">
      <label for="first_name">Primer Nombre</label>
      <input type="text" class="form-control" id="first_name"  placeholder="Primer Nombre" name="first_name">
    </div>
    <div class="form-group">
      <label for="last_name">Apellido</label>
      <input type="text" class="form-control" id="last_name" placeholder="Apellido" name="last_name">
    </div>
    <div class="form-group">
    <label for="gender">Genero:</label>
          <select name="gender" id="Gender">
      <option value="male">Hombre</option>
      <option value="female">Mujer</option>
      <option value="other">Otro</option>
    </select>
    </div>
    <div class="form-group">
      <label for="contact_no">Numero Contacto</label>
      <input type="text" class="form-control" id="contact_no" placeholder="Numero Contacto" name="contact_no">
    </div>
    <div class="form-group">
      <label for="email">Direccion de Correo</label>
      <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
    <label for="nationality">Nacionalidad:</label>
          <select name="nationality" id="nationality">
      <option value="indian">El Salvador</option>
      <option value="non_indian">Non El Salvador</option>
    </select>
  
    
  
  </div>
  
    <button type="submit" class="btn btn-primary"  value="submit" name="updated" >Actualizar</button>
    <button type="submit" class="btn btn-secondary"  value="submit" name="cancel" >Cancelar</button>

  </form>
  </div>
      
      <?php
  }
  elseif(isset($_POST['cancel'])){
    header('Location:booking.php');
  }
  else{
    echo "You have already submitted your personal information.";
    ?>
    <br>
    <br>
    <span>Si quieres actualizar tu informacion da click en Actualizar</span>
    <br>
    <br>
    <form action="booking.php" method="post">
    <button type="submit" class="btn btn-primary"  value="submit" name="update" >Actualizar</button>
    </form>
  <?php
}
$conn->close();
  ?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hotel-mangement-system";
          // Create connection
          $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  if(isset($_POST['updated'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $contact_no=$_POST['contact_no']; 
    $nationality=$_POST['nationality'];
    $username=htmlspecialchars($_SESSION["username"]);
       
     $query = "CALL update_customer_info('$first_name','$last_name','$gender','$email','$contact_no','$nationality','$username')";
     $query_run=mysqli_query($conn,$query);
     
  
    if($query_run){
        echo '<script> alert("Data Saved"); </script>';
        // header('Location:booking.php');
    }
    else{
      
        echo "<script> alert('$conn->error'); </script>";
    }
  }
  $conn->close();
  ?>
  
  </div>    
  <!--Reserva Habitacion -->
  <div id="room_booking" class="tabcontent">
  <form action="booking.php"   method="POST">
    <br>
    <div class="form-group">
    <label>Revisar Disponibilidad</label>
  </div>
  <div class="form-group">
    <label for="date">Fecha de Check In</label>
    <input class="date-1" type="date" name="Fecha de Check In"  placeholder="Fecha de Check In" >
  <!-- </div>
  <div class="form-group"> -->
    <label for="date">Fecha de Check Out</label>
    <input class="date-1" type="date" name="check-out-date"  placeholder="Fecha de Check Out" >
  </div>
    <!-- <div class="form-group">
  <span class="date">Fecha de Check In</span>
    <input class="date-1" type="date" name="Fecha de Check In" id="">
    <span class="date">Fecha de Check Out</span>
    <input class="date-1" type="date" name="check-out-date" >
    </div> -->
<button type="submit" class="btn btn-primary"  value="submit" name="available_room">Revisar Disponibilidad</button>

</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['available_room'])){
  $date = strtotime($_POST['Fecha de Check In']);
  $check_in= date('Y-m-d', $date );
  $date = strtotime($_POST['check-out-date']);
  $check_out= date('Y-m-d', $date ); 
  $sql = "CALL available_room('$check_in','$check_out')";
$result = $conn->query($sql);

     
  
    if($result){
       
   

        
      
?>
  
<br>   
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Piso numero</th>
                <th>Room name</th>
                <th>No of Single Bed</th>
                <th>No of Double Bed</th>
                <th>No of Accomodate</th>
                <th>Caracteristicas</th>
                <th>Precio por Dia</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['floor_no'] ?></td>
                    <td><?php echo $r['room_name'] ?></td>
                    <td><?php echo $r['no_of_single_bed'] ?></td>
                    <td><?php echo $r['no_of_double_bed'] ?></td>
                    <td><?php echo $r['no_of_accomodate'] ?></td>
                    <td><?php echo $r['features'] ?></td>
                    <td><?php echo $r['amount'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); ?>
            </tbody>
        </table>
<?php 
 }
 else{
   
     echo "<script> alert('$conn->error'); </script>";
    
 }} ?>
      
<!--  Book by Habitacion numero -->

<form action="booking.php" method="post">
  <!-- <span>Enter the room which you want to book: </span>
  <input type="text" name="room_no" id=""> -->
<hr>  
  <div class="form-group">
    <label >Reserva Habitacion</label>
  </div>
  <div class="form-group">
    <label for="room_no">Ingresa Numero de Habitacion que quieres reservar</label>
    <input  type="text" name="room_no"  placeholder="Habitacion numero" >
  <div class="form-group">
    <label for="date">Fecha de Check In</label>
    <input class="date-1" type="date" name="check-in"  placeholder="Fecha de Check In" >
  <!-- </div>
  <div class="form-group"> -->
    <label for="date">Fecha de Check Out</label>
    <input class="date-1" type="date" name="check-out"  placeholder="Fecha de Check Out" >
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="book">Book</button>
</form>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}  

if(isset($_POST['book'])){
  $date = strtotime($_POST['check-in']);
  $checkin= date('Y-m-d', $date ); 
  $date1 = strtotime($_POST['check-out']);
  $checkout= date('Y-m-d', $date1 );
  $room_no=$_POST['room_no'];

  $sql="SELECT DATEDIFF('$checkout','$checkin') AS days";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  // echo $row["days"];
  $days=$row["days"];

  $username=htmlspecialchars($_SESSION["username"]);
  $sql = "SELECT customer_id FROM customer where username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$customer_id = $row["customer_id"];
   $query = "INSERT INTO room_booked (`customer_id`,`check_in`,`check_out`,`total_days`,`room_no`) VALUES ('$customer_id','$checkin','$checkout','$days','$room_no')";
   $query_run=mysqli_query($conn,$query);
   if($query_run){
      echo '<script> alert("Room Booked"); </script>';
  }
  else{
    echo "<script> alert('$conn->error'); </script>"; 
  }
}
$conn->close();
?>


</div> 
  </div>

  <!-- Pago Section -->

  <div id="payment" class="tabcontent">

  
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username=htmlspecialchars($_SESSION["username"]);
  $sql = "SELECT customer_id FROM customer where username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row==NULL){
   
}
else{
$customer_id = $row["customer_id"];

$sql = "SELECT payment_status FROM booking where customer_id=$customer_id";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){

$status=$row["payment_status"]; 

if($status==0){
  ?>
  <h2> Habitaciones Reservadas</h2>
<?php
$sql = "SELECT amount FROM booking where customer_id=$customer_id AND payment_status=0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$amount=$row["amount"];

$sql = "CALL payment_info($customer_id)";
$result = $conn->query($sql);       
      
?>
  
<br>  
<table class="table table-striped table-dark table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Fecha de Check In</th>
                <th>Check-out-Fecha</th>
                <th>Dias Totales</th>
                <th>Caracteristicas</th>
                <th>Precio por Dia</th>
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['total_days'] ?></td>
                    <td><?php echo $r['features'] ?></td>
                    <td><?php echo $r['amount'] ?></td>
                   
                </tr>
            <?php endwhile; 
			?>
            </tbody>
        </table>
        <div>
        <span>Total Monto: </span>
        <?php echo $amount ?>
        </div>
        
<br>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
  <label for="payment_method">Metodo de Pago</label>
        <select name="payment_method" id="payment_method">
    <option value="NET_BANKING">Banco</option>
    <option value="Efectivo">Efectivo</option>
    <option value="CREID_CARD">Tarjeta Credito</option>
  </select>
  </div>

  <button type="submit" class="btn btn-primary"  value="submit" name="payment_done" >Pagar</button>
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
        if(isset($_POST['payment_done'])){
          $sql = "SELECT booking_id,amount FROM booking where customer_id=$customer_id AND payment_status=0";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $amount=$row["amount"];
          $booking_id=$row["booking_id"];

$payment_method=$_POST['payment_method'];
 
   $query = "INSERT INTO transaction (`booking_id`,`payment_type`,`total_amount`) VALUES ('$booking_id','$payment_method','$amount')";
   $query_run=mysqli_query($conn,$query);

   if($query_run){
      echo '<script> alert("Pago Realizado"); </script>';  
  }
  else{
      echo '<script> alert("Pago unsuccesful"); </script>';   
  }
}
?>
  
<?php

mysqli_close($conn);?>
<hr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label >Ingresa numero de habitacion</label>
   </div>  
  <div class="form-group">
    <label for="room_no">Habitacion numero:</label>
    <input type="text" name="room_no"  placeholder="Habitacion numero" >
   </div>  
   <div class="form-group">
    <label for="check_out">Check-out-date:</label>
    <input type="text" name="check_out"  placeholder="Check-out-date" >
   </div>  
  <button type="submit" class="btn btn-primary"  value="submit" name="delete" >Cancelar Reserva</button>
  </form>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hotel-mangement-system";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_POST['delete'])){
  $room_no = $_POST['room_no'];
  $check_out = $_POST['check_out'];
  $sql = "CALL cancel_booked_room('$room_no','$check_out')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("booking cancellation done."); </script>';     
  }
  else{
      echo "<script> alert('$conn->error'); </script>";

  }
}
$conn->close();   
}
else{
   }   
}}
  ?>
  
  </div>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script>
            function openCity(cityName,elmnt,color) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablink");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
              }
              document.getElementById(cityName).style.display = "block";
              elmnt.style.backgroundColor = color;
            
            }
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
            </script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>