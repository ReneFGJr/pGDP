<?php
$answer = trim($tips_question);
if ($answer == '') {
    $answer = lang('ma_dmp.' . $plf_field);
}

?>
<div class="container mt-3">
    <div class="row">
        <div class="col-8">
            <h4 class="dmp_h"><?= $answer; ?></h4>
            <textarea class="form-control mt-1" rows="6" name="form_<?= $id_plf; ?>"><?= $pv_value; ?></textarea>
        </div>
        <div class="col-4">
            <h5>Info</h5>
            <p class="border border-secondary p-2"><?= $tips_description; ?></p>
        </div>
    </div>
</div>