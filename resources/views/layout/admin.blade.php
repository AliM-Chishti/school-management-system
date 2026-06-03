<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Management System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Students</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Teachers</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Courses</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('fees.index') }}">Fees</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('timetable.index') }}">Timetable</a></li>
    </ul>
  </div>
</nav>
<div class="container mt-4">
  @yield('content')
</div>
</body>
</html>
