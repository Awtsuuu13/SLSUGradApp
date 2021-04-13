<style>
.error {
    border: 1px red solid;
}
</style>


<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Update Student</li>
</ol>


<div class="student_details">

    <div class="col-md-9">
        <h2>Student Information</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?add" method="POST"
            onsubmit="return checkforblank()">
            <div class="form-student">
                <div class="form-group spacing">
                    <div class="row">
                        <div class="col-md-4">
                            <label id="label" class="text-right">Student ID:</label>
                            <input class="form-control input-md " name="IDNO" placeholder="Student Id" type="text"
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-student">
                <div class="form-group spacing">
                    <div class="row">
                        <div class="col-md-4">
                            <label id="label" class="text-right"> First Name:</label>
                            <input class="form-control input-md" name="fname" required placeholder="First Name"
                                type="text">
                        </div>

                        <div class="col-md-4">
                            <label id="label" class="text-right">Last Name:</label>
                            <input class="form-control input-md" name="lname" required placeholder="Last Name"
                                type="text">
                        </div>

                        <div class="col-md-4">
                            <label id="label" class="text-right">Middle Name:</label>
                            <input class="form-control input-md" name="mname" required placeholder="Middle Name"
                                type="text">
                        </div>
                    </div>
                </div>


            </div>

            <div class="form-student">
                <div class="form-group spacing">
                    <div class="row">
                        <div class="col-md-12">
                            <label id="label" class="text-right"> Address:</label>
                            <input class="form-control input-md" name="address" required placeholder="Address"
                                type="text">
                        </div>


                    </div>
                </div>
            </div>

            <div class="form-student">
                <div class="form-group spacing">
                    <div class="row">
                        <div class="col-md-4">
                            <label id="label" class="text-right"> Gender:</label>
                            <select type="text" name="gender" onchange="checkforblank()" class="form-control"
                                id="gender">
                                <option value="Please Select">
                                    Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label id="label" class="text-right">Date of Birth:</label>
                            <input class="form-control input-md" name="bday" placeholder="" required type="date">
                        </div>

                        <div class="col-md-4">
                            <label id="label" class="text-right"> Contact Number:</label>
                            <input class="form-control input-md" name="contact" required placeholder="Contact Number (Only Numbers)" 
                                type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class=" form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label id="label" class="text-right"> Place of Birth:</label>
                                        <input class="form-control input-md" required name="bplace"
                                            placeholder="Place of Birth" type="text">
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> Nationality:</label>
                                        <input class="form-control input-md" required name="nationality"
                                            placeholder="Nationality" type="text">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Religion:</label>
                                        <input class="form-control input-md" required name="religion"
                                            placeholder="Religion" type="text">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Civil Status:</label>
                                        <select class="form-control" onchange="checkforblank()" name="civilstatus"
                                            id="status">
                                            <option value="Please Select">Select Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="label" class="text-right"> Guardian Name:</label>
                                        <input class="form-control input-md" required name="guardian"
                                            placeholder="Guardian Name" type="text">
                                    </div>

                                    <div class="col-md-6">
                                        <label id="label" class="text-right">Contact No. of Guardian:</label>
                                        <input class="form-control input-md" required name="contact_guardian"
                                            placeholder="Contact No. of Guardian (Only Numbers)" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>

                                </div>
                            </div>


                        </div>



                        <!-- ----------------------------------------------------------------- -->
                        <br><br>
                        <h3>Educational Background</h3>
                        <br>
                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label id="label" class="text-right"> Elemtary School Name:</label>
                                        <input class="form-control input-md" required name="elem"
                                            placeholder="Elemtary School Name:" type="text">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Year Graduated:</label>
                                        <input class="form-control input-md" required name="elem_year"
                                            placeholder="Year Graduated (Only Numbers)" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label id="label" class="text-right"> High School Name:</label>
                                        <input class="form-control input-md" required name="hs"
                                            placeholder="High School Name" type="text">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Year Graduated:</label>
                                        <input class="form-control input-md" required name="hs_year"
                                            placeholder="Year Graduated (Only Numbers)" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label id="label" class="text-right"> University School Name:</label>
                                        <input class="form-control input-md" required name="col"
                                            placeholder="University School Name:" type="text">
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right">Year Graduated:</label>
                                        <input class="form-control input-md" required name="col_year"
                                            placeholder="Year Graduated (Only Numbers)" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>

                                </div>
                            </div>


                        </div>

                        <!-- ----------------------------------------------------------------- -->
                        <br><br>
                        <h3>Course</h3>
                        <br>
                        <div class="form-student">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label id="label" class="text-right"> Department:</label>
                                        <select required="required" autofocus="autofocus" class="form-control"
                                            name="department">
                                            <option disabled="disabled" selected="selected">Select Department</option>
                                            <?php 

                        $mydepartment = "SELECT * FROM department";
                        $result = mysqli_query($db, $mydepartment);

                        mysqli_num_rows($result);

                        while($row = $result->fetch_assoc()){
                         ?>
                                            <option value="<?php echo $row['DEPT_ID'] ?>">
                                                <?php echo $row['DEPARTMENT_NAME'].' ('.$row['DEPARTMENT_DESC'].')'?>
                                            </option>
                                            <?php
                        }

                     ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label id="label" class="text-right"> Course</label>
                                        <select required="required" autofocus="autofocus" class="form-control"
                                            name="course">
                                            <option disabled="disabled" selected="selected">Select Course</option>

                                        </select>
                                    </div>

                                </div>
                            </div>


                        </div>
                        
                        <br>
                        <div class="form-student1">
                            <div class="form-group spacing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success btn-lg" value="Save">
                                        <a href="student.php" class="btn btn-danger btn-lg">Cancel</a>
                                    </div>


                                </div>
                            </div>


                        </div>
        </form>

    </div>

</div>


<script>
function checkforblank() {

    var location = document.getElementById('gender');

    var status = document.getElementById('status');

    var invalid = location.value == "Please Select";

    var invalid1 = status.value == "Please Select";

    if (invalid) {
        alert('Please select gender.');
        location.className = 'form-control error';
    } else if (invalid1) {
        alert('Please select status.');
        status.className = 'form-control error';
    } else {
        location.className = 'form-control';
        status.className = 'form-control';
    }

    return !invalid;
    return !invalid1;

}

</script>

<script src="../../assets/vendor/jquery/jquery.min.js"></script>

<script>
    $( "select[name='department']" ).change(function () {
    var stateID = $(this).val();


    if(stateID) {


        $.ajax({
            url: "ajaxpro.php",
            dataType: 'Json',
            data: {'DEPT_ID':stateID},
            success: function(data) {
                $('select[name="course"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="course"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        $('select[name="course"]').empty();
    }
});
</script>