// const navItems = document.querySelectorAll('.nav_link')
// navItems.forEach(element => {
//     element.addEventListener('click', (event) => {
//         // event.preventDefault()
//         document.querySelector('.selected').classList.remove('selected')
//         event.target.classList.add('selected')
//     })
// });
const darkModeToggler = document.querySelector('.dark-mode-toggler')
let darkMode;

if (localStorage.getItem('darkMode')) {
    darkMode = JSON.parse(localStorage.getItem('darkMode'))
} else {
    darkMode = true;
    localStorage.setItem('darkMode', JSON.stringify(darkMode));
}


if (darkMode) {
    document.getElementsByTagName('link')[1].href = './assets/css/dark_style.css'
} else {
    document.getElementsByTagName('link')[1].href = './assets/css/style.css'
    darkModeToggler.classList.remove('fa-toggle-on')
    darkModeToggler.classList.add('fa-toggle-off')
}
darkModeToggler.addEventListener('click', (event) => {
    if (darkMode) {
        event.target.classList.remove('fa-toggle-on')
        event.target.classList.add('fa-toggle-off')
        document.getElementsByTagName('style')
        document.getElementsByTagName('link')[1].href = './assets/css/style.css'
        darkMode = false

    } else {
        event.target.classList.remove('fa-toggle-off')
        event.target.classList.add('fa-toggle-on')
        document.getElementsByTagName('link')[1].href = './assets/css/dark_style.css'
        darkMode = true
    }

    localStorage.setItem('darkMode', JSON.stringify(darkMode))
})