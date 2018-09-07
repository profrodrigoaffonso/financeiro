<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Value $value
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Value'), ['action' => 'edit', $value->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Value'), ['action' => 'delete', $value->id], ['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Values'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Value'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Form Payments'), ['controller' => 'FormPayments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Payment'), ['controller' => 'FormPayments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="values view large-9 medium-8 columns content">
    <h3><?= h($value->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $value->has('user') ? $this->Html->link($value->user->id, ['controller' => 'Users', 'action' => 'view', $value->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Payment') ?></th>
            <td><?= $value->has('form_payment') ? $this->Html->link($value->form_payment->name, ['controller' => 'FormPayments', 'action' => 'view', $value->form_payment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $value->has('category') ? $this->Html->link($value->category->name, ['controller' => 'Categories', 'action' => 'view', $value->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($value->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($value->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($value->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($value->modified) ?></td>
        </tr>
    </table>
</div>
