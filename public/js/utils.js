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
