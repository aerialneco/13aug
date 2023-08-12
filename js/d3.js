
  // var node2 = d3.select(".canvas").select("svg")
  //   .append("g")
  //   .attr("class", "node")
  //   .attr("transform", "translate(300, 300)");

// Get the canvas element
var canvas = d3.select(".canvas");

// Get the dimensions of the canvas dynamically
var canvasWidth = canvas.node().getBoundingClientRect().width;
var canvasHeight = canvas.node().getBoundingClientRect().height;

// Calculate the center coordinates of the canvas
var centerX = canvasWidth / 2;
var centerY = canvasHeight / 2;

// Append the <g> element (group) to the <svg> element and set its transform to center the <svg> element
var node2 = canvas.select("svg")
    .append("g")
    .attr("class", "node")
    .attr("transform", "translate(" + centerX + ", " + centerY + ")");


  var circle = node2.append("circle")
    .attr('r', 15)
    .style('stroke', '#49c3b1')
    .style('fill', '#A3DEB5')
    .style('stroke-width', 0);
    
  node2.append("circle").classed("pulse", true)
    .attr('r', function() {
      return parseInt(circle.attr('r')) + 10;
    })
    .style('stroke', '#fff')
    .style('fill', '#A3DEB5')
    .style('stroke-width', 1);

  // A function that update the color circle
  var changeColor = function(color) {
    circle
      // .transition()
      // .duration(800)
      .style('fill', color);
    node2.select('.pulse')
      // .transition()
      // .duration(1000)
      .style('fill', color);
  };

  // A function that update the circle radius
  var updateCircleRadius = function(radius) {
    circle
      // .transition()
      // .duration(1000)
      .attr('r', radius);
    node2.select('.pulse')
      // .transition()
      // .duration(1000)
      .attr('r', function() {
        return parseInt(circle.attr('r')) + 10;
      });
  };

// ラジオボタンの要素を取得
var radioButtons = document.getElementsByName('emotionOption');

// イベントリスナーを追加
radioButtons.forEach(function(button) {
  button.addEventListener('change', function() {
    // 選択された要素の値を取得
    var selectedValue = document.querySelector('input[name="emotionOption"]:checked').id;
    
    // アニメーションの速さを設定
    if (selectedValue === 'relief' || selectedValue === 'happy') {
      node2.select('.pulse').style('animation-duration', '6s');
    } else if (selectedValue === 'tention'){
      node2.select('.pulse').style('animation-duration', '1s');
    } else if (selectedValue === 'surprise'){
      node2.select('.pulse').style('animation-duration', '0.6s');
    } else {
      node2.select('.pulse').style('animation-duration', '2s');
    }

    // "anger"が選択された場合の処理
    if (selectedValue === 'anger') {
      // pulseのアニメーションを停止
      node2.select('.pulse').style('animation', 'none');

      // circleがeaseBounceOutするアニメーションを設定
      function bounceOutAnimation() {
        node2.select('circle')
          .transition()
          .ease(d3.easeBounceOut)
          .duration(300)
          .attr('r', 100) // サークルの半径を変更
          .transition()
          .ease(d3.easeBounceOut)
          .duration(300)
          .attr('r', 170) // サークルの半径を変更
          .transition()
          .ease(d3.easeBounceOut)
          .duration(300)
          .attr('r', 100) // サークルの半径を変更
          .on('end', bounceOutAnimation); // アニメーションが終了した後に再度bounceOutAnimationを呼び出す
      }
      // 初回のbounceOutAnimationを呼び出す
      bounceOutAnimation();
    }


    // "annoyed"が選択された場合の処理
    if (selectedValue === 'annoyed') {
      // pulseのアニメーションを停止
      node2.select('.pulse').style('animation', 'none');

      // circleがeaseBounceOutするアニメーションを設定
      function bounceOutAnimation() {
        node2.select('circle')
          .transition()
          .ease(d3.easeBounce)
          .duration(1000)
          .attr('r', 100) // サークルの半径を変更
          .transition()
          .ease(d3.easeBounceIn)
          .duration(1000)
          .attr('r', 120) // サークルの半径を変更
          .transition()
          .ease(d3.easeBounce)
          .duration(1000)
          .attr('r', 80) // サークルの半径を変更
          .on('end', bounceOutAnimation); // アニメーションが終了した後に再度bounceOutAnimationを呼び出す
      }
      // 初回のbounceOutAnimationを呼び出す
      bounceOutAnimation();
    }


// "depressed"が選択された場合の処理
if (selectedValue === 'disappoint') {
  // pulseのアニメーションを制御する関数を定義
  function startStopPulse() {
    // pulseを開始するアニメーション
    node2.select('.pulse')
      .transition()
      .duration(2000)
      .style('animation', 'pulse 2s')
      .on('end', function() {
        // pulseを停止するアニメーション
        node2.select('.pulse')
          .transition()
          .duration(2000)
          .style('animation', 'none')
          .on('end', startStopPulse); // アニメーションが終了した後に再度startStopPulseを呼び出す
      });
  }
  // 初回のstartStopPulseを呼び出す
  startStopPulse();
}



  });
});




