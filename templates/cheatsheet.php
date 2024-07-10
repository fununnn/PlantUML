<div class="cheatsheet-container">
    <h2>PlantUML Cheatsheet</h2>
    <div id="cheatsheet-content"></div>
    <h3>Practice Task</h3>
    <div id="task-description"></div>
    <div id="task-solution"></div>
    <button id="new-task-btn">New Task</button>
</div>

<script>
document.getElementById('new-task-btn').addEventListener('click', function() {
    fetch('generate_task.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('task-description').innerHTML = data.description;
        document.getElementById('task-solution').innerHTML = `<img src="${data.solution}" alt="Task Solution">`;
    });
});

// チートシートの内容を動的に生成
fetch('get_cheatsheet.php')
.then(response => response.text())
.then(html => {
    document.getElementById('cheatsheet-content').innerHTML = html;
});
</script>