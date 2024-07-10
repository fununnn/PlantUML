require.config({ paths: { 'vs': '../node_modules/monaco-editor/min/vs' }});
require(['vs/editor/editor.main'], function() {
    window.editor = monaco.editor.create(document.getElementById('editor'), {
        value: `@startuml\nAlice -> Bob: Hello\n@enduml`,
        language: 'plaintext',
        theme: 'vs-dark'
    });

    editor.onDidChangeModelContent(function (e) {
        generateUML();
    });

    document.getElementById('uml-btn').addEventListener('click', generateUML);
    document.getElementById('download-png-btn').addEventListener('click', () => downloadUML('png'));
    document.getElementById('download-svg-btn').addEventListener('click', () => downloadUML('svg'));
    document.getElementById('download-txt-btn').addEventListener('click', downloadTXT);
    document.getElementById('cheatsheet-btn').addEventListener('click', showCheatsheet);
});