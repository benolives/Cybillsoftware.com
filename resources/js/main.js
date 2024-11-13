/*=============== SHOW MENU ===============*/
/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/* Menu show */
if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

/* Menu hidden */
if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

/**NAV DROPDOWN */
let profile = document.querySelector('.profile');
let action = document.querySelector('.action');

profile.addEventListener('click', () => {
    action.classList.toggle('active');
})


/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

const linkAction = () =>{
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))


/*=============== button dropdown ===============*/
let loginBtn = document.querySelector('.login-btn')
let dropLogin = document.querySelector('.drop-login')

loginBtn.onclick = () => {
    dropLogin.classList.toggle("drop-login-open")
}


/*=============== GSAP ANIMATION ===============*/
gsap.from('.home__points', 1.5, {opacity: 0, y: -300, delay: .2})
gsap.from('.home__rocket', 1.5, {opacity: 0, y: 300, delay: .3})
gsap.from('.home__planet-1', 1.5, {opacity: 0, x: -200, delay: .8})
gsap.from('.home__planet-2', 1.5, {opacity: 0, x: 200, delay: .1})
gsap.from('.home__content', 1.5, {opacity: 0, y: -100, delay: 1.4})
gsap.from('.home__title img', 1.5, {opacity: 0, x: 100, delay: 1.6})
gsap.from('.price-box', 1.5, {opacity: 0, x: -200, delay: .8})

