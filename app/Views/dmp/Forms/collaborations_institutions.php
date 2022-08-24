<?php

/************************************* Header */
if (!isset($this->collaboration_inst)) {
    $this->collaboration_inst = 0;
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-8">
            <h4 class="dmp_h"><?= lang('ma_dmp.' . trim($plf_field)); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <?php
                $PlansCollaborationsInstitutions = new \App\Models\dmp\PlansCollaborationsInstitutions();
                echo $PlansCollaborationsInstitutions->list($id_p);

                $data['id_p'] = $id_p;
                //echo view("dmp/Forms/collaborations_authors_invitation", $data);
                ?>
        </div>
    </div>
</div>
<?php
}
/********************************* End Header */
?>