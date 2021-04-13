<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Subject</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">
    <div id="card-header">
        <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Subject <a href="index.php?add" class="btn btn-primary"> New<img
                    src="/gradapp/assets/img/plus_30px.png" width="20px"> </a></h1>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Pre-Requisite</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                $sql = "SELECT * FROM `subject` s, `course` c WHERE s.COURSE_ID = c.COURSE_ID";
                $result = mysqli_query($db, $sql);

                if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){
                  ?>

                    <tr style=>
                        <td><?php echo $row['SUBJ_CODE'] ?></td>
                        <td style="width: 25%;"><?php echo $row['SUBJ_DESCRIPTION'] ?></td>
                        <td><?php echo $row['UNIT'] ?></td>
                        <td style="width: 10%;"><?php echo $row['PRE_REQUISITE'] ?></td>
                        <td><?php echo $row['COURSE_NAME'] ?></td>
                        <td><?php echo $row['YEARLEVEL'] ?></td>
                        <td><?php echo $row['SEMESTER'] ?></td>
                        <td><?php echo $row['CURRICULUM'] ?></td>
                        <td>
                            <a href="" class="btn btn-info btn-xs" data-toggle="modal"
                                data-target="#update<?php echo $row['SUBJ_ID']?>"><span style="color:white"
                                    class="fa fa-edit fw-fa"></span></a>
                            <a href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete<?php echo $row['SUBJ_ID']?>"><span style="color:white"
                                    class="fa fa-trash"></span></a>

                        </td>
                    </tr>

                    <!-- Update Modal -->
                    <div class="modal fade" id="update<?php echo $row['SUBJ_ID']?>" tabindex="-1" role="dialog"
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
                                    <form
                                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?update=<?php echo $row['SUBJ_ID']?>"
                                        method="POST">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Subject Code:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['SUBJ_CODE']?>"
                                                        name="subj_code" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Subject Description:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea name="subj_desc" class="form-control"
                                                        id=""><?php echo $row['SUBJ_DESCRIPTION'] ; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Unit:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['UNIT']?>" name="unit"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Pre-Requisite:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['PRE_REQUISITE']?>"
                                                        name="requisite" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Course Holder:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="course" id="" class="form-control">
                                                        <option value="<?php echo $row['COURSE_ID']?>" disabled>
                                                            <?php echo $row['COURSE_NAME'] ." (". $row['COURSE_DESC'] .")" ?>
                                                        </option>

                                                        <?php 

                                                        $sql1 = "SELECT * FROM `course`";
                                                        $result1 = mysqli_query($db, $sql1);

                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                          ?>
                                                        <option value="<?php echo $row1['COURSE_ID']?>">
                                                            <?php echo $row1['COURSE_NAME'] ." (". $row1['COURSE_DESC'] .")" ?>
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
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Year Level:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="year" id="" class="form-control">
                                                        <option value="<?php echo $row['LEVELID']?>" disabled>
                                                            <?php echo $row['YEARLEVEL'] ?>
                                                        </option>

                                                        <?php 

                                                        $sql1 = "SELECT * FROM `tbllevel`";
                                                        $result1 = mysqli_query($db, $sql1);

                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                          ?>
                                                        <option value="<?php echo $row1['YEARLEVEL']?>">
                                                            <?php echo $row1['YEARLEVEL']?>
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
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Semester:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="semester" id="" class="form-control">
                                                        <option value="<?php echo $row['SEMID']?>" disabled>
                                                            <?php echo $row['SEMESTER'] ?>
                                                        </option>

                                                        <?php 

                                                        $sql1 = "SELECT * FROM `tblsemester`";
                                                        $result1 = mysqli_query($db, $sql1);

                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                          ?>
                                                        <option value="<?php echo $row1['SEMESTER']?>">
                                                            <?php echo $row1['SEMESTER']?>
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
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Curriculum:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="cur" id="" class="form-control">
                                                        <option value="<?php echo $row['CURRICULUM']?>" disabled>
                                                            <?php echo $row['CURRICULUM']?>
                                                        </option>
                                                        <option value="New Curriculum">
                                                            New Curriculum
                                                        </option>

                                                        <option value="Old Curriculum">
                                                            Old Curriculum
                                                        </option>


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
                    <div class="modal fade" id="delete<?php echo $row['SUBJ_ID']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Subject
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                       
                                        <h4>Are you sure you want to <span class="text-danger">delete</span> this
                                            Subject?</h4>
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
              }

                 ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>

</div>
<!-- /.container-fluid -->