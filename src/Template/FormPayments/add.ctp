<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormPayment $formPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Form Payments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Values'), ['controller' => 'Values', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Value'), ['controller' => 'Values', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formPayments form large-9 medium-8 columns content">
    <?= $this->Form->create($formPayment) ?>
    <fieldset>
        <legend><?= __('Add Form Payment') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
