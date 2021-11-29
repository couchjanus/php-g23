<div class="container">
  <main>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Brands</span>
          <span class="badge bg-primary rounded-pill">20</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Active brands</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Not active brands</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">8</span>
          </li>
          
        </ul>

        
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Edit brand</h4>
        <form class="needs-validation" novalidate method="POST" action="">
          <div class="row g-3">
           
              <div class="col-12">
                <label for="brandname" class="form-label">Brand name</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="brandname" value="<?=$brand->name?>" required name="name">
                  <div class="invalid-feedback">
                      brand name is required.
                  </div>
                </div>
              </div>
          </div>

          <hr class="my-4">
          <div class="row g-3">
           
              <div class="col-12">
                <label for="branddescription" class="form-label">Brand description</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="branddescription" value="<?=$brand->description?>" required name="description">
                  <div class="invalid-feedback">
                      brand description is required.
                  </div>
                </div>
              </div>
          </div>
          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Update brand</button>
        </form>
      </div>
    </div>
  </main>
</div>