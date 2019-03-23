<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bank[]|\Cake\Collection\CollectionInterface $banks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bank'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Saques'), ['controller' => 'Saques', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Saque'), ['controller' => 'Saques', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="banks index large-9 medium-8 columns content">
    <h3><?= __('Banks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('correntista') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banks as $bank): ?>
            <tr>
                <td><?= $this->Number->format($bank->id) ?></td>
                <td><?= h($bank->code) ?></td>
                <td><?= h($bank->name) ?></td>
                <td><?= h($bank->correntista) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bank->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bank->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bank->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
