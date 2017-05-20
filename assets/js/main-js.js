
$( document ).ready(function() {

  $("#test-circle").circliful({
    animateInView: true,
    animationStep: 13,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#3498DB',
    replacePercentageByText: '',
    fontColor: '#000',
    percentageY: 105
  }, function(){
     $('#test-circle .timer').countTo({
      from: 0, 
      to: 3,
      speed: 500
    });
  });
  $("#test-circle2").circliful({
    animateInView: true,
    animationStep: 9,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#FF4136',
    replacePercentageByText: '',
    fontColor: '#000',
    percentageY: 105
  }, function(){
     $('#test-circle2 .timer').countTo({
      from: 0, 
      to: 50,
      speed: 1000
    });
  });
  $("#test-circle3").circliful({
    animateInView: true,
    animationStep: 7,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#39CCCC',
    replacePercentageByText: '',
    fontColor: '#000',
    percentageY: 105
  }, function(){
     $('#test-circle3 .timer').countTo({
      from: 0, 
      to: 200,
      speed: 1200
    });
  });

});

