<?php include 'includes/header.php'; ?>

<?php 

require 'includes/connection.php';

?>

<style>

.error {border: 1px red solid;}

</style>
<div id="wrapper">

    <?php include 'includes/sidebar.php'; ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <form action="#" class="group" method="post" onsubmit="return checkforblank()">
                <legend><span class="number">1</span>Departing & Arriving</legend>
                <fielset class="col-sm-6">
                    <label for="FDestination">From</label>
                    <select class="form-control" name="Location" id="Location" onchange="checkforblank()">
                        <option value="Please Select">Please Select</option>
                        <option value="Newport">Newport</option>
                        <option value="Mahdi">Mahdi</option>
                        <option value="Cardiff">Cardiff</option>
                        <option value="Cilo">Cilo is</option>
                    </select>
                    </fieldset>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                    <button>Save</button>
            </form>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php include 'includes/footer.php' ?>

<script>
function checkforblank() {

    var location = document.getElementById('Location');
    var invalid = location.value == "Please Select";

    if (invalid) {
        alert('Please enter first name');
        location.className = 'error';
    } else {
        location.className = '';
    }

    return !invalid;
}
</script>