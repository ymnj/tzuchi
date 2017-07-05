
jQuery( document ).ready(function() {


  // Front page circle stats
  jQuery("#test-circle").circliful({
    animateInView: true,
    animationStep: 13,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#3498DB',
    replacePercentageByText: '',
    fontColor: '#f2f2f2',
    percentageY: 105
  }, function(){
     jQuery('#test-circle .timer').countTo({
      from: 0, 
      to: 3,
      speed: 500
    });
  });
  jQuery("#test-circle2").circliful({
    animateInView: true,
    animationStep: 9,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#FF4136',
    replacePercentageByText: '',
    fontColor: '#f2f2f2',
    percentageY: 105
  }, function(){
     jQuery('#test-circle2 .timer').countTo({
      from: 0, 
      to: 50,
      speed: 1000
    });
  });
  jQuery("#test-circle3").circliful({
    animateInView: true,
    animationStep: 7,
    noPercentageSign: true,
    percent: 100,
    backgroundBorderWidth: 15,
    backgroundColor: 'none',
    foregroundColor:'#39CCCC',
    replacePercentageByText: '',
    fontColor: '#f2f2f2',
    percentageY: 105
  }, function(){
     jQuery('#test-circle3 .timer').countTo({
      from: 0, 
      to: 200,
      speed: 1200
    });
  });


  //Front page 4 doctors section

  window.sr = ScrollReveal();
  memberSectionOptions = {
    duration: 500,
    origin: 'left',
    distance: '20px',
    scale: 1,
    easing: 'ease',
    reset: false
  }

  sr.reveal('.team-section .intro-header', {viewFactor: 1});
  sr.reveal('.section-member', memberSectionOptions, 300);

});

