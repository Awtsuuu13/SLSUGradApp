
<style type="text/css">
label {
    font-size: 12px;
    font-weight: bold;
}

.error {border: 1px red solid;}
</style>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">Profiles</li>
</ol>
<div class="col-lg-12">

    <?php if (isset($_GET['update'])) {
                  $username = $_GET['update'];


                  $sql = "SELECT * FROM `tblstudent` s, `course` c WHERE IDNO = '$username' AND s.COURSE_ID = c.COURSE_ID";
                  $result = mysqli_query($db, $sql);

                  mysqli_num_rows($result);

                  while ($row = mysqli_fetch_array($result)) {
                    ?>
    <div class="col-sm-3 hidden-xs">
        <div class="panel">
            <ul class="list-group">
                <li class="list-group-items text-right">
                    <span class="pull-left"><strong>NAME:</strong></span>
                    <?php echo $row['FNAME'].' '.$row['LNAME'] ?>
                </li>
                <li class="list-group-items text-right">
                    <span class="pull-left"><strong>Course:</strong></span>
                    <?php echo $row['COURSE_NAME'].' | '.$row['COURSE_DESC'] ?>
                </li>
            </ul>
        </div>
    </div>


    <div class="col-sm-9" style="float: right;margin-top: -100px;">


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?update=<?php echo $_GET['update']?>" class="form-horizontal" method="post" onsubmit="return checkforblank()">
            <div class="table-responsive">
                <div class="col-md-8">
                    <h2>Student Information</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><label>Id</label></td>
                            <td>
                                <input class="form-control input-md" readonly="" id="IDNO" name="IDNO"
                                    placeholder="Student Id" type="text" value="<?php echo $row['IDNO'] ?>">
                            </td>
                            <td colspan="4"></td>

                        </tr>
                        <tr>
                            <td><label>Firstname</label></td>
                            <td>
                                <input required="true" class="form-control input-md" id="FNAME" name="FNAME"
                                    placeholder="First Name" type="text" value="<?php echo $row['FNAME'] ?>">
                            </td>
                            <td><label>Lastname</label></td>
                            <td colspan="2">
                                <input required="true" class="form-control input-md" id="LNAME" name="LNAME"
                                    placeholder="Last Name" type="text" value="<?php echo $row['LNAME'] ?>">
                            </td>
                            <td>
                                <input class="form-control input-md" id="MI" name="MI" placeholder="MI" type="text"
                                    value="<?php echo $row['MNAME'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Address</label></td>
                            <td colspan="5">
                                <input required="true" class="form-control input-md" id="PADDRESS" name="PADDRESS"
                                    placeholder="Permanent Address" type="text" value="<?php echo $row['HOME_ADD'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Sex </label></td>
                            <td colspan="2">
                                <select type="text" name="gender" onchange="checkforblank()"
                                    class="form-control" id="gender">
                                    <option value="Please Select">
                                        Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                            <td><label>Date of birth</label></td>
                            <td colspan="2">
                                <div class="input-group ">
                                    <input required="true" name="BIRTHDATE" id="BIRTHDATE" type="date"
                                        class="form-control input-md" data-inputmask="'alias': 'mm/dd/yyyy'"
                                        data-mask="" value="<?php echo $row['BDAY'] ?>">
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td><label>Place of Birth</label></td>
                            <td colspan="5">
                                <input required="true" class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE"
                                    placeholder="Place of Birth" type="text" value="<?php echo $row['BPLACE'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nationality</label></td>
                            <td colspan="2"><input required="true" class="form-control input-md" id="NATIONALITY"
                                    name="NATIONALITY" placeholder="Nationality" type="text"
                                    value="<?php echo $row['NATIONALITY'] ?>">
                            </td>
                            <td><label>Religion</label></td>
                            <td colspan="2"><input required="true" class="form-control input-md" id="RELIGION"
                                    name="RELIGION" placeholder="Religion" type="text"
                                    value="<?php echo $row['RELIGION'] ?>">
                            </td>

                        </tr>
                        <tr>
                            <td><label>Contact No.</label></td>
                            <td colspan="3"><input required="true" class="form-control input-md" id="CONTACT"
                                    name="CONTACT" placeholder="Contact Number" type="text"
                                    value="<?php echo $row['CONTACT_NO'] ?>">
                            </td>
                            <td><label>Civil Status</label></td>
                            <td colspan="2">
                                <select class="form-control" onchange="checkforblank()" name="CIVILSTATUS" id="status">
                                    <option value="Please Select">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label>Gaurdian</label></td>
                            <td colspan="2">
                                <input required="true" class="form-control input-md" id="GUARDIAN" name="GUARDIAN"
                                    placeholder="Parents/Guardian Name" type="text"
                                    value="<?php echo $row['guardian'] ?>">
                            </td>
                            <td><label>Contact No. of Guardian</label></td>
                            <td colspan="2"><input required="true" class="form-control input-md" id="GCONTACT"
                                    name="GCONTACT" placeholder="Contact Number" type="text"
                                    value="<?php echo $row['guardian_contact'] ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5">
                                <button class="btn btn-success btn-lg" name="save" type="submit">Save</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php

                        }
                   } ?>



    <script>
    function checkforblank() {

        var location = document.getElementById('gender');

        var status = document.getElementById('status');

        var invalid = location.value == "Please Select";

        var invalid1 =  status.value == "Please Select";

        if (invalid) {
            alert('Please select gender.');
            location.className = 'form-control error';
        } else if (invalid1){
            alert('Please select status.');
            status.className = 'form-control error';
        }
        else {
            location.className = 'form-control';
            status.className = 'form-control';
        }

        return !invalid;
        return !invalid1;

    }
  </script>