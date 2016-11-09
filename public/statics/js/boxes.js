function Box() {
  this.x = 0;
  this.y = 0;
  this.w = 1; 
  this.h = 1;
  this.fill = '#00FF44';
}


function addRect(x, y, w, h, fill, name) {
  var rect = new Box;
  rect.x = x;
  rect.y = y;
  rect.w = w
  rect.h = h;
  rect.fill = fill;
  boxes.push(rect);
  boxesnames.push(name);

  invalidate();

}

var boxes = [];
var boxesnames = [];

var canvas;
var ctx;
var WIDTH;
var HEIGHT;
var INTERVAL = 20;  

var isDrag = false;
var mx, my; 

var canvasValid = false;

var mySel; 

var mySelColor = '#0000FF';
var mySelWidth = 2;

var ghostcanvas;
var gctx; 

var offsetx, offsety;

var stylePaddingLeft, stylePaddingTop, styleBorderLeft, styleBorderTop;

var boxID;

function init() {
  canvas = document.getElementById('canvas');
  HEIGHT = canvas.height;
  WIDTH = canvas.width;
  ctx = canvas.getContext('2d');
  ghostcanvas = document.createElement('canvas');
  ghostcanvas.height = HEIGHT;
  ghostcanvas.width = WIDTH;
  gctx = ghostcanvas.getContext('2d');

  canvas.onselectstart = function () { return false; }

  if (document.defaultView && document.defaultView.getComputedStyle) {
    stylePaddingLeft = parseInt(document.defaultView.getComputedStyle(canvas, null)['paddingLeft'], 10)      || 0;
    stylePaddingTop  = parseInt(document.defaultView.getComputedStyle(canvas, null)['paddingTop'], 10)       || 0;
    styleBorderLeft  = parseInt(document.defaultView.getComputedStyle(canvas, null)['borderLeftWidth'], 10)  || 0;
    styleBorderTop   = parseInt(document.defaultView.getComputedStyle(canvas, null)['borderTopWidth'], 10)   || 0;
  }
  
  setInterval(draw, INTERVAL);
  
  canvas.onmousedown = myDown;
  canvas.onmouseup = myUp;

}

function clear(c) {
  c.clearRect(0, 0, WIDTH, HEIGHT);
}

function draw() {
  if (canvasValid == false) {
    clear(ctx);

    var l = boxes.length;
    for (var i = 0; i < l; i++) {
        drawshape(ctx, boxes[i], boxes[i].fill, boxesnames[i]);
    }

    if (mySel != null) {
      ctx.strokeStyle = mySelColor;
      ctx.lineWidth = mySelWidth;
      ctx.strokeRect(mySel.x-50,mySel.y-30,mySel.w-30,mySel.h-30);
    }

    canvasValid = true;
  }
}

function drawshape(context, shape, fill, name) {
  context.fillStyle = fill;
  
  if (shape.x > WIDTH || shape.y > HEIGHT) return; 
  if (shape.x + shape.w < 0 || shape.y + shape.h < 0) return;
  
  context.fillRect(shape.x-50,shape.y-30,shape.w-30,shape.h-30);
  context.fillStyle = 'black';
  context.font="14px Verdana";
  context.fillText(name,shape.x-30,shape.y+10);

}

function myMove(e){
  if (isDrag){
    getMouse(e);
    
    mySel.x = mx - offsetx;
    mySel.y = my - offsety;
    var elem_x = document.getElementById(boxID+"x");
    var elem_y = document.getElementById(boxID+"y");
    var elem_name = document.getElementById(boxID+"name");
    elem_name.style.backgroundColor = "#85e7ff";
    elem_x.value = mySel.x;
    elem_y.value = mySel.y;
    invalidate();
  }
}

function myDown(e){
  getMouse(e);
  clear(gctx);
  var l = boxes.length;
  for (var i = l-1; i >= 0; i--) {
    drawshape(gctx, boxes[i], 'black', boxesnames[i]);
    var imageData = gctx.getImageData(mx, my, 1, 1);
    var index = (mx + my * imageData.width) * 4;

    boxID = i;
    if (imageData.data[3] > 0) {
      mySel = boxes[i];
      offsetx = mx - mySel.x;
      offsety = my - mySel.y;
      mySel.x = mx - offsetx;
      mySel.y = my - offsety;
      isDrag = true;
      canvas.onmousemove = myMove;
      invalidate();
      clear(gctx);

      return;
    }
    
    
  }
  mySel = null;
  clear(gctx);
  invalidate();
}

function myUp(){
  isDrag = false;
  canvas.onmousemove = null;
  var elem_name = document.getElementById(boxID+"name");
  elem_name.style.backgroundColor = "white";
}

function invalidate() {
  canvasValid = false;
}

function getMouse(e) {
      var element = canvas, offsetX = 0, offsetY = 0;

      if (element.offsetParent) {
        do {
          offsetX += element.offsetLeft;
          offsetY += element.offsetTop;
        } while ((element = element.offsetParent));
      }

      // Add padding and border style widths to offset
      offsetX += stylePaddingLeft;
      offsetY += stylePaddingTop;

      offsetX += styleBorderLeft;
      offsetY += styleBorderTop;

      mx = e.pageX - offsetX;
      my = e.pageY - offsetY

}

