import { DEFAULT_TD_CLASSES } from './constants.js'

export const createRow = (info) => {

    const { id, datasets, classes } = info
    const row = document.createElement('tr')

    if (id !== undefined) row.setAttribute('id', id)
    if (classes !== undefined) row.className = classes


    if (datasets !== undefined) {
        Object.keys(datasets).forEach((data) => {
            row.dataset[data] = datasets[data]
        })
    }

    return row

}


export const createCell = (info) => {

    const { id, classes, text, type, attributes, html } = info
    const cell = document.createElement(type)

    if (id !== undefined) cell.setAttribute('id', id)
    if (classes !== undefined) {
        cell.className = classes
    } else {
        cell.className = DEFAULT_TD_CLASSES
    }
    if (text !== undefined) {
        if (html === true) {

            if (typeof text === 'string') {
                cell.innerHTML = text
            } else if (typeof text === 'object') {
                cell.appendChild(text)
            }
        } else {
            cell.textContent = text
        }
    }
    if (attributes !== undefined) {
        Object.keys(attributes).forEach((attr) => {
            cell.setAttribute(attr, attributes[attr])
        })
    }

    return cell

}