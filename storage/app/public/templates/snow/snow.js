
var Snow = function (options) {
  this.start = function(){
    let div = document.getElementById(options.id)
    if(div == null){
        div = document.createElement('DIV');
        div.id = options.id;
        document.body.append(div);
    }
    console.log(div)
    document.getElementById(options.id).style.position = "fixed";
    document.getElementById(options.id).style.top = 0;
    document.getElementById(options.id).style.left = 0;
    document.getElementById(options.id).style.right = 0;
    document.getElementById(options.id).style.bottom = 0;
    document.getElementById(options.id).style.zIndex = 1000;
    document.getElementById(options.id).style.pointerEvents = "none";
    this.canvas = document.createElement("canvas");
    console.log("nic")
    console.log(document.getElementById(options.id))
    document.getElementById(options.id).appendChild(this.canvas);
    var W = window.innerWidth;
    var H = window.innerHeight;
    this.canvas.width = W;
    this.canvas.height = H;
    var ctx = this.canvas.getContext("2d");

    var mf = 100; //max flakes
    var flakes = [];
    for(var i = 0; i < mf; i++)
    {
      flakes.push({
        x: Math.random()*W,
        y: Math.random()*H,
        r: Math.random()*5+2, //min of 2px and max of 7px
        d: Math.random() + 1 //density of the flake

      })
    }

    //draw flakes onto canvas
    function drawFlakes()
    {
      ctx.clearRect(0, 0, W, H);
      ctx.fillStyle = "white";
      ctx.beginPath();
      for(var i = 0; i < mf; i++){
        var f = flakes[i];
        ctx.moveTo(f.x, f.y);
        ctx.arc(f.x, f.y, f.r, 0, Math.PI*2, true);
      }
      ctx.fill();
      moveFlakes();
    }

    //animate the flakes
    var angle = 0;
    function moveFlakes(){
      angle += 0.01;
      for(var i = 0; i < mf; i++)
      {
        //store current flake
        var f = flakes[i];

        //update X and Y coordinates of each snowflakes
        f.y += Math.pow(f.d, 2) + 1;
        f.x += Math.sin(angle) * 2;

        //if the snowflake reaches the bottom, send a new one to the top
        if(f.y > H){
          flakes[i] = {x: Math.random()*W, y: 0, r: f.r, d: f.d};
        }
      }
    }
    setInterval(drawFlakes, 25);
  }
}
var Snowflake = function (canvas, theme, min, max) {}

new Snow({
  id: 'snow'
}).start();