<div class="table-responsive">
    <?php if (count($categories) > 0):?>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category name</th>
              <th scope="col">Category status</th>
              <th scope="col">Action</th> 
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($categories as $category):?>
            <tr>
              <td><?=$category->id?></td>
              <td><?=$category->name?></td>
              <td><?=$category->status?></td>
              <td>
                    <a href="/admin/categories/edit/<?=$category->id?>"><buttom class="btn btn-warning">Edit</buttom></a>
                    <a href="/admin/categories/delete/<?=$category->id?>"><buttom class="btn btn-danger">Delete</buttom></a>
              </td>
             
            </tr>
        <?php endforeach  ?>  
        </tbody>
    </table>
    <?php else: ?>
        <h2>No categories yet</h2>
    <?php endif ?>
</div>