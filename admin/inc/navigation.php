<style>
  .sidebar-nav .nav-content a i {
    font-size: .9rem;
}
</style>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?= $page != 'home' ? 'collapsed' : '' ?>" href="<?= base_url.'admin' ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link <?= !in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'collapsed' : '' ?>" data-bs-target="#services-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="<?= in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'true' : 'false' ?>">
      <i class="bi bi-menu-button-wide"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="services-nav" class="nav-content collapse <?= in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url.'admin/?page=services/manage_service' ?>" class="<?= $page == 'services/manage_service' ? 'active' : '' ?>">
          <i class="bi bi-plus-lg" style="font-size:.9rem"></i><span>Add New</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url.'admin/?page=services' ?>" class="<?= $page == 'services' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>List</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->
  <li class="nav-item">
    <a class="nav-link <?= !in_array($page, ['bookings', 'bookings/manage_booking', 'bookings/view_booking']) ? 'collapsed' : '' ?>" data-bs-target="#bookings-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="<?= in_array($page, ['bookings', 'bookings/manage_booking', 'bookings/view_booking']) ? 'true' : 'false' ?>">
      <i class="bi bi-book"></i><span>Bookings</span>
      <?php 
      $pbook = $conn->query("SELECT * FROM `book_list` where `status` = 0")->num_rows;
      ?>
      <?php if($pbook > 0): ?>
        <span class="badge rounded-pill bg-danger text-light ms-4"><?= format_num($pbook) ?></span>
      <?php endif; ?>
      
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="bookings-nav" class="nav-content collapse <?= in_array($page, ['bookings', 'bookings/manage_booking', 'bookings/view_booking']) ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url.'admin/?page=bookings/manage_booking' ?>" class="<?= $page == 'bookings/manage_booking' ? 'active' : '' ?>">
          <i class="bi bi-plus-lg" style="font-size:.9rem"></i><span>Add New</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url.'admin/?page=bookings' ?>" class="<?= $page == 'bookings' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>List</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= !in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'collapsed' : '' ?>" data-bs-target="#pages-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="<?= in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'true' : 'false' ?>">
      <i class="bi bi-window-sidebar"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pages-nav" class="nav-content collapse <?= in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url.'admin/?page=pages/welcome_page' ?>" class="<?= $page == 'welcome_page' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Welcome Page</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url.'admin/?page=pages/about_page' ?>" class="<?= $page == 'about_page' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>About Page</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $page != 'inquiries' ? 'collapsed' : '' ?> nav-users" href="<?= base_url."admin?page=inquiries" ?>">
      <i class="bi bi-inbox"></i>
      <span>Inquiries</span>
      <?php 
      $messages = $conn->query("SELECT * FROM `inquiry_list` where `status` = 0")->num_rows;
      ?>
      <?php if($messages > 0): ?>
        <span class="badge rounded-pill bg-danger text-light ms-4"><?= format_num($messages) ?></span>
      <?php endif; ?>
    </a>
  </li>
  <?php if($_settings->userdata('type') == 1): ?>
  <li class="nav-heading">Maintenance</li>

  <li class="nav-item">
    <a class="nav-link <?= $page != 'user/list' ? 'collapsed' : '' ?> nav-users" href="<?= base_url."admin?page=user/list" ?>">
      <i class="bi bi-people"></i>
      <span>Users</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $page != 'system_info/contact_information' ? 'collapsed' : '' ?>  nav-system_info" href="<?= base_url."admin?page=system_info/contact_information" ?>">
      <i class="bi bi-telephone"></i>
      <span>Contact Information</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $page != 'system_info' ? 'collapsed' : '' ?>  nav-system_info" href="<?= base_url."admin?page=system_info" ?>">
      <i class="bi bi-gear"></i>
      <span>System Information</span>
    </a>
  </li>
  <?php endif; ?>
  

</ul>

</aside><!-- End Sidebar-->