<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">

          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Services <span>| Active</span></h5>

                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-25 text-success">
                    <i class="bi bi-menu-button-wide"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                    $services = $conn->query("SELECT * FROM `service_list` where `status` = 1")->num_rows;
                    ?>
                    <h6><?= format_num($services) ?></h6>
                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Services <span>| Inctive</span></h5>

                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-dark bg-opacity-25 text-dark">
                    <i class="bi bi-menu-button-wide"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                    $services = $conn->query("SELECT * FROM `service_list` where `status` = 0")->num_rows;
                    ?>
                    <h6><?= format_num($services) ?></h6>
                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Book Entry <span>| Pending</span></h5>
                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-dark bg-opacity-25 text-dark">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                    $books = $conn->query("SELECT * FROM `service_list` where `status` = 0")->num_rows;
                    ?>
                    <h6><?= format_num($books) ?></h6>
                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title">Book Entry <span>| Confirmed</span></h5>
                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-25 text-primary">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                    $books = $conn->query("SELECT * FROM `service_list` where `status` = 1")->num_rows;
                    ?>
                    <h6><?= format_num($books) ?></h6>
                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
          </div>

     

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <?php 
                  if(is_dir(base_app.'uploads/banner')){
                    $images = scandir(base_app.'uploads/banner');
                    foreach($images as $k=>$v){
                      if(in_array($v, ['.', '..'])){
                        unset($images[$k]);
                      }
                    }
                  }
                ?>
                <?php if(isset($images) && count($images) > 0): ?>
                <div id="banner-slider" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <?php foreach(array_values($images) as $k => $fname): ?>
                    <div class="carousel-item <?= ($k == 0) ? "active" : "" ?>">
                      <img src="<?= validate_image('uploads/banner/'.$fname) ?>" class="d-block w-100" alt="Banner Image <?= $k + 1 ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                  <div class="text-muted text-center">No Banner has been set</div>
                <?php endif; ?>


              </div>

            </div>
          </div>

        </div>
      </div><!-- End Left side columns -->

    </div>
  </section>