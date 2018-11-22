<script src="/saebom/editor/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="/saebom/editor/ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="/saebom/editor/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<section class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3">
            <h2>New POST</h2>
            <form role="form" method="post" id="reused_form">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="name"> Category:</label>1
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
                        <textarea name="comment" rows="15" style="width:100%;height:250;"></textarea>
                        <div class="adjoined-bottom">
                            <div class="grid-container">
                                <div>
                                    <div id="editor">

                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Post It! </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    CKEDITOR.replace('comment',
        {
            startupFocus : false,  // 자동 focus 사용할때는  true
            //C:\Users\admin\Desktop\work\saebom\editor\ckeditor\config.js
            customConfig : '/saebom/editor/ckeditor/config.js', //커스텀설정js파일위치
            //filebrowserUploadUrl: '/saebom/editor/ckeditor/upload.php?type=Files',
            filebrowserImageUploadUrl: '/saebom/editor/upload.php?type=Images',
            toolbar :
                [
                    ['ajaxsave'],
                    ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
                    ['Cut','Copy','Paste','PasteText'],
                    ['Undo','Redo','-','RemoveFormat'],
                    ['TextColor','BGColor'],
                    ['Maximize', 'Image']
                ],
        }
    );
</script>