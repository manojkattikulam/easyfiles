class Task {
    constructor(title, content) {
        this.title = title;
        this.content = content;
    }

}

class UI {

    addTaskToList(task) {

        const list = document.getElementById('task-list');
        // Create tr element
        const row = document.createElement('tr');
        // Insert cols
        row.innerHTML = `
            <td>${task.title}</td>
            <td>${task.content}</td>
            <td><a href="#" class="text-danger">X</a></td>
            `;
        list.appendChild(row);

    }

    showAlert(message, className) {

        // Create div
        const div = document.createElement('div');
        // Add classes
        div.className = `alert ${className}`;
        // Add text
        div.appendChild(document.createTextNode(message));
        // Get parent
        const container = document.querySelector('.container');
        // Get form
        const form = document.querySelector('#task-form');
        // Insert alert
        container.insertBefore(div, form);

        //Timeout after 3 sec
        setTimeout(function() {
            document.querySelector('.alert').remove();
        }, 2000);

    }

    deleteTask(target) {

        if (target.className === 'delete') {
            target.parentElement.parentElement.remove();
        }
    }

    clearFields() {

        document.getElementById('title').value = '';
        document.getElementById('taches').value = '';
    }

}

// Local Storage Class
class Store {

    static getTasks() {
        let tasks;
        if (localStorage.getItem('tasks') === null) {
            tasks = [];
        } else {
            tasks = JSON.parse(localStorage.getItem('tasks'));
        }

        return tasks;

    }

    static displayTasks() {

        const tasks = Store.getTasks();

        tasks.forEach(function(task) {
            const ui = new UI;

            // Add book to UI
            ui.addTaskToList(task);
        });

    }

    static AddTasks(task) {
        const tasks = Store.getTasks();

        tasks.push(task);

        localStorage.setItem('tasks', JSON.stringify(tasks));

    }

    static removeTasks(content) {

        const tasks = Store.getTasks();

        tasks.forEach(function(task, index) {
            if (task.content === content) {
                tasks.splice(index, 1);
            }
        });

        localStorage.setItem('tasks', JSON.stringify(tasks));
        location.reload();
    }



}


// DOM Load Event
document.addEventListener('DOMContentLoaded', Store.displayTasks);

// Event Listeners to Add task
document.getElementById('task-form').addEventListener('submit', function(e) {

    //Get form values
    const title = document.getElementById('title').value,
        content = document.getElementById('taches').value

    //Instantiate task
    const task = new Task(title, content);

    //Instantiate UI
    const ui = new UI();

    //Validate
    if (title === '' || taches === '') {

        ui.showAlert('Tous les champs sont Obligatoires', 'task-error');

    } else {

        //Add task to list
        ui.addTaskToList(task);

        //Add to LS
        Store.AddTasks(task);

        //Show success
        ui.showAlert('Tâches ajouté !', 'task-success');

        //Clear fields
        ui.clearFields();
    }

    e.preventDefault();
});

// Event Listeners to Delete task

document.getElementById('task-list').addEventListener('click', function(e) {
    //Instantiate UI
    const ui = new UI();

    // Delete Task
    ui.deleteTask(e.target);

    // Remove from LS
    Store.removeTasks(e.target.parentElement.previousElementSibling.textContent);

    // Show message
    ui.showAlert('Tâches supprimer !', 'task-success')

    e.preventDefault();
});