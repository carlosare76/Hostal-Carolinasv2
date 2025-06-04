<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";


$conn = new mysqli($servername, $username, $password, $dbname);?>   
 

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
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Income', 'Expenses'],
          <?php
           
           $sql = "SELECT sum(amount) AS loss,date from revenue where revenue_type='expense' group by date";
           $result = $conn->query($sql);
           
         
         $sql = "SELECT sum(amount) AS profit,date from revenue where revenue_type='income'  group by date";
           $result1 = $conn->query($sql);
            
          
        while($r = $result1->fetch_assoc()){
            $rr = $result->fetch_assoc();
echo "['".$r['date']."',".$r['profit'].",".$rr['loss']."],";
}
?> 
]);

        var options = {
          title: 'Total Revenue',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Room Status', 'No of Room'],
         <?php   $sql = "SELECT COUNT(check_out) AS booked from room_status where check_out>=CURRENT_DATE";

$result = $conn->query($sql);
  $r = $result->fetch_assoc();
$booked=$r['booked'];
$sql = "SELECT COUNT(check_out) AS non_booked from room_status where check_out<CURRENT_DATE";

$result = $conn->query($sql);
  $r = $result->fetch_assoc();
$non_booked=$r['non_booked'];?>
          
          ['Habitaciones Reservadas',     <?php echo $booked ?>],
          ['Available Room',      <?php echo $non_booked ?>]
          
        ]);

        var options = {
          title: 'Current Room Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      



    </script>
  
        <title>Opciones Menu</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/admin.jfif" alt="Admin">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <div class="nav__list">
                    <a href="#" class="nav__link active tablink" onclick="openCity('admin', this, 'blue')" id="defaultOpen">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Pagina Administrador</span>
                    </a>

                    
                        <a href="#" class="nav__link tablink" onclick="openCity('booked_room', this, 'blue')">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Habitaciones Reservadas</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('all_room_info', this, 'blue')">
                            <i class='far fa-address-book nav__icon' ></i>
                            <span class="nav__name">Informacion Habitacion</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('add_new_room', this, 'blue')">
                            <!-- <i class='bx bx-user nav__icon' ></i> -->
                            <i class="iconify" data-icon="fluent:conference-room-28-regular" data-inline="false"></i>
                            <span class="nav__name">Agrega Habitacion</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('update_room_info', this, 'blue')">
                        <i class="iconify" data-icon="dashicons:update" data-inline="false"></i>
                            <span class="nav__name">Actualizar Informacion</span>
                        </a>
                        
                         <a href="#" class="nav__link tablink" onclick="openCity('customer_info', this, 'blue')">
                            <i class='far fa-user nav__icon' ></i>
                            <span class="nav__name">Informacion Cliente</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('Empleado', this, 'blue')">
                            <i class='far fa-id-card nav__icon' ></i>
                            <span class="nav__name">Empleado</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('Empleado_attendence', this, 'blue')">
                            <i class='fas fa-fingerprint nav__icon' ></i>
                            <span class="nav__name">Asistencia Empleado</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('expenses', this, 'blue')">
                            <i class='fas fa-hand-holding-usd nav__icon' ></i>
                            <span class="nav__name">Agrega Gastos</span>
                        </a>

                       
                        <!--<a href="#" class="nav__link">
                            <i class='bx bx-folder nav__icon' ></i>
                            <span class="nav__name">Data</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                            <span class="nav__name">Analytics</span>
                        </a>  -->
                    </div>
                </div>

                <a href="#" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Cerrar Sesion</span>
                </a>
            </nav>
        </div>

        
<div id="admin" class="tabcontent">
    <h1>Bienvenido Pagina Administrador</h1>
    <div class="row">
    <div class="col-md-6">
    <div id="piechart" style="width: 800px; height: 500px;"></div>
    </div>
    <div class="col-md-6">
    <div id="curve_chart" style="width: 800px; height: 500px;"></div>
  </div>
</div>   
</div>
    
  
  
  <!-- Habitaciones Reservadas -->
  <div id="booked_room" class="tabcontent">
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
$sql = "CALL showing_booked_room_info_to_admin_for_payment_status_1()";
$result = $conn->query($sql);   
   
?>
  
<br>
<h2>Pago Realizado</h2>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Fecha de Check In</th>
                <th>Fecha Check Out</th>
                <th>ID Cliente</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['customer_id'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); ?>
            </tbody>
        </table>

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
$sql = "CALL showing_booked_room_info_to_admin_for_payment_status_0()";
$result = $conn->query($sql);   
   
?>
  
<br>
<h2>Pago no realizado</h2>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Fecha de Check In</th>
                <th>Fecha de Check Out</th>
                <th>ID Cliente</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['customer_id'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); ?>
            </tbody>
        </table>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label >Ingresa numero de habitacion y fecha de Check Out para cancelar la reserva.</label>
   </div>  
  <div class="form-group">
    <label for="room_no">Habitacion numero:</label>
    <input type="text" name="room_no"  placeholder="Habitacion numero" >
   </div>  
   <div class="form-group">
    <label for="check_out">Fecha de Check Out:</label>
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
//   echo gettype($check_out);
//   echo $check_out;
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
  

  ?>


    </div>

    
  <!-- Agrega Habitacion -->
  <div id="add_new_room" class="tabcontent">
    <h2>Crear Nueva Habitacion</h2>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
  <label for="room_code">Nombre de Habitacion</label>
        <select name="room_code" id="room_code">
    <option value="111">Sencilla</option>
    <option value="222">Doble</option>
    <option value="333">Cuadruple</option>
  </select>
</div>
    <div class="form-group">
    <label for="room_no">Habitacion numero</label>
    <input type="text" name="room_no" id="">            
    </div>
    <div class="form-group">
    <label for="floor_no">Piso numero</label>
    <input type="text" name="floor_no" id="">            
    </div>
    <div class="form-group">
    <label for="features">Caracteristicas</label>
    <input type="text" name="features" id="">            
    </div>
    <div class="form-group">
    <label for="amount">Monto</label>
    <input type="text" name="amount" id="">            
    </div>
    
  <button type="submit" class="btn btn-primary"  value="submit" name="add_room" >Crear</button>
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
  if(isset($_POST['add_room'])){
  $room_code = $_POST['room_code'];
  $room_no = $_POST['room_no'];
  $floor_no = $_POST['floor_no'];
  $features = $_POST['features'];
  $amount = $_POST['amount'];
 
  $sql = "INSERT INTO room VALUES ('$room_no','$floor_no','$room_code','$features','$amount')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Added New Room."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();   
  

  ?>

<br>
  <h2>Elimina Habitacion</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
    <label for="room_no">Habitacion numero</label>
    <input type="text" name="room_no" id="">            
    </div>

    <button type="submit" class="btn btn-primary"  value="submit" name="delete_room" >Eliminar</button>
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
  if(isset($_POST['delete_room'])){
  $room_no = $_POST['room_no'];
 
  $sql = "CALL delete_room_from_admin('$room_no')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Room deleted."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();   
  

  ?>

  </div>


  <!-- Informacion Habitacion -->
  <div id="all_room_info" class="tabcontent">
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
$sql = "CALL showing_all_room_info_to_admin()";
$result = $conn->query($sql);   
   
?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Habitacion numero</th>
                <th>Piso numero</th>
                <th>Nombre habitacion</th>
                <th>No de camas sencillas</th>
                <th>No de camas dobles</th>
                <th>No de personas</th>
                <th>Caracteristicas</th>
                <th>Precio por dia</th>
                
                
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
  </div>

<!-- Actualizar Informacion -->
<div id="update_room_info" class="tabcontent">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <h2>Ingresa los detalles para Actualizar Informacion</h2>
    <div class="form-group">
    <label for="room_no">Habitacion numero</label>
    <input type="text" name="room_no" id="">            
    </div>
    <div class="form-group">
    <label for="room_name">Nombre de habitacion</label>
    <input type="text" name="room_name" id="">            
    </div>
    <div class="form-group">
    <label for="floor_no">Piso numero</label>
    <input type="text" name="floor_no" id="">            
    </div>
    <div class="form-group">
    <label for="features">Caracteristicas</label>
    <input type="text" name="features" id="">            
    </div>
    <div class="form-group">
    <label for="amount">Monto</label>
    <input type="text" name="amount" id="">            
    </div>
    
  <button type="submit" class="btn btn-primary"  value="submit" name="update_room_info" >Enviar</button>
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
if(isset($_POST['update_room_info'])){
  $room_no= $_POST['room_no'];
  $room_name= $_POST['room_name'];
  $floor_no= $_POST['floor_no'];
  $features= $_POST['features'];
  $amount= $_POST['amount'];
$sql = "CALL update_room_info_by_admin('$room_no','$floor_no','$room_name','$features','$amount')";
$query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Updated the Room Info."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();?>

  </div>


  <!-- Informacion Cliente -->

  <div id="customer_info" class="tabcontent">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
  <h2>Ingresa ID Cliente para ver detalles</h2>
    <div class="form-group">
    <label for="customer_id">ID Cliente</label>
    <input type="text" name="customer_id" id="">            
    </div>
    <button type="submit" class="btn btn-primary"  value="submit" name="show" >Mostrar</button>
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
if(isset($_POST['show'])){
  $customer_id= $_POST['customer_id'];
$sql = "CALL showing_customer_details_to_admin('$customer_id')";
$result = $conn->query($sql);   
if($result){
 

?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>ID Cliente</th>
                <th>Primer Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Email</th>
                <th>Numero Contacto</th>
                <th>Nacionalidad</th>
                <th>Nombre de Usuario</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['customer_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['email'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['nationality'] ?></td>
                    <td><?php echo $r['username'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } 
        
  
    
    else{
    
      echo "<script> alert('$conn->error'); </script>";
     
    }}?>
            </tbody>
        </table>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
        <br>
        <button type="submit" class="btn btn-primary"  value="submit" name="show_all" >Mostrar Detalles Cliente</button>
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
if(isset($_POST['show_all'])){
  
$sql = "CALL showing_all_customer_details_to_admin()";
$result = $conn->query($sql);   
   
?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>ID Cliente</th>
                <th>Primer Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Email</th>
                <th>Numero Contacto</th>
                <th>Nacionalidad</th>
                <th>Nombre de Usuario</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['customer_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['email'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['nationality'] ?></td>
                    <td><?php echo $r['username'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } ?>
            </tbody>
        </table>
  </div>

<!-- Empleado -->

<div id="Empleado" class="tabcontent">
<div class="container">
<h2>Agrega Nuevo Empleado</h2>
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
    <label for="department">Area</label>
    <input type="text" class="form-control" id="department" placeholder="Area" name="department">
  </div>
  <div class="form-group">
    <label for="salary">Salario Mensual</label>
    <input type="text" class="form-control" id="salary" placeholder="Salary" name="salary">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="insert_Empleado" >Agregar</button>
<br>
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
if(isset($_POST['insert_Empleado'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $contact_no=$_POST['contact_no']; 
  $department=$_POST['department'];
  $salary=$_POST['salary'];
  
     
   $query = "INSERT INTO Empleado (`first_name`,`last_name`,`gender`,`contact_no`,`department`,`salary`) VALUES ('$first_name','$last_name','$gender','$contact_no','$department','$salary')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Personal Information Added."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
<!-- Mostrar all Empleado -->

    <br>
    <button type="submit" class="btn btn-primary"  value="submit" name="show_Empleado" >Mostrar Detalles Empleado</button>
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
if(isset($_POST['show_Empleado'])){
  
$sql = "CALL show_all_Empleado_to_admin()";
$result = $conn->query($sql);   
   
?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Empleado ID</th>
                <th>Primer Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Numero Contacto</th>
                <th>Area</th>
                <th>Salario Mensual</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['Empleado_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['department'] ?></td>
                    <td><?php echo $r['salary'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } ?>
            </tbody>
        </table>


  </div>
  </div>
  
  <!-- Asistencia Empleado -->
  <div id="Empleado_attendence" class="tabcontent">
  <div class="container">
  <h2>Ingresa ID Empleado para marcar asistencia</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="Empleado_id">Empleado ID</label>
    <input type="text" class="form-control" id="Empleado_id"  placeholder="Empleado ID" name="Empleado_id">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="Empleado_attendence" >Agregar</button>
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
if(isset($_POST['Empleado_attendence'])){
  $Empleado_id=$_POST['Empleado_id'];
    
   $query = "INSERT INTO Empleado_attendence (`Empleado_id`) VALUES ('$Empleado_id')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Attendence Done."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
<br>
<br>
<br>
<h2>Ingresa Fecha para ver Asistencia Empleado</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="date">Fecha</label>
    <input type="text" class="form-control" id="date"  placeholder="Fecha" name="date">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="show_attendence" >Mostrar</button>
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
if(isset($_POST['show_attendence'])){
  $date = strtotime($_POST['date']);
  $da= date('Y-m-d', $date );

  $sql = "CALL show_attendence_of_Empleado('$da')";
  $result = $conn->query($sql);
    
      if($result){
  ?>
    
  <br>   
  <table class="table table-striped table-light table-bordered">
            <thead class="thead-dark"><tr>
                  <th>Empleado ID</th>
                  <th>Primer Nombre</th>
                  <th>Apellido</th>
                  <th>Area</th>
                  
                  
              </tr></thead>
              
              <tbody>
              <?php while ($r = $result->fetch_array()): ?>
                  <tr>
                    <th scope="row"><?php echo $r['Empleado_id'] ?></th>
                      <td><?php echo $r['first_name'] ?></td>
                      <td><?php echo $r['last_name'] ?></td>
                      <td><?php echo $r['department'] ?></td>
                      
                     
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
  </div>
  </div>

          
<div id="expenses" class="tabcontent">
<div class="container">
    <h2>Agrega Gastos</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="expense_name">Nombre</label>
    <input type="text" class="form-control" id="expense_name"  placeholder="Expense Nombre" name="expense_name">
  </div>
  <div class="form-group">
    <label for="amount">Monto</label>
    <input type="text" class="form-control" id="amount"  placeholder="Monto" name="amount">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="add_expenses" >Agregar</button>
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
if(isset($_POST['add_expenses'])){
  $expense_name=$_POST['expense_name'];
  $amount=$_POST['amount'];
  $expense="expense";
    
   $query = "INSERT INTO revenue (`revenue_type`,`expense_name`,`amount`) VALUES ('$expense','$expense_name','$amount')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Expense Added."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
</div>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>