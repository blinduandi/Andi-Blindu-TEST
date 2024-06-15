var userID = sessionStorage.getItem('user_id');

new Vue({
    el: '#app',
    data: {
        tasks: [],
        newTask: {
            name: '',
            description: '',
            start_date: '',
            done_date: '',
            end_date: '',
            user_id: userID
        },
        editingTask: null,
        editedTask: {
            taskid: '',
            name: '',
            description: '',
            start_date: '',
            done_date: '',
            end_date: '',
            user_id: userID
        },
        showEditModal: false
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.post('http://localhost/todo%20api/', {
                    entity: 'taskSelect',
                    id: userID
            })
            .then(response => {
                this.tasks = response.data;
            })
            .catch(error => {
                console.error('Error fetching tasks:', error);
            });
        },
        createTask() {
            axios.post('http://localhost/todo%20api/', {
                entity: 'task',
                name: this.newTask.name,
                description: this.newTask.description,
                start_date: this.newTask.start_date,
                done_date: this.newTask.done_date,
                end_date: this.newTask.end_date,
                user_id: userID
            })
            .then(response => {
                console.log('Task created successfully:', response.data);
                this.fetchTasks();
                this.newTask = {};
            })
            .catch(error => {
                console.error('Error creating task:', error);
            });
        },
        executeTask(taskId) {
            axios.post('http://localhost/todo%20api/', {
                entity: 'taskDone',
                taskid: taskId
            })
            .then(response => {
                console.log(response);
                console.log('Task status updated successfully:', response.data);
                this.fetchTasks();
                this.newTask = {};
            })
            .catch(error => {
                console.error('Error updating status task:', error);
            });
        },
        updateTask() {
            //console.log(this.editedTask);
            axios.put(`http://localhost/todo%20api/`, {
                entity: 'task',
                id: this.editedTask.taskid,
                name: this.editedTask.name,
                description: this.editedTask.description,
                start_date: this.editedTask.start_date,
                done_date: this.newTask.done_date,
                end_date: this.editedTask.end_date,
                user_id: userID
            })
            .then(response => {
                console.log('Task updated successfully:', response.data);
                this.fetchTasks();
                this.closeModal();
            })
            .catch(error => {
                console.error('Error updating task:', error);
            });
        },
        deleteTask(taskId) {
            axios.delete(`http://localhost/todo%20api/`, {
                data: {
                    entity: 'task',
                    id: taskId
                }
            })
            .then(response => {
                console.log('Task deleted successfully:', response.data);
                this.fetchTasks();
            })
            .catch(error => {
                console.error('Error deleting task:', error);
            });
        },
        editTask(task) {
            this.editingTask = task;
            this.editedTask = {
                taskid: task.id,
                name: task.name,
                description: task.description,
                start_date: task.start_date,
                done_date: task.done_date,
                end_date: task.end_date,
                user_id: userID
            };
            this.showEditModal = true;
        },
        cancelEdit() {
            this.editingTask = null;
            this.editedTask = {
                taskid: null,
                name: '',
                description: '',
                start_date: '',
                done_date: '',
                end_date: '',
                user_id: userID
            };
            this.showEditModal = false;
        },
        closeModal() {
            this.showEditModal = false;
        }
    }
});
