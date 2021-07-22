// Currency Format
const price = document.querySelectorAll('.currency');

window.addEventListener('load', function() {
  price.forEach((val, index) => {
    valInner = val.innerHTML;
    // console.log(typeof(val.innerHTML));
    val.innerHTML = parseFloat(valInner).toLocaleString('id');
  });
});


  // Create Account Toggle
  const createAcc = document.querySelector('.form-check-input');
  const guest = document.querySelector('.guest');
  const guestInner = document.querySelector('.guest').innerHTML;
  const password = document.querySelector('.password-row');
  const pwInput = document.querySelector('.pwinput');
  const pwInput2 = document.querySelector('.pwinput2');


  createAcc.addEventListener('click', function() {
    if (password.style.display === 'none') {
      guest.innerHTML = '';
      password.style.display = "block";
    } else {
      guest.innerHTML = '<input type="hidden" name="_method" value="patch">';
      password.style.display = "none";
    }

    pwInput.toggleAttribute('required');
    pwInput2.toggleAttribute('required');
  });