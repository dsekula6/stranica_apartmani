let indexes = [0,0,0];

function changePreview(direction, currentIndex, previewImgs, previewContainer, previewInner, mainImg) {
  if (direction === 'left') {
    currentIndex--;
    if (currentIndex < 0) {
      currentIndex = previewImgs.length - 1;
    }
  } else if (direction === 'right') {
    currentIndex++;
    if (currentIndex > previewImgs.length - 1) {
      currentIndex = 0;
    }
  }
  const imageWidth = previewContainer[currentIndex].clientWidth;
  // console.log(imageWidth);
  const translateX = -1 * currentIndex * imageWidth;
  previewInner.style.transform = `translateX(${translateX}px)`;
  updateGallery(mainImg, previewImgs, currentIndex);
  return currentIndex;
}
function updateGallery(mainImg, previewImgs, currentIndex) {
  mainImg.src = previewImgs[currentIndex].src;

  previewImgs.forEach((img) => {
    img.classList.remove('active');
  });

  previewImgs[currentIndex].classList.add('active');


}
document.addEventListener('DOMContentLoaded', function() {
  const mainImg = document.querySelector('.main-img');
  const previewImgs = document.querySelectorAll('#gallery-preview1 img');
  const previewInner = document.querySelector('#gallery-preview1 .preview-inner');
  const previewContainer = document.querySelectorAll('#gallery-preview1 .image-container');

  const mainImg2 = document.querySelectorAll('.main-img')[1];
  const previewImgs2 = document.querySelectorAll('#gallery-preview2 img');
  const previewInner2 = document.querySelector('#gallery-preview2 .preview-inner');
  const previewContainer2 = document.querySelectorAll('#gallery-preview2 .image-container');

  const mainImg3 = document.querySelectorAll('.main-img')[2];
  const previewImgs3 = document.querySelectorAll('#gallery-preview3 img');
  const previewInner3 = document.querySelector('#gallery-preview3 .preview-inner');
  const previewContainer3 = document.querySelectorAll('#gallery-preview3 .image-container');


  let btnleft = document.querySelectorAll('.btn-left');
  let btnright = document.querySelectorAll('.btn-right');
  
  btnleft[0].addEventListener('click', () => {indexes[0] = changePreview('left', indexes[0], previewImgs, previewContainer, previewInner, mainImg);});
  btnleft[1].addEventListener('click', () => {indexes[1] = changePreview('left', indexes[1], previewImgs2, previewContainer2, previewInner2, mainImg2);});
  btnleft[2].addEventListener('click', () => {indexes[2] = changePreview('left', indexes[2], previewImgs3, previewContainer3, previewInner3, mainImg3);});
  btnright[0].addEventListener('click', () => {indexes[0] = changePreview('right', indexes[0], previewImgs, previewContainer, previewInner, mainImg);});
  btnright[1].addEventListener('click', () => {indexes[1] = changePreview('right', indexes[1], previewImgs2, previewContainer2, previewInner2, mainImg2);});
  btnright[2].addEventListener('click', () => {indexes[2] = changePreview('right', indexes[2], previewImgs3, previewContainer3, previewInner3, mainImg3);});

  previewImgs.forEach((img, index) => {
    img.addEventListener('click', () => {
      indexes[0] = index;
      const imageWidth = previewContainer[indexes[0]].clientWidth;
      const translateX = -1 * indexes[0] * imageWidth;
      previewInner.style.transform = `translateX(${translateX}px)`;
      updateGallery(mainImg, previewImgs, indexes[0]);
    });
  });
  previewImgs2.forEach((img, index) => {
    img.addEventListener('click', () => {
      indexes[1] = index;
      const imageWidth = previewContainer2[indexes[1]].clientWidth;
      const translateX = -1 * indexes[1] * imageWidth;
      previewInner2.style.transform = `translateX(${translateX}px)`;
      updateGallery(mainImg2, previewImgs2, indexes[1]);
    });
  });
  previewImgs3.forEach((img, index) => {
    img.addEventListener('click', () => {
      indexes[2] = index;
      const imageWidth = previewContainer3[indexes[2]].clientWidth;
      const translateX = -1 * indexes[0] * imageWidth;
      previewInner3.style.transform = `translateX(${translateX}px)`;
      updateGallery(mainImg3, previewImgs3, indexes[2]);
    });
  });
});
