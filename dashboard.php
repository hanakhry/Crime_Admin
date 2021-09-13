<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Criminology Toolkit</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
		<link rel="icon" href="images/logo.png">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
             <a class="navbar-brand ps-3" href="dashboard.php"><img src="images/logo.png" alt="" style="max-height: 200px;
                    max-width: 250;
                    width: 25px;
                    height: 25px;">  Criminology Toolkit</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Viewer</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Tools</div>
							<a class="nav-link" href="web_crawl.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                Web Crawler
                            </a>
							<a class="nav-link" href="db_search.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                                Analyze Data
                            </a>
							<a class="nav-link" href="rss_feed.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-rss-square"></i></div>
                                News Live Feeds
                            </a>
							<a class="nav-link" href="web_search.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                                Web Search
                            </a>
                            
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            
                             <div class="sb-sidenav-menu-heading">Addons & Guides</div>
                            <a class="nav-link" href="guides.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Guides & Manuals 
                            </a>
                            <a class="nav-link" href="downloads.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                                Automation Crawlers 
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">AI Statistics</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Crime Cases Against Women</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
								    <?php 
									 header('Content-Type: text/html; charset=utf-8');
									
									 $conn=mysqli_connect("sql11.freesqldatabase.com","sql11436586","pfVpqjsLH8","sql11436586");
									 $conn->set_charset("utf8");
									 if($conn-> connect_error){
										
									    die("Connection Failed:". $conn-> connect_error);
									 }
									 $sql1= "SELECT COUNT(*) as 'Num' FROM Walla WHERE Summary LIKE '%תקף%' or Summary LIKE '%אלימות%' or Summary LIKE '%היכה%'";
									 
									 $result= $conn-> query($sql1);
									 $row = $result-> fetch_assoc();
									 
									 echo "<div class='card-body'>Physical violence:".$row["Num"]."</div>";
									 
									 $conn-> close();
									 ?>
                                    
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
								    <?php 
									 header('Content-Type: text/html; charset=utf-8');
									
									 $conn=mysqli_connect("sql11.freesqldatabase.com","sql11436586","pfVpqjsLH8","sql11436586");
									 $conn->set_charset("utf8");
									 if($conn-> connect_error){
										
									    die("Connection Failed:". $conn-> connect_error);
									 }
									 $sql= "SELECT COUNT(*) as 'Num' FROM Walla WHERE Summary LIKE '%סכין%'";
									 
									 $result= $conn-> query($sql);
									 $row = $result-> fetch_assoc();
									 
									 echo "<div class='card-body'>Knife assault:".$row["Num"]."</div>";
									 
									 $conn-> close();
									 ?>
                      
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
								     <?php 
									 header('Content-Type: text/html; charset=utf-8');
									
									 $conn=mysqli_connect("sql11.freesqldatabase.com","sql11436586","pfVpqjsLH8","sql11436586");
									 $conn->set_charset("utf8");
									 if($conn-> connect_error){
										
									    die("Connection Failed:". $conn-> connect_error);
									 }
									 $sql1= "SELECT COUNT(*) as 'Num' FROM Walla WHERE Summary LIKE '%אקדח%' or Summary LIKE '%נשק%' or Summary LIKE '%רובה%'";
									 
									 $result= $conn-> query($sql1);
									 $row = $result-> fetch_assoc();
									 
									 echo "<div class='card-body'>Gun assault:".$row["Num"]."</div>";
									 
									 $conn-> close();
									 ?>
                                   
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
								
							         <?php 
									 header('Content-Type: text/html; charset=utf-8');
									
									 $conn=mysqli_connect("sql11.freesqldatabase.com","sql11436586","pfVpqjsLH8","sql11436586");
									 $conn->set_charset("utf8");
									 if($conn-> connect_error){
										
									    die("Connection Failed:". $conn-> connect_error);
									 }
									 $sql1= "SELECT COUNT(*) as 'Num' FROM Walla WHERE Summary LIKE '%רצח%' or Summary LIKE '%הרג%'";
									 
									 $result= $conn-> query($sql1);
									 $row = $result-> fetch_assoc();
									 
									 echo "<div class='card-body'>Homicide:".$row["Num"]."</div>";
									 
									 $conn-> close();
									 ?>
                                
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Crime by date
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        News by source
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Crime Datastore - Israel
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                     <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th>Summary</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th>Summary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                     <?php 
									 header('Content-Type: text/html; charset=utf-8');
									
									 $conn=mysqli_connect("sql11.freesqldatabase.com","sql11436586","pfVpqjsLH8","sql11436586");
									 $conn->set_charset("utf8");
									 if($conn-> connect_error){
										
									    die("Connection Failed:". $conn-> connect_error);
									 }
									 $sql= "SELECT Title, URL, Summary from Walla";
									 
									 $result= $conn-> query($sql);
									 
									 if ($result-> num_rows >0){
									    while ($row = $result-> fetch_assoc()){
										  echo "<tr><td>".$row["Title"]."</td><td> <a target='_blank' href='".$row["URL"]."'>Link</a></td><td>".$row["Summary"]."</td></tr>";
										}
										
									 }
									 else {
									  echo "0 result";
									 }
									 
									 $conn-> close();
									 ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; IS Final Project 2021</div>
                            <div>
                               
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
