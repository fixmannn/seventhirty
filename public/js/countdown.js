// Countdown Timer for Payment
var countdownEl = document.querySelector('.countdown');
var countdown = document.querySelector('.countdown').innerHTML + "000";
var countdown = parseInt(countdown);

var x = setInterval(function(){
  var now = new Date().getTime();
  var distance = countdown - now;
  
  var hours = Math.floor((distance % (1000*60*60*24))/(1000*60*60));
  var minutes = Math.floor((distance % (1000*60*60))/(1000*60));
  var seconds = Math.floor(distance % (1000*60)/1000);
  
  countdownEl.innerHTML = hours + ":" + minutes + ":" + seconds;
  
  // If countdown over
  if(distance < 0) {
    clearInterval(x);
    countdownEl.innerHTML = "EXPIRED";
  }
  
}, 1000);

// Convert Price Format
var amountEl = document.querySelector('.amount')
var amount = document.querySelector('.amount').innerText;

window.addEventListener('load', function() {
  amountEl.innerHTML = parseFloat(amount).toLocaleString('en');
});
