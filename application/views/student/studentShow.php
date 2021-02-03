<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <div class="row">  
        <div class="col-md-12">
            <section class="content-header" style="padding-right: 0;">
                <h1>
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>

            </section>
        </div>

        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">

                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                                ?>
                                <li <?php
                                if ($student["section_id"] == $svalue["section_id"]) {
                                    echo "class='active'";
                                }
                                ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
                                <?php } ?>
                        </ul> 
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                         
                        <?php foreach ($class_section as $skey => $snvalue) {
                            ?>
                            <div class="tab-pane <?php
                            if ($student["section_id"] == $snvalue["section_id"]) {
                                echo "active";
                            }
                            ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                 <?php
                                 foreach ($studentlistbysection as $stkey => $stvalue) {
                                     if ($stvalue['section_id'] == $snvalue["section_id"]) {
										
                                         ?>
                                        <div class="studentname"> 
                                            <a class="" href="<?php echo base_url() . "student/view/" . $stvalue["id"] ?>">
                                                <div class="icon">
												
												<img src="<?php
                                                    if (!empty($stvalue["image"])) {
                                                        echo base_url() . $stvalue["image"];
                                                    } else {
														
                                                        if($student['gender']== 'Female'){
                                                             echo base_url() . "uploads/student_images/default_female.jpg";
                                                        }elseif($student['gender']== 'Male'){
                                                             echo base_url() . "uploads/student_images/default_male.jpg";
                                                        }
                                                       
                                                    }
                                                    ?>" alt="User Image"></div>
                                                <div class="student-tittle"><?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?></div></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div> 
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div>  
        <!-- /.control-sidebar -->
    </div>

    <section class="content">
        <div class="row">

            <div class="col-md-3"> 

                <div class="box box-primary"  <?php
                if ($student["is_active"] == "no") {
                    echo "style='background-color:#f0dddd;'";
                }
                ?>>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php
                                                    if (!empty($student["image"])) {
                                                        echo base_url() . $student["image"];
                                                    } else {
														
                                                        if($student['gender']== 'Female'){
                                                             echo base_url() . "uploads/student_images/default_female.jpg";
                                                        }else{
                                                             echo base_url() . "uploads/student_images/default_male.jpg";
                                                        }
                                                       
                                                    }
                                                    ?>" alt="User profile picture">
						
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>

                        <ul class="list-group list-group-unbordered">
                            <?php
                            if ($student['is_active'] == 'no') {
                                ?>



                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('disable')." ".$this->lang->line('reason') ?></b> <span class="pull-right text-aqua"><?php echo $reason_data['reason'] ?></span>
                                </li>
                                <li class="list-group-item listnoback">
                                     <b><?php  echo $this->lang->line('disable')." ".$this->lang->line('note') ?></b> <span class="pull-right text-aqua"><?php echo $student['dis_note'] ?></span>
                                </li>
                                 <li class="list-group-item listnoback">
                                    <b><?php  echo $this->lang->line('disable')." ".$this->lang->line('date') ?></b> <span class="pull-right text-aqua"><?php echo date($this->customlib->getSchoolDateFormat(),$this->customlib->dateyyyymmddTodateformat($student['disable_at'])); ?></span>
                                </li>


                            <?php } ?> 
                            
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                        <?php 
                            if ($sch_setting->roll_no) { ?> 
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <?php 
                        } ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class'] . " (" . $session . ")"; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                if (!empty($siblings)) {
                    ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('sibling'); ?></h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            foreach ($siblings as $sibling_key => $sibling_value) {
                                ?>
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="siblingview">
                                        <img class="" src="<?php echo base_url() . $sibling_value->image; ?>" alt="User Avatar">
                                        <h4><a href="<?php echo site_url('student/view/' . $sibling_value->id) ?>"><?php echo $sibling_value->firstname . " " . $sibling_value->lastname ?></a></h4>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">


                                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->admission_no; ?></a>
                                            </li>

                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->class; ?></a>
                                            </li> 
                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->section; ?></a>

                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                        <!-- /.box-body -->

                    </div>

                    <?php
                }
                ?>
 
            </div>
            <div class="col-md-9">

                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                        <?php
                        if ($this->rbac->hasPrivilege('student_timeline', 'can_add')) {
                            ?> 
                            <li class=""><a href="#timelineh" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('timeline') ?></a></li>
                        <?php } ?>




                        <?php if ($student["is_active"] == "yes") { ?>
                            <?php
                            if ($this->rbac->hasPrivilege('disable_student', 'can_view')) {
                                ?>
                                <li class="pull-right dropdown">
                                    <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a style="cursor: pointer;" href="<?php echo base_url() . "student/changepass/" . $student["id"] ?>"><?php echo $this->lang->line('change_password');?></a></li>
                                        <li><a style="cursor: pointer;" href="<?php echo base_url() . "student/changeusername/" . $student["id"] ?>"><?php echo $this->lang->line('change_username');?></a></li>
                                    </ul>


                                </li>

                                <li class="pull-right">
                                    <a style="cursor: pointer;" onclick="disable_student('<?php echo $student["id"] ?>')"  class="text-red" data-toggle="tooltip" data-placement="bottom" title="<?php echo "Disable"; ?>">
                                        <i class="fa fa-thumbs-o-down"></i><?php //echo "Disable Student";        ?>
                                    </a>
                                </li>

                                <?php
                            }

//5235
                            if ($this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
                                ?> 


                                <li class="pull-right">
                                    <a href="#"  class="schedule_modal text-green" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('login_details'); ?>"><i class="fa fa-key"></i>
                                        <?php //echo $this->lang->line('login_details');    ?>
                                    </a>
                                </li>
                                <?php
                            }  
                            if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                ?>

                                <li class="pull-right">
                                    <a href="<?php echo base_url() . "student/edit/" . $student["id"] ?>"  class="" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i>
                                        <?php //echo $this->lang->line('login_details');    ?>
                                    </a>
                                </li>
                                <?php
                            }
                        } else {
                            ?>

                           
                            <li class="pull-right">
                                <a href="#" onclick="enable('<?php echo $student["id"] ?>')"  class="text-green" data-toggle="tooltip" data-placement="left" title="<?php echo "Enable"; ?>">
                                    <i class="fa fa-thumbs-o-up"></i><?php ?>
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">

                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody> 
                                            <?php if ($sch_setting->admission_date) {  ?>
                                            <tr>
                                                <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                                <td class="col-md-5">                                          
                                                    <?php
                                                    if (!empty($student['admission_date'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->mobile_no) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                                <td><?php echo $student['mobileno']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->student_email) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('email'); ?></td>
                                                <td><?php echo $student['email']; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                            $cutom_fields_data = get_custom_table_values($student['id'], 'students');
                                            if (!empty($cutom_fields_data)) {
                                                foreach ($cutom_fields_data as $field_key => $field_value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $field_value->name; ?></td>
                                                        <td>
                                                            <?php
                                                            if (is_string($field_value->field_value) && is_array(json_decode($field_value->field_value, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                                                                $field_array = json_decode($field_value->field_value);
                                                                echo "<ul class='student_custom_field'>";
                                                                foreach ($field_array as $each_key => $each_value) {
                                                                    echo "<li>" . $each_value . "</li>";
                                                                }
                                                                echo "</ul>";
                                                            } else {
                                                                $display_field = $field_value->field_value;

                                                                if ($field_value->type == "link") {
                                                                    $display_field = "<a href=" . $field_value->field_value . " target='_blank'>" . $field_value->field_value . "</a>";
                                                                }
                                                                echo $display_field;
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>

                                <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');             ?> <?php //echo $this->lang->line('list');             ?></h2> -->
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('title'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('file'); ?> <?php echo $this->lang->line('name'); ?>
                                                </th>
                                                <th class="mailbox-date text-right">
                                                    <?php echo $this->lang->line('action'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <div class="row">                                     
                                            <tbody>
                                                <?php
                                                if (empty($student_doc)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($student_doc as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['title']; ?></td>
                                                            <td><?php echo $value['doc']; ?></td>
                                                            <td class="mailbox-date pull-right">
                                                                <a href="<?php echo base_url(); ?>student/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                    </table>
                                </div>  
                            </div>
                            </table>
                        </div>  

                        <div class="tab-pane" id="timelineh">
                            <div>   <?php if ($this->rbac->hasPrivilege('student_timeline', 'can_add')) { ?>
                                    <input type="button" id="myTimelineButton"  class="btn btn-sm btn-primary pull-right " value="<?php echo $this->lang->line('add') ?>" /> 

                                <?php } ?> 
                            </div>


                            <br/>
                            <div class="timeline-header no-border">
                                <div id="timeline_list">
                                    <?php
                                    if (empty($timeline_list)) {
                                        ?>
                                        <br/>
                                        <div class="alert alert-info"><?php echo $this->lang->line("no_record_found") ?></div>



                                    <?php } else {
                                        ?>

                                        <ul class="timeline timeline-inverse">
                                            <?php
                                            foreach ($timeline_list as $key => $value) {
                                                ?>      
                                                <li class="time-label">
                                                    <span class="bg-blue">    <?php
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['timeline_date']));
                                                        ?></span>
                                                </li> 
                                                <li>
                                                    <i class="fa fa-list-alt bg-blue"></i>
                                                    <div class="timeline-item">
                                                        <?php if ($this->rbac->hasPrivilege('student_timeline', 'can_delete')) { ?>
                                                            <span class="time"><a class="defaults-c text-right" data-toggle="tooltip" title="" onclick="delete_timeline('<?php echo $value['id']; ?>')" data-original-title="Delete"><i class="fa fa-trash"></i></a></span>
                                                        <?php } ?>
                                                        <?php if (!empty($value["document"])) { ?>
                                                            <span class="time"><a class="defaults-c text-right" style="color:#0084B4"  data-toggle="tooltip" title="" href="<?php echo base_url() . "admin/timeline/download/" . $value["id"] . "/" . $value["document"] ?>" data-original-title="Download"><i class="fa fa-download"></i></a></span>
                                                        <?php } ?>
                                                        <h3 class="timeline-header text-aqua"> <?php echo $value['title']; ?> </h3>
                                                        <div class="timeline-body">
                                                            <?php echo $value['description']; ?> 

                                                        </div>

                                                    </div>
                                                </li>

                                            <?php } ?>    
                                            <li><i class="fa fa-clock-o bg-gray"></i></li>       
                                        <?php } ?>
                                    </ul>
                                </div>


 <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');               ?> <?php //echo $this->lang->line('list');               ?></h2> -->

                            </div>

                        </div>  


                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
    $("#myTimelineButton").click(function () {
        $("#reset").click();
        $('.transport_fees_title').html("<b><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('timeline'); ?></b>");
        $('#myTimelineModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });



</script>
<div class="modal fade" id="myTimelineModal" role="dialog">
    <div class="modal-dialog modal-sm400">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                   

                    <form  id="timelineform" name="timelineform" method="post"  enctype="multipart/form-data">
                         <div class="modal-body pt0 pb0">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div id='timeline_hide_show' class="row">                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student["id"] ?>" id="student_id">
                                
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                        <input id="timeline_title" name="timeline_title" placeholder="" type="text" class="form-control"  />
                                        <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input id="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getSchoolDateFormat())); ?>" name="timeline_date" placeholder="" type="text" class="form-control"  />
                                        <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea id="timeline_desc" name="timeline_desc" placeholder=""  class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <div class=""><input id="timeline_doc_id" name="timeline_doc" placeholder="" type="file"  class="filestyle form-control" data-height="40"  value="<?php echo set_value('timeline_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="labeltopmb0"><?php echo $this->lang->line('visible'); ?></label>
                                        <input id="visible_check" checked="checked" name="visible_check" value="yes" placeholder="" type="checkbox"   />

                                    </div>
                                </div>
                              </div>
                            </div>  
                              <div class="modal-footer">
                                <button type="submit"  class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                <button type="reset" id="reset" style="display: none"  class="btn btn-info pull-right">Reset</button>
                            </div>  
                            
                           
                        </form>
                                     
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog modal-sm400">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <form id="form1" action="<?php echo site_url('student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                         <div class="modal-body pt0 pb0">   
                            <div id='upload_documents_hide_show'>                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?><small class="req" > *</small></label>
                                        <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                        <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('documents'); ?><small class="req" > *</small></label>
                                        <div class=""><input id="first_doc_id" name="first_doc" placeholder="" type="file"  class="filestyle form-control" data-height="40"  value="<?php echo set_value('first_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('first_doc'); ?></span></div>
                                    </div>

                                
                            </div>
                         </div>  
                            <div class="modal-footer" style="clear:both">
                                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php //echo $this->lang->line('cancel'); ?></button> -->
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>

                        </form>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title_logindetail"></h4>
            </div>
            <div class="modal-body_logindetail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="disable_modal" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" ><?php echo $this->lang->line('disable') . " " . $this->lang->line('student') ?></h4>
            </div>
            <form role="form" id="disable_form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-body pt0 pb0" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label><small class="req"> *</small>
                                        <input type="hidden" name="student_id" id="disstudent_id" >
                                        <select class="form-control" name="reason">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php
                                            foreach ($reason as $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['reason'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('date'); ?></label>
                                        <input name="disable_date" class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" type="text"   />

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                        <textarea name="note" class="form-control"></textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="box-footer">

                    <div class="pull-right paddA10">
                        <button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>

                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">



    $(document).ready(function (e) {

        $("#timelineform").on('submit', (function (e) {
            var student_id = $("#student_id").val();

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/timeline/add") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    if (data.status == "fail") {

                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {

                        successMsg(data.message);

                        $.ajax({
                            url: '<?php echo base_url(); ?>admin/timeline/student_timeline/' + student_id,
                            success: function (res) {
                                $('#timeline_list').html(res);

                                $('#myTimelineModal').modal('toggle');
                            },
                            error: function () {
                                alert("Fail")
                            }
                        });
                        window.location.reload(true);
                    }

                },
                error: function (e) {
                    alert("Fail");
                    console.log(e);
                }
            });


        }));
    });

    function delete_timeline(id) {

        var student_id = $("#student_id").val();
        if (confirm('<?php echo $this->lang->line("delete_confirm") ?>')) {

            $.ajax({
                url: '<?php echo base_url(); ?>admin/timeline/delete_timeline/' + id,
                success: function (res) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/timeline/student_timeline/' + student_id,
                        success: function (res) {
                            $('#timeline_list').html(res);

                        },
                        error: function () {
                            alert("Fail")
                        }
                    });

                },
                error: function () {
                    alert("Fail")
                }
            });
        }

    }

    function disable_student(id) {
        if (confirm("Are you sure you want to disable this record.")) {
            $('#disstudent_id').val(id);
            $('#disable_modal').modal('show');
        }
    }

    $("#disable_form").on('submit', (function (e) {
        e.preventDefault();
        var id = $('#disstudent_id').val();
        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/disable_reason") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
            success: function (res)
            {

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
    function disable(id) {


        if (confirm("Are you sure you want to disable this record.")) {
            var student_id = '<?php echo $student["id"] ?>';
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {

                    var userid = response.id;



                    changeStatus(userid, 'no', 'student');

                }
            });

        } else {
            return false;
        }

    }

    function enable(id, status, role) {
        if (confirm("<?php echo $this->lang->line('are_you_sure').' '.$this->lang->line('you_want_to_enable_this_record'); ?>")) {
            var student_id = '<?php echo $student["id"] ?>';
          
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {
                    
                    var userid = response.id;



                    changeStatus(userid, 'yes', 'student');
                   

                }
            });

             $.ajax({
                type: "post",
                url: base_url + "student/enablestudent/"+student_id,
                data: {'student_id': student_id},
                dataType: "json",
                success: function (data) {
    
                 window.location.reload(true);

                }
            });
            
            
             
        } else {
            return false;
        }

    }

    function changeStatus(rowid, status = 'no', role = 'student') {

         
        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/users/changeStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
            }
        });
    }
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });



    function send_parent_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $guardian_credential['username']; ?>';
        var password = '<?php echo $guardian_credential['password']; ?>';
        var contact_no = '<?php echo $student['guardian_phone']; ?>';
        var email = '<?php echo $student['guardian_email']; ?>';
        //alert(student_id);
        $.ajax({
            type: "post",
            url: base_url + "student/send_parent_password",
            data: {student_id: student_id, username: username, password: password, contact_no: contact_no, email: email},
            // dataType: "json",
            success: function (response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent');?>');
            }
        });
    }


    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_first_name = '<?php echo $student["firstname"] ?>';
        var student_last_name = '<?php echo $student["lastname"] ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {'student_id': student_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + student_first_name + ' ' + student_last_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    if(obj.role !== "parent"){
                        data += '<tr>';
                        data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                        data += '<input type=hidden name=userid id=userid value=' + obj.id + '>';
                        data += '<td class="text text-center">' + obj.username + '</td> ';
                        data += '<td class="text text-center">' + obj.password + '</td> ';
                        data += '</tr>';
                    }});
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

    $(document).ready(function () {
        getExamResult();
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $("#timeline_date").datepicker({
            format: date_format,
            autoclose: true

        });
    });
    function getExamResult(student_session_id) {
        if (student_session_id != "") {
            $('.examgroup_result').html("");


            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getStudentCurrentResult",
                data: {'student_session_id': 17},
                dataType: "JSON",
                beforeSend: function () {

                },
                success: function (data) {


                    $('.examgroup_result').html(data.result);
                },
                complete: function () {

                }
            });
        }
    }
</script>

<script type="text/javascript">

    $(document).on('change', '#exam_group_id', function () {
        var exam_group_id = $(this).val();
        if (exam_group_id != "") {
            $('#exam_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: baseurl + "admin/examgroup/getExamsByExamGroup",
                data: {'exam_group_id': exam_group_id},
                dataType: "JSON",
                beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data.result, function (i, obj)
                    {

                        div_data += "<option value=" + obj.id + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
                complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    });

// this is the id of the form
    $("form#form_examgroup").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
        var submit_button = $("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function () {
                submit_button.button('loading');
            },
            success: function (data)
            {

                $('.examgroup_result').html(data.result);
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                submit_button.button('reset');
            },
            complete: function () {
                submit_button.button('reset');
            }
        });

 
    });
                        $(document).ready(function (e) {

                                            $("#form1").on('submit', (function (e) {

                                                e.preventDefault();
                                                $.ajax({
                                                    url: "<?php echo site_url("student/create_doc") ?>",
                                                    type: "POST",
                                                    data: new FormData(this),
                                                    dataType: 'json',
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function (res)
                                                    {

                                                        if (res.status == "fail") {

                                                            var message = "";
                                                            $.each(res.error, function (index, value) {

                                                                message += value;
                                                            });
                                                            errorMsg(message);

                                                        } else {

                                                            successMsg(res.message);

                                                            window.location.reload(true);
                                                        }
                                                    }
                                                });

                                            }));

                                        });
</script>