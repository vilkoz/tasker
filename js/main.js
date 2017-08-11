window.addEventListener("DOMContentLoaded", function() {
	function insertHTMLToElement(element, htmlResponse) {
		var temp = document.createElement('div');
		temp.innerHTML = htmlResponse;
		while (temp.firstChild) {
			element.appendChild(temp.firstChild);
		}
	}

	function sendNewTask() {
		var form = new FormData();
		var email = document.getElementById('e-mail').value;
		var username = document.getElementById('username').value;
		var text = document.getElementById('text').value;
		var file = document.getElementById('file').files[0];
		form.append('e-mail', email);
		form.append('username', username);
		form.append('text', text);
		form.append('file', file);
		var request = new XMLHttpRequest();
		request.open('post', '/add/new/', true);
		request.onload = function () {
			var response = document.getElementById('response')
			if (this.responseText != 'SUCCESS') {
				response.innerText = this.responseText;
				response.style.display = "block";
				response.classList.add('alert-danger');
			} else {
				response.innerText = "New task created!";
				response.style.display = "block";
				response.classList.remove('alert-danger');
				response.classList.add('alert-success');
				document.location.reload(true);
			}
		}
		request.send(form);
		return false;
	}
	function addListenersToForm() {
		var cover = document.getElementsByClassName('add-cover')[0];
		cover.addEventListener('click', function (e) {
			if (e.target !== this)
				return;
			document.getElementById('content').removeChild(cover);
		});
		document.getElementById('send').addEventListener('click', sendNewTask);
		document.getElementById('file').addEventListener('change', function() {
			var path = this.value.split("\\");
			if (path.length == 3) {
				path = path[2];
			}
			else {
				path = this.value;
			}
			document.querySelector('.custom-file-control').innerHTML = path;
		});
	}
	function showNewTaskPopup() {
		var container = document.getElementById('content');
		var cover = document.createElement('div');
		var popup = document.createElement('div');
		cover.classList.add('add-cover');
		popup.classList.add('popup');
		cover.appendChild(popup);
		var request = new XMLHttpRequest();
		request.open('post', '/add/', true);
		request.onload = function () {
			insertHTMLToElement(popup, this.responseText);
			container.appendChild(cover);
			addListenersToForm();
		}
		request.send();
	}

	document.getElementById('new-task').addEventListener('click', showNewTaskPopup);
});
