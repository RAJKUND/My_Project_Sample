<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<style>
body {
    font-family: Arial;
    width: 40%;
}

.message-box {
    margin-bottom: 20px;
    border-top: #F0F0F0 2px solid;
    padding: 10px;
    background: #F0F0F0;
    border: #E4E4E5 1px solid;
    border-radius: 5px;
}

.comment-form-container {
    border: #0a0808 1px solid;
    padding: 10px 20px;
    border-radius: 4px;
}

.message-content {
    margin-top: 10px;
}

.btn-submit {
    padding: 10px 20px;
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-cancel {
    padding: 10px 20px;
    background: #F0F0F0;
    border: #1d1d1d 1px solid;
    font-size: 0.9em;
    width: 100px;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
}

.btn-action {
    color: #2f20d1;
    cursor: pointer;
    text-decoration: none;
}

.btn-action:hover {
    text-decoration: underline;
}

#link-space {
    word-spacing: 10px;
}

.txtMessage {
    width: 100%;
    margin: 10px 0px;
}
</style>
<script>
function showEditBox(editobj,id) {
    $('.comment-form-container').hide();
    $(editobj).prop('disabled','true');
    var currentMessage = $("#message_" + id + " .message-content").html();
    var editMarkUp = '<textarea rows="5" class="txtMessage" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" class="btn-submit" onClick="callCrudAction(\'edit\','+id+')">Save</button><button name="cancel" class="btn-cancel"  onClick="cancelEdit(\''+currentMessage+'\','+id+')">Cancel</button>';
    $("#message_" + id + " .message-content").html(editMarkUp);
}
function cancelEdit(message,id) {
    $("#message_" + id + " .message-content").html(message);
    $('.comment-form-container').show();
}
function callCrudAction(action,id) {
    var queryString;
    valid = true;
    if(action != "delete") {
        if($(".txtmessage").val() == '') {
           valid = false;
        }
    } else {
        if(!(confirm('Are you sure you want delete'))) {
            valid = false;
        }
    }

    if(valid == true) {
    switch(action) {
        case "add":
            queryString = 'action='+action+'&txtmessage='+ $("#txtmessage").val();
        break;
        case "edit":
            queryString = 'action='+action+'&message_id='+ id + '&txtmessage='+ $("#txtmessage_"+id).val();
        break;
        case "delete":
            queryString = 'action='+action+'&message_id='+ id;
        break;
    }
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "crud_action.php",
    data:queryString,
    type: "POST",
    success:function(data){
        switch(action) {
            case "add":
                $("#comment-list-box").append(data);
                $("#loaderIcon").hide();
                $("#txtmessage").val('');
            break;
            case "edit":
                $("#message_" + id + " .message-content").html(data);
                $('.comment-form-container').show();
                $("#message_"+id+" .btnEditAction").prop('disabled','');
                $("#loaderIcon").hide();
                $("#txtmessage").val('');
            break;
            case "delete":
            	$('#message_'+id).fadeOut();
            	$("#loaderIcon").hide();
            	break;

        }
},
    error:function (){}
    });
}
}
</script>
</head>
<body>
<?php
require_once __DIR__ . '/DataSource.php';
$database = new DataSource();
$sql = "SELECT * FROM comment";
$comments = $database->select($sql);
?>
<div class="form_style">
        <div id="comment-list-box">
        <?php
        if (! empty($comments)) {
            foreach ($comments as $k => $v) {
                ?>
        <div class="message-box"
                id="message_<?php echo $comments[$k]["id"];?>">
                <div id="link-space">
                    <a class="btn-action"
                        onClick="showEditBox(this,<?php echo $comments[$k]["id"]; ?>)">Edit</a>
                    <a class="btn-action"
                        onClick="callCrudAction('delete',<?php echo $comments[$k]["id"]; ?>)">Delete</a>
                </div>
                <div class="message-content"><?php echo $comments[$k]["message"]; ?></div>
            </div>
        <?php
            }
        }
        ?>
        </div>
        <div class="comment-form-container">
            <form id="frm-comment">
                <div id="frmAdd">
                    <textarea name="txtmessage" id="txtmessage"
                        class="txtmessage" rows="5"></textarea>
                    <p>
                        <button name="submit"
                            onClick="callCrudAction('add','')"
                            type="submit" name="submit" id="submit"
                            class="btn-submit">Add</button>
                        <span id="txtmessage-info"></span>
                    </p>
                </div>
                <img src="LoaderIcon.gif" id="loaderIcon"
                    style="display: none" />
            </form>
        </div>
    </div>
</body>
</html>