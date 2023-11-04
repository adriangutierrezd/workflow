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
    const closeModalEv = new Event('closeModal')
    targetModal.dispatchEvent(closeModalEv)
}
