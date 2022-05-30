// let allCross = document.getElementsByClassName('question');
// const allImg = document.getElementsByTagName('img');
// console.log(allCross);

function myFunction(e){
    let el = e.querySelector('img');
    let txt = e.querySelector('.toggle-pannel');

    if(el.src.includes('plus.png')){
        el.src = 'rs/moins.png';
        el.style.transform = 'scale(.65)';
        txt.style.display = 'block';
        txt.style.transform = 'scale(1)';
        txt.style.opacity = '1';
    } else if (el.src.includes('moins.png')){
        el.src = 'rs/plus.png';
        el.style.transform = 'scale(1)';
        txt.style.display = 'none';
        txt.style.transform = 'scale(0)';
        txt.style.opacity = '0';
    }

}
// allCross.addEventListener('click', function(){

    // const height = this.parentNode.parentNode.childNodes[3].scrollHeight;
    
    // const currentCHoice = this.parentNode.parentNode.childNodes[3];
    
    // if(this.src.includes('plus')){
    //     this.src = 'moins.png';
    //     gsap.to(currentCHoice, {duration: 0.2, height: height + 40, opacity: 1,
    //     padding: '20px 15px'})
    // } else if (this.src.includes('moins')){
    //     this.src = 'plus.jpg';
    //     gsap.to(currentCHoice, {duration: 0.2, height: 0, opacity: 0,
    //         padding: '0px 15px'})
    // }
// })
// allCross.forEach(element => {

   
// })