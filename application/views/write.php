<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>New POST</h2>
            <form role="form" enctype="multipart/form-data" method="post" id="reused_form" onsubmit="postForm()" action="write_update">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="name"> Category:</label>
                        <select class="selectpicker" id="category" name="category" >
                            <?php for ($i=1; $i < count($gnb_list); $i++) { ?>
                                <option value="<?=$gnb_list[$i][menu_name]?>"><?=$gnb_list[$i][menu_name]?></option>
                            <?php  }  ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="name"> Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" maxlength="50">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="name"> Content:</label>
                        <textarea name="content" style="display: none;"></textarea>
                        <div id="summernote"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="name"> Thumnail:</label>
                        <!-- image-preview-filename input [CUT FROM HERE]-->
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                                <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="userfile"/> <!-- rename it -->
                    </div>
                </span>
                        </div><!-- /input-group image-preview [TO HERE]-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Post It! </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 600,
        callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                for (var i = files.length - 1; i >= 0; i--) {
                    sendFile(files[i], this);
                }
            }
        }
    });
    $(document).on('click', '#close-preview', function(){
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
        );
    });
    function postForm() {
        $('textarea[name="content"]').val($('#summernote').summernote('code'));
    }
    function sendFile2(file, el) {
        var form_data = new FormData();
        form_data.append('file', file);
        $.ajax({
            data: form_data,
            type: "POST",
            url: '/saebom/board/upload_img',
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function(url) {
                $(el).summernote('editor.insertImage', url.save_url);
                $('#imageBoard > ul').append('<li><img src="'+url.save_url+'" width="480" height="auto"/></li>');
            }
        });
    }


    function sendFile(file,editor,welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            url: "/saebom/board/upload_img", // image 저장 경로
            data: data,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            type: 'POST',
            success: function(data){
                var obj = JSON.parse(data);
                if (obj.success) {
                    $(editor).summernote('editor.insertImage', obj.save_url);
                } else {
                    alert(obj.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus+" "+errorThrown);
            }
        });
    }

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            }
            reader.readAsDataURL(file);
        });
    });
</script>