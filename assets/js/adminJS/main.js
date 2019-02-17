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

    location.reload();

    e.preventDefault();
});