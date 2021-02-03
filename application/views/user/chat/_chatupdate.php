<?php
if (!empty($updated_chat)) {

    foreach ($updated_chat as $chat_key => $chat_value) {

        $chat_type = ($chat_value->chat_user_id == $chat_user_id) ? 'replies' : 'sent';
        $date_time = ($chat_value->chat_user_id == $chat_user_id) ? 'time_date_send' : 'time_date';
        ?>

        <li class="<?php echo $chat_type; ?>">
            <?php if($chat_value->message !=""){   ?>
                <p><?php echo $chat_value->message; ?></p>
            <?php }elseif ($chat_value->files != ""){
                $filename=explode("/",$chat_value->files);
                ?>
                <p><a style="color: white" href="chat/downloadFileChat/<?php echo $filename[2]?>"><i class="fa fa-file"></i><?php echo" ". $filename[2];?></a></p>
            <?php }elseif ($chat_value->audio != ""){ ?>
                <p><audio controls controlsList="nodownload"><source src="<?php echo '../'.$chat_value->audio; ?>"></audio></p>
            <?php }?>
            <span class="<?php echo $date_time; ?>"> <?php echo $this->customlib->dateyyyymmddToDateTimeformat($chat_value->created_at); ?></span>
        </li>
        <?php
    }
}
?>
