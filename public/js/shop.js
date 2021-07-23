// Shop 
// New Arrival Hover
const catalogs = document.querySelectorAll('.catalog');
let catPics = ['friendship', 'anxiety', 'forgiving', 'paramore', 'blackpink', 'hayley', 'purpose', 'zayn', 'travis', 'beerbongs', 'dualipa', 'drake', 'dynamite', 'hollywoods', 'lookmom', 'modernity', 'neckdeep', 'starboy'];


catalogs.forEach((val, index) => {
    val.addEventListener('mouseover', function () {
        val.src = "https://seventhirty-id.com/img/" + catPics[index] + "-zoomed.jpg";
        val.classList.add('fadeIn');
    })
})

catalogs.forEach((val, index) => {
    val.addEventListener('mouseout', function () {
        val.src = "https://seventhirty-id.com/img/" + catPics[index] + ".jpg";
        val.classList.remove('fadeIn');
    })

})

// Show Load More Products 
const moreDisplay = document.querySelector('.more-display');
const loadMore = document.querySelector('.load-more');


loadMore.addEventListener('click', function () {
    moreDisplay.style.display = null;
    loadMore.style.display = 'none';
});


console.log('ok');