
// function showlogin(){
//     document.getElementById('login').style.display='block';
//     document.getElementById('body').style.overflow='hidden';
// }
// function showRegister(){
//     document.getElementById('register').style.display='block';
//     document.getElementById('body').style.overflow='hidden';
// }
// function closeForm(){
//     document.getElementById('register').style.display='none';
//     document.getElementById('login').style.display='none';
//     document.getElementById('body').style.overflow='scroll';
// }
// function checkRegister(){
//     var x = document.getElementById("password-dk").value;
//     document.getElementById('re-password').pattern=x;
// }
window.addEventListener('scroll',function(){
    var scroll =document.querySelector('.scrollTop');
    scroll.classList.toggle("active",window.scrollY>400)
})
function scrolltoTop(){
    window.scrollTo({
        top:0
    })
}
function srcollChange(){
    window.addEventListener("scroll",function(){ 
        var y=window.innerWidth;
        
        if( y>770){
            var elmnt = document.getElementById("getHeight");
            var Height =  elmnt.offsetHeight ;
            document.getElementById("srollchange").style.height =Height;
           
        }
      
    });
}

// Update the count down every 1 second
//  var x = setInterval(function() {
//     // Set the date we're counting down to
//     divs  = $('.timedown')
//     var mydate = new Date("2021-01-09").getTime(); 
//     for(ind in divs){
        
//         div = divs[ind];
//         var now = new Date().getTime();
        
       
//         var distance =mydate-now;
//         var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//         var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//         var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//         div.innerHTML="Còn "+days + " ngày " + hours + ":"
//         + minutes + ":" + seconds;
//     //do whatever you want
//     }
   
//     // If the count down is over, write some text 
//     if (distance < 0) {
//         clearInterval(x);
//         $('.timedown').html("Hết hạn");
//     }
// }, 1000)
function monney() {
    var Adult=document.getElementById("Adult").value ;
    var a=document.getElementById("m-Adult").innerHTML;
    var Child=document.getElementById("Child").value ;
    var c=document.getElementById("m-Child").innerHTML;
    var Baby=document.getElementById("Baby").value ;
    var b=document.getElementById("m-Baby").innerHTML;
    var Infant=document.getElementById("Infant").value ;
    var I=document.getElementById("m-Infant").innerHTML;
  
    var arr=[a,c,b,I];
    for (let i=0; i<arr.length; i++) {
      arr[i]= arr[i].replaceAll(",","");
    }
    var monney=Adult*arr[0]+Child*arr[1]+Baby*arr[2]+Infant*arr[3];
    var monney = monney.toString();
    const format =monney.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    document.getElementById("sumary").innerHTML=format;
   

}



