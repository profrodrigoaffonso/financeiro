<div class="container">
    <h3><?= __('Saques') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('bank_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saques as $saque): ?>
            <tr>
                <td><?= $saque->bank->name?></td>
                <td><?= date('d/m/Y', strtotime(($saque->created))) ?></td>
                <td><?= number_format($saque->value,2,',','.') ?></td>
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
    <div class="row">
        <h3>Totais</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Banco</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($totais as $total) :?>
                <tr>
                    <td><?=$total['Banks__name']?></td>
                    <td><?=$total['qt']?></td>
                    <td><?=number_format($total['valor'],2,',','.')?></td>
                </tr>

            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
