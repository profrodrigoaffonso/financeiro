<div class="container">
    <h3><?= __('Banks') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('code','Código') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name','Banco') ?></th>
                <th scope="col"><?= $this->Paginator->sort('agency','Agência') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account','Conta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('correntista') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banks as $bank): ?>
            <tr>
                <td><?= h($bank->code) ?></td>
                <td><?= h($bank->name) ?></td>
                <td><?= h($bank->agency) ?></td>
                <td><?= h($bank->account) ?></td>
                <td><?= ($bank->correntista==1?"Sim":"Não") ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bank->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bank->id]) ?>
                    <?php // $this->Form->postLink(__('Delete'), ['action' => 'delete', $bank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bank->id)]) ?>
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
