<?php
if($this->session->flashdata('message')) {
  $message = $this->session->flashdata('message');
  ?>
<div class="alert alert-<?php echo $message['class']; ?>">
<button class="close" data-dismiss="alert" type="button">×</button>
<?php echo $message['message']; ?>
</div>
<?php
}
?>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add <?php echo $page_title; ?></h2>
                <div class="box-icon">
          			<a class="btn btn-minimize btn-round btn-default" href="#">
            			<i class="glyphicon glyphicon-chevron-up"></i>
          			</a>
       	 		</div>
            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="category">Choose Category</label>
                        <select name="category" class="form-control required" placeholder="">
                            <option value="">Choose Category</option>
                            <?php foreach($categories as $category){ ?>
                                <optgroup label="<?php echo $category->category_name; ?>">
                                    <?php 
                                        if($category->parent_category==0){
                                            $get_parent_category = $this->service_model->get_service_parents_categories(array('parent_category'=>$category->id));
                                            foreach ($get_parent_category as $child_category) {
                                               ?>
                                               <option value="<?php echo $child_category->id;  ?>"><?php echo $child_category->category_name;  ?></option>
                                               <?php
                                            }
                                            ?>
                                            
                                            <?php
                                        }
                                        else{
                                           
                                        }          
                                    ?>                                    
                                </optgroup>
                                <!-- <option value="<?php echo $categories->id; ?>"><?php echo $categories->category_name; ?></option> -->
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="service_name">Service Name</label>
                        <input type="text" name="service_name" class="form-control required" placeholder="Enter Service Name">
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="serviceicon">Select Icon</label>
                        <input type="file" name="service_icon"/>
                    </div>
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Service</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div>

<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-eye-open"></i> View <?php echo $page_title; ?></h2>
        <div class="box-icon">
          			<a class="btn btn-minimize btn-round btn-default" href="#">
            			<i class="glyphicon glyphicon-chevron-up"></i>
          			</a>
       	 		</div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Service Name</th>
        <th>Category Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $service) {
	?>
    <tr>
        <td><?php echo $service->service_name; ?></td>
        <td>
            <?php 
                $get_parent_category = $this->service_model->get_parent_category_detail(array('id'=>$service->category));
                echo $get_parent_category->category_name;
            ?>
        </td>
       <td>
            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>service/edit_service/<?php echo $service->id; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>service/delete_service/<?php echo $service->id; ?>">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
        </td>
    </tr>
    <?php
	}
	?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>

<div class="modal modal-wide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>View Service</h3>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/ajax-loader-4.gif" /></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>