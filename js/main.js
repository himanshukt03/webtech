window.addEventListener('load', () => {
    const form = document.querySelector("#new-task-form");
    const input = document.querySelector("#new-task-input");
    const list_el = document.querySelector("#tasks");

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const task = input.value;

        if (!task) {
            alert("Please fill out the task");
            return;
        }

        fetch('add_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `description=${encodeURIComponent(task)}`
        })
        .then(response => response.text())
        .then(data => {
            list_el.innerHTML = data;
            input.value = '';
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    list_el.addEventListener('click', (e) => {
        if (e.target.matches('.edit')) {
            handleEdit(e.target);
        } else if (e.target.matches('.delete')) {
            handleDelete(e.target);
        } else if (e.target.matches('.complete')) {
            handleComplete(e.target);
        }
    });
});

function handleEdit(button) {
    const task = button.closest('.task');
    const taskId = task.dataset.taskId;
    const textInput = task.querySelector('.text');

    if (button.innerText.toLowerCase() === 'edit') {
        button.innerText = 'Save';
        textInput.removeAttribute('readonly');
        textInput.focus();
    } else {
        button.innerText = 'Edit';
        textInput.setAttribute('readonly', 'readonly');
        updateTask(taskId, textInput.value);
    }
}

function handleDelete(button) {
    const task = button.closest('.task');
    const taskId = task.dataset.taskId;
    deleteTask(taskId);
}

function handleComplete(button) {
    const task = button.closest('.task');
    const taskId = task.dataset.taskId;
    completeTask(taskId);
}

function updateTask(id, description) {
    fetch('update_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&description=${encodeURIComponent(description)}`
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector("#tasks").innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function deleteTask(id) {
    fetch('delete_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector("#tasks").innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function completeTask(id) {
    fetch('complete_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector("#tasks").innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}