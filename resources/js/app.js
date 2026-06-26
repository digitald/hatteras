window.addEventListener('load', function () {
    const mainNavigation = document.getElementById('primary-navigation')
    const mainNavigationToggle = document.getElementById('primary-menu-toggle')

    if (mainNavigation && mainNavigationToggle) {
        mainNavigationToggle.addEventListener('click', function (e) {
            e.preventDefault()
            const isHidden = mainNavigation.classList.toggle('hidden')
            mainNavigationToggle.setAttribute('aria-expanded', isHidden ? 'false' : 'true')
        })
    }
})
