<div id="<?= $id ?>" class='public rating-stars'>
    <ul class='stars' data-value="<?= $value ?>">
        <li class='star' title='Poor' data-value='1'>
            <i class='fa fa-star fa-fw'></i>
        </li>
        <li class='star' title='Fair' data-value='2'>
            <i class='fa fa-star fa-fw'></i>
        </li>
        <li class='star' title='Good' data-value='3'>
            <i class='fa fa-star fa-fw'></i>
        </li>
        <li class='star' title='Excellent' data-value='4'>
            <i class='fa fa-star fa-fw'></i>
        </li>
        <li class='star' title='WOW!!!' data-value='5'>
            <i class='fa fa-star fa-fw'></i>
        </li>
        <?php if (isset($count) && $count): ?>
            <?= $count ?> Reviews
        <?php endif; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        var v = parseInt($("#<?= $id ?>").find('ul.stars').attr("data-value"));
        
        if (v)
        {
            var stars = $("#<?= $id ?>").find('ul.stars li.star');
            for (var i = 0; i < v; i++) 
            {
                $(stars[i]).addClass('selected');
            }
        }
    });
</script>