<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre[]|\Cake\Collection\CollectionInterface $membres
 */
?>
<div class="index large-9 medium-8 columns content">
    <h3><?= __('Fichiers partagés')?> <font size="+1">[<?= $this->Html->link(__('Upload un fichier'), ['action' => 'add']) ?>]</font> </h3>
    <table>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Nom du fichier') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
				<tr>
					<td><?= $this->Html->link($file, $uploadfolder.'/'.$file) ?></td>
				</tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
