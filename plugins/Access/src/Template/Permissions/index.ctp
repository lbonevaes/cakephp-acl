<div class="row">
    <div class="col-md-12">
        <h3>Permissões</h3>
        
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Local</th>
                    <th><?= __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($acos as $aco) : ?>
                <tr>
                    <td><?= $aco->id; ?></td>
                    <td><?= $acos_list[$aco->id]; ?></td>
                    <td><?php
                        $aco_separators = count(explode('- ', $acos_list[$aco->id]));
                        echo str_repeat('- ', $aco_separators-1);
                        
                        echo $this->Permission->link($aro, $aco, $aros_acos);
                    ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>