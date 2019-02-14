// Task Constructor
function Task(title, content) {

    this.title = title;
    this.content = content;

}

// UI Constructor
function UI() {}

UI.prototype.addTaskToList = function(task) {
    const list = document.getElementById('task-list');
    // Create tr element
    const row = document.createElement('tr');
    // Insert cols
    row.innerHTML = `
          <td>${task.title}</td>
          <td>${task.content}</td>
          <td><a href="#" class="delete">X</a></td>
        `;
    list.appendChild(row);

}

// Show Alert
UI.prototype.showAlert = function(message, className) {
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

// Delete Task
UI.prototype.deleteBook = function(target) {
    if (target.className === 'delete') {
        target.parentElement.parentElement.remove();
    }
}

// Clear Fields
UI.prototype.clearFields = function() {

    document.getElementById('title').value = '';
    document.getElementById('taches').value = '';

}

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

        //Clear fields
        ui.clearFields();

        ui.showAlert('Tâches ajouté !', 'task-success');


    }





    e.preventDefault();
});

// Event Listeners to Delete task

document.getElementById('task-list').addEventListener('click', function(e) {
    //Instantiate UI
    const ui = new UI();

    // Delete Task
    ui.deleteBook(e.target);

    // Show message
    ui.showAlert('Tâches supprimer !', 'task-success')

    e.preventDefault();
})