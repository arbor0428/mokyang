function passwordCHK(uid,type,x,y){


	/*클릭 위치 확인*/
	tempX = event.clientX + document.body.scrollLeft;
    tempY = event.clientY + document.body.scrollTop;


	modX = x.substring(0,1);	//x값 설정
	posX = x.substring(1,x.length);	//x값 위치

	if(modX=='+')	 var	img_x = tempX + parseInt(posX);
	else	 var	img_x = tempX - parseInt(posX);



	modY = y.substring(0,1);	//y값 설정
	posY = y.substring(1,y.length);	//y값 위치

	if(modY=='+')	 var	img_y = tempY + parseInt(posY);
	else	 var	img_y = tempY - parseInt(posY);


	var	Mtable = document.getElementById("pop_form");

	/*토글설정*/
	if(Mtable){
		if(Mtable.style.display == ''){
			Mtable.style.display = 'none';
		}
			Mtable.style.display = '';
			Mtable.style.left = img_x;
			Mtable.style.top = img_y;		

	}

	form = document.frm01;
	form.uid.value = uid;
	form.type.value = type;
	form.chk_pwd.value = '';
	form.chk_pwd.focus();

}