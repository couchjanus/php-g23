<div class="container">
  <main>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Categories</span>
          <span class="badge bg-primary rounded-pill">20</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Active categories</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Not active categories</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">8</span>
          </li>
          
        </ul>

        
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Create New Category</h4>
        <form class="needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
          <div class="row g-3">
           
            <div class="col-12">
              <label for="categoryname" class="form-label">Category name</label>
              <div class="input-group has-validation">
               
                <input type="text" class="form-control" id="categoryname" placeholder="Category name" required name="name">
                <div class="invalid-feedback">
                    Category name is required.
                </div>
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
          <div class="col-12">
              <label class="form-label">Choose the file: </label>
              <input type="file" class="form-control" name="cover">
            </div>
            <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Create new category</button>
        </form>
      </div>
    </div>
  </main>
</div>