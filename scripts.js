document.addEventListener('keydown', submitKey);


function submitKey(e) {
    let keyStroke = '';
    keyStroke = e.key;
    document.getElementById("key").setAttribute("value", keyStroke);
    document.getElementById("keyboard").submit();
}

