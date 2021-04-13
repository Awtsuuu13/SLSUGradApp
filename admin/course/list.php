<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Courses</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">

    <div id="card-header">
        <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Courses <a href="index.php?add" class="btn btn-primary"> New<img
                    src="/gradapp/assets/img/plus_30px.png" width="20px"> </a></h1>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                    <tr>
                        <th>Course</th>
                        <th>Description</th>
                        <th>Department</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $sql = "SELECT * FROM `course` c, `department` d WHERE c.DEPT_ID=d.DEPT_ID";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while ($row = mysqli_fetch_array($result)) {
                     ?>
                    <tr>
                        <td width="15%"><?php echo $row['COURSE_NAME'] ?></td>
                        <td width="50%"><?php echo $row['COURSE_DESC'] ?></td>
                        <td width="15%"><?php echo $row['DEPARTMENT_NAME'] ?></td>
                        <td align="center">
                            <a href="" class="btn btn-info btn-xs" data-toggle="modal"
                                data-target="#update<?php echo $row['COURSE_ID']?>"><span style="color:white"
                                    class="fa fa-edit fw-fa"></span></a>
                            <a href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete<?php echo $row['COURSE_ID']?>"><span style="color:white"
                                    class="fa fa-trash"></span></a>

                        </td>
                    </tr>

                    <!-- Update Modal -->
                    <div class="modal fade" id="update<?php echo $row['COURSE_ID']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Deparment
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?update=<?php echo $row['COURSE_ID']?>"
                                        method="POST">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Course Code:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['COURSE_NAME']?>"
                                                        name="COURSE_NAME" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Course Description:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['COURSE_DESC']?>"
                                                        name="COURSE_DESC" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Department Name:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="DEPARTMENT" id="select" class="form-control required">
                                                        
                                                        <?php 

                                                        $sql1 = "SELECT * FROM `department`";
                                                        $result1 = mysqli_query($db, $sql1);

                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                          ?>
                                                          <option value="<?php echo $row1['DEPT_ID']?>">
                                                            <?php echo $row1['DEPARTMENT_NAME'] ." (". $row1['DEPARTMENT_DESC'] .")" ?>
                                                          </option>
                                                          <?php
                                                         }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4"> </div>
                                                <div class="col-md-8">
                                                    <input type="submit" value="Update" class="btn btn-success">
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete<?php echo $row['COURSE_ID']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Deparment
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?delete=<?php echo $row['COURSE_ID']?>"
                                        method="POST">

                                        <h4>Are you sure you want to <span class="text-danger">delete</span> this
                                            department?</h4>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </div>


                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                    }




                   ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


<script>

select = document.getElementById('select'); // or in jQuery use: select = this;
if (select.value) {
  // value is set to a valid option, so submit form
  return true;
}
return false;
</script>