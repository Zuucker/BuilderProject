const slider = document.querySelector('.slider');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const images = document.querySelectorAll('.slider img');

let currentIndex = 0;

const updateSlider = () => {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

const showPrev = () =>  {
    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    updateSlider();
}

const showNext = () =>  {
    console.log("next")
    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    updateSlider();
}

setInterval(()=>{
    showNext();
}, 3000);