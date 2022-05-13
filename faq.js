const allCross = document.querySelectorAll('.visible-pannel img');
const allImg = document.getElementsByTagName('button');
console.log(allImg)
console.log(allCross);

allCross.forEach(element => {

    element.addEventListener('click', function(e){

        // const height = this.parentNode.parentNode.childNodes[3].scrollHeight;
        
        // const currentCHoice = this.parentNode.parentNode.childNodes[3];
        
        if(e.src == 'ressources/croix.jpg'){
            console.log("testtt");
            e.src = '/ressources/minus.png';
            /*gsap.to(currentCHoice, {duration: 0.2, height: height + 40, opacity: 1,
            padding: '20px 15px'})*/
        } else if (e.src.includes('minus')){
            e.src = '/ressources/croix.jpg';
            /*gsap.to(currentCHoice, {duration: 0.2, height: 0, opacity: 0,
            padding: '0px 15px'})*/
        }
    })
})

function toggleButton(button) {
    console.log(button.firstElementChild)

    if (button.firstElementChild == "ressources/croix.jpg") {
        console.log(button.firstElementChild.src)
    }
}