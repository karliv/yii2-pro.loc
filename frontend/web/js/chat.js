var webSocketPort = wsPort ? wsPort : 8083;
var conn = new WebSocket('ws://localhost:' + webSocketPort);
var itemList = document.getElementById('chatMessages');

conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onerror = function (e) {
    console.log("Connection fail!");
};

conn.onmessage = function(e) {
    var item = document.createElement('p');

    item.innerHTML = e.data;
    itemList.appendChild(item);

    console.log(e.data);
};