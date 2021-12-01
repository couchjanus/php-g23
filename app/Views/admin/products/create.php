<div class="container">
  <main>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">products</span>
          <span class="badge bg-primary rounded-pill">20</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Active products</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Not active products</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">8</span>
          </li>
          
        </ul>

        
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Create New product</h4>
        <form class="needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
          
        <div class="row g-3">
           
          <div class="col-sm-6">
                <label for="productname" class="form-label">product name</label>
                <div class="input-group has-validation">
               
                  <input type="text" class="form-control" id="productname" placeholder="product name" required name="name">
                  <div class="invalid-feedback">
                    product name is required.
                  </div>
                </div>
          </div>
          <div class="col-sm-6">
              <label for="price" class="form-label">Product price</label>
              <input type="text" class="form-control" id="price" placeholder="Product price" name="price" required>
              <div class="invalid-feedback">
                Valid price is required.
              </div>
          </div>
          
        </div>

          <hr class="my-4">
          <h4 class="mb-3">Status</h4>
          <div class="form-check">
            <input type="checkbox" name="status" class="form-check-input" id="status">
            <label class="form-check-label" for="status">Active</label>
          </div>
          <hr class="my-4">
          <div class="row g-3">
           
            <div class="col-12">
              <label class="form-label">Product description</label>
              <textarea name="description" class="form-control">Product description</textarea>
            </div>

            <div class="col-md-6">
              <label for="category" class="form-label">Category</label>
              <select class="form-select" id="category" required name="category_id">
                <option value="">Choose...</option>
                <?php foreach ($categories as $category):?>
                <option value="<?=$category->id?>"><?=$category->name?></option>
                <?php endforeach?>
              </select>
              <div class="invalid-feedback">
                Please select a valid category.
              </div>
            </div>

            <div class="col-md-6">
              <label for="brand" class="form-label">Brand</label>
              <select class="form-select" id="brand" required name="brand_id">
                <option value="">Choose...</option>
                <?php foreach ($brands as $brand):?>
                <option value="<?=$brand->id?>"><?=$brand->name?></option>
                <?php endforeach?>
              </select>
              <div class="invalid-feedback">
                Please provide a valid brand.
              </div>
            </div>

            <hr class="my-4">

            <div class="col-12">
              <label class="form-label">Choose the file: </label>
              <input type="file" class="form-control" name="cover">
            </div>
            <hr class="my-4">

            <h4 class="mb-3">Badges</h4>

            <div class="my-3">
              <?php foreach($badges as $key => $value):?>
              <div class="form-check">
                <input id="<?=$value?>" name="badge" type="radio" class="form-check-input" value="<?=$key?>">
                <label class="form-check-label" for="<?=$value?>"><?=$value?></label>
              </div>
              <?php endforeach?>
            </div>
          </div>

          <hr class="my-4">
          <button class="w-100 btn btn-primary btn-lg" type="submit">Create new product</button>
        </form>
      </div>
    </div>
  </main>
</div>