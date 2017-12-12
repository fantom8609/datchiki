window.onload = function () {
	var label = document.getElementById('status');
	var message = document.getElementById('message');
	var btnSend = document.getElementById('send');
	var btnStop = document.getElementById('stop');


/* Статусы соединения(ReadyState): открывается,открыто, закрывается,закрыто
WebSocket.CONNECTING
WebSocket.OPEN
WebSocket.CLOSING
WebSocket.CLOSED
*/

    btnSend.onclick = function () {
		//console.log("Нажали кнопку");
		//если соединение установлено
		if(socket.readyState === WebSocket.OPEN)
			socket.send(message.value);
	};

	btnStop.onclick = function () {
		//console.log("Нажали кнопку");
		//если соединение установлено
		if(socket.readyState === WebSocket.OPEN)
			socket.close();
	};

	//var socket = new WebSocket("ws://echo.websocket.org");
	var socket = new WebSocket("ws://localhost:8080");

//количество байт в очереди (исп-ся при отправке больших данных)
   // socket.bufferdAmount;

	socket.onopen = function(event) {
		console.log("Соединились");
		label.innerHTML = "Соединились по адресу: " + socket.url;
	};

	socket.onclose = function(event) {
		console.log("Соединение закрыто");
		label.innerHTML = "Соединение закрыто";
		var code = event.code;
		var reason = event.reason;
		var wasClean = event.wasClean;
		if(wasClean) 
			label.innerHTML = "Соединение закрыто корректно";
		else 
			label.innerHTML = "Соединение закрыто с ошибкой" + reason;
	};

	socket.onerror = function(event) {
		console.log("error");
	};
	socket.onmessage = function(event) {
		if(typeof event.data === "string")
			label.innerHTML = event.data;
	};
};

/*
1. Поддержка браузерами
2. Создание объекта
3. Соединение с сервером
4. Назначение обработчиков событий
5. Обмен информацией с сервером
6. Закрытие соединения
*/
