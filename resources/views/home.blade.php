
<!DOCTYPE html>

<html lang="es">

<head>



	<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link  rel="icon"   href="3ti_logo.png" type="png" />

	<title>Reporte de requerimientos</title>



	<!-- Bootstrap -->

	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/style_nav.css" rel="stylesheet">



	<style>

		.content {

			margin-top: 80px;

		}

	</style>



</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top">

			<div class="container">

			<div class="navbar-header">

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

					<span class="sr-only">Toggle navigation</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

				</button>

				<a class="navbar-brand visible-xs-block visible-sm-block" href="">Inicio</a>

			</div>

			<div class="pull-right">

				<img src="team_logo.png" width="50" height="50">

			</div>

			<div id="navbar" class="navbar-collapse collapse">

				<ul class="nav navbar-nav ">

					<li><a href="rbugs.php">Bugs</a></li>

					<li class="active"><a href="rrequerimientos.php">Requerimientos</a></li>

					<li><a href="rpruebas.php">Pruebas</a></li>

					<li><a href="rmovil.php">Pruebas móviles</a></li>

					<li><a href="rweb.php">Pruebas Web</a></li>

				</ul>

			</div><!--/.nav-collapse -->

	</div>
	</nav>

	<div class="container">

		<div class="content">



			
		<form class="form-inline" method="get">



		<h3>Reporte de requerimientos</h3>

		<hr />



			<div class="form-group">

			

			<a href="r_add.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo registro</a>

			</div>



				<div class="form-group pull-right">



					<select name="filter" id="filter" class="form-control" onchange="form.submit()">

						<option value="">Filtro por mes</option>

						
						
							<option value="1">ENERO</option>


						
							<option value="2">FEBRERO</option>


						
							<option value="3">MARZO</option>


						
							<option value="4">ABRIL</option>


						
							<option value="5">MAYO</option>


						
							<option value="6">JUNIO</option>


						
							<option value="7">JULIO</option>


						
							<option value="8">AGOSTO</option>


						
							<option value="9">SEPTIEMBRE</option>


						
							<option value="10">OCTUBRE</option>


						
							<option value="11">NOVIEMBRE</option>


						
							<option value="12">DICIEMBRE</option>


						
					</select>



						<a href="rrequerimientos.php?filter="" title="Actualizar" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>



				</div>

			</form>

			<hr />

			<div class="table-responsive">

			<table class="table table-striped table-hover">

                    <th>No.</th>

					<th>Mes</th>

					<th>Requerimiento</th>

					<th>Ejecutivo</th>

                    <th>Sistema</th>

					<th>Cuenta</th>

					<th>Prioridad</th>

                    <th>Status</th>

                    <th width="15%">Opciones</th>                  

				</tr>

				<tr><td colspan="8">No hay datos.</td></tr>
			</table>

		<center>

			<div class="Zebra_Pagination"><ul class="pagination"><li class="page-item disabled"><a href="javascript:void(0)" class="page-link" rel="prev">&laquo;</a></li><li class="page-item active"><a href="/rrequerimientos.php" class="page-link">1</a></li><li class="page-item disabled"><a href="javascript:void(0)" class="page-link" rel="next">&raquo;</a></li></ul></div>
		</center>

			</div>

		</div>

	</div>

	<center>

		<form class="form-inline" method="get">

			<div class="form-group">

				<a href="sistema2.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar sistema</a>

			</div>

			<div class="form-group">

				<a href="cuenta2.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar cuenta</a>

			</div>

			<div class="form-group">

				<a href="ejecutivo.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar ejecutivo</a>

			</div>

		</form>



	</center>

	

	<br />



	<center>

	<p>&copy; PIP 3TI 2021</p

		</center>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="js/bootstrap.min.js"></script>

</body>

</html>

