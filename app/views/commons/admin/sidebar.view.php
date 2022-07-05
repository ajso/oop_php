<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?= ROOT ?>/admin">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-cash-coin"></i>
                <span>My Sales</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= ROOT ?>/admin/courses">
                <i class="bi bi-camera-reels"></i>
                <span>My Courses</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-clock-history"></i>
                <span>Lesson History</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-mortarboard"></i>
                <span>Enrolled Courses</span>
            </a>
        </li>

        <li class="nav-heading">Go To </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= ROOT ?>/">
                <i class="bi bi-globe"></i>
                <span>Back To Front</span>
            </a>
        </li><!-- End Dashboard Nav -->


    </ul>

</aside><!-- End Sidebar-->
<main id="main" class="main">
    <?php if (message()) : ?>
        <div class="alert alert-success text-center"><?= message('', true) ?></div>
    <?php endif ?>