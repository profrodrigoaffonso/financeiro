<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bank $bank
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Banks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Saques'), ['controller' => 'Saques', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Saque'), ['controller' => 'Saques', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="banks form large-9 medium-8 columns content">
    <?= $this->Form->create($bank) ?>
    <fieldset>
        <legend><?= __('Add Bank') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('correntista');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
