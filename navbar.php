<?php 
include_once("./assets/plugins.php"); 
include_once("auth.php");
?>
<style>
    .navbar-gradient {
        background: #833AB4;
        background: linear-gradient(45deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
    }
    .navbar-custom {
  background-color: #ffffffff; /* Example: custom background color */
  color: #ffcc00;
}
</style>

<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="index">Task Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php if ($current_page == 'index') echo 'active'; ?>">
                <a class="nav-link " href="index">All Users</a>
            </li>
            <li class="nav-item <?php if ($current_page == 'tasks') echo 'active'; ?>">
                <a class="nav-link" href="tasks">All Tasks</a>
            </li>
            <li class="nav-item <?php if ($current_page == 'add_tasks') echo 'active'; ?>">
                <a class="nav-link" href="add_tasks">Add Task</a>
            </li>
            <li class="nav-item <?php if ($current_page == 'signup') echo 'active'; ?>">
                <a class="nav-link" href="signup">Create Profile</a>
            </li>
        </ul>
    </div>
</nav>