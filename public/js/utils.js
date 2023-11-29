export const generateProgressBar = (info) => {

    const { id, classes, progress, bgColor, color } = info

    const div = document.createElement('div')
    if (id !== undefined) div.id = id

    div.className = `${classes} overflow-hidden rounded-full ${bgColor}`
    const div2 = document.createElement('div')
    div2.className = `${color} h-1.5`
    div2.style.width = `${progress}%`
    div.appendChild(div2)
    return div
}

export const changeButtonStatus = (info) => {

    const { button, disabled, inner } = info

    if (disabled) {
        button.setAttribute('disabled', true)
        button.classList.add('cursor-not-allowed')
    } else {
        button.classList.remove('cursor-not-allowed')
        button.removeAttribute('disabled')
    }

    button.innerHTML = inner
}

export const closeModal = (modalId) => {
    const targetModal = document.getElementById(modalId)
    if (!targetModal) return
    const closeModalEv = new Event('closeModal')
    targetModal.dispatchEvent(closeModalEv)
}

export const openModal = (modalId) => {
    const targetModal = document.getElementById(modalId)
    if (!targetModal) return
    const openModalEv = new Event('openModal')
    targetModal.dispatchEvent(openModalEv)
}

export const createDialogDropDownItem = ({ icon, text }) => {

    const dialogDropDownItem = document.createElement('li')
    dialogDropDownItem.className = 'dialog-dropdown-item'
    dialogDropDownItem.setAttribute('role', 'menuitem')
    dialogDropDownItem.setAttribute('tabindex', '-1')
    dialogDropDownItem.setAttribute('id', 'options-menu-1')
    dialogDropDownItem.innerHTML = icon

    const dropDownDialogText = document.createElement('span')
    dropDownDialogText.className = 'ml-2'
    dropDownDialogText.innerText = text
    dialogDropDownItem.appendChild(dropDownDialogText)

    return dialogDropDownItem

}

export const createDialogDropDownContainer = () => {
    const dialogDropDownContainer = document.createElement('div')
    dialogDropDownContainer.className = 'hidden dialog-dropdown-container'
    dialogDropDownContainer.setAttribute('role', 'menu')
    dialogDropDownContainer.setAttribute('aria-orientation', 'vertical')
    dialogDropDownContainer.setAttribute('aria-labelledby', 'options-menu')
    dialogDropDownContainer.setAttribute('tabindex', '-1')
    return dialogDropDownContainer
}

export const createDialogDroDownBtn = ({ icon }) => {
    const optionsButton = document.createElement('button')
    optionsButton.className = 'dropdown-dots-button'
    optionsButton.innerHTML = icon
    optionsButton.setAttribute('aria-haspopup', 'true')
    optionsButton.setAttribute('aria-expanded', 'true')
    optionsButton.setAttribute('type', 'button')
    return optionsButton
}

export const trans = ({ key, def }) => {

    const substitute = def ?? key
    return translations[key] ?? substitute

}