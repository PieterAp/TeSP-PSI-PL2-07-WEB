<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="modal-dialog" id="repair">
    <div class="titleRepair p-b-20">
        <b>Reparação</b>
    </div>
    <?php

    if($reparacoes==null)
    {
        echo '<h4 class="text-center" style="color: red;">No repairs were found linked to your account!</h4>';
    }

    foreach ($reparacoes as $eachReparacao)
    {?>
        Product <input type="text" name="name" value="<?= $eachReparacao['reparacaoNome'] ?>" disabled>
        Access key<input type="text" name="key" value="<?= $eachReparacao['reparacaoNumero'] ?>" disabled>
        Start date<input type="text" name="dateStart" value="<?= $eachReparacao['reparacaoData'] ?>" disabled>
        End date<input type="text" name="dateFinish" value="<?= $eachReparacao['reparacaoDataConcluido'] ?>" disabled>
        <span>Status: </span> <span> <?= $eachReparacao['reparacaoEstado'] ?></span>
        <div class="progress" style="width: 100%">
            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                 aria-valuemin="0" aria-valuemax="80"
                 <?php
                    if ($eachReparacao['reparacaoEstado']=='Tratamento')
                    {
                        echo 'style="width:10%"';
                    }
                    elseif ($eachReparacao['reparacaoEstado']=='Aguardar Produto')
                    {
                        echo 'style="width:25%"';
                    }
                    elseif ($eachReparacao['reparacaoEstado']=='Processamento')
                    {
                        echo 'style="width:50%"';
                    }
                    elseif ($eachReparacao['reparacaoEstado']=='Concluida')
                    {
                        echo 'style="width:100%"';
                    }
                 ?>
                 style="width:100%"

            >
                <span class="sr-only">70% Complete</span>
            </div>
        </div>
        <hr style="padding-top: 20px; padding-bottom: 20px;">
        <?php
    }
    ?>
</div>
