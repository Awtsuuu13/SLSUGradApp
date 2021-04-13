<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Home</a>
          </li>
          <li class="breadcrumb-item active">Department</li>
        </ol>
        
          
       
        <!-- DataTables Example -->
        <div class="card mb-3">
         
          <div id="card-header">
            <h2 style="padding: 30px 0px 0px 20px">
            Add Department</h2> 
            <img width="100px" src="/gradapp/assets/img/logo.png" style="float: right; margin: -70px 20px 0px 0px"></div>
          <div class="card-body">
          		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
           
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for="DEPARTMENT_NAME"><strong>School Year:</strong></label>

                      <div class="col-md-8">
                       
                         <input class="form-control input-sm" id="DEPARTMENT_NAME" name="schoolyear" placeholder="School Year" type="text" value="" required="">
                      </div>
                    </div>
                  </div>

            		 <div class="form-group">
                    <div class="col-md-8">
                      <div class="col-md-8">
                       <button class="btn btn-primary btn-sm" name="save" type="submit"><span style="color:white" class="fa fa-save fw-fa"></span>  Save</button> 
                          
                       </div>
                    </div>
                  </div>
          
        </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>