// Thumnail Animation
const thumb1 = document.querySelector('.thumb1');
const thumb2 = document.querySelector('.thumb2');
const previewImg = document.querySelector('.previewImg');
var path = window.location.pathname;
var page = path.split("/products/").pop();
let product = page.split("/").shift();

catalogs.forEach((val, index) => {
    val.addEventListener('mouseover', function () {
        val.src = <? php echo asset('img/') ?> + catPics[index] + "-zoomed.jpg";
        val.classList.add('fadeIn');
    })
});

catalogs.forEach((val, index) => {
    val.addEventListener('mouseout', function () {
        val.src = <? php echo asset('img/') ?> + catPics[index] + ".jpg";
        val.classList.remove('fadeIn');
    })
});

thumb2.addEventListener('click', function () {
    previewImg.src = <? php echo asset('img/') ?> + product + "-zoomed.jpg";
    event.preventDefault();
    previewImg.classList.add('fadeIn');
    setTimeout(function () {
        previewImg.classList.remove('fadeIn');
    }, 200);
});

thumb1.addEventListener('click', function () {
    previewImg.src = <? php echo asset('img/') ?> + product + ".jpg";
    event.preventDefault();
    previewImg.classList.add('fadeIn');
    setTimeout(function () {
        previewImg.classList.remove('fadeIn')
    }, 200);
});


// Size Controller
let radioBtn = document.querySelectorAll('.radio-button');
const message = document.querySelector('.message');
const available = document.querySelector('.stock-available');
const notAvailable = document.querySelector('.stock-na');
const cartBtn = document.querySelector('#cart-btn');

radioBtn.forEach(function (size) {
    if (size.checked = false) {
        message.style.display = "block";
    } else {
        size.addEventListener('click', function () {
            if (size.ariaLabel == 0) {
                notAvailable.style.display = "block";
                available.style.display = "none";
                cartBtn.setAttribute("disabled", "true");
            } else {
                available.style.display = "block";
                notAvailable.style.display = "none";
                cartBtn.removeAttribute("disabled");
            }
        });
    }


});



const priceInner = document.getElementById('number').innerText;
const price = document.getElementById('number');

const priceInner2 = document.getElementById('number2').innerText;
const price2 = document.getElementById('number2');

console.log(typeof (priceInner));

window.addEventListener('load', function () {
    price2.innerHTML = parseFloat(priceInner2).toLocaleString('id');
    price.innerHTML = parseFloat(priceInner).toLocaleString('id');
});

