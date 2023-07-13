document.addEventListener('DOMContentLoaded', function() {
  let currentImageIndex = 0;
  const images = document.querySelectorAll('.image-wrapper');

  function showImage(index) {
    images.forEach((img, i) => {
      if (i === index) {
        img.style.display = 'block';
      } else {
        img.style.display = 'none';
      }
    });
  }

  document.querySelector('.next-button').addEventListener('click', function() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    showImage(currentImageIndex);
  });

  document.querySelector('.prev-button').addEventListener('click', function() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    showImage(currentImageIndex);
  });

  showImage(currentImageIndex);
});
