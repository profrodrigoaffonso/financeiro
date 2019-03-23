<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bank $bank
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bank'), ['action' => 'edit', $bank->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bank'), ['action' => 'delete', $bank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bank->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Banks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bank'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Saques'), ['controller' => 'Saques', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Saque'), ['controller' => 'Saques', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="banks view large-9 medium-8 columns content">
    <h3><?= h($bank->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($bank->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($bank->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bank->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correntista') ?></th>
            <td><?= $bank->correntista ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Saques') ?></h4>
        <?php if (!empty($bank->saques)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bank Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bank->saques as $saques): ?>
            <tr>
                <td><?= h($saques->id) ?></td>
                <td><?= h($saques->bank_id) ?></td>
                <td><?= h($saques->created) ?></td>
                <td><?= h($saques->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Saques', 'action' => 'view', $saques->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Saques', 'action' => 'edit', $saques->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Saques', 'action' => 'delete', $saques->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saques->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
