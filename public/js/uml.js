function generateUML() {
    const umlCode = editor.getValue();
    fetch('uml_generator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'uml=' + encodeURIComponent(umlCode)
    })
    .then(response => response.text())
    .then(svg => {
        document.getElementById('preview-content').innerHTML = svg;
    });
}

function downloadUML(format) {
    const umlCode = editor.getValue();
    fetch('uml_generator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `uml=${encodeURIComponent(umlCode)}&format=${format}`
    })
    .then(response => response.blob())
    .then(blob => {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `diagram.${format}`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
}

function downloadTXT() {
    const umlCode = editor.getValue();
    const blob = new Blob([umlCode], {type: 'text/plain'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'diagram.txt';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function showCheatsheet() {
    fetch('cheatsheet.php')
    .then(response => response.text())
    .then(html => {
        document.getElementById('preview-content').innerHTML = html;
    });
}