<style type="text/css">

    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-md-12">
                <!-- general form elements -->
                <div id="frame">
                    <!-- <div class="chatloader"></div>  -->
                    <div id="sidepanel">
                        <input type="hidden" name="chat_connection_id" value="0">
                        <input type="hidden" name="chat_to_user" value="0">
                        <input type="hidden" name="last_chat_id" value="0">

                        <div id="search">
                            <label for=""><?php echo $this->lang->line('chats') ?></label>
                            <!-- <input type="text" placeholder="Search contacts..." /> -->
                            <div id="bottom-bar">
                              <button id="addcontact" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <!-- <span>Add contact</span> --></button>
                              <!-- <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button> -->
                            </div>
                        </div>
                        <div id="contacts">
                            <ul>


                            </ul>
                        </div>

                    </div>
                    <div class="chatcontent">
                        <div class="contact-profile">
                            <img src="<?php echo base_url('uploads/student_images/no_image.png'); ?>" alt="" />
                            <p><?php echo $this->lang->line('select_any_user_to_start_your_chat') ?></p>

                        </div>
                        <div class="messages">
                            <ul>

                            </ul>
                        </div>
                        <div class="message-input ">
                            <div class="wrap relative">
                                <input id="message" type="text" placeholder="Write your message..." class="chat_input" />
                                <button id="stopButton" style="right: 86px; background-color: red;" class="submit input_submit"><i class="fa fa-stop"></i></button>
                                <button id="recordButton" style="right: 86px;" class="submit input_submit"><i class="fa fa-microphone"></i></button>
                                <input id="atten" type="file" name="file" style="display:none;">
                                <button id="icon_atten" style="right: 43px;" class="submit input_submit">
                                    <i  style="position: initial; color: #fff; font-size: 20px; margin-top: -1px;" class=" fa fa-paperclip attachment" aria-hidden="true"></i>
                                </button>
                                <button class="submit input_submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
        </div><!-- /.box-header -->

    </section>
</div><!-- /.box-body -->
</div>
</div><!--/.col (left) -->
<!-- right column -->

</div>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form id="addUser" action="<?php echo site_url('user/chat/adduser') ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $this->lang->line('add') . " " . $this->lang->line('contact') ?></h4>
                </div>
                <div class="modal-body">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="search-query form-control" placeholder="Search" />
                        </div>
                    </div>
                    <div class="usersearchlist">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                </div>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script>

    function startRecording() {
        /* Simple constraints object, for more advanced audio features see

    https://addpipe.com/blog/audio-constraints-getusermedia/ */

        var constraints = {
            audio: true,
            video: false
        }
        /* Disable the record button until we get a success or fail from getUserMedia() */

        recordButton.hide();
        stopButton.show();

        /* We're using the standard promise based getUserMedia()

        https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia */

        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
            console.log("getUserMedia() success, stream created, initializing Recorder.js ...");
            /* assign to gumStream for later use */
            gumStream = stream;
            /* use the stream */
            input = audioContext.createMediaStreamSource(stream);
            /* Create the Recorder object and configure to record mono sound (1 channel) Recording 2 channels will double the file size */
            rec = new Recorder(input, {
                numChannels: 1
            })
            //start the recording process
            rec.record()
            console.log("Recording started");
        }).catch(function(err) {
            //enable the record button if getUserMedia() fails
            recordButton.show();
            stopButton.hide();
        });
    }
    function createDownloadLink(blob) {
        var chat_connection_id = $("input[name='chat_connection_id']").val();
        var chat_to_user = $("input[name='chat_to_user']").val();
        if (chat_connection_id > 0 && chat_to_user > 0) {
            var filename = new Date().toISOString();
            var ad = new FormData();
            ad.append("audio_data", blob,filename);
            ad.append('chat_connection_id', chat_connection_id);
            ad.append('chat_to_user', chat_to_user);
            ad.append('time', date_time_temp);
            $.ajax({
                type: "POST",
                url: 'chat/upload_audio',
                data: ad,
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: function () {

                },
                success: function (data) {

                },
                error: function (jqXHR, textStatus, errorThrown) {

                },
                complete: function (data) {

                }
            })
        }

    }

    function stopRecording() {
        console.log("stopButton clicked");
        //disable the stop button, enable the record too allow for new recordings
        recordButton.show();
        stopButton.hide();
        //tell the recorder to stop the recording
        rec.stop(); //stop microphone access
        gumStream.getAudioTracks()[0].stop();
        //create the wav blob and pass it on to createDownloadLink
        rec.exportWAV(createDownloadLink);
    }


</script>

<script>
    //webkitURL is deprecated but nevertheless
    URL = window.URL || window.webkitURL;
    var gumStream;
    //stream from getUserMedia()
    var rec;
    //Recorder.js object
    var input;
    //MediaStreamAudioSourceNode we'll be recording
    // shim for AudioContext when it's not avb.
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var audioContext = new AudioContext;
    //new audio context to help us record
    var recordButton = $("#recordButton");
    var stopButton = $("#stopButton");
    //add events to those 3 buttons
    recordButton.click(startRecording);
    stopButton.click(stopRecording);

</script>

<script type="text/javascript">
    var interval;
    var intervalchat;
    var intervalchatnew;

    var timestamp = '<?php echo time(); ?>';
    var date_time_temp = "";
    function updateTime() {
        date_time_temp = js_yyyy_mm_dd_hh_mm_ss(Date(timestamp));
        timestamp++;
    }
    $(function () {
        setInterval(updateTime, 1000);
    });

    $(document).on('keyup', '.search-query', function () {
        $this = $(this);
        var keyword = $(this).val();

        if (keyword.length >= 2) {

            $.ajax({
                type: "POST",
                url: baseurl + 'user/chat/searchuser',
                data: {'keyword': keyword},
                dataType: "JSON",
                beforeSend: function () {
                    $this.addClass('dropdownloading');

                },
                success: function (data) {
                    $('.usersearchlist').html("").html(data.page);
                    $this.removeClass('dropdownloading');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $this.removeClass('dropdownloading');
                },
                complete: function (data) {
                    $this.removeClass('dropdownloading');
                }
            })
        } else if (keyword.length >= 0) {
            $('.usersearchlist').html("")
        }

    });


    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: baseurl + 'user/chat/myuser',
            data: {},
            dataType: "JSON",
            beforeSend: function () {

            },
            success: function (data) {
                $("#contacts ul").html(data.page);


                if (data.status === "1") {

                    clearInterval(intervalchat);
                    intervalchat = setInterval(getChatNotification, 15000);

                    clearInterval(intervalchatnew);
                    intervalchat = setInterval(mynewUser, 25000);

                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            complete: function (data) {

            }
        })
    });
    $(document).on('click', '.contact', function () {
        var chat_connection_id = $(this).data('chatConnectionId');
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: baseurl + 'user/chat/getChatRecord',
            data: {'chat_connection_id': chat_connection_id},
            dataType: "JSON",
            beforeSend: function () {
                $(".chat_input").val("");
                $('.contact-profile').find('p').html($this.find('.name').text());
                $('.contact-profile').find('img').attr("src", $this.find('img').attr('src'));
                $this.addClass('active').siblings().removeClass('active');
            },
            success: function (data) {

                $this.find('span.notification_count').css("display", "none");


                $(".messages ul").html(data.page);
                $("input[name='chat_connection_id']").val(data.chat_connection_id);
                $("input[name='chat_to_user']").val(data.chat_to_user);
                $("input[name='last_chat_id']").val(data.user_last_chat.id);
                $('.messages').animate({
                    scrollTop: $('.messages')[0].scrollHeight}, "slow"
                        );
                clearInterval(interval);
                interval = setInterval(getChatsUpdates, 2000);


            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            complete: function (data) {

            }
        })

    });


    $(document).on('keydown', '.chat_input', function (e) {


        switch (e.which) {
            case 13:
                newChatMessage();
                break;
        }



    });


    $(document).on('click', '.input_submit', function (e) {


        message = $(".message-input input").val();
        if ($.trim(message) == '') {
            return false;
        }
        newChatMessage();
        e.preventDefault(); // To prevent the default
    });

    function htmlEncode(str) {
        return String(str).replace(/[^\w. ]/gi, function (c) {
            return '&#' + c.charCodeAt(0) + ';';
        });
    }

    var atten=$("#atten");
    var files = 0;
    $("#icon_atten").click(function (){
        atten.click()
    });
    atten.change(function (){
        // readURL(this);
        var fd = new FormData();
        var files = atten[0].files;

        var chat_connection_id = $("input[name='chat_connection_id']").val();
        var chat_to_user = $("input[name='chat_to_user']").val();
        if (chat_connection_id > 0 && chat_to_user > 0) {

            // Check file selected or not
            if (files.length != 0) {
                fd.append('file', files[0]);
                fd.append('chat_connection_id', chat_connection_id);
                fd.append('chat_to_user', chat_to_user);
                fd.append('time',date_time_temp);


                $.ajax({
                    type: "POST",
                    url: 'chat/upload_file',
                    data: fd,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    beforeSend: function () {

                    },
                    success: function (data) {

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    },
                    complete: function (data) {

                    }
                })
            }

        }
    });

    function newChatMessage() {
        message = htmlEncode($(".message-input input").val());
        if ($.trim(message) == '') {
            return false;
        }

        var chat_connection_id = $("input[name='chat_connection_id']").val();
        var chat_to_user = $("input[name='chat_to_user']").val();

        if (chat_connection_id > 0 && chat_to_user > 0) {

            $.ajax({
                type: "POST",
                url: baseurl + 'user/chat/newMessage',
                data: {'chat_connection_id': chat_connection_id, 'message': message, 'chat_to_user': chat_to_user, 'time': date_time_temp},

                dataType: "JSON",
                beforeSend: function () {

                },
                success: function (data) {
                    var last_chat_id = $("input[name='last_chat_id']").val(data.last_insert_id);
                    $('<li class="replies"><p>' + message + '</p> <span class="time_date_send"> ' + date_time_temp + '</span></li>').appendTo($('.messages ul'));
                    $('.chat_input').val(null);
                    $('.contact.active .preview').html('<span><?php echo $this->lang->line('you') ?>: </span>' + message);
                    // $(".messages").animate({scrollTop: $(document).height()}, "fast");

                    $('.messages').animate({
                        scrollTop: $('.messages')[0].scrollHeight}, "slow");

                },
                error: function (jqXHR, textStatus, errorThrown) {

                },
                complete: function (data) {

                }
            })
        }

    }
    ;


    function getChatsUpdates() {
        var end_reach = false;
        var chat_connection_id = $("input[name='chat_connection_id']").val();
        var chat_to_user = $("input[name='chat_to_user']").val();
        var last_chat_id = $("input[name='last_chat_id']").val();
        $.ajax({
            type: "POST",
            url: baseurl + 'user/chat/chatUpdate',
            data: {'chat_connection_id': chat_connection_id, 'chat_to_user': chat_to_user, 'last_chat_id': last_chat_id},
            dataType: "JSON",
            beforeSend: function () {

            },
            success: function (data) {
                var scrollTop = $('.messages').scrollTop();
                if (scrollTop + $('.messages').innerHeight() >= $('.messages')[0].scrollHeight) {
                    end_reach = true;
                }
                $("input[name='last_chat_id']").val(data.user_last_chat.id);
                $('.messages ul').append(data.page);


                if (end_reach) {

                    $('.messages').animate({
                        scrollTop: $('.messages')[0].scrollHeight}, "slow");

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            complete: function (data) {

            }
        })


    }


    $(document).on('click', '.usersearchlist ul li', function () {
        $this = $(this);
        $this.addClass('active').siblings().removeClass('active');

    });

    $("#addUser").submit(function (event) {
        event.preventDefault();
        var img = "";
        var userrecord = $('.usersearchlist').find("ul li.active");
        var userId = userrecord.data('userId');
        var userType = userrecord.data('userType');
        var $form = $(this),
                url = $form.attr('action');
        // var $this = $('.submit_class');
        // $this.button('loading');
        var $button = $form.find("button[type=submit]:focus");
        $.ajax({
            type: "POST",
            url: url,
            data: {'user_type': userType, 'user_id': userId},
            dataType: "JSON",

            beforeSend: function () {
                $button.button('loading');

            },
            success: function (data) {
                if (data.status == 0) {
                    var message = "";
                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {

                    $("#contacts ul").prepend(newUserLi(data.new_user, data.chat_connection_id)).find('li').addClass('active').siblings().not('li:first').removeClass('active');

                    $(".messages ul").html(data.chat_records);

                    $("input[name='chat_connection_id']").val(data.chat_connection_id);
                    $("input[name='chat_to_user']").val(data.new_user.chat_user_id);
                    $("input[name='last_chat_id']").val(data.user_last_chat.id);
                    $(".chat_input").val("");
                    if (data.new_user.user_type == "student") {
                        new_user_type = "Student";
                        img = baseurl + data.new_user.image;
                    } else if (data.new_user.user_type == "staff") {
                        new_user_type = "Staff";
                        img = baseurl + "uploads/staff_images/" + data.new_user.image;
                    }
                    $('.contact-profile').find('p').html(data.new_user.name);
                    $('.contact-profile').find('img').attr("src", img);
                    $('.messages').animate({
                        scrollTop: $('.messages')[0].scrollHeight}, "slow"
                            );
                    clearInterval(interval);
                    interval = setInterval(getChatsUpdates, 2000);



                    $('#myModal').modal('hide');
                    successMsg(data.message);
                }
                $button.button('reset');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $button.button('reset');
            },
            complete: function (data) {
                $button.button('reset');
            }
        });

    });

    $('#myModal').on('hidden.bs.modal', function (e) {

        $('.usersearchlist').html("");
        $('#addUser').trigger("reset");
    });


    function newUserLi(user_array, chat_connection_id) {

        var new_user_type = "<?php echo $this->lang->line('staff') ?>";
        var img = "";
        if (user_array.user_type == "student") {
            new_user_type = "<?php echo $this->lang->line('student') ?>";
            img = baseurl + user_array.image;
        } else if (user_array.user_type == "staff") {
            new_user_type = "<?php echo $this->lang->line('staff') ?>";
            img = baseurl + "uploads/staff_images/" + user_array.image;

        }
        var newli = "<li class='contact' data-chat-connection-id='" + chat_connection_id + "'>";
        newli += "<div class='wrap'>";
        newli += "<img src='" + img + "' alt=''>";
        newli += "<div class='meta'>";
        newli += "<p class='name'>" + user_array.name + " (" + new_user_type + ")" + "</p>";
        newli += "<p class='preview'></p>";
        newli += "</div>";
        newli += "</div>";
        newli += "<span class='chatbadge notification_count' style='display: none;'>0</span>";
        newli += "</li>";
        return newli;

    }



    function getChatNotification() {
        $.ajax({
            type: "POST",
            url: baseurl + 'user/chat/mychatnotification',
            data: {},
            dataType: "JSON",
            beforeSend: function () {

            },
            success: function (data) {
                var active_user = $('#contacts').find("ul li.active");

                if (data.notifications.length > 0) {

                    $.each(data.notifications, function (index, value) {
                        if (active_user.data('chatConnectionId') != value.chat_connection_id) {

                            $('#contacts').find("ul li[data-chat-connection-id='" + value.chat_connection_id + "']").find('span.notification_count').text(value.no_of_notification).css("display", "block");
                        }

                    });
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            complete: function (data) {

            }
        })
    }


    function mynewUser() {
        var users_Array = []; // more efficient than new Array()
        $("#contacts ul li").each(function (n) {
            var as = $(this).data('chatConnectionId');
            users_Array.push(as);

        });

        $.ajax({
            type: "POST",
            url: baseurl + 'user/chat/mynewuser',
            data: {'users': users_Array},
            dataType: "JSON",
            beforeSend: function () {


            },
            success: function (data) {
                $("#contacts ul").prepend(data.new_user_list);
            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            complete: function (data) {

            }
        })

    }

    function js_yyyy_mm_dd_hh_mm_ss(now) {

        var date_format = '<?php echo$this->customlib->getSchoolDateFormat() ?>';
        var new_str = date_format;
        var month_String = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        now = new Date();
        var day = String(now.getDate()).padStart(2, '0');
        var month = String(now.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = now.getFullYear();
        hour = "" + now.getHours();
        if (hour.length == 1) {
            hour = "0" + hour;
        }
        minute = "" + now.getMinutes();
        if (minute.length == 1) {
            minute = "0" + minute;
        }
        second = "" + now.getSeconds();
        if (second.length == 1) {
            second = "0" + second;
        }
        var inputAttr = {};
        inputAttr["m"] = month;
        inputAttr["M"] = month_String[now.getMonth()];
        inputAttr["d"] = day;
        inputAttr["Y"] = year;
        for (var key in inputAttr) {
            if (!inputAttr.hasOwnProperty(key)) {
                continue;
            }

            new_str = new_str.replace(key, inputAttr[key]);
        }

        return new_str + " " + hour + ":" + minute + ":" + second;
    }

</script>