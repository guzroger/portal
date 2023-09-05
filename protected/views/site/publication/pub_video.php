<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="full-width-modalLabel">Subir Video YouTube</h4>
        </div>
        <div class="modal-body">            
            <div class="col-md-12" align="center">
                <i class="fa fa-file-video-o fa-5x"></i>
                <hr>
            </div>
            <label>URL YouTube</label>
            <input type="text" class="form-control" onchange="validURL(this.value)" onkeyup="validURL(this.value)" />
            <input type="hidden" name="pubYoutube" id="pubYoutube">
            <?php /*
            <input name="pubVideo" id="pubVideo" type="file" accept="video/mp4" />            
            */ ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Guardar</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
function validURL(url) {      
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    //return (match&&match[7].length==11)? match[7] : false;
    document.getElementById("pubYoutube").value = match[7];
}
</script>