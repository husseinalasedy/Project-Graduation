
    
listvideo=document.querySelectorAll('.boxvid .vid');
mainvideo=document.querySelector('.boxvideo .video');
titel=document.querySelector('.boxvideo .titel');
listvideo.forEach(video =>{
    video.onclick = () =>{
        listvideo.forEach(vid => vid.classList.remove('active'));
        video.classList.add('active');
        if(video.classList.contains('active')){
            let src=video.children[0].getAttribute('src');
            mainvideo.src=src;
            let text=video.children[1].innerHTML;
            titel.innerHTML=text;


        };
        
    };
});


listvideo.forEach(video => {
    video.onclick=()=>{
        listvideo.forEach(vid => vid.classList.remove('active'));
        video.classList.add('active')
    };
});
    const loginContainer = document.querySelector('.login');
    const signupContainer = document.querySelector('.login-in');
    const switchLinks = document.querySelector('.cliceLogin');
    const switchLinks2 = document.querySelector('.cliceLogin2');

    switchLinks.addEventListener('click', switchpag);
    switchLinks2.addEventListener('click', switchpag2);
    function switchpag(){
            signupContainer.style.display =  'block' ;
            loginContainer.style.display =  'none' ;
    }
    function switchpag2(){
        signupContainer.style.display =  'none' ;
        loginContainer.style.display =  'block' ;
}

// downlode img 
function down(){
    var image = document.getElementById("certificateIMG");
        var imageURL = image.src;
        var link = document.createElement("a");
        link.href = imageURL;
        link.download = "الشهادة.jpg";

        if (document.createEvent) {
            var event = document.createEvent("MouseEvents");
            event.initEvent("click", true, true);
            link.dispatchEvent(event);
        } else if (link.click) {
            link.click();
        }
}