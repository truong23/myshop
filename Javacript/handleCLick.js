let liElement = document.querySelectorAll('.user_nav li:not(:last-child')
let divElement = document.querySelectorAll('.user_right')

liElement[0].classList.add("active")
divElement[0].classList.add("visible");
let currentIndex = localStorage.getItem("tab");
if (currentIndex !== 0 && typeof currentIndex === "string") {
  liElement[0].classList.remove("active")
  divElement[0].classList.remove("visible");
  liElement[currentIndex].classList.add("active")
  divElement[currentIndex].classList.add("visible");
}

document.querySelector('.user_nav li:last-child').onclick = function(){
  localStorage.removeItem('tab')
}

liElement.forEach((element,index) => {
    element.onclick = function () {
      document.querySelector(".user_nav li.active").classList.remove("active");
      document.querySelector('.user_right.visible').classList.remove("visible");
      this.classList.add("active");
      divElement[index].classList.add("visible");
      localStorage.setItem("tab",index)
    };
  });

function chooseFile(fileInput){
  if(fileInput.files && fileInput.files[0]){
        var reader = new FileReader(fileInput.files);
        reader.onload = function(e) {
          $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);   
  }
}