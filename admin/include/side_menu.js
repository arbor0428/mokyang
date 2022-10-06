
	var newPos = new Array();
	var newTop = new Array();
 
	function swapDiv(divID) {
		this.divID = divID;
		this.cookieName = divID + '_order';
		this.divOrder = getCookie(this.cookieName);
		this.divOrderArray = new Array();
		this.step = 10;
		this.interval = 10;
		this.mode = 1;
		this.noButton = false;
		this.direction = 1;
	}
 
	swapDiv.prototype.init = function () {
		var self = this;
		var motherDiv = document.getElementById(self.divID);
		var cont = motherDiv.childNodes;
 
		for (var i=0; i<cont.length; i++) {
			if(cont[i].className == 'swapDiv') {
				if(self.noButton == false) {
					var imgs = cont[i].getElementsByTagName('img');
					for (var ii=0; ii<imgs.length; ii++)
					{
						if (imgs[ii].className == 'swapButtonU')
						{
							imgs[ii].onclick = function () {
								moveUp(this, self.cookieName, self.step, self.interval, self.mode);
							}
							imgs[ii].title = "위로 한칸 이동";
						}
						if (imgs[ii].className == 'swapButtonD')
						{
							imgs[ii].onclick = function () {
								moveDown(this, self.cookieName, self.step, self.interval, self.mode);
							}
							imgs[ii].title = "아래로 한칸 이동";
						}
					}
					var cbs = cont[i].getElementsByTagName('input');
					for (var iii=0; iii<cbs.length; iii++)
					{
						if(cbs[iii].name == 'checkSwap') {
							cbs[iii].title = "서로 위치를 바꿀 2개의 상자에 체크하세요.";
							cbs[iii].onclick = function () {
								triggerSwitch(this, self.step, self.interval, self.mode);
							}
						}
					}
				} else {
					if (self.direction == 1) {
						cont[i].onclick = function () {
							moveUp(this, self.cookieName, self.step, self.interval, self.mode);
						}
					} else {
						cont[i].onclick = function () {
							moveDown(this, self.cookieName, self.step, self.interval, self.mode);
						}
					}
					cont[i].style.cursor = 'pointer';
				}
				self.divOrderArray.push(cont[i].id);
			}
		}
		if (!getCookie(self.cookieName)) {
			self.divOrder = self.divOrderArray.join(',');
			setCookie(self.cookieName,self.divOrder,365);
		} else {
			var divOrderSaved = getCookie(self.cookieName);
			if (divOrderSaved != self.divOrderArray.join(',')) {
				var divOrderArraySaved = divOrderSaved.split(',');
				calculateGap(divOrderArraySaved, self.divOrderArray);
				for(var i=0; i < divOrderArraySaved.length; i++) {
					var obj1 = document.getElementById(divOrderArraySaved[i]);
					var startPos = getStylePos(obj1);
					var endPos = newPos[obj1.id];
					elementMover(obj1,startPos,[0,endPos],self.step,self.interval,self.mode);
				}
			}
		}
	}
 
	function calculateGap (divOrderArraySaved, divOrderArray) {
		var tempOrderArray = divOrderArray.slice(0);
		for(var i=0; i < divOrderArray.length; i++) {
			newPos[divOrderArray[i]] = 0;
			newTop[divOrderArray[i]] = getOffsetTop(document.getElementById(divOrderArray[i]));
		}
		for(var i=0; i < divOrderArraySaved.length; i++) {
			if (divOrderArraySaved[i] != tempOrderArray[i]) {
				var key1 = divOrderArraySaved.getKey(divOrderArraySaved[i]);
				var obj1 = document.getElementById(tempOrderArray[key1]);
				var key2 = tempOrderArray.getKey(divOrderArraySaved[i]);
				var obj2 = document.getElementById(tempOrderArray[key2]);
				var tempObj, tempKey;
				if (key1 < key2) {
					tempKey = key1;
					tempObj = obj1;
					key1 = key2;
					obj1 = obj2;
					key2 = tempKey;
					obj2 = tempObj;
				}
				var currentPos = newTop[obj1.id];
				var partnerPosTop = newTop[obj2.id];
				var partnerElmGap = (obj1.offsetHeight) - (obj2.offsetHeight);
				var gap = currentPos - partnerPosTop;
				newPos[obj1.id] -= gap;
				newTop[obj1.id] -= gap;
				for (var ii = key2+1; ii < key1; ii ++) {
					newPos[tempOrderArray[ii]] += partnerElmGap;
					newTop[tempOrderArray[ii]] +=  partnerElmGap;
				}
				var partnerElmTopGap = (currentPos + obj1.offsetHeight) - (partnerPosTop + obj2.offsetHeight);
				newPos[obj2.id] += partnerElmTopGap;
				newTop[obj2.id] += partnerElmTopGap;
				tempOrderArray.switchArrayPos(key1, key2);
			}
		}
	}
 
	function getSwapDiv(obj) {
		while (obj.className != "swapDiv") {
			obj = obj.parentNode;
		}
		return obj;
	}
 
	function moveUp(obj, cookieName, step, interval, mode) {
		obj = getSwapDiv(obj);
		if(cookieName == '' || !cookieName) {
			cookieName = obj.parentNode.id+'_order';
		}
		var currentPos = getStylePos(obj);
		var divOrderArray = getCookie(cookieName).split(',');
		var divKey = divOrderArray.getKey(obj.id);
 
		if(divKey == 0) {
			var partnerElmTop = document.getElementById(divOrderArray[1]);
			var partnerElmBottom = document.getElementById(divOrderArray[divOrderArray.length-1]);
			var gap =  (getOffsetTop(partnerElmBottom) + partnerElmBottom.offsetHeight) - (getOffsetTop(obj) + obj.offsetHeight);
			var partnerElmGap = getOffsetTop(obj) - getOffsetTop(partnerElmTop);
			elementMover(obj,currentPos,[currentPos[0],currentPos[1]+gap],step, interval, mode);
			for (var i=1; i < divOrderArray.length; i ++) {
				var partnerElm = document.getElementById(divOrderArray[i]);
				var partnerPos = getStylePos(partnerElm);
				elementMover(partnerElm,partnerPos,[currentPos[0],partnerPos[1]+partnerElmGap],step, interval, mode);
			}
			divOrderArray.remove(obj.id);
			divOrderArray.push(obj.id);
		} else {
			var partnerElm = document.getElementById(divOrderArray[divKey-1]);
			var partnerPos = getStylePos(partnerElm);
			var partnerElmGap = (getOffsetTop(obj) + obj.offsetHeight) - (getOffsetTop(partnerElm) + partnerElm.offsetHeight);
			var gap = getOffsetTop(obj) - getOffsetTop(partnerElm);
			elementMover(obj,currentPos,[currentPos[0],currentPos[1]-gap],step, interval, mode);
			elementMover(partnerElm,partnerPos,[currentPos[0],partnerPos[1]+partnerElmGap],step, interval, mode);
			divOrderArray.switchArrayPos(divKey-1, divKey);
		}
 
		divOrder = divOrderArray.join(',');
		setCookie(cookieName,divOrder,365);
	}
 
	function moveDown(obj, cookieName, step, interval, mode) {
		obj = getSwapDiv(obj);
		if(cookieName == '' || !cookieName) {
			cookieName = obj.parentNode.id+'_order';
		}
		var currentPos = getStylePos(obj);
		var divOrderArray = getCookie(cookieName).split(',');
		var divKey = divOrderArray.getKey(obj.id);
 
		if(divKey == divOrderArray.length-1) {
			var partnerElmTop = document.getElementById(divOrderArray[0]);
			var partnerElmBottom = document.getElementById(divOrderArray[divOrderArray.length-2]);
			var partnerElmGap =  (getOffsetTop(obj) + obj.offsetHeight) - (getOffsetTop(partnerElmBottom) + partnerElmBottom.offsetHeight);
			var gap = getOffsetTop(partnerElmTop) - getOffsetTop(obj);
			elementMover(obj,currentPos,[currentPos[0],currentPos[1]+gap],step, interval, mode);
			for (var i=0; i < divOrderArray.length-1; i ++) {
				var partnerElm = document.getElementById(divOrderArray[i]);
				var partnerPos = getStylePos(partnerElm);
				elementMover(partnerElm,partnerPos,[currentPos[0],partnerPos[1]+partnerElmGap],step, interval, mode);
			}
			divOrderArray.remove(obj.id);
			divOrderArray.unshift(obj.id);
		} else {
			var partnerElm = document.getElementById(divOrderArray[divKey+1]);
			var partnerPos = getStylePos(partnerElm);
			var gap = (getOffsetTop(obj) + obj.offsetHeight) - (getOffsetTop(partnerElm) + partnerElm.offsetHeight);
			var partnerElmGap = getOffsetTop(obj) - getOffsetTop(partnerElm);
			elementMover(obj,currentPos,[currentPos[0],currentPos[1]-gap],step, interval, mode);
			elementMover(partnerElm,partnerPos,[currentPos[0],partnerPos[1]+partnerElmGap],step, interval, mode);
			divOrderArray.switchArrayPos(divKey+1, divKey);
		}
		divOrder = divOrderArray.join(',');
		setCookie(cookieName,divOrder,365);
	}
 
	function switchDiv(obj1, obj2, key1, key2, cookieName, step, interval, mode) {
		var tempObj, tempKey;
		if (key1 == key2) return;
		if(key1 < key2) {
			tempKey = key1;
			tempObj = obj1;
			key1 = key2;
			obj1 = obj2;
			key2 = tempKey;
			obj2 = tempObj;
		}
		if(cookieName == '' || !cookieName) {
			cookieName = obj1.parentNode.id+'_order';
		}
		var currentPos = getStylePos(obj1);
		var divOrderArray = getCookie(cookieName).split(',');
		var partnerElmTop = obj2;
		var partnerPosTop = getStylePos(partnerElmTop);
		var partnerElmGap = (obj1.offsetHeight) - (obj2.offsetHeight);
		var gap = getOffsetTop(obj1) - getOffsetTop(partnerElmTop);
		elementMover(obj1,currentPos,[currentPos[0],currentPos[1]-gap],step, interval, mode);
		for (var i = key2+1; i < key1; i ++) {
			var partnerElm = document.getElementById(divOrderArray[i]);
			var partnerPos = getStylePos(partnerElm);
			elementMover(partnerElm,partnerPos,[currentPos[0],partnerPos[1]+partnerElmGap],step, interval, mode);
		}
		var partnerElmTopGap = (getOffsetTop(obj1) + obj1.offsetHeight) - (getOffsetTop(obj2) + obj2.offsetHeight);
		elementMover(obj2,partnerPosTop,[currentPos[0],partnerPosTop[1]+partnerElmTopGap],step, interval, mode);
		divOrderArray.switchArrayPos(key1, key2);
		divOrder = divOrderArray.join(',');
		setCookie(cookieName,divOrder,365);
	}
 
	function triggerSwitch(obj , step, interval, mode) {
		var objName = obj.name;
		var val = getSelectedCheckbox(document.getElementsByName(objName));
		if (val.length < 2) {
			return;
		} else if (val.length > 2) {
			unCheckAllCheckbox(document.getElementsByName(objName));
		} else {
			var obj1 = getSwapDiv(obj);
			var obj2 = getSwapDiv(val[1]);
			var oldChecked = val[1];
			if(obj1.id == obj2.id) {
				obj2 = getSwapDiv(val[0]);
				oldChecked = val[0];
			}
			if(obj1.parentNode.id != obj2.parentNode.id) {
				unCheckAllCheckbox(document.getElementsByName(objName));
				return;
			}
			var cookieName = obj1.parentNode.id+'_order';
			var divOrderArray = getCookie(cookieName).split(',');
			var key1 = divOrderArray.getKey(obj1.id);
			var key2 = divOrderArray.getKey(obj2.id);
			switchDiv(obj1, obj2, key1, key2, cookieName, step, interval, mode);
			unCheckAllCheckbox(document.getElementsByName(objName));
			obj.blur();
			return;
		}
	}
 
	function elementMover(elem,startPos,endPos,steps,intervals,powr) {
		if (elem.posChangeMemInt) window.clearInterval(elem.posChangeMemInt);
		var actStep = 0;
		elem.posChangeMemInt = window.setInterval(
		function() {
			elem.currentPos = [	changeValue(startPos[0],endPos[0],steps,actStep,powr), changeValue(startPos[1],endPos[1],steps,actStep,powr)];
			elem.style.left = elem.currentPos[0]+"px";
			elem.style.top = elem.currentPos[1]+"px";
			actStep++;
			if (actStep > steps) window.clearInterval(elem.posChangeMemInt);
		}
		,intervals);
	}
 
	function changeValue(minValue,maxValue,totalSteps,actualStep,powr) {
		totalSteps = Math.max(totalSteps,1)
		var delta = maxValue - minValue;
		var stepp = minValue+(Math.pow(((1 / totalSteps) * actualStep), powr) * delta);
		return Math.ceil(stepp)
	}
 
	function getSelectedCheckbox(buttonGroup) {
		var arr = new Array();
		for (var i=0; i<buttonGroup.length; i++){
			if(buttonGroup[i].checked) {
				arr.push(buttonGroup[i]);
			}
		}
		return arr;
	}
 
	function unCheckAllCheckbox(buttonGroup) {
		for (var i=0; i<buttonGroup.length; i++){
			buttonGroup[i].checked = false;
		}
		return;
	}
 
	Array.prototype.getKey = function (value) {
		for (var i=0; i < this.length; i++) {
			if (this[i] === value) {
				return i;
			}
		}
		return false;
	}
 
	Array.prototype.switchArrayPos = function (key1, key2) {
		var tempValue, tempKey;
		if(key1 > key2) {
			tempKey = key1;
			key1 = key2;
			key2 = tempKey;
		}
		for (var i=0; i < this.length; i++) {
			if (i == key1) {
				tempValue = this[i];
				this[i] = this[key2];
			}
			if (i == key2) {
				this[i] = tempValue;
			}
		}
	}
 
	Array.prototype.remove = function(value){
		for(i=0; i < this.length; i++){
			if(value == this[i]) this.splice(i, 1);
		}
	}
 
	function getCookie(name){
		var tmp=document.cookie.split('; ');
		for (var i=0; i<tmp.length;i++){
			var c_name = tmp[i].split('=');
			if (c_name[0] == name) return unescape(c_name[1]);
		}
		return false;
	}
 
	function setCookie(name,value,expiredays)
	{
		var todayDate = new Date();
		todayDate.setDate(todayDate.getDate() + expiredays);
		document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}
 
	function getStylePos(elm) {
		var left = (parseInt(elm.style.left)||0);
		var top = (parseInt(elm.style.top)||0);
		return [left, top];
	}
 
	function getOffsetLeft(obj){
		var curleft = 0;
		if (obj.offsetParent){
			while (obj.offsetParent){
				curleft += obj.offsetLeft;
				obj = obj.offsetParent;
			}
		}
		else if (obj.x){
			curleft += obj.x;
		}
		return curleft;
	}
 
	function getOffsetTop(obj){
		var curtop = 0;
		if (obj.offsetParent){
			while (obj.offsetParent){
				curtop += obj.offsetTop;
				obj = obj.offsetParent;
			}
		}
		else if (obj.y){
			curtop += obj.y;
		}
		return curtop;
	}
 

 


