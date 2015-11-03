var phpurl = 'handler.php';
var firefox = document.getElementById && !document.all;
function createRequestObject() {
    if(window.XMLHttpRequest) return new XMLHttpRequest();
    if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
}
var http = createRequestObject();
function handleResponse() {
	// do nothing for now
}

function removeElementById(id) {
	element = document.getElementById(id);
	if (element.parentNode && element.parentNode.removeChild) {
		element.parentNode.removeChild(element); 
	}
}

function getRandomNumber(range) { return Math.floor(Math.random() * range);}
function getRandomChar() { 
	var chars = "0123456789abcdefghijklmnopqurstuvwxyzABCDEFGHIJKLMNOPQURSTUVWXYZ";
	return chars.substr( getRandomNumber(62),1);
}
function randomId() {
//	str = "";
//	for(i=0;i<10;i++) str += getRandomChar();
//	return str;
	now = new Date();
	return now.getTime();
}

function removeTodoItem(id){
	removeElementById(id);
	http.open('get', phpurl+'?removeTodoItem=do&id='+id);
	http.onreadystatechange = handleResponse;
	http.send(null);
}

function doneTodoItem(id){
	element = document.getElementById('text_'+id);
	element.className = "done";
	http.open('get', phpurl+'?doneTodoItem=do&id='+id);
	http.onreadystatechange = handleResponse;
	http.send(null);
}

function addTodoItem(id, text, s, listID) {
	if (id == 0){
		id = randomId();
		text = document.getElementById(listID+"_newtodotext").value;
		s = "undone";
		if (text.length>0){
			http.open('get', phpurl+'?addTodoItem=do&id='+id+'&text='+text+'&listID='+listID);
			http.onreadystatechange = handleResponse;
			http.send(null);
		}
		
	}
	if (text.length==0) return;
	document.getElementById(listID+"_newtodotext").value = '';
	items = document.getElementById(listID+"_todoitems");
	
	itemhtml = '<table width="100%" border="0" cellspacing="0" cellpadding="3" id="'+id+'"><tr>' +
			   '<td style="vertical-align:top; width:10px;"><img src="bullet.png"></td>' +
			   '<td class="'+s+'" id="text_'+id+'">'+text+'</td>'+
			   '<td width style="vertical-align:top; text-align:right; width:38px;">'+
			   '<img style="cursor:pointer;" onclick="javascript:doneTodoItem(\''+id+'\');" src="done.png">' +
			   '<img style="cursor:pointer;" onclick="javascript:removeTodoItem(\''+id+'\');" src="delete.png"></td>'+
			   '</tr></table>';
	items.innerHTML+=itemhtml;
}
