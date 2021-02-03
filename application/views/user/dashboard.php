<style type="text/css">
   @media print
   {
   .no-print, .no-print *
   {
   display: none !important;
   }
   }
   .option_grade{
   display: none;
   }
</style>
<?php
   $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
   ?>
<div class="content-wrapper" style="min-height: 946px;">
   <section class="content-header">
      <h1>
         <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('my_profile'); ?> <small><?php echo $this->lang->line('student1'); ?></small>
      </h1>
   </section>
   <section class="content">
      <?php
         foreach ($unread_notifications as $notice_key => $notice_value) {
             ?>
      <div class="dashalert alert alert-success alert-dismissible" role="alert">
         <button type="button" class="alertclose close close_notice stualert" data-dismiss="alert" aria-label="Close" data-noticeid="<?php echo $notice_value->id; ?>"><span aria-hidden="true">&times;</span></button>
         <a href="<?php echo site_url('user/notification') ?>"><?php echo $notice_value->title; ?></a>
      </div>
      <?php
         }
         ?>
      <div class="row">
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php
                     if (!empty($student['image'])) {
                         echo base_url() . $student['image'];
                     } else {
                         echo base_url() . "uploads/student_images/no_image.png";
                     }
                     ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                  <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                        <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                     </li>
                     <li class="list-group-item">
                        <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                     </li>
                     <li class="list-group-item">
                        <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                     </li>

                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-9">
            <div class="nav-tabs-custom theme-shadow">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>
                  <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                  <li class=""><a href="#timelineh" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('timeline'); ?></a></li>
                  <?php 
                     if($sch_setting->student_profile_edit){
                     ?>
                  <li class="pull-right">
                     <a href="<?php echo site_url('user/user/edit') ?>"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $this->lang->line('edit')?>"><i class="fa fa-pencil"></i>
                     </a>
                  </li>
                  <?php
                     }
                                             ?>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                     <div class="tshadow mb25 bozero">
                        <div class="table-responsive around10 pt0">
                           <table class="table table-hover table-striped">
                              <tbody>
                                 <?php if ($sch_setting->admission_date) {
                                    ?>
                                 <tr>
                                    <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                    <td class="col-md-5">
                                       <?php
                                          if (!empty($student['admission_date'])) {
                                              echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date']));
                                          }
                                          ?>
                                    </td>
                                 </tr>
                                 <?php } ?>
                                 <tr>
                                    <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                    <td><?php echo $student['mobileno']; ?></td>
                                 </tr>

                                 <?php if ($sch_setting->student_email) { ?>
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
                  <div class="tab-pane" id="timelineh">
                     <div class="timeline-header no-border">
                        <div id="timeline_list">
                           <?php
                              if (empty($timeline_list)) {
                                  ?>
                                    <div class="alert alert-danger">
                        <?php echo $this->lang->line('no_record_found'); ?>
                     </div>
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
                                    <?php if (!empty($value["document"])) { ?>
                                    <span class="time"><a data-placement="left" class="defaults-c text-right" data-toggle="tooltip" title="" href="<?php echo base_url() . "user/user/timeline_download/" . $value["id"] . "/" . $value["document"] ?>" data-original-title="Download"><i class="fa fa-download"></i></a></span>
                                    <?php } ?>
                                    <h3 class="timeline-header text-aqua"><?php echo $value['title']; ?> </h3>
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
                        <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');                                                                                               ?> <?php //echo $this->lang->line('list');                                                                                               ?></h2> -->
                     </div>
                  </div>
                  <div class="tab-pane" id="documents">
                     <div class="timeline-header no-border">
                        <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn mb10"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>
                        <div class="table-responsive" style="clear: both;">
                           <table class="table table-striped table-bordered table-hover example">
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
                               <tbody>
                              <?php
                                 if (empty($student_doc)) {
                                     ?>
                                       
                              <?php } else {
                                 ?>
                             
                                 <?php
                                    foreach ($student_doc as $value) {
                                        ?>
                                 <tr>
                                    <td><?php echo $value['title']; ?></td>
                                    <td><?php echo $value['doc']; ?></td>
                                    <td class="mailbox-date text-right">
                                       <a data-placement="left" href="<?php echo base_url(); ?>user/user/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                       <i class="fa fa-download"></i>
                                       </a>
                                    </td>
                                 </tr>
                                 <?php }
                                    ?> 
                            
                              <?php
                                 }
                                 ?>
                                   </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="modal fade" id="myTransportFeesModal" role="dialog">
<div class="modal-dialog modal-sm400">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title title text-center transport_fees_title"></h4>
</div>


<div class="modal-body pb0">    
<form id="form11"   name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
<?php echo $this->customlib->getCSRF(); ?> 
<div id='upload_documents_hide_show'>
<input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?> <small class="req">*</small></label>
<input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
<span class="text-danger"><?php echo form_error('first_title'); ?></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('documents'); ?> <small class="req">*</small></label>
<div class="" >
<input  name="first_doc" placeholder="" type="file" class="form-control filestyle" data-height="40"  value="<?php echo set_value('first_doc'); ?>" />
<span class="text-danger"><?php echo form_error('first_doc'); ?></span></div>
</div>
</div>
</div>
<div class="modal-footer" style="clear:both">
<!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php //echo $this->lang->line('cancel');     ?></button> -->
<button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
</div>
</form>
</div>
</div>
</div>
<?php
   function findGradePoints($exam_grade, $exam_type, $percentage) {
   
       foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
           if ($exam_grade_value['exam_key'] == $exam_type) {
   
               if (!empty($exam_grade_value['exam_grade_values'])) {
                   foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                       if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                           return $grade_value->point;
                       }
                   }
               }
           }
       }
       return 0;
   }
   
   function findExamGrade($exam_grade, $exam_type, $percentage) {
   
       foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
           if ($exam_grade_value['exam_key'] == $exam_type) {
   
               if (!empty($exam_grade_value['exam_grade_values'])) {
                   foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                       if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                           return $grade_value->name;
                       }
                   }
               }
           }
       }
       return "-";
   }
   
   function getConsolidateRatio($exam_connection_list, $examid, $get_marks) {
   
       if (!empty($exam_connection_list)) {
           foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
   
               if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                   return ($get_marks * $exam_connection_value->exam_weightage) / 100;
               }
           }
       }
       return 0;
   }
   
   function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type) {
   
       $object = new stdClass();
       $return_total_points = 0;
       $return_total_exams = 0;
       if (!empty($array)) {
   
           // print_r($array['exam_result_' . $exam_id]);
           if (!empty($array['exam_result_' . $exam_id])) {
               foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
                   $return_total_exams++;
                   $percentage_grade = ($exam_value->get_marks * 100) / $exam_value->max_marks;
                   $point = findGradePoints($exam_grade, $exam_type, $percentage_grade);
                   $return_total_points = $return_total_points + $point;
               }
           }
       }
   
       $object->total_points = $return_total_points;
       $object->total_exams = $return_total_exams;
   
       return $object;
   }
   
   function getCalculatedExam($array, $exam_id) {
       // echo "<pre/>";
   //                                                                                                    print_r($array);
       $object = new stdClass();
       $return_max_marks = 0;
       $return_get_marks = 0;
       $return_credit_hours = 0;
       $return_exam_status = false;
       if (!empty($array)) {
           $return_exam_status = 'pass';
           // print_r($array['exam_result_' . $exam_id]);
           if (!empty($array['exam_result_' . $exam_id])) {
               foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
   
   
                   if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                       $return_exam_status = "fail";
                   }
   
                   $return_max_marks = $return_max_marks + ($exam_value->max_marks);
                   $return_get_marks = $return_get_marks + ($exam_value->get_marks);
                   $return_credit_hours = $return_credit_hours + ($exam_value->credit_hours);
               }
           }
       }
       $object->credit_hours = $return_credit_hours;
       $object->get_marks = $return_get_marks;
       $object->max_marks = $return_max_marks;
       $object->exam_status = $return_exam_status;
       return $object;
   }
   ?>
<script type="text/javascript">
   var base_url = '<?php echo base_url() ?>';
   function printDiv(elem) {
       Popup(jQuery(elem).html());
   }
   
   function Popup(data)
   {
   
       var frame1 = $('<iframe />');
       frame1[0].name = "frame1";
       frame1.css({"position": "absolute", "top": "-1000000px"});
       $("body").append(frame1);
       var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
       frameDoc.document.open();
       frameDoc.document.write('<html>');
       frameDoc.document.write('<head>');
       frameDoc.document.write('<title></title>');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
       frameDoc.document.write('</head>');
       frameDoc.document.write('<body>');
       frameDoc.document.write(data);
       frameDoc.document.write('</body>');
       frameDoc.document.write('</html>');
       frameDoc.document.close();
       setTimeout(function () {
           window.frames["frame1"].focus();
           window.frames["frame1"].print();
           frame1.remove();
       }, 500);
   
    
       return true;
   }
</script>
<script type="text/javascript">

   $("#form11").on('submit', (function (e) {

     e.preventDefault();
       $.ajax({
           url: "<?php echo site_url("user/user/create_doc") ?>",
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
   
   /*--dropify--*/
   $(document).ready(function () {
       // Basic
       $('.filestyle').dropify();
   
   
   });
   /*--end dropify--*/
</script>
<script type="text/javascript">
   // $(document).ready(function () {
   //     $.extend($.fn.dataTable.defaults, {
   //         searching: false,
   //         ordering: false,
   //         paging: false,
   //         bSort: false,
   //         info: false
   //     });
   
   //     $("#feetable").DataTable({
   //         searching: false,
   //         ordering: false,
   //         paging: false,
   //         bSort: false,
   //         info: false,
   //         dom: "Bfrtip",
   //         buttons: [
   //             {
   //                 extend: 'copyHtml5',
   //                 text: '<i class="fa fa-files-o"></i>',
   //                 titleAttr: 'Copy',
   //                 title: $('.download_label').html(),
   //                 exportOptions: {
   //                     columns: ':visible'
   //                 }
   //             },
   //             {
   //                 extend: 'excelHtml5',
   //                 text: '<i class="fa fa-file-excel-o"></i>',
   //                 titleAttr: 'Excel',
   //                 title: $('.download_label').html(),
   //                 exportOptions: {
   //                     columns: ':visible'
   //                 }
   //             },
   //             {
   //                 extend: 'csvHtml5',
   //                 text: '<i class="fa fa-file-text-o"></i>',
   //                 titleAttr: 'CSV',
   //                 title: $('.download_label').html(),
   //                 exportOptions: {
   //                     columns: ':visible'
   //                 }
   //             },
   //             {
   //                 extend: 'pdfHtml5',
   //                 text: '<i class="fa fa-file-pdf-o"></i>',
   //                 titleAttr: 'PDF',
   //                 title: $('.download_label').html(),
   //                 exportOptions: {
   //                     columns: ':visible'
   
   //                 }
   //             },
   //             {
   //                 extend: 'print',
   //                 text: '<i class="fa fa-print"></i>',
   //                 titleAttr: 'Print',
   //                 title: $('.download_label').html(),
   //                 customize: function (win) {
   //                     $(win.document.body)
   //                             .css('font-size', '10pt');
   
   //                     $(win.document.body).find('table')
   //                             .addClass('compact')
   //                             .css('font-size', 'inherit');
   //                 },
   //                 exportOptions: {
   //                     columns: ':visible'
   //                 }
   //             },
   //             {
   //                 extend: 'colvis',
   //                 text: '<i class="fa fa-columns"></i>',
   //                 titleAttr: 'Columns',
   //                 title: $('.download_label').html(),
   //                 postfixButtons: ['colvisRestore']
   //             },
   //         ]
   //     });
   // });
   
   
   $(document).ready(function () {
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
   });
   
   $(document).ready(function () {
       $('table.display').DataTable();
   });
   
   
</script>
<script type="text/javascript">
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
   
   document.getElementById("no-print").style.display = "block";
   
   
   function printDiv() {
       document.getElementById("no-print").style.display = "none";
   
       $('.bg-green').removeClass('label');
       $('.label-danger').removeClass('label');
       $('.label-success').removeClass('label');
       var divElements = document.getElementById('exam').innerHTML;
       var oldPage = document.body.innerHTML;
       document.body.innerHTML =
               "<html><head><title></title></head><body>" +
               divElements + "</body>";
       window.print();
       document.body.innerHTML = oldPage;
   
       location.reload(true);
   }
   
   
   
   
   
  
   $(document).ready(function () {
   
       $(document).on('click', '.close_notice', function () {
           var data = $(this).data();
   
   
           $.ajax({
               type: "POST",
               url: base_url + "user/notification/read",
               data: {'notice': data.noticeid},
               dataType: "json",
               success: function (data) {
                   if (data.status == "fail") {
   
                       errorMsg(data.msg);
                   } else {
                       successMsg(data.msg);
                   }
   
               }
           });
   
   
       });
   });
</script>