<div class="table-responsive">
    <?php if (count($products) > 0):?>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">product name</th>
              <th scope="col">product price</th>
              <th scope="col">product status</th>
              <th scope="col">Action</th> 
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($products as $product):?>
            <tr>
              <td><?=$product->id?></td>
              <td><?=$product->name?></td>
              <td><?=$product->price?></td>
              <td><?=$product->status?></td>
              
              <td>
                    <a href="/admin/products/edit/<?=$product->id?>"><buttom class="btn btn-warning">Edit</buttom></a>
                    <a href="/admin/products/delete/<?=$product->id?>"><buttom class="btn btn-danger">Delete</buttom></a>
              </td>
             
            </tr>
        <?php endforeach  ?>  
        </tbody>
    </table>
    <?php else: ?>
        <h2>No products yet</h2>
    <?php endif ?>
</div>