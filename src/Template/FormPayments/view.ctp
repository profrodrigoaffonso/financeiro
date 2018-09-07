<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormPayment $formPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Form Payment'), ['action' => 'edit', $formPayment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Form Payment'), ['action' => 'delete', $formPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formPayment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Form Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Values'), ['controller' => 'Values', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Value'), ['controller' => 'Values', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formPayments view large-9 medium-8 columns content">
    <h3><?= h($formPayment->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($formPayment->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($formPayment->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Values') ?></h4>
        <?php if (!empty($formPayment->values)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Form Payment Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($formPayment->values as $values): ?>
            <tr>
                <td><?= h($values->id) ?></td>
                <td><?= h($values->user_id) ?></td>
                <td><?= h($values->value) ?></td>
                <td><?= h($values->form_payment_id) ?></td>
                <td><?= h($values->category_id) ?></td>
                <td><?= h($values->created) ?></td>
                <td><?= h($values->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Values', 'action' => 'view', $values->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Values', 'action' => 'edit', $values->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Values', 'action' => 'delete', $values->id], ['confirm' => __('Are you sure you want to delete # {0}?', $values->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
