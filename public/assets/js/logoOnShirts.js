var shirt = new Image();
shirt.src = "/assets/images/shirt/front/shirt.png";
var draw = new Image();
draw.src = "/assets/images/test/1.png";

var back  = false;
var front = false;
var color = "black";


window.onload = function() {
    var canvas = document.getElementById("canvas");

    var ctx = canvas.getContext("2d");    
    ctx.fillStyle = color;
    ctx.fillRect(0, 0, canvas.width, canvas.height);


    
    
    maxSize  = 160;
    var ratio = Math.min(maxSize  / draw.width, maxSize / draw.height);
    var width= draw.width*ratio, 
        height= draw.height*ratio;
    
        console.log(ratio,width,height);
        
    ctx.drawImage(draw,95,90,width,height);

    ctx.drawImage(shirt,0,0,canvas.width,canvas.height);
}
 