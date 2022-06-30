<?php $this->view('commons/admin/header', $data); ?>

<body>

  <!-- ======= Header ======= -->
  <?php $this->view('commons/admin/nav', $data); ?>

  <?php $this->view('commons/admin/sidebar', $data); ?>
  <?php if (!empty($row)) : ?>
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
          <li class="breadcrumb-item active"><?= $row->slug_url; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= ROOT ?>/<?= $row->img_url; ?>" style="width:150px; max-width:150px; height:150px;object-fit:cover;" alt="Profile" class="rounded-circle">
              <h2><?= esc($row->firstname); ?> <?= esc(ucfirst(Auth::getLastname())) ?></h2>
              <h3><?= esc(ucfirst($row->role)) ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" onclick="set_tab(this.getAttribute('data-bs-target'))" data-bs-toggle="tab" id="profile-overview-tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" onclick="set_tab(this.getAttribute('data-bs-target'))" data-bs-toggle="tab" id="profile-edit-tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" onclick="set_tab(this.getAttribute('data-bs-target'))" data-bs-toggle="tab" id="profile-settings-tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" onclick="set_tab(this.getAttribute('data-bs-target'))" data-bs-toggle="tab" id="profile-change-password-tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?= esc($row->bio); ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->firstname); ?> <?= $row->lastname ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->company); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->job); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->country); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->address); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->phone); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= esc($row->email); ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="d-flex">
                          <!-- addition -->
                          <img class="js-image-preview" src="<?= ROOT ?>/<?= $row->img_url; ?>" style="width:200px; max-width: 200px; height:200px; object-fit:cover;" alt="Profile">
                          <!-- js- div -->
                          <div class="js-filename m-2"> Selected file: None


                          </div>

                        </div>
                        <div class="pt-2">
                          <label href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="text-white bi bi-upload"></i>
                            <input type="file" onchange="load_img(this.files[0])" name="image" style="display: none;" /></label>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="fullName" value="<?= setValue('firstname', $row->firstname) ?>">
                        <?php if (!empty($errors['firstname'])) : ?>
                          <small class=" text-danger"><?= $errors['firstname'] ?></small>
                        <?php endif ?>
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="lastName" value="<?= setValue('lastname', $row->lastname) ?>">
                        <?php if (!empty($errors['lastname'])) : ?>
                          <small class=" text-danger"><?= $errors['lastname'] ?></small>
                        <?php endif ?>
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?= setValue('about', $row->bio) ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?= setValue('company', $row->company) ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?= setValue('job', $row->job) ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?= setValue('country', $row->country) ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?= setValue('address', $row->address) ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?= setValue('phone', $row->phone) ?>">

                        <?php if (!empty($errors['phone'])) : ?>
                          <small class=" text-danger"><?= $errors['phone'] ?></small>
                        <?php endif ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= setValue('email', $row->email) ?>">
                      </div>
                      <?php if (!empty($errors['email'])) : ?>
                        <small class=" text-danger"><?= $errors['email'] ?></small>
                      <?php endif ?>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter_link" type="text" class="form-control" id="Twitter" value="<?= setValue('twitter_link', $row->twitter_link) ?>">
                        <?php if (!empty($errors['twitter_link'])) : ?>
                          <small class=" text-danger"><?= $errors['twitter_link'] ?></small>
                        <?php endif ?>
                      </div>

                    </div>


                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin_link" type="text" class="form-control" id="Linkedin" value="<?= setValue('linkedin_link', $row->linkedin_link) ?>">
                        <?php if (!empty($errors['linkedin_link'])) : ?>
                          <small class=" text-danger"><?= $errors['linkedin_link'] ?></small>
                        <?php endif ?>
                      </div>

                    </div>

                    <!-- <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving.. 50%</div>
                    </div> -->

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary float-start">Cancel</button>
                      <button type="submit" class="btn btn-primary float-end">Update Profile</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

    </main><!-- End #main -->
  <?php else : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      This Profile was not found!!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  <?php endif ?>

  <script>
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#profile-overview";

    function show_tab(tab_name) {
      const someTabTriggerEl = document.querySelector(tab_name + "-tab");
      const tab = new bootstrap.Tab(someTabTriggerEl);

      tab.show();

    }

    function set_tab(tab_name) {
      tab = tab_name;
      sessionStorage.setItem("tab", tab_name);
    }

    function load_img(file) {

      document.querySelector(".js-filename").innerHTML = "Selected file: " + file.name; //grab the item at class .js-filename

      var mylink = window.URL.createObjectURL(file); //create the link
      document.querySelector(".js-image-preview").src = mylink; //grab the image
    }
  </script>

  <!-- will work when the window is loaded-->
  <script>
    window.onload = function() {

      show_tab(tab);
    }

    //upload functions
    function save_profile() {
      // var image = document.querySelector(".js-profile-image-input");
      // send_data({
      //   pic: image.files[0]
      // });
    }

    //progress bar
    function send_data(obj) {

      // var prog = document.querySelector(".js-prog"); //progress bar
      // prog.children[0].style.width = "0%";
      // prog.classList.remove("hide"); // showing e

      // var myform = new FormData(); //creating a virtual form
      // for (key in obj) { //looping through an object
      //   myform.append(key, obj[key]); //adding obj to a form
      // }

      // var ajax = new XMLHttpRequest();

      // ajax.addEventListener('readystatechange', function() { //event listener

      //   if (ajax.readyState == 4) { //state 4 is when everything is complete

      //     if (ajax.status == 200) { //server status 'OK'
      //       //everything went well
      //       alert("upload complete");
      //     } else {
      //       //error
      //       alert("an error occurred");
      //     }
      //   }
      // });

      //event listener to the upload object to the progress event
      // ajax.upload.addEventListener('progress', function(e) {

      //   var percent = Math.round((e.loaded / e.total) * 100); //progress values
      //   prog.children[0].style.width = percent + "%"; //changing the style
      //   prog.children[0].innerHTML = "Saving.. " + percent + "%";

      // });

      // ajax.open('post', '', true);
      // ajax.send(myform); //sending the form

    }
  </script>

  <?php $this->view('commons/admin/footer', $data); ?>