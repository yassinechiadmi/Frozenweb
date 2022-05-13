let allCross = document.getElementsByClassName('question');
// const allImg = document.getElementsByTagName('img');
console.log(allCross);

function myFunction(){
    // console.log(this);
    console.log('test');
    // const height = this.children[0].scrollHeight;
    // console.log(height);    
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
}

for (var i = 0; i < allCross.length; i++) {
    allCross[i].addEventListener('click', myFunction, false);
}

console.log('here');


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