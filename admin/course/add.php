<style>

.error {border: 1px red solid;}

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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" onsubmit="return checkforblank()">

            <div class="form-group">
                <div class="col-md-8">
                    <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>Course:</strong></label>

                    <div class="col-md-8">

                        <input class="form-control input-sm" id="DEPARTMENT_NAME" name="COURSE_NAME"
                            placeholder="Course Name" type="text" value="" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>Course
                            Description:</strong></label>

                    <div class="col-md-8">

                        <textarea class="form-control input-sm" id="DEPARTMENT_NAME" name="COURSE_DESC"
                            placeholder="Course Description" type="text" value="" required></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>Course
                            Description:</strong></label>

                    <div class="col-md-8">

                        <select class="form-control" name="department" onchange="checkforblank()" id="Location">
                        <option value="Please Select">Select Department</option>
                            <?php 

                        $mydepartment = "SELECT * FROM department";
                        $result = mysqli_query($db, $mydepartment);

                        mysqli_num_rows($result);

                        while($row = $result->fetch_assoc()){
                         ?>
                            <option value="<?php echo $row['DEPT_ID'] ?>">
                                <?php echo $row['DEPARTMENT_NAME'].' ('.$row['DEPARTMENT_DESC'].')'?></option>
                            <?php
                        }

                     ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <div class="col-md-8">
                        <button class="btn btn-primary btn-sm" name="save" type="submit"><span style="color:white"
                                class="fa fa-save fw-fa"></span> Save</button>

                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

    <script>
    function checkforblank() {

        var location = document.getElementById('Location');
        var invalid = location.value == "Please Select";

        if (invalid) {
            alert('Please enter Department name.');
            location.className = 'form-control error';
        } else {
            location.className = 'form-control';
        }

        return !invalid;
    }
    </script>