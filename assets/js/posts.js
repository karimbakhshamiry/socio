const posts = document.querySelectorAll('.post__image')

posts.forEach(element => {
    element.addEventListener('click', (event) => {
        console.log('clicked')
        element.parentElement.classList.toggle('parent-strech')
        element.classList.toggle('stretch')
    })
});