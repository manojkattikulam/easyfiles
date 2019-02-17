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