<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                
                    <select name="animalsStatus" id="input-status" class="form-control">
                        <?php if ($module_animals_status==1) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select>
                
            </div>
            
            <div class="text-right">
                <button type="submit" class="btn btn-primary"><?php echo $button_save; ?></button>
            </div>
        </form>
    </div>
</div>
<?php echo $footer; ?>
