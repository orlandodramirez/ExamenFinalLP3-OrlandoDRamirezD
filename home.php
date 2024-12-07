<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM branches")->num_rows; ?></h3>

                <p>Sucursales totales</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels")->num_rows; ?></h3>

                <p>Paquetes totales</p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users where type != 1")->num_rows; ?></h3>

                <p>Total Personas</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <hr>
          <?php 
              $status_arr = array("Artículo aceptado por paquetería","Recogido","Enviado","En-Tránsito","Llegó a Destino","En salida para entrega","Listo para recoger","Entregada","Recogido","Intento de entrega fallida");
               foreach($status_arr as $k =>$v):
          ?>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels where status = {$k} ")->num_rows; ?></h3>

                <p><?php echo $v ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
          </div>
            <?php endforeach; ?>
      </div>

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Bienvenido <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
          
<?php endif; ?>
