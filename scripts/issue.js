window.onload = function(){
	const all = document.querySelector("#all");
	const open = document.querySelector("#open");
	const tickets = document.querySelector("#tickets");
	all.onclick = function(){
		all.style.backgroundColor = "#1b6ac9";
		open.style.backgroundColor = "white";
		tickets.style.backgroundColor = "white";
		all.style.color = "white";
		open.style.color = "#252525";
		tickets.style.color = "#252525";
	}
	open.onclick = function(){
		all.style.backgroundColor = "white";
		open.style.backgroundColor = "#1b6ac9";
		tickets.style.backgroundColor = "white";
		open.style.color = "white";
		all.style.color = "#252525";
		tickets.style.color = "#252525";
	}
	tickets.onclick = function(){
		all.style.backgroundColor = "white";
		open.style.backgroundColor = "white";
		tickets.style.backgroundColor = "#1b6ac9";
		tickets.style.color = "white";
		all.style.color = "#252525";
		open.style.color = "#252525";
	}
}