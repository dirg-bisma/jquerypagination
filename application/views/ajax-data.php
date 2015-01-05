<table class="table">
    <thead>
    <tr>
        <th>Nama</th>
        <th>E-Mail</th>
        <th>Telepone</th>
        <th>Pekerjaan</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($test as $row){?>
    <tr>
        <td><?php print($row->nama); ?></td>
        <td><?php print($row->email)?></td>
        <td><?php print($row->telp);?></td>
        <td><?php print($row->pekerjaan);?></td>
    </tr>
    <?php }?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <?php echo $paging;?>
    </ul>
</nav>