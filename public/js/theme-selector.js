

const setSystemTheme = () => {
    const actualTheme = localStorage.getItem('color-theme')
    if (actualTheme) {
        localStorage.removeItem('color-theme')
    }
    applyTheme()
}

const setLightTheme = () => {
    localStorage.setItem('color-theme', 'light')
    applyTheme()
}

const setDarkTheme = () => {
    localStorage.setItem('color-theme', 'dark')
    applyTheme()
}

const themeOptions = {
    'dark': setDarkTheme,
    'light': setLightTheme,
    'system': setSystemTheme
}

document.getElementById('theme-selector-form').addEventListener('submit', (ev) => {
    ev.preventDefault()

    const selection = document.getElementById('theme_selector').value
    if (themeOptions.hasOwnProperty(selection)) {
        themeOptions[selection]()
    }

})

const applyTheme = () => {
    const actualTheme = localStorage.getItem('color-theme')
    document.body.classList.remove('dark', 'light')
    if (actualTheme === 'dark') {
        document.body.classList.add('dark')
    } else if (actualTheme === 'light') {
        document.body.classList.add('light')
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('theme_selector').value = localStorage.getItem('color-theme') ?? 'system'
    applyTheme()
})
