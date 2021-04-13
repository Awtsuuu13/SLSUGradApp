<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Semester</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">

    <div id="card-header">
        <h2 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Semester</h2>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                    <tr>
                        <th>Semester</th>
                        <th>Set Semester</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $sql = "SELECT * FROM `tblsemester`";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while ($row = mysqli_fetch_array($result)) {
                     ?>
                    <tr>

                        <td width="20%"><?php echo $row['SEMESTER'] ?></td>
                        <td width="60%"><?php echo $row['SETSEM'] ?></td>
                        <td align="center">
                            <a href="" class="btn btn-primary btn-xs " data-toggle="modal"
                                data-target="#update<?php echo $row['SEMID']?>"><span style="color:white"  class="fa fa-edit fw-fa">Set </span></a>

                        </td>
                    </tr>

                    <!-- Update Modal -->
                    <div class="modal fade" id="update<?php echo $row['SEMID']?>" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Semester
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?update=<?php echo $row['SEMID']?>"
                                        method="POST">

                                        <h4>Make this semester as an active?</h4>
                                        
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <input type="submit" class="btn btn-info" value="Update">
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