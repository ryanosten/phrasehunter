
//this file adds eventlistener for key press and submits the keyboard form with the key pressed as submitted value
document.addEventListener('keydown', submitKey);

function submitKey(e) {
    let keyStroke = '';
    keyStroke = e.key;
    document.getElementById("key").setAttribute("value", keyStroke);
    document.getElementById("keyboard").submit();
}

