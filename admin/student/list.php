<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Student</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">

    <div id="card-header">
        <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Student <a href="index.php?add" class="btn btn-primary"> New<img
                    src="/gradapp/assets/img/plus_30px.png" width="20px"> </a></h1>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                    <tr>
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Course</th>
                        <th>Upload Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $sql = "SELECT * FROM `tblstudent` s, `course` c WHERE s.COURSE_ID = c.COURSE_ID";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while ($row = mysqli_fetch_array($result)) {
                     ?>
                    <tr>
                        <td width="10%"><?php echo $row['IDNO'] ?></td>
                        <td width="15%"><?php echo $row['FNAME'] ?> <?php echo $row['LNAME'] ?>
                            <?php echo $row['MNAME'] ?></td>
                        <td width="5%"><?php echo $row['SEX'] ?></td>
                        <td width="3%"><?php echo $row['AGE'] ?></td>
                        <td width="15%"><?php echo $row['HOME_ADD'] ?></td>
                        <td width="10%"><?php echo $row['CONTACT_NO'] ?></td>
                        <td width="1%"><?php echo $row['COURSE_NAME'] ?></td>
                        <td>
                        <a href="" data-toggle="modal" data-target="#uploadedgrade<?php echo $row['IDNO']?>"
                                class="btn btn-warning"><i style="color: #fff" class="fa fa-print"> </i> View
                                Uploaded Grade</a></td>
                        <td>
                            <a href="index.php?update=<?php echo $row['IDNO']?>"
                                class="btn btn-primary btn-xs  "><span style="color:white"
                                    class="fa fa-edit fw-fa"></span></a>
                            <a href="" class="btn btn-danger btn-xs  "><span style="color:white"
                                    class="fa fa-trash"></span></a>

                        </td>
                    </tr>

                    <div class="modal fade" id="uploadedgrade<?php echo $row['IDNO']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">View Uploaded Grade Image
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <a href="../../file_upload/<?php echo $row['IDNO']?>.jpg"
                                        class="btn btn-warning btn-sm " target="_blank"> VIEW FULL IMAGE</a>
                                    <img src="../../file_upload/<?php echo $row['IDNO']?>.jpg" width="100%" />
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