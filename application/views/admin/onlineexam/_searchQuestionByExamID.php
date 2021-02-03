<style type="text/css">
    .hrexam {
        margin-top: 5px;
        margin-bottom: 5px;
        border: 0;
        border-top: 1px solid #eee;
    }

</style>


<?php
if (!empty($questionList)) {

    foreach ($questionList as $question_key => $question_value) {
        $checkbox_status = "";

        if ($question_value->onlineexam_question_id != 0) {
            $checkbox_status = "checked";
        }
        ?>
        <div class="">
            <div class="row">

                <div class="col-xs-12 col-md-12 section-box">
                    <?php //if(!empty($and_array)){
                        //if($question_value->subject_id == $and_array->search){
                          //  if($question_value->class_id == $and_array->class_id){
                            //    if($question_value->exam_name == $and_array->exam_name){
                                    if ($this->rbac->hasPrivilege('add_questions_in_exam', 'can_edit')) {
                        ?>

                        <div class="checkbox" style="margin-left: 20px">
                            <input type="checkbox" class="question_chk" value="<?php echo $question_value->id; ?>" <?php echo $checkbox_status; ?>></div>
                    <?php } ?>
                    <div class="rltpaddleft">

                        <?php echo readmorelink($question_value->question, site_url('admin/question/read/' . $question_value->id)); ?>
                        <p>
                            <b><?php echo $this->lang->line('subject') ?>:</b>
                            <?php echo $question_value->subject_name; ?>

                            <b><?php echo $this->lang->line('class') ?>:</b>
                            <?php echo $question_value->class_id; ?>

                            <b><?php echo "exam name" ?>:</b>
                            <?php echo $question_value->exam_name; ?>
                    </div>
                    <?//}}}}?>

                </div>
            </div>
            <div class="hrexam"></div>
        </div>
        <?php
    }
}
?>
</form>