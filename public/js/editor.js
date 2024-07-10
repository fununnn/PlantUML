require.config({ paths: { 'vs': '../node_modules/monaco-editor/min/vs' }});
require(['vs/editor/editor.main'], function() {
    var editor = monaco.editor.create(document.getElementById('editor'), {
        value: '@startuml\n\n@enduml',
        language: 'plantuml',
        theme: 'vs-dark'
    });

    function generateUML() {
        var uml = editor.getValue();
        fetch('generate_uml.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'uml=' + encodeURIComponent(uml)
        })
        .then(response => response.blob())
        .then(blob => {
            var url = URL.createObjectURL(blob);
            document.getElementById('preview-content').innerHTML = `<img src="${url}" alt="UML Diagram">`;
        });
    }

    document.getElementById('generate-btn').addEventListener('click', generateUML);

    ['png', 'svg', 'txt'].forEach(format => {
        document.getElementById(`download-${format}-btn`).addEventListener('click', function() {
            var uml = editor.getValue();
            fetch('download.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `uml=${encodeURIComponent(uml)}&format=${format}`
            })
            .then(response => response.blob())
            .then(blob => {
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = `diagram.${format}`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            });
        });
    });

    editor.onDidChangeModelContent(generateUML);
});

monaco.languages.register({ id: 'plantuml' });
monaco.languages.setMonarchTokensProvider('plantuml', {
  tokenizer: {
    root: [
      [/@\w+/, "keyword"],
      [/".*?"/, "string"],
      [/'.*?'/, "string"],
      [/[{}()\[\]]/, "@brackets"],
      [/[<>](?!@)/, "@brackets"],
      [/[a-z_$][\w$]*/, "identifier"],
      [/[0-9]+/, "number"],
      [/\/\/.*/, "comment"],
      [/\/\*/, "comment", "@comment"],
    ],
    comment: [
      [/[^\/*]+/, "comment"],
      [/\/\*/, "comment", "@push"],
      ["\\*/", "comment", "@pop"],
      [/[\/*]/, "comment"]
    ],
  }
});