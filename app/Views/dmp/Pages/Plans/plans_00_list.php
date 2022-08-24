<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table dmp_table">
                <tr class="dmp_table_th">
                    <th class="dmp_table_th" width="5%"><?= lang('ma_dmp.p_nr'); ?></th>
                    <th class="dmp_table_th" width="60%"><?= lang('ma_dmp.p_title'); ?></th>
                    <th class="dmp_table_th" width="10%"><?= lang('ma_dmp.p_form'); ?></th>
                    <th class="dmp_table_th" width="10%"><?= lang('ma_dmp.p_version'); ?></th>
                    <th class="dmp_table_th" width="10%"><?= lang('ma_dmp.updated_at'); ?></th>
                    <th class="dmp_table_th" width="10%"><?= lang('ma_dmp.p_status'); ?></th>
                    <th class="dmp_table_th" colspan=4><?= lang('ma_dmp.action'); ?></th>
                </tr>
                <?php
                for ($r = 0; $r < count($plans); $r++) {
                    $line = $plans[$r];
                    $status = lang('ma_dmp.plans_status_' . $line['p_status']);
                    /* PDF ****************************************************/
                    $pdf = '';
                    $edit = '';
                    $trash = '';
                    $linka = '</a>';
                    switch ($line['p_status']) {
                        case 0:
                            /* Edit ***************************************************/
                            $link = '<a href="/dmp/plans/edit/' . $line['id_p'] . '" class="dmp_edit_plans">';
                            $edit = $link . bsicone('edit', 16) . $linka;
                            /* Tash ***************************************************/
                            $link = '<a href="/dmp/plans/trash/' . $line['id_p'] . '" class="dmp_trash_plans">';
                            $trash = $link . bsicone('trash', 16) . $linka;;
                            break;

                        case 1:
                            $pdf = bsicone('pdf', 16);
                            break;
                    }
                    $link = '<a href="/dmp/plans/view/' . $line['id_p'] . '" class="dmp_view_plans">';
                ?>
                <tr>
                    <td><?= strzero($line['p_nr'], 6) . '/' . $line['p_year']; ?></td>
                    <td><?= $link . $line['p_title'] . $linka; ?></td>
                    <td><?= $line['pf_acronic']; ?></td>
                    <td><?= $line['p_version']; ?></td>
                    <td><?= $line['updated_at']; ?></td>
                    <td><?= $status ?></td>
                    <td width="1%"><?= $edit;
                                        bsicone('edit', 16); ?></td>
                    <td width="1%"><?= $trash; ?></td>
                    <td width="1%"><?= $pdf; ?></td>
                </tr>
                <?php
                }

                if (count($plans) == 0) {
                echo '<tr><td colspan=7>'.lang('ma_dmp.no_plans').'</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>