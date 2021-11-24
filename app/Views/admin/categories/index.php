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
              <td>placeholder</td>
             
            </tr>
        <?php endforeach  ?>  
        </tbody>
    </table>
    <?php else: ?>
        <h2>No categories yet</h2>
    <?php endif ?>
</div>