// Open login form on login click
let qLoginFormTrigger = document.querySelector('.js-toggle-form-trigger');

qLoginFormTrigger.addEventListener('click', function(){
	let toggleTarget = this.parentNode.querySelector('.js-toggle-form-target');
	
	toggleTarget.classList.toggle('js-form-open');
});

// Login form data to api
let qLoginForm = document.querySelector('.js-login-form');