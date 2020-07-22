<?php
if ($this->request->data[$model]["type"] == GatePass::TYPE_INVENTORY)
{
    echo $this->element("$controller/tab_inventory");
}
else if ($this->request->data[$model]["type"] == GatePass::TYPE_ITEM)
{
    echo $this->element("$controller/tab_item");
}
else if ($this->request->data[$model]["type"] == GatePass::TYPE_ASSET)
{
    echo $this->element("$controller/tab_asset");
}
else if ($this->request->data[$model]["type"] == GatePass::TYPE_JOB_ORDER)
{
    echo $this->element("$controller/tab_job_order");
}

