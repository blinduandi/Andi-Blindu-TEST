<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/dashboard.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/daypilot-lite/2023.2.5528/daypilot-lite.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/daypilot-lite/2023.2.5528/daypilot-lite.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <title>Dashboard</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var isLoggedIn = sessionStorage.getItem('logged_in');
            var userEmail = sessionStorage.getItem('username');

            if (!isLoggedIn) {
                window.location.href = 'login.php'; 
            }
            else{
                document.getElementById('username').textContent = userEmail;
            }

            document.getElementById('logoutButton').addEventListener('click', function() {
                sessionStorage.removeItem('logged_in');
                sessionStorage.removeItem('user_email');
                sessionStorage.removeItem('user_id');
                window.location.href = 'login.php'; 
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ToDoList</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  d-flex justify-content-end" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" tabindex="-1" aria-disabled="true"><button id="logoutButton" class="btn btn-danger">Logout</button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2 dashMenu ">
                <i class="fa-solid fa-user iconMenu"></i>
                <div id="username" class="userName"></div>

                 <div class="buttons-container">
                    <button class="btnn"><i class="fas fa-calendar-day"></i> Today</button><br>
                    <button class="btnn"><i class="far fa-calendar-alt"></i> All</button><br>
                    <button class="btnn"><i class="fas fa-tasks"></i> Done</button><br>
                    <button class="btnn"><i class="far fa-calendar"></i> Overdue</button>
                </div>

            </div> -->

            <div class="col-12">    
            <div id="app">
  <h1>Task Manager</h1>
  <form @submit.prevent="createTask">
    <input v-model="newTask.name" placeholder="Task Name" required />
    <textarea v-model="newTask.description" placeholder="Task Description" required></textarea>
    <input type="date" v-model="newTask.start_date" placeholder="Start Date" required />
    <input type="date" v-model="newTask.end_date" placeholder="End Date" required />
    <button type="submit">Add Task</button>
  </form>

  <h2>Tasks</h2>
  <ul>
    <li v-for="task in tasks" :key="task.taskid" 
        :class="{
          'task-done-before': task.done_date && new Date(task.done_date) <= new Date(task.end_date),
          'task-done-after': task.done_date && new Date(task.done_date) > new Date(task.end_date),
          'task-overdue': !task.done_date && new Date(task.end_date) < new Date()
        }">
      {{ task.name }}: {{ task.description }}
      <span v-if="task.done_date">✓</span>
        <div class="d-flex justify-content-end">
            <button @click="deleteTask(task.id)">Delete</button>
            <button @click="executeTask(task.id)">Execute</button>
            <button @click="editTask(task)">Edit</button> 
        </div> 
    </li>
  </ul>

  <div v-if="showEditModal" class="modal">
    <div class="modal-content">
      <span class="close" @click="closeModal">&times;</span>
      <h2>Edit Task</h2>
      <form @submit.prevent="updateTask">
        <input v-model="editedTask.name" placeholder="Task Name" required />
        <textarea v-model="editedTask.description" placeholder="Task Description" required></textarea>
        <input type="date" v-model="editedTask.start_date" placeholder="Start Date" required />
        <input type="date" v-model="editedTask.end_date" placeholder="End Date" required />
        <button type="submit">Save Changes</button>
      </form>
    </div>
  </div>
</div>

            </div>
        </div>

</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="js/vueWeek.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
