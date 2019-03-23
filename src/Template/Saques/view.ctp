<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saque $saque
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Saque'), ['action' => 'edit', $saque->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Saque'), ['action' => 'delete', $saque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saque->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Saques'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Saque'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Banks'), ['controller' => 'Banks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bank'), ['controller' => 'Banks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="saques view large-9 medium-8 columns content">
    <h3><?= h($saque->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bank') ?></th>
            <td><?= $saque->has('bank') ? $this->Html->link($saque->bank->name, ['controller' => 'Banks', 'action' => 'view', $saque->bank->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($saque->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $this->Number->format($saque->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($saque->value) ?></td>
        </tr>
    </table>
</div>
