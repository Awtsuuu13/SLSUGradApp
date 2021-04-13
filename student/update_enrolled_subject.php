
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Update Enrolled Subject</li>
            </ol>

            <div class="card mb-3">

                <div id="card-header">
                    <h2 style="padding: 30px 0px 0px 20px">
                        Update Enrolled Subject</h2>
                    <img width="100px" src="../assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px">
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $_GET['id']?>;" method="POST">

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>Subject
                                        Code:</strong></label>

                                <div class="col-md-9 search-box">
                    
                                    <input type="text" class="form-control input-sm" id="DEPARTMENT_NAME" name="subject" placeholder="Subject Code" type="text" 
                                    value="<?php echo $subject_code?>" autocomplete="off" required="">
                                    
                                        <div class="result"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>
                                        Professor Name:</strong></label>

                                <div class="col-md-9">

                                    <input type="text" class="form-control input-sm" id="DEPARTMENT_NAME"
                                        name="prof_name" placeholder="Professor Name" type="text" value="<?php echo $prof_name?>" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <div class="col-md-9">
                                    <button class="btn btn-primary" name="save" type="submit"><span style="color:white"
                                            class="fa fa-save fw-fa"></span> Save</button>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
              
            </div>
