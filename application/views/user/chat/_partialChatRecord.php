<?php
if (!empty($chatList)) {
    foreach ($chatList as $chat_key => $chat_value) {

        $chat_type = ($chat_value->chat_user_id != $chat_user->id) ? 'replies' : 'sent';
        $date_time = ($chat_value->chat_user_id != $chat_user->id) ? 'time_date_send' : 'time_date';
        ?>
        <?php
        if ($chat_value->is_first) {
            ?>
            <li class="text text-center" style="margin: 0px;">

                <h4 class="chattitle"><span><?php echo $this->lang->line('you_are_now_connected_on_chat') ?></span></h4>
            </li>
            <?php
        } else {
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
        ?>
        <?php
    }
}
?>