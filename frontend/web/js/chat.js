var webSocketPort = wsPort ? wsPort : 8083;
var conn = new WebSocket('ws://localhost:' + webSocketPort);
var idMessages = 'chatMessages';

conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onerror = function (e) {
    console.log("Connection fail!");
};

conn.onmessage = function(e) {
    document.getElementById(idMessages).value = e.data + '\n' + document.getElementById(idMessages).value;
    console.log(e.data);
};