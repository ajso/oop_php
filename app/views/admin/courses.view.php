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
        <li class="breadcrumb-item active">course</li>
        <li class="breadcrumb-item active"><?php //$row->slug_url; 
                                            ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-lg-12">
    <?php if ($action == 'add') : ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">New Course</h5>

          <!-- No Labels Form -->
          <form method="POST" class="row g-3">
            <div class="col-md-12">
              <input type="text" name="title" value="<?= setValue('title') ?>" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>" placeholder="Course Title">
              <?php if (!empty($errors['title'])) : ?>
                <small class=" text-danger"><?= $errors['title'] ?></small>
              <?php endif ?>
            </div>

            <div class="col-md-12">
              <input type="text" name="primary_subject" value="<?= setValue('primary_subject') ?>" class="form-control <?= !empty($errors['primary_subject']) ? 'border-danger' : ''; ?>" placeholder="Course Primary Subject e.g Videography">
              <?php if (!empty($errors['primary_subject'])) : ?>
                <small class=" text-danger"><?= $errors['primary_subject'] ?></small>
              <?php endif ?>
            </div>


            <div class="col-md-12">
              <select name="category_id" id="inputState" class="form-select form-control <?= !empty($errors['category_id']) ? 'border-danger' : ''; ?>">

                <option value="">Select Category</option>
                <?php if (!empty($categories)) : ?>
                  <?php foreach ($categories as $cat) : ?>
                    <option <?= setSelect('category_id', $cat->id); ?> value="<?= $cat->id; ?>"><?= esc($cat->category); ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <?php if (!empty($errors['category_id'])) : ?>
                <small class=" text-danger"><?= $errors['category_id'] ?></small>
              <?php endif ?>
            </div>

            <div class="text-center float-end">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="<?= ROOT ?>/admin/courses/">
                <button type="button" class="btn btn-secondary">Cancel</button>
              </a>
            </div>
          </form><!-- End No Labels Form -->

        </div>
      </div>
    <?php elseif ($action == 'edit') : ?>


    <?php else : ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">My Courses
            <a href="<?= ROOT ?>/admin/courses/add">
              <button class="btn btn-primary float-end"><i class="bi bi-plus"></i>Add New Course</button>
            </a>
          </h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Primary Subject</th>
                <th scope="col">Instructor</th>
                <th scope="col">Upload Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <?php if (!empty($rows)) : ?>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr>
                    <th scope="row">32<?= $row->id; ?></th>
                    <td><?= esc($row->title); ?></td>
                    <td><?= esc($row->category_id_row->category ?? 'Unknown Category'); ?></td>
                    <td><?= esc($row->price_id_row->name ?? 'Unknown Price'); ?></td>
                    <td><?= esc($row->primary_subject ?? 'Unknown Subject'); ?></td>
                    <td><?= esc($row->user_id_row->name ?? 'Unknown User'); ?></td>
                    <td><?= get_date($row->date_created); ?></td>
                    <td>
                      <i class="bi bi-pencil-square"></i>
                      <i class="bi bi-trash"></i>
                    </td>
                  </tr>

                <?php endforeach; ?>
              </tbody>
            <?php else : ?>
              <tr>
                <td colspan="10">No Record Found.</td>
              </tr>
            <?php endif; ?>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
    <?php endif; ?>

  </div>
  </main>

  <?php $this->view('commons/admin/footer', $data); ?>