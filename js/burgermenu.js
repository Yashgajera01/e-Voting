burger = document.querySelector('.burger')
navBar = document.querySelector('.navbar')
navList = document.querySelector('.nav-list')

burger.addEventListener('click',()=>{

    navList.classList.toggle('v-class');
    navBar.classList.toggle('h-nav-resp');

})
