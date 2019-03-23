<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saque $saque
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Saques'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Banks'), ['controller' => 'Banks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bank'), ['controller' => 'Banks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="saques form large-9 medium-8 columns content">
    <?= $this->Form->create($saque) ?>
    <fieldset>
        <legend><?= __('Add Saque') ?></legend>
        <?php
            echo $this->Form->control('bank_id', ['options' => $banks]);
            echo $this->Form->control('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
