const navelement = document.querySelector('.navbar');

window.addEventListener('scroll', () => {

    if(window.scrollY > 75){

        navelement.classList.add('navbar-scrolled');
    }
    else if(window.scrollY <= 75){
        navelement.classList.remove('navbar-scrolled');
    }

});