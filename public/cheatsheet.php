<?php
$cheatsheets = [
    'usecase' => '@startuml
actor User
usecase "Use the System" as UC1
User -> UC1
@enduml',
    'class' => '@startuml
class User {
  +name: string
  +email: string
  +register()
  +login()
}
@enduml',
    'activity' => '@startuml
start
:User logs in;
if (Credentials valid?) then (yes)
  :Grant access;
else (no)
  :Show error message;
endif
stop
@enduml',
    'state' => '@startuml
[*] --> Idle
Idle --> Processing : Start
Processing --> Completed : Finish
Completed --> [*]
@enduml',
    'mindmap' => '@startmindmap
* Project
** Planning
*** Requirements
*** Schedule
** Development
*** Coding
*** Testing
** Deployment
@endmindmap',
    'gantt' => '@startgantt
[Task 1] lasts 3 days
[Task 2] lasts 4 days
[Task 2] starts at [Task 1]\'s end
@endgantt'
];

$randomType = array_rand($cheatsheets);
$example = $cheatsheets[$randomType];

echo "<h2>Cheatsheet: {$randomType} Diagram</h2>";
echo "<pre><code>{$example}</code></pre>";
echo "<div id='cheatsheet-uml'></div>";
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    const umlCode = `{$example}`;
    fetch('uml_generator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'uml=' + encodeURIComponent(umlCode)
    })
    .then(response => response.text())
    .then(svg => {
        document.getElementById('cheatsheet-uml').innerHTML = svg;
    });
});
</script>";