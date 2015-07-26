//Create Clock Manager
var ClockManager = function() {
  var clock = $('#clock').FlipClock();
  clock.setTime(moment().hour() * 3600 + moment().minute() * 60 + moment().second());
}
    
new ClockManager();