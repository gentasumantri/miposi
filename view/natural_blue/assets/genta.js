let btm = document.getElementById("mb_btn");
let btv = document.getElementById("vc_btn");
let xyz = document.login;
let col1 = document.getElementById("col-1");
let col2 = document.getElementById("col-2");
let col3 = document.getElementById("col-3");
function col_1(){
	col1.classList.add("in");
	col2.classList.remove("in");
	col3.classList.remove("in");
}
function col_2(){
	col2.classList.add("in");
	col1.classList.remove("in");
	col3.classList.remove("in");
}
function col_3(){
	col3.classList.add("in");
	col1.classList.remove("in");
	col2.classList.remove("in");
}

function l_mb(){
	btm.classList.add("active");
	btv.classList.remove("active");
	let x = document.getElementById("pw");
	if (x.style.display == "none"){
		x.style.display = "block";
		xyz.tipe.value = "mb";
		xyz.username.focus();
	}
}
function l_vc(){
	btv.classList.add("active");
	btm.classList.remove("active");
	let x = document.getElementById("pw");									
	if (x.style.display != "none"){
		x.style.display = "none";
		xyz.tipe.value = "vc";
		xyz.username.focus();
	}
}
function show_pw(){
	let y = document.getElementById("s_pw");
	if (y.checked == true){
		xyz.password.type = "text";
	}
	else{
		xyz.password.type = "password";
	}
}
function loadfil(dat,fnc){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', dat);
	xhr.onload = function(){
		if (xhr.status != 200){
			alert('unable to load data! - ' + xhr.status + ' ' + xhr.statusText);
		}
		else{
			if (fnc == "tbvc"){
				tabcr(xhr.responseText,fnc);
			}
			else if(fnc =="tbmtr"){
				tabcr(xhr.responseText,fnc);
			}
			else{
				alert("check your config");
			}
		}
	};
	xhr.onerror = function(){
		alert("unable to load data");
	};
	xhr.send();
};
function tabcr(data,fnc){
	if (fnc == "tbvc"){
		var cls = "";
		var trcls = "danger";
		var element = "tablegsvc";
	}else{
		var cls = "mitra-table";
		var trcls = "success";
		var element = "tablegsmitra";
	}
	var table = '<table class="table table-bordered table-hover '+cls+'">';
	var allRows = data.split(/\r?\n|\r/);
	for (var singleRow = 0; singleRow < allRows.length; singleRow++){
		if (singleRow === 0){
			table += '<thead>';
			table += '<tr class="'+trcls+'">';
		}
		else{
		  table += '<tr>';
		}
		var rowCells = allRows[singleRow].split(',');
		for (var rowCell = 0; rowCell < rowCells.length; rowCell++){
			if (singleRow === 0){
				table += '<th>';
				table += rowCells[rowCell];
				table += '</th>';
			}
			else{
				table += '<td>';
				table += rowCells[rowCell];
				table += '</td>';
			}
		}
		if (singleRow === 0){
			table += '</tr>';
			table += '</thead>';
			table += '<tbody>';
		}
		else{
			table += '</tr>';
		}
	}
	table += '</tbody>';
	table += '</table>';
	document.getElementById(element).insertAdjacentHTML('beforeend', table);
}