<?php
// Track current filename to apply highlight states accurately
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="col-md-3 col-lg-2 sidebar p-0 collapse d-md-block" id="sidebarMenu">
    <div class="sticky-top" style="top: 85px;">
        <div class="sidebar-title">Core Features</div>
        
        <a href="adminHome.php" class="<?php echo ($current_page == 'adminHome.php') ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="view_admissions.php" class="<?php echo ($current_page == 'view_admissions.php') ? 'active' : ''; ?>">
            <i class="bi bi-file-earmark-text-fill"></i> Admissions
        </a>

        <div class="sidebar-title">Management</div>
        <a href="addStudent.php" class="<?php echo ($current_page == 'addStudent.php') ? 'active' : ''; ?>">
            <i class="bi bi-person-plus-fill"></i> Add Student
        </a>
        <a href="viewStudents.php" class="<?php echo ($current_page == 'viewStudents.php') ? 'active' : ''; ?>">
            <i class="bi bi-people-fill"></i> View Students
        </a>
        <a href="addTeacher.php" class="<?php echo ($current_page == 'addTeacher.php') ? 'active' : ''; ?>">
            <i class="bi bi-person-video3"></i> Add Teacher
        </a>
        <a href="viewTeachers.php" class="<?php echo ($current_page == 'viewTeachers.php') ? 'active' : ''; ?>">
            <i class="bi bi-person-bounding-box"></i> View Teachers
        </a>
        <a href="addCourse.php" class="<?php echo ($current_page == 'addCourse.php') ? 'active' : ''; ?>">
            <i class="bi bi-book-half"></i> Add Course
        </a>
        <a href="viewCourses.php" class="<?php echo ($current_page == 'viewCourses.php') ? 'active' : ''; ?>">
            <i class="bi bi-journal-bookmark-fill"></i> View Courses
        </a>
        
        <div class="d-lg-none border-top border-secondary mt-4 pt-2">
            <a href="logout.php" class="text-danger fw-bold">
                <i class="bi bi-box-arrow-right text-danger"></i> Secure Logout
            </a>
        </div>
    </div>
</div>