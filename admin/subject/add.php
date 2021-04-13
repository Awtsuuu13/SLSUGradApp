<style>
.error {
    border: 1px red solid;
}
</style>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Add Course</li>
</ol>



<!-- DataTables Example -->
<div class="card mb-3">

    <div id="card-header">
        <h2 style="padding: 30px 0px 0px 20px">
            Add Course</h2>
        <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
    </div>
    <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
            onsubmit="return checkforblank()">

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label><strong>Subject Code:</strong></label>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="First name" required
                                name="subj_code">
                        </div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label><strong>Subject Description:</strong></label>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="First name" required
                                name="subj_desc">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label><strong>Unit:</strong></label>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="First name" required
                                name="unit">
                        </div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label><strong>Pre-Requisite:</strong></label>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="First name" required="required"
                                name="requisite">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <div class="form-label-group">
                            <select class="form-control" name="year" onchange="checkforblank()" id="level">
                                <option value="Please Select"> Select Year</option>
                                <?php

                              $sql = "SELECT * FROM tbllevel";

                              $res = mysqli_query($db, $sql);

                              while($row = mysqli_fetch_array($res)){
                                ?>
                                <option value="<?php echo $row['YEARLEVEL']?>"><?php echo $row['YEARLEVEL']?></option>
                                <?php
                              }

                             ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <div class="form-label-group">
                            <select onchange="checkforblank()" id="semester" class="form-control" name="semester">
                                <option value="Please Select"> Select Semester</option>
                                <?php

                              $sql = "SELECT * FROM tblsemester";

                              $res = mysqli_query($db, $sql);

                              while($row = mysqli_fetch_array($res)){
                                ?>
                                <option value="<?php echo $row['SEMESTER']?>"><?php echo $row['SEMESTER']?></option>
                                <?php
                              }

                             ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">

                    <div class="col-sm-6 form-group">
                        <div class="form-label-group">
                            <select onchange="checkforblank()" id="course" class="form-control" name="course">
                                <option value="Please Select"> Select Course</option>
                                <?php

                              $sql = "SELECT * FROM course";

                              $res = mysqli_query($db, $sql);

                              while($row = mysqli_fetch_array($res)){
                                ?>
                                <option value="<?php echo $row['COURSE_ID'] ?>">
                                    <?php echo $row['COURSE_NAME']." (".$row['COURSE_DESC'].")" ?></option>
                                <?php
                              }

                             ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <div class="row">

                    <div class="col-sm-6 form-group">
                        <input type="submit" value="Insert" class="btn btn-primary">
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


<script>
function checkforblank() {

    var location = document.getElementById('level');
    var invalid = location.value == "Please Select";

    var semester = document.getElementById('semester');
    var invalid1 = semester.value == "Please Select";

    var course = document.getElementById('course');
    var invalid2 = course.value == "Please Select";

    if (invalid) {
        alert('Please select year level.');
        location.className = 'form-control error';
    } else if (invalid1) {
        alert('Please select semester.');
        semester.className = 'form-control error';
    } else if (invalid2) {
        alert('Please select course.');
        course.className = 'form-control error';
    } else {
        location.className = 'form-control';
        semester.className = 'form-control';
        course.className = 'form-control';
    }

    return !invalid;
    return !invalid1;
    return !invalid2;
}
</script>