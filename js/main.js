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

	function loadAndCropImage() {
		var file = document.getElementById('file').files[0];
		if (file) {
			var new_img = document.createElement('img');
			new_img.src = URL.createObjectURL(file);
			new_img.onload = function () {
				var size = {
					x: parseFloat(new_img.width),
					y: parseFloat(new_img.height)
				};
				var proportion = 1.0;
				if (size.x > 320.0 || size.y > 240.0) {
					if (size.x / 320.0 > size.y / 240.0) {
						proportion = 320.0 / size.x;
					}
					else {
						proportion = 240.0 / size.y;
					}
				}
				var w = size.x * proportion;
				var h = size.y * proportion;
				this.width = w;
				this.height = h;
				document.querySelector('.img-perview').appendChild(this);
			};
		}
	}

	function addPerviewListeners() {
		document.getElementById('send1').addEventListener('click', sendNewTask);
		document.getElementById('back-perview').addEventListener('click', function () {
			document.getElementById('response').style.display = "none";
			var send_form = document.getElementById('send-form');
			send_form.style.display = "block";
			var card = document.getElementById('card-perview');
			document.querySelector('.popup').removeChild(card);
			document.querySelector('.popup').removeChild(document.getElementById('controls'));
		});
	}

	function showPerview() {
		var send_form = document.getElementById('send-form');
		send_form.style.display = "none";
		var email = document.getElementById('e-mail').value;
		var username = document.getElementById('username').value;
		var text = document.getElementById('text').value;
		var card = document.createElement('div');
		loadAndCropImage();
		card.classList.add('card');
		card.classList.add('form-group');
		card.id = 'card-perview';
		var card_inner_html = `
				<div class="card-header">
					`+username+` &lt;`+email+`&gt;
				</div>
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="col-lg-6 img-perview">
						</div>
						<div class="col-lg-6">
							<p class="text-wrap">`+text+`</p>
						</div>
					</div>
				</div>`;
		var controls = `
				<div class="form-group" id="controls">
					<button type="submit" class="btn btn-primary" id="send1">Submit</button>
					<button type="button" class="btn btn-danger" id="back-perview">Edit</button>
				</div>`;
		insertHTMLToElement(card, card_inner_html);
		document.querySelector('.popup').appendChild(card);
		insertHTMLToElement(document.querySelector('.popup'), controls);
		addPerviewListeners();
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
		document.getElementById('perview').addEventListener('click', showPerview);
	}

	function addLoginListeners() {
		var cover = document.getElementsByClassName('add-cover')[0];
		cover.addEventListener('click', function (e) {
			if (e.target !== this)
				return;
			document.getElementById('content').removeChild(cover);
		});
		document.getElementById('send').addEventListener('click', function () {
			var form = new FormData();
			var username = document.getElementById('username').value;
			var password = document.getElementById('password').value;
			form.append('username', username);
			form.append('password', password);
			var request = new XMLHttpRequest();
			request.open('post', '/login/login/');
			request.onload = function () {
				var alert = document.getElementById('response');
				if (this.responseText == 'SUCCESS') {
					alert.innerText = "Login successful";
					alert.style.display = 'block';
					alert.classList.remove('alert-danger');
					alert.classList.add('alert-success');
					document.location.reload(true);
				} else {
					alert.innerText = this.responseText;
					alert.style.display = 'block';
					alert.classList.add('alert-danger');
					alert.classList.remove('alert-success');
				}
			}
			request.send(form);
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
		var switchFunction = function () {};
		if (this.id == 'new-task') {
			request.open('post', '/add/', true);
			switchFunction = addListenersToForm;
		} else {
			request.open('post', '/login/', true);
			switchFunction = addLoginListeners;
		}
		request.onload = function () {
			insertHTMLToElement(popup, this.responseText);
			container.appendChild(cover);
			switchFunction();
		}
		request.send();
	}

	function toggleComplete() {
		var request = new XMLHttpRequest();
		var form = new FormData();
		form.append('tid', parseInt(this.value));
		request.open('post', '/main/toggle/', true);
		request.onload = function() {
			document.location.reload(true);
		};
		request.send(form);
	}

	document.getElementById('new-task').addEventListener('click', showNewTaskPopup);
	if (document.getElementById('admin-login')) {
		document.getElementById('admin-login').addEventListener('click', showNewTaskPopup);
	}
	if (document.getElementById('admin-logout')) {
		document.getElementById('admin-logout').addEventListener('click', function () {
				var request = new XMLHttpRequest();
				request.open('get', '/login/logout/', true);
				request.onload = function () {
					document.location.reload(true);
				}
				request.send();
		});
	}

	function editPostText() {
		var tid = this.value;
		var editable = this.parentNode.parentNode.querySelector('p.text-wrap');
		editable.contentEditable = 'true';
		this.innerText = 'Save';
		this.addEventListener('click', function() {
			var editable = this.parentNode.parentNode.querySelector('p.text-wrap');
			var text = editable.innerText;
			var request = new XMLHttpRequest();
			var form = new FormData();
			form.append('tid', this.value);
			form.append('text', text);
			request.open('post', '/main/edit', true);
			request.onload = function () {
				document.location.reload(true);
			}
			request.send(form);
			this.addEventListener('click', editPostText);
		});
	}

	function setListenersForClass(class_name, callback) {
		if (document.getElementsByClassName(class_name)) {
			var complete_btns = document.getElementsByClassName(class_name);
			for (var i = 0; i < complete_btns.length; i++) {
				complete_btns[i].addEventListener('click', callback);
			}
		}
	}

	setListenersForClass('complete-btn', toggleComplete);
	setListenersForClass('not-complete-btn', toggleComplete);
	setListenersForClass('edit-btn', editPostText);
});
