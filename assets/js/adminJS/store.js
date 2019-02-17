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