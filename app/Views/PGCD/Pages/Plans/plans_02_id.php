<?php
/*********************************** CHECK */
if (!isset($p_title))
    {
        $p_title = lang('ma_dmp.not_title_defined');
        $p_persistent_id = lang('ma_dmp.creating');
    }

?>
<div class="container">
    <div class="row">
        <div class="col-10" id="plan_title">
            <?=lang('ma_dmp.plans');?>
            <h4><?=$p_title;?></h4>
        </div>
        <div class="col-2 text-bg-primary text-end p-3" id="plan_nr">
            <?php
            if (trim($p_persistent_id) != '')
                {
                    echo '--'.$p_persistent_id;
                } else {
                    echo lang('ma_dmp.draft');
                    echo ': ';
                    echo '<b>';
                    echo strzero($p_nr,6).'/'.$p_year;
                    echo '</b>';
                }
            ?>
        </div>

        <div style="border-top: 1px solid #000;" class="mb-5">
        </div>
    </div>
</div>