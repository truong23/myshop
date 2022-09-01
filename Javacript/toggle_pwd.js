let input = document.querySelector('.pswrd');
let show = document.querySelector('.show');
let icon = document.querySelector('.show i')
show.addEventListener('click', active);
function active(){
    if(input.type === "password"){
        input.type = "text";
        icon.innerText = "visibility_off";
    }else{
        input.type = "password";
        icon.innerText = "visibility";
    }
}
