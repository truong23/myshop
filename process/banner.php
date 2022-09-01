<style>
    <?php include './Css/banner.css'; ?>
</style>
<div class="big__banner">
    <a href="#">
      <img src="./img/banner.png" alt="">
    </a>

</div>
<div class="banner">
    <div class="banner__slides fade">
        <a href="#"><img src="./img/banner1.png"></a>
        <a href="product.php?id=146"><img src="./img/banner2.png"></a>
      </div>
      <div class="banner__slides fade">
        <a href="product.php?id=157"><img src="./img/banner3.png"></a>
        <a href="product.php?id=162"><img src="./img/banner4.png"></a>
      </div>
      <div class="banner__slides fade">
        <a href="#"><img src="./img/banner5.png"></a>
        <a href="#"><img src="./img/banner6.png"></a>
      </div>
      <div class="banner__slides fade">
        <a href="product.php?id=147"><img src="./img/banner7.gif"></a>
        <a href="#"><img src="./img/banner8.png"></a>
      </div>
      <a class="prevb" onclick="addSlides(-1)">
              <i class="material-icons material-symbols-outlined">
                arrow_back_ios
              </i>
          </a>
      <a class="nextb" onclick="addSlides(1)">
          <i class="material-icons material-symbols-outlined">
            arrow_forward_ios
          </i>
      </a>  
</div>
<div class="banner_responsive">
  <div class="banner__slides--res fade">
    <a href="#"><img src="./img/banner1.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="product.php?id=146"><img src="./img/banner2.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="product.php?id=157"><img src="./img/banner3.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="product.php?id=162"><img src="./img/banner4.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="#"><img src="./img/banner5.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="#"><img src="./img/banner6.png"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="product.php?id=147"><img src="./img/banner7.gif"></a>
  </div>
  <div class="banner__slides--res fade">
    <a href="#"><img src="./img/banner8.png"></a>
  </div>
</div>
<script src="./Javacript/slideshow.js"></script>


<script>
    let index = 1;
    carousel(index);

  function addSlides(n) {
    carousel(index += n);
  }
  function curSlide(n) {
    carousel(index = n);
  }

  function carousel(n) {
    let i;
    let slides = document.querySelectorAll(".banner__slides");
    if (n > slides.length) {index = 1}    
    if (n < 1) {index = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    slides[index-1].style.display = "flex";   
  }

  slideAuto()
  function slideAuto() {
    let i;
    let slides = document.getElementsByClassName("banner__slides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    index++;
    if (index > slides.length) {index = 1}    
    slides[index-1].style.display = "flex";  
    setTimeout(slideAuto, 5000); // Change image every 2 seconds
  }

  slide2Auto()
  function slide2Auto() {
    let i;
    let slides = document.getElementsByClassName("banner__slides--res");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    index++;
    if (index > slides.length) {index = 1}    
    slides[index-1].style.display = "block";  
    setTimeout(slide2Auto, 5000); // Change image every 2 seconds
  }

</script>
<!-- <script>
let index = 0;
carousel();
function carousel() {
  let i;
  let slides = document.getElementsByClassName("banner__slides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  index++;
  if (index > slides.length) {index = 1}    
  slides[index-1].style.display = "flex";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}
</script> -->
