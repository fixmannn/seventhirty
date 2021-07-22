const currency = document.querySelectorAll('.currency');
const numberFormatter = new Intl.NumberFormat('en-ID', {
  style: 'currency',
  currency: 'IDR'
});


// window.addEventListener('load', function() {
//     currency.forEach(x => {
//       x.innerText = numberFormatter.format(parseFloat(x.innerText)).replace(/\D00$/, '');
//     });
// });

// Currency Format
const price = document.querySelectorAll('.number');

window.addEventListener('load', function() {
  price.forEach((val, index) => {
    valInner = val.innerHTML;
    // console.log(typeof(val.innerHTML));
    val.innerHTML = parseFloat(valInner).toLocaleString('id');
  });
});

