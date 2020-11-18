<?php if($success != "" || $failure !=""){ ?>
    <div class="modal" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                </div>
                <div class="modal-body">
                    <p class="lead"><?php echo $success; echo $failure; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>