<?php
include('../functions/init.php');
include('../includes/header.php');
if (logged_in() == 'admin') {
} else if (logged_in() == 'user') {
  redirect('../index.php');
} else {
  redirect('../login.php');
}
?>
<nav class="navbar bg-dark border-bottom border-body">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="../images/logo.png" alt="Logo" width="40" class="d-inline-block align-text-top">
    </a>
    <?php
    if (logged_in()) { ?>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userAccountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          User Account
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userAccountDropdown">
          <!-- Add dropdown items here, e.g., user profile, settings, logout, etc. -->
          <li><a class="dropdown-item" href="../index.php">Home</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
        </ul>
      </div>
    <?php
    } else { ?>
      <div class="btn-group" role="group">
        <a href="login.php" class="btn btn-primary">Login</a>
        <a href="register.php" class="btn btn-primary">Register</a>
      </div>
    <?php } ?>
    <!-- User Account Dropdown -->
  </div>
</nav>
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-body-secondary">
      <span class="h5">All Users</span><br>
      Manage all the existing users by adding, updating, or deleting
    </div>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
      <i class="fas fa-user-plus"></i>
      Add new user
    </button>
  </div>
  <table class="table table-bordered table-striped table-hover" id="myTable">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Image</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows will be dynamically generated here -->
    </tbody>
  </table>
</div>


<!-- Add user offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" style="width:600px;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add new user</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form method="POST" id="insertForm">
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
        </div>
        <div class="col">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Enter Email">
        </div>
        <div class="col">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
      </div>
      <div class="row mb-3">
        <label class="form-label">Image</label>
        <div class="col-2">
          <img class="preview_img" src="images/default_profile.jpg">
        </div>
        <div class="col-10">
          <div class="file-upload text-secondary">
            <input type="file" class="image" name="image" accept="image/*">
            <span class="fs-4 fw-2">Choose file...</span>
            <span>or drag and drop file here</span>
          </div>
        </div>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-control">
          <option value="">Select</option>
          <option value="1">Admin</option>
          <option value="0">User</option>
        </select>
      </div>
      <div>
        <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit user offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" style="width:600px;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit user</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form method="POST" id="editForm">
      <input type="hidden" name="id" id="id">
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
        </div>
        <div class="col">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Enter Email">
        </div>
        <div class="col">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
      </div>
      <div class="row mb-3">
        <label class="form-label">Image</label>
        <div class="col-2">
          <img class="preview_img" src="images/default_profile.jpg">
        </div>
        <div class="col-10">
          <div class="file-upload text-secondary">
            <input type="file" class="image" name="image" accept="image/*">
            <input type="hidden" name="image_old" id="image_old">
            <span class="fs-4 fw-2">Choose file...</span>
            <span>or drag and drop file here</span>
          </div>
        </div>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Role</label>
        <select name="role" id="roleSelect" class="form-control">
          <option value="">Select</option>
          <option value="1">Admin</option>
          <option value="0">User</option>
        </select>
      </div>
      <div>
        <button type="submit" class="btn btn-primary me-1" id="editBtn">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Toast container  -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <!-- Success toast  -->
  <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
    <div class="d-flex">
      <div class="toast-body">
        <strong>Success!</strong>
        <span id="successMsg"></span>
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
  <!-- Error toast  -->
  <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
    <div class="d-flex">
      <div class="toast-body">
        <strong>Error!</strong>
        <span id="errorMsg"></span>
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<?php include('../includes/footer.php') ?>