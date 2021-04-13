<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Home</a>
          </li>
          <li class="breadcrumb-item active">User</li>
        </ol>
        
          
       
        <!-- DataTables Example -->
        <div class="card mb-3">
         
          <div id="card-header">
            <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Users <a href="index.php?add" class="btn btn-primary"> New<img src="/gradapp/assets/img/plus_30px.png" width="20px"> </a></h1> 
            <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px"></div>
          <div class="card-body">
            
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                  <tr>
                    <th>Account Name</th>
                    <th>Account Type</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $sql = "SELECT * FROM useraccounts";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while ($row = mysqli_fetch_array($result)) {
                     ?>
                     <tr>
                       <td class="text-center" width="25%"><?php echo $row['ACCOUNT_NAME'] ?></td>
                       <td width="35%" class="text-center"><?php echo $row['ACCOUNT_TYPE'] ?></td>
                       <td align="center">
                         <a href="" class="btn btn-primary btn-xs  "><span style="color:white" class="fa fa-edit fw-fa"></span></a>
                         <a href="" class="btn btn-danger btn-xs  "><span style="color:white" class="fa fa-trash"></span></a>
                         <a href="" class="btn btn-info btn-xs"><span style="color:white" class="fa fa-pencil-o fw-fa">Reset Password</span></a>
                       </td>
                     </tr>
                     <?php
                    }




                   ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>