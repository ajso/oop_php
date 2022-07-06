<?php $this->view('commons/admin/header', $data); ?>

<body>

  <!-- ======= Header ======= -->
  <?php $this->view('commons/admin/nav', $data); ?>

  <?php $this->view('commons/admin/sidebar', $data); ?>
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
        <li class="breadcrumb-item active"><?php //$row->slug_url; 
                                            ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">My Courses <a href="<?=ROOT?>/admin/courses/add"><button class="btn btn-primary float-end"><i class="bi bi-plus"></i>Add New Course</button></a></h5>

        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Price</th>
              <th scope="col">Primary Subject</th>
              <th scope="col">Upload Date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Brandon Jacob</td>
              <td>Designer</td>
              <td>28</td>
              <td>2016-05-25</td>
              <td>2016-05-25</td>
              <td>
                <i class="bi bi-pencil-square"></i>
                <i class="bi bi-trash"></i>
              </td>
            </tr>


          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
  </main>

  <?php $this->view('commons/admin/footer', $data); ?>