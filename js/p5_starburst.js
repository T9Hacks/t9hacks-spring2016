var canvasHeight = $("header").height();
var canvasWidth = $("header").width();
//console.log(canvasHeight + " " + canvasWidth);

$("#header-canvas")
	.height(canvasHeight)
	.width(canvasWidth);


var starsStart = 100;
var starsCount = starsStart;
var starsMax = 150;
var starsMore = 0;
var stars = new Array(starsMax); 


var backRed = 170;
var backGreen = 136;
var backBlue = 170;

var resetBtnHeight = 30;
var resetBtnWidth = 110;
var resetBtnY = canvasHeight-20-30;
var resetBtnX = 20;

function setup() {
	var canvas = createCanvas(canvasWidth, canvasHeight);
	canvas.id('header-canvas');
	//size(canvasWidth, canvasHeight);
	background(backRed, backGreen, backBlue);
	
	noStroke();
	
	for(var i=0; i<starsCount; i++) {
		var size = Math.floor((Math.random() * 6) + 5); // between 5 and 11 (inclusive)
		var speed = map(size, 5, 11, 0.7, 0.3);
		var xSpeed = ( (Math.random() < 0.5) ? (speed*(-1)) : speed );
		var ySpeed = ( (Math.random() < 0.5) ? (speed*(-1)) : speed );
		var colorDiff = map(size, 5, 11, 3, 7);
		stars[i] = {
			x: Math.floor((Math.random() * canvasWidth) + 1), 
			y: Math.floor((Math.random() * canvasHeight) + 1),
			xSpeed: xSpeed,
			ySpeed: ySpeed,
			colorDiff: colorDiff,
			size: size
		};
	}
	
	
};

function draw() {
	//background(backRed, backGreen, backBlue);
	for(var i=0; i<starsCount; i++) {
		if(i < 100) {
			fill(backRed+stars[i].colorDiff, backGreen+stars[i].colorDiff, backBlue+stars[i].colorDiff);
		} else
			//fill(80, 184, 226);
			fill(200, 184, 226);
		drawDot(stars[i]);
	}
	
	drawButton();
};

function mousePressed() {
	if(mouseX >= resetBtnX && mouseX <= resetBtnX+resetBtnWidth && mouseY >= resetBtnY && mouseY <= resetBtnY+resetBtnHeight) {
		background(backRed, backGreen, backBlue);
		starsCount = 100;		
	} else {
		// start:	starsCount = 100   starsMore = 0
		// max:   	starsCount = 130   starsMore = 30
		// restart: starsCount = 130   starsMore = 0
		//console.log("starsCount: " + starsCount + " starsMore: " + starsMore);
		var size = Math.floor((Math.random() * 6) + 5); // between 5 and 11 (inclusive)
		var speed = (size/10);
		var xSpeed = ( (Math.random() < 0.5) ? (speed*(-1)) : speed );
		var ySpeed = ( (Math.random() < 0.5) ? (speed*(-1)) : speed );
		
		stars[(starsStart+starsMore)] = {
			x: mouseX, 
			y: mouseY,
			xSpeed: xSpeed,
			ySpeed: ySpeed,
			diff: 0,
			size: size
		};
		
		if(starsCount < starsMax) {
			starsCount++;
			starsMore++;
		} else {
			if(starsMore >= (starsMax-starsStart)) {
				starsMore = 0;
			} else {
				starsMore++;
			}
		}
	}
};

function drawDot(star) {
	ellipse(star.x, star.y, star.size, star.size);
	
	if(star.x <= 10 || star.x >= (canvasWidth-10)) {
		star.xSpeed = star.xSpeed * (-1);
	}
	if(star.y <= 10 || star.y >= (canvasHeight-10)) {
		star.ySpeed = star.ySpeed * (-1);
	}
	
	star.x += star.xSpeed;
	star.y += star.ySpeed;
};

function drawButton() {
	if(mouseX >= resetBtnX && mouseX <= resetBtnX+resetBtnWidth && mouseY >= resetBtnY && mouseY <= resetBtnY+resetBtnHeight) 
		fill(backRed-50, backGreen-50, backBlue-50);
	else
		fill(backRed-30, backGreen-30, backBlue-30);
	rect(resetBtnX, resetBtnY, resetBtnWidth, resetBtnHeight);
	fill(0);
	text("Reset Animation", resetBtnX+10, resetBtnY+20);
	
}
