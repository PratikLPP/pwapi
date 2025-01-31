
<?php
if(isset($_POST['pass']) && isset($_POST['token'])){
  if($_POST['pass'] == "rishab"){
    $myfile = fopen("token.txt", "w") or die("Unable to open file!");
$txt = $_POST['token'];
fwrite($myfile, $txt);
fclose($myfile);
    $s = "Token Updated";
  }else{
    $err = "Password is Incorrect";
  }
} 

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Token Form</title>
  <style>
    label {
      font-weight: bold;
      width: 100px;
      font-size: 14px;
    }

    canvas {
      position: fixed;
      z-index: 0;
      opacity: 0.85;
    }

    form {
      background-color: white;
      position: absolute;
      padding: 30px;
    }

    * {
      margin: 0;
      padding: 0;
      text-decoration: none;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      background-image: linear-gradient(120deg, #3498db, #8e44ad);
    }

    .login-form {
      width: 360px;
      background: #ffffff;
      height: min-content;
      padding: 50px;
      border-radius: 10px;
      position: absolute;
      left: 50%;
      top: 40%;
      transform: translate(-50%, -50%);
    }

    .login-form h1 {
      text-align: center;
      margin-bottom: 60px;
    }

    .txtb {
      border-bottom: 2px solid #adadad;
      position: relative;
      margin: 30px 0;
    }

    .txtb input {
      font-size: 15px;
      color: #333;
      border: none;
      width: 100%;
      outline: none;
      background: none;
      padding: 0 5px;
      height: 40px;
    }

    .txtb span::before {
      content: attr(data-placeholder);
      position: absolute;
      top: 50%;
      left: 5px;
      color: #a8a8a8;
      transform: translateY(-50%);
      z-index: -1;
      transition: .5s;
    }

    .txtb span::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      background: linear-gradient(120deg, #3498db, #8e44ad);
      transition: .5s;
      top: 100%;
      left: 0;
    }

    .focus+span::before {
      top: -5px;
    }

    .focus+span::after {
      width: 100%;
    }

    .logbtn {
      display: block;
      width: 100%;
      height: 50px;
      border: none;
      background: linear-gradient(120deg, #3498db, #8e44ad, #3498db);
      background-size: 200%;
      color: #fff;
      outline: none;
      cursor: pointer;
      transition: .5s;
      font-size: large;
      font-weight: 700;
    }

    .logbtn:hover {
      background-position: right;
    }

    .bottom-text {
      margin-top: 60px;
      text-align: center;
      font-size: 13px;
    }
  </style>
 <!-- Compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<div class="trail">

  <canvas id="world" width="366" height="626"></canvas></div>

<body>
  
  <form action="" class="login-form" method="POST" >
    <h1>PW Token FORM</h1>
        <div style="color:green;font-size:15px;font-weight:700;margin-top:15px;">
      <?php echo $s; ?>
    </div>

    <div style="color:red;font-size:15px;font-weight:700;margin-top:15px;">
      <?php echo $err; ?>
    </div>
    
    <div class="txtb">
      <input type="text" name="token" id="token">
      <span data-placeholder="Enter Token"></span>
    </div>

    <div class="txtb">
      <input type="text" name="pass" id="pass">
      <span data-placeholder="Password"></span>
    </div>


      <input type="submit" class="logbtn" value="Submit">
<br>
      <a href="jsonadd.php" class="logbtn"> Open IMPORTER </a>

  </form>
  


  
  
  <script>

     $(".txtb input").on("focus", function() {
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur", function() {
      if ($(this).val() == "")
        $(this).removeClass("focus");
    });


var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;

var RADIUS = 50;
var RADIUS_SCALE = 1;
var RADIUS_SCALE_MIN = 1;
var RADIUS_SCALE_MAX = 1.5;

var QUANTITY = 50;

var canvas;
var context;
var particles;

var mouseX = SCREEN_WIDTH * 0.5;
var mouseY = SCREEN_HEIGHT * 0.5;
var mouseIsDown = false;

function init() {

  canvas = document.getElementById('world');
  if (canvas && canvas.getContext) {
		context = canvas.getContext('2d');
		
		// Register event listeners
		window.addEventListener('mousemove', documentMouseMoveHandler, false);
		window.addEventListener('mousedown', documentMouseDownHandler, false);
		window.addEventListener('mouseup', documentMouseUpHandler, false);
		document.addEventListener('touchstart', documentTouchStartHandler, false);
		document.addEventListener('touchmove', documentTouchMoveHandler, false);
		window.addEventListener('resize', windowResizeHandler, false);
		
		createParticles();
		windowResizeHandler();
		setInterval(loop, 1000/60);
	}
}

function createParticles() {
	particles = [];
	var webuzo_colors = ["#20336e","#406a1b","#e86d30","#992929","#20336e","#406a1b","#e86d30","#992929","#B00000","#3300CC" ];
	for (var i = 0; i < QUANTITY; i++) {
		var particle = {
			size: 1,
			position: { x: mouseX, y: mouseY },
			offset: { x: 0, y: 0 },
			shift: { x: mouseX, y: mouseY },
			speed: 0.01+Math.random()*0.04,
			targetSize: 1,
			//fillColor: '#' + (Math.random() * 0x404040 + 0xaaaaaa | 0).toString(16),
			fillColor: webuzo_colors[i],
			orbit: RADIUS*.5 + (RADIUS * .5 * Math.random())
		};
		
		particles.push(particle);
	}
}

function documentMouseMoveHandler(event) {
	mouseX = event.clientX - (window.innerWidth - SCREEN_WIDTH) * .5;
	mouseY = event.clientY - (window.innerHeight - SCREEN_HEIGHT) * .5;
}

function documentMouseDownHandler(event) {
	mouseIsDown = true;
}

function documentMouseUpHandler(event) {
	mouseIsDown = false;
}

function documentTouchStartHandler(event) {
	if(event.touches.length == 1) {
		event.preventDefault();

		mouseX = event.touches[0].pageX - (window.innerWidth - SCREEN_WIDTH) * .5;;
		mouseY = event.touches[0].pageY - (window.innerHeight - SCREEN_HEIGHT) * .5;
	}
}

function documentTouchMoveHandler(event) {
	if(event.touches.length == 1) {
		event.preventDefault();

		mouseX = event.touches[0].pageX - (window.innerWidth - SCREEN_WIDTH) * .5;;
		mouseY = event.touches[0].pageY - (window.innerHeight - SCREEN_HEIGHT) * .5;
	}
}

function windowResizeHandler() {
	SCREEN_WIDTH = window.innerWidth;
	SCREEN_HEIGHT = window.innerHeight;
	
	canvas.width = SCREEN_WIDTH;
	canvas.height = SCREEN_HEIGHT;
}

function loop() {
	
	if(mouseIsDown) {
		RADIUS_SCALE += (RADIUS_SCALE_MAX - RADIUS_SCALE) * (0.02);
	}
	else {
		RADIUS_SCALE -= (RADIUS_SCALE - RADIUS_SCALE_MIN) * (0.02);
	}
	
	RADIUS_SCALE = Math.min(RADIUS_SCALE, RADIUS_SCALE_MAX);
	
	context.fillStyle = 'rgba(0,0,0,0.05)';
	//context.fillStyle = '#9e9e9e'
	context.fillRect(0, 0, context.canvas.width, context.canvas.height);
	
	for (i = 0, len = particles.length; i < len; i++) {
		var particle = particles[i];
		
		var lp = { x: particle.position.x, y: particle.position.y };
		
		// Rotation
		particle.offset.x += particle.speed;
		particle.offset.y += particle.speed;
		
		// Follow mouse with some lag
		particle.shift.x += ( mouseX - particle.shift.x) * (particle.speed);
		particle.shift.y += ( mouseY - particle.shift.y) * (particle.speed);
		
		// Apply position
		particle.position.x = particle.shift.x + Math.cos(i + particle.offset.x) * (particle.orbit*RADIUS_SCALE);
		particle.position.y = particle.shift.y + Math.sin(i + particle.offset.y) * (particle.orbit*RADIUS_SCALE);
		
		// Limit to screen bounds
		particle.position.x = Math.max( Math.min( particle.position.x, SCREEN_WIDTH ), 0 );
		particle.position.y = Math.max( Math.min( particle.position.y, SCREEN_HEIGHT ), 0 );
		
		particle.size += ( particle.targetSize - particle.size ) * 0.05;
		
		if( Math.round( particle.size ) == Math.round( particle.targetSize ) ) {
			particle.targetSize = 1 + Math.random() * 7;
		}
		
		context.beginPath();
		context.fillStyle = particle.fillColor;
		//console.log(particle.fillColor);
		context.strokeStyle = particle.fillColor;
		context.lineWidth = particle.size;
		context.moveTo(lp.x, lp.y);
		context.lineTo(particle.position.x, particle.position.y);
		context.stroke();
		context.arc(particle.position.x, particle.position.y, particle.size/2, 0, Math.PI*2, true);
		context.fill();
	}
}
window.onload = init;

  </script>

</body>

</html>
