<?php
    $event = isset($event) ? $event : true;
?>
<?php if (isset($font_size)): ?>
<style>
    #<?= $id ?>.rating-stars ul {
        list-style-type:none;
        padding:0;

        -moz-user-select:none;
        -webkit-user-select:none;
    }
    #<?= $id ?>.rating-stars ul > li.star {
        display:inline-block;
    }

    /* Idle State of the stars */
    #<?= $id ?>.rating-stars ul > li.star > i.fa {
        font-size: <?= $font_size ?>;
        color:#ccc;
    }

    /* Hover state of the stars */
    #<?= $id ?>.rating-stars ul > li.star.hover > i.fa {
        color:#FFCC36;
    }

    /* Selected state of the stars */
    #<?= $id ?>.rating-stars ul > li.star.selected > i.fa {
        color:#FF912C;
    }
</style>
<?php endif; ?>


<div id="<?= $id ?>" class='rating-stars text-center'>
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
    </ul>
</div>

<?php if ($event): ?>
<script type="text/javascript">
    var RatingStar = {
        onRating : function(value){
            
        }
    };
    
    $(document).ready(function()
    {
        $(document).on("mouseover", 'ul.stars li', function() 
        {
            var onStar = parseInt($(this).data('value'), 10);

            $(this).parent().children('li.star').each(function(e) 
            {
                if (e < onStar) 
                {
                    $(this).addClass('hover');
                }
                else 
                {
                    $(this).removeClass('hover');
                }
            });

        })
                
        $(document).on("mouseout", 'ul.stars li', function() 
        {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });

        $(document).on("click", 'ul.stars li', function()
        {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');

            for (var i = 0; i < stars.length; i++) 
            {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) 
            {
                $(stars[i]).addClass('selected');
            }

            var ratingStar = $(this).parent();
            var ratingValue = parseInt(ratingStar.find('li.selected').last().data('value'));
            
            ratingStar.attr("data-value", ratingValue);
            RatingStar.onRating(ratingValue);
        });
    });
</script>
<?php endif; ?>

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