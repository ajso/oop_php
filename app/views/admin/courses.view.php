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

      <div class="card">
        <div class="card-body">

          <?php if (!empty($row)) : ?>
            <div class="float-end mt-2">
              <button class="js-save-button btn btn-secondary disabled">Save</button>
              <a href="<?= ROOT ?>/admin/courses/">
                <button class="btn btn-primary">Back</button></a>
            </div>
            <h5 class="card-title">Edit Course - <?= $row->title ?></h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
              <li class="nav-item flex-fill" role="presentation">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100 active" id="intented-learners-tab" data-bs-toggle="tab" data-bs-target="#intented-learners" type="button" role="tab" aria-controls="home" aria-selected="true">Intended Learners</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="profile" aria-selected="false">Curriculum</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="course-landing-page-tab" data-bs-toggle="tab" data-bs-target="#course-landing-page" type="button" role="tab" aria-controls="contact" aria-selected="false">Course Landing Page</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="promotions-tab" data-bs-toggle="tab" data-bs-target="#promotions" type="button" role="tab" aria-controls="contact" aria-selected="false">Promotions</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="course-messages-tab" data-bs-toggle="tab" data-bs-target="#course-messages" type="button" role="tab" aria-controls="contact" aria-selected="false">Course Messages</button>
              </li>
            </ul>
            <div oninput="something_changed(event)" class="tab-content pt-2" id="borderedTabJustifiedContent">

              <div class="tab-pane fade show active" id="intented-learners" role="tabpanel" aria-labelledby="intented-learners-tab">
                Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
                <input type="text" name="" />
              </div>
              <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                <input type="text" name="" />
              </div>
              <div class="tab-pane fade" id="course-landing-page" role="tabpanel" aria-labelledby="landing-page-tab">
                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                <input type="text" name="" />
              </div>
              <div class="tab-pane fade" id="promotions" role="tabpanel" aria-labelledby="promotions-tab">
                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                <input type="text" name="" />
              </div>
              <div class="tab-pane fade" id="course-messages" role="tabpanel" aria-labelledby="course-messages-tab">
                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                <input type="text" name="" />
              </div>
            </div><!-- End Bordered Tabs Justified -->

          <?php else : ?>

            <div>This Course Was not found.!!</div>

          <?php endif; ?>

        </div>
      </div>


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
                      <a href="<?= ROOT ?>/admin/courses/edit/<?= $row->id ?>">
                        <i class="bi bi-pencil-square"></i></a>
                      <a href="<?= ROOT ?>/admin/courses/delete/<?= $row->id ?>">
                        <i class="bi bi-trash text-danger"></i>
                      </a>
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

  <script>
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#intented-learners-tab";
    var unSave = false; //if something is not saved or not right/dirty.

    function show_tab(tab_name) {
      const someTabTriggerEl = document.querySelector(tab_name + "-tab");
      const tab = new bootstrap.Tab(someTabTriggerEl);

      tab.show();
      save_btn_status(false);

    }

    function set_tab(tab_name) {
      tab = tab_name;
      sessionStorage.setItem("tab", tab_name);
      // alert(tab_name);
      //if there are wrong inputs or anything is wrong, don't switch tabs.
      if (unSave) {

        //ask user to save when switching tabs.

        if (!confirm("Your Changes were not saved! Are you sure you want to switch Tab?")) {

          tab = unSave;
          sessionStorage.setItem("tab", unSave);

          //set Timer to return to original tab.
          setTimeout(function() {
            show_tab(unSave); //go back to unsaved tab
            save_btn_status(true); //when switch tab, disable the button.

            // if (unSave) { //if text field is filled or has some values.
            //   save_btn_status(true); //if there are values in the text field, enable the save button
            // } else {
            //   save_btn_status(false);
            // }

          }, 10);

        } else {
          unSave = false; //change tab
          save_btn_status(false);
        }

      }
    }

    //function to detect any change in the inputs.
    function something_changed(e) {

      //remain on the current tab in case something is not right.
      unSave = tab;
      //whenever something is changed in the text field, enable the button.
      save_btn_status(true);

    }

    //enable a disabled button.
    function save_btn_status(status = false) {

      if (status) {
        document.querySelector('.js-save-button').classList.remove('disabled');
      } else {
        document.querySelector('.js-save-button').classList.add('disabled');
      }

    }
  </script>

  <?php $this->view('commons/admin/footer', $data); ?>