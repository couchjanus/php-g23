<div class="table-responsive">
    <?php if (count($brands) > 0):?>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">brand name</th>
              <th scope="col">Action</th> 
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($brands as $brand):?>
            <tr>
              <td><?=$brand->id?></td>
              <td><?=$brand->name?></td>
              
              <td>
                    <a href="/admin/brands/edit/<?=$brand->id?>"><buttom class="btn btn-warning">Edit</buttom></a>
                    <a href="/admin/brands/delete/<?=$brand->id?>"><buttom class="btn btn-danger">Delete</buttom></a>
              </td>
             
            </tr>
        <?php endforeach  ?>  
        </tbody>
    </table>
    <?php else: ?>
        <h2>No brands yet</h2>
    <?php endif ?>
</div>