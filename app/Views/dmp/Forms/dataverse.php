<?php
$dataverse = new \App\Models\Dataverse\DDI();
$dt = $dataverse->metadata();
$dt = simplexml_load_string($dt);

$fls = array();
$sx = '';
$sx .= h('Dataverse Integration');
$sx .= h('Files TYPE',2);

foreach($dt as $desc=>$cont)
    {
        $cont = (array)($cont);

        switch($desc)
            {
                case 'docDscr':
                    $citation = (array)$cont['citation'];
                    $titlStmt = (array)$citation['titlStmt'];
                    $title = (string)$titlStmt['titl'];
                    $doi = (string)$titlStmt['IDNo'];

                    $sx .= h($title, 5,'text-right');
                    $sx .= h('DOI: '.anchor('https://doi.org/'.$doi,$doi),5);

                    $verStmt = (array)$citation['verStmt'];

                    $version = $verStmt['version'];

                    $sx .= '<p>'.lang('dmp.release').' <b>v.'.$version. '</b></p>';
                    break;
                case 'fileDscr':
                    $fileT = (array)$cont['fileTxt'];
                    $fileT = $fileT['fileType'];

                    $img = '/img/svg/file.svg';
                    switch($fileT)
                        {
                            case 'text/tab-separated-values':
                                $img = '/img/svg/file-spreadsheet.svg';
                                $txt = lang('dmp.spreadsheet');
                            break;
                        }
                    $sa = '<img src="'.$img.'" style="height: 100px">';
                    $sa .= '<br>';
                    $sa .= $txt;
                    $sx .= bsc($sa,2,'text-center');
                    break;
            case 'otherMat':
                $fileT = (array)$cont['notes'];

                $img = '/img/svg/file.svg';
                switch ($fileT) {
                    case 'text/comma-separated-values':
                        $img = '/img/svg/file-spreadsheet.svg';
                        $txt = lang('dmp.spreadsheet');
                        break;
                }
                $sa = '<img src="' . $img . '" style="height: 100px">';
                $sa .= '<br>';
                $sa .= $txt;
                $sx .= bsc($sa, 2, 'text-center');
                break;

            }
    }

echo bs($sx);
?>