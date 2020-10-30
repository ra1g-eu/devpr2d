<?php if($success != "" || $failure !=""){ ?>
    <div class="modal" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><?php echo $success; echo $failure; ?></h2>
                </div>
                <div class="modal-body">
                    <p><h4>You will be redirected shortly</h4></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>