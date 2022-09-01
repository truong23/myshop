<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css);
    #top-up {
    font-size: 4rem;
    cursor: pointer;
    position: fixed;
    z-index: 9999;
    color:#2f80ed;
    bottom: 50px;
    right: 50px;
    display: none;
    opacity: 0.8;
    }
    #top-up:hover {
        opacity: 1;
    }
    @media screen and (max-width: 768px){
        #top-up {
        font-size: 3rem;
        bottom: 50px;
        right: 50px;
     }
    
    @media screen and (min-width: 461px) and (max-width: 600px){
        #top-up {
        font-size: 2.5rem;
        right: 25px;
     }
    }

    @media screen and (max-width: 460px){
        #top-up {
        font-size: 3rem;
        right: 20px;
     }
    }
    }
</style>

<div title="Về đầu trang" id="top-up">
<i class="fas fa-arrow-circle-up"></i></div>

<!-- Import thư viện JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
// kéo xuống khoảng cách 500px thì xuất hiện nút Top-up
var offset = 500;
// thời gian di trượt 0.75s ( 1000 = 1s )
var duration = 750;
$(function(){
$(window).scroll(function () {
if ($(this).scrollTop() > offset)
$('#top-up').fadeIn(duration);else
$('#top-up').fadeOut(duration);
});
$('#top-up').click(function () {
$('body,html').animate({scrollTop: 0}, duration);
});
});
</script>