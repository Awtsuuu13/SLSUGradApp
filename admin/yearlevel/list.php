<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Year Level</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">

    <div id="card-header">
        <h1 style="padding: 30px 0px 0px 20px"><i class="fas fa-table"></i>
            List of Year Level <a href="index.php?add" class="btn btn-primary"> New<img
                    src="/gradapp/assets/img/plus_30px.png" width="20px"> </a></h1>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #4CAF50; color: white">
                    <tr>
                        <th>Year Level</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $sql = "SELECT * FROM `tbllevel` ORDER BY `tbllevel`.`LEVELID` ASC";
                    $result = mysqli_query($db, $sql);

                    mysqli_num_rows($result);

                    while ($row = mysqli_fetch_array($result)) {
                     ?>
                    <tr>

                        <td width="80%"><?php echo $row['YEARLEVEL'] ?></td>
                        <td align="center">
                            <a href="" class="btn btn-info btn-xs" data-toggle="modal"
                                data-target="#update<?php echo $row['LEVELID']?>"><span style="color:white"
                                    class="fa fa-edit fw-fa"></span></a>
                            <a href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete<?php echo $row['LEVELID']?>"><span style="color:white"
                                    class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <!-- Update Modal -->
                    <div class="modal fade" id="update<?php echo $row['LEVELID']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update School Year
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?update=<?php echo $row['LEVELID']?>"
                                        method="POST">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="dept-name">Year Level:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" value="<?php echo $row['YEARLEVEL']?>" name="yearlevel"
                                                        class="form-control">
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
                    <div class="modal fade" id="delete<?php echo $row['LEVELID']?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width: auto; max-width: 622.222px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Year Level
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?delete=<?php echo $row['LEVELID']?>"
                                        method="POST">

                                        <h4>Are you sure you want to <span class="text-danger">delete</span> this
                                            Year Level?</h4>
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