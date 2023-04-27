<!DOCTYPE html>
<html>


<?php
if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "doctorDash.php") {
	header("Location: index.php");
}
require ("head.php");
?>

<body>
	<!-- Pre Loader -->
	<div class="loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--/Pre Loader -->
	
	<nav class="navbar navbar-default">
		<div class="container-fluid nav d-flex justify-content-between">
			<!-- <ul class="" > -->
				<div>
					<li class="nav-item">
						<div class="responsive-logo text-dark bg-dark">
							<a href="index.html" class="text-dark p-3"><img src="images/logo.png" class="ayushya-logo" alt="logo"></a>
						</div>
					</li>			
				</div>
				<div>
					<li class="nav-item">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
							aria-haspopup="true" aria-expanded="false">
							<span class="ti-user"></span>
						</a>
						<div class="dropdown-menu proclinic-box-shadow2 profile animated flipInY">
							<h5><?php  echo $_SESSION['name']; ?></h5>
							
							<a class="dropdown-item" href="logout.php">
								<span class="ti-power-off"></span> Logout</a>
						</div>
					</li>
				</div>
			<!-- </ul> -->

		</div>
	</nav>
	<div class="wrapper">
		<div id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Patient Details</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                <?php
                                    if(isset($_GET["id"])) {
                                        require("connection.php");
                                        $id = $_GET["id"];
                                        $query = "select name, dob, gender, address, phone, email, bloodgroup from patient where id = $id";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                ?>
                                    <tbody>
                                        <tr>											
                                            <td><strong>Name</strong></td>
                                            <td><?php
                                                echo $row["name"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Blood Group</strong> </td>
                                            <td><?php
                                                echo ucfirst($row["bloodgroup"]);
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date Of Birth</strong> </td>
                                            <td><?php
                                                echo $row["dob"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gender</strong></td>
                                            <td><?php
                                                if($row["gender"] == "M") {
                                                    echo "Male";
                                                } else {
                                                    echo "Female";
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Address</strong></td>
                                            <td><?php
                                                echo $row["address"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone </strong></td>
                                            <td><?php
                                                echo $row["phone"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><?php
                                                echo $row["email"];
                                            ?></td>
                                        </tr>									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Patient Visits</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    
                                    <thead>
                                        <tr>										
                                            <th>Doctor Name</th>
                                            <th>Visit Date</th>
                                            <th>Complaint</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "select u.name as doc_name, date(a.created_at) as visit_date, a.complaint as complaint from appointments a join user u on a.doc_id = u.id where date(a.created_at) <> current_date()";
                                        $res = $conn->query($query);
                                        while($row = $res->fetch_assoc()) {
                                    ?>
                                        <?php echo "<tr>";?>
                                            <?php echo "<td>" . $row["doc_name"] . "</td>"?>
                                            <?php echo "<td>" . $row["visit_date"] . "</td>"?>
                                            <?php echo "<td>" . $row["complaint"] . "</td>"?>
                                            <?php $date = $row["visit_date"]; echo "<td><button class='btn-success p-1' onclick='show-prev-visit($date)'>Show</button></td>"?>
                                        </tr>
                                    <?php        
                                        }
                                    ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <?php
        }
    ?>
<!-- Jquery Library-->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Popper Library-->
<script src="js/popper.min.js"></script>
<!-- Bootstrap Library-->
<script src="js/bootstrap.min.js"></script>
<!-- morris charts -->
<script src="charts/js/raphael-min.js"></script>
<script src="charts/js/morris.min.js"></script>
<script src="js/custom-morris.js"></script>

<!-- Custom Script-->
<script src="js/custom.js"></script>
</body>


</html>
