<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">Details</div>
    </div>
    <div class="portlet-body">
        <?php 
        $count = count($records);
        foreach($records as $i => $record):
            $record = $record['TaskFieldValue'];
        ?>
        <?php if ($i % 2 == 0): ?>
            <div class="form-group">
        <?php endif; ?>
                
            <label class="col-md-6 col-sm-6 col-xs-12">
                <b><?= $record["field_name"] ?> : </b>
                <?php
                    $type = $record["field_type"];
                    switch($type)
                    {
                        case "date":
                            $record["value"] = DateUtility::getDate($record["value"], DateUtility::DATE_OUT_FORMAT);
                            break;

                        case "checkbox":
                            $record["value"] = $record["value"] == "1" ? "Yes" : "No";
                            break;
                    }
                    
                    echo $record["value"];
                ?>
            </label>
        <?php if ($i % 2 != 0 || ($i + 1) == $count): ?>
            </div>
        <?php endif; ?>
        
        <?php endforeach; ?>
    </div>
</div>