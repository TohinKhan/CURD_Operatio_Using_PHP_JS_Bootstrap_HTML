
<?php

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "billal";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn)
{
  if (isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `sell` WHERE `ID` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result)
      {
        $delete = true;
      }
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['snoEdit']))
    {
      $sno = $_POST['snoEdit'];
      $name = $_POST['nameedit'];
      $quan = $_POST['quanedit'];
      $price = $_POST['priceedit'];


      $sql = "UPDATE `sell` SET `item` = '$name' , `quantity` = '$quan' , `price` = '$price' WHERE `sell`.`ID` = $sno;";

      $result = mysqli_query($conn, $sql);
    
      if ($result)
      {
        $update = true;
      }
    }
    else{

    
      $name = $_POST['name'];
      $quan = $_POST['quan'];
      $price = $_POST['price'];


      $sql = "INSERT INTO `sell` (`item`, `quantity`, `price`) VALUES ('$name', '$quan', '$price');";

      $result = mysqli_query($conn, $sql);
      
      if ($result)
      {
        $insert = true;
      }

    }

  }

}
else
{
    $error = mysqli_connect_error();
    echo "Connection Failed with database for this error -> $error";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CURD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
   
  
  </head>
  <body>

    <!-- Button Edit modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
      Edit modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="row g-3 needs-validation" action ="/PHP/Billal Hossan/class 32 (CURD project).php?update=true" method = "POST" novalidate>
          <div class="modal-body">
            
              <input type="text" class="hidden" name = "snoEdit" id = "snoEdit">
              <div class="col-md-4">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" name = "nameedit" class="form-control" id="nameedit" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4">
                <label for="quan" class="form-label">Quantity</label>
                <input type="text" name = "quanedit" class="form-control" id="quanedit" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4">
                <label for="price" class="form-label">Price</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                  <input type="text" name ="priceedit" class="form-control" id="priceedit" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please choose a username.
                  </div>
                </div>
              </div>
            <!-- <div class="col-12">
                <button class="btn btn-primary" type="submit">Update Data</button>
              </div> -->
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">CURD Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <?php
    
    if ($update)
      {
      
          echo ' <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <strong>Record is Updated Successfully. </strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }

      if ($insert)
      {
        
          echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Record is Inserted Successfully. </strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }

      if ($delete)
      {
        
          echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Record is Deleted Successfully. </strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }

    ?>


    <!-- Forms starts -->


        <div class="container">

          <form class="row g-3 needs-validation" action ="/PHP/Billal Hossan/class 32 (CURD project).php" method = "POST" novalidate>
            <div class="col-md-4">
              <label for="name" class="form-label">Item Name</label>
              <input type="text" name = "name" class="form-control" id="name" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4">
              <label for="quan" class="form-label">Quantity</label>
              <input type="text" name = "quan" class="form-control" id="quan" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4">
              <label for="price" class="form-label">Price</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">$</span>
                <input type="text" name ="price" class="form-control" id="price" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div>
          <div class="col-12">
              <button class="btn btn-primary" type="submit">Submit Data</button>
            </div>
          </form>
        </div>

          <div class="container my-3">

            <table class="table" id ="myTable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                  <th scope="col">Sell Date</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
              <?php

            $sql = "select * from `sell`";

            $result = mysqli_query($conn, $sql);

            $num = mysqli_num_rows($result);

            echo $num." Items"."<br>";

            $no = 0;

            while ($row = mysqli_fetch_assoc($result))
            {
              $no=$no+1;
                echo "<tr>
                  <th scope='row'>".$no. "</th>
                  <td>". $row['item'] . "</td>
                  <td>". $row['quantity']. "</td>
                  <td>". $row['price']. "</td>
                  <td>". $row['date']. "</td>
                  <td> <button class='edit btn btn-sm btn-success' id =".$row['id'].">Edit</button> <button class='delete btn btn-sm btn-danger' id =d".$row['id'].">Delete</button> </td>
                </tr>";
            }
            

            ?>
                
                
              </tbody>
            </table>
          
 
          </div>

            <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
            <script>
              let table = new DataTable('#myTable');
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  
            <script>
              edits = document.getElementsByClassName('edit');
              Array.from(edits).forEach((element)=>{
                element.addEventListener("click", (e)=>{
                  console.log("edit, ");
                  tr = e.target.parentNode.parentNode;
                  item = tr.getElementsByTagName("td")[0].innerText;
                  quantity = tr.getElementsByTagName("td")[1].innerText;
                  price = tr.getElementsByTagName("td")[2].innerText;
                  console.log(item, quantity, price);
                  nameedit.value = item;
                  quanedit.value = quantity;
                  priceedit.value = price;
                  snoEdit.value = e.target.id;
                  console.log(e.target.id)
                  $('#editModal').modal('toggle');
                })
              })

              deletes = document.getElementsByClassName('delete');
              Array.from(deletes).forEach((element)=>{
                element.addEventListener("click", (e)=>{
                  console.log("edit, ");
                  sno = e.target.id.substr(1,);

                  if(confirm("Are You Sure! You Want To Delete?")){

                    console.log("yes");
                    window.location = `/PHP/Billal Hossan/class 32 (CURD project).php?delete=${sno}`;
                  }
                  else{
                    console.log("no");
                  }
                  
                })
              })
            
            </script> 
  
  </body>

  
</html>