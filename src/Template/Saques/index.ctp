<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saque[]|\Cake\Collection\CollectionInterface $saques
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Saque'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Banks'), ['controller' => 'Banks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bank'), ['controller' => 'Banks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="saques index large-9 medium-8 columns content">
    <h3><?= __('Saques') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saques as $saque): ?>
            <tr>
                <td><?= $this->Number->format($saque->id) ?></td>
                <td><?= $saque->has('bank') ? $this->Html->link($saque->bank->name, ['controller' => 'Banks', 'action' => 'view', $saque->bank->id]) : '' ?></td>
                <td><?= $this->Number->format($saque->created) ?></td>
                <td><?= $this->Number->format($saque->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $saque->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saque->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saque->id)]) ?>
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
