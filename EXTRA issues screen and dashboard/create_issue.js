String.prototype.capitalize = function() {
    return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
};

window.onload = function(){
	const submit = document.querySelector("#submit");
	const title = document.querySelector("#title");
	const description = document.querySelector("#desc");
	const assigned_to = document.querySelector("#assign");
	const type = document.querySelector("#types");
	const priority = document.querySelector("#prior");
	const error = document.querySelector("#error");
	//The url constant should be the value of the link to your php file
	const url = "http://localhost:8080/issue/issue.php"
	const titleParam = "?title=";
	const descParam = "&description=";
	const assignParam = "&assigned_to=";
	const typeParam = "&type=";
	const priorityParam = "&priority=";
	const statusParam = "&status=";
	submit.onclick = function(){
		let errors = 0;
		const title_input = DOMPurify.sanitize(title.value, {SAFE_FOR_TEMPLATES: true});
		const desc_input = DOMPurify.sanitize(description.value, {SAFE_FOR_TEMPLATES: true});
		const assigned_input = DOMPurify.sanitize(assigned_to.value, {SAFE_FOR_TEMPLATES: true});
		const type_input = DOMPurify.sanitize(type.value, {SAFE_FOR_TEMPLATES: true});
		const priority_input = DOMPurify.sanitize(priority.value, {SAFE_FOR_TEMPLATES: true});
		switch(""){
			case title_input:
				title.style.borderColor = "crimson";
				error.style.visibility = "visible";
				errors = 1;
			case assigned_input:
				assigned_to.style.borderColor = "crimson";
				error.style.visibility = "visible";
				errors = 1;
			case type_input:
				type.style.borderColor = "crimson";
				error.style.visibility = "visible";
				errors = 1;
			case priority_input:
				priority.style.borderColor = "crimson";
				error.style.visibility = "visible";
				errors = 1;
		}
		if(error == 0){
			const endpoint = url+titleParam+title_input.capitalize()+descParam+desc_input+assignParam+assigned_input.capitalize()+typeParam+type_input.capitalize()+statusParam+"Open";
			fetch(endpoint).then(res => res.text()).then();
		}
	};
	title.onkeypress = function(){
		title.style.borderColor = "lightgrey";
		if(assigned_to.style.borderColor == "lightgrey" && type.style.borderColor == "lightgrey" && priority.style.borderColor == "lightgrey")
			error.style.visibility = "hidden";

	};
	assigned_to.onmousedown = function(){
		assigned_to.style.borderColor = "lightgrey";
		if(title.style.borderColor == "lightgrey" && type.style.borderColor == "lightgrey" && priority.style.borderColor == "lightgrey")
			error.style.visibility = "hidden";
	};
	type.onmousedown = function(){
		type.style.borderColor = "lightgrey";
		if(assigned_to.style.borderColor == "lightgrey" && title.style.borderColor == "lightgrey" && priority.style.borderColor == "lightgrey")
			error.style.visibility = "hidden";
	};
	priority.onmousedown = function(){
		priority.style.borderColor = "lightgrey";
		if(assigned_to.style.borderColor == "lightgrey" && type.style.borderColor == "lightgrey" && title.style.borderColor == "lightgrey")
			error.style.visibility = "hidden";
	};
};