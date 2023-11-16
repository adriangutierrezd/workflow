import { SPINNER } from './constants.js'

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

export const createFullTd = (info) => {

    const { colSpan, innerHTML, classes } = info

    const td = document.createElement('td')
    td.colSpan = colSpan
    if (classes !== undefined) td.className = classes
    if (typeof innerHTML === 'string') {
        td.innerHTML = innerHTML
    } else if (typeof innerHTML === 'object') {
        td.appendChild(innerHTML)
    }

    return td

}

export const showTableLoading = (info) => {

    const { table } = info

    const spinnerParentDiv = document.createElement('div')
    spinnerParentDiv.className = 'flex justify-center w-full'
    spinnerParentDiv.innerHTML = SPINNER

    const td = createFullTd({
        colSpan: table.children[0].children[0].children.length,
        innerHTML: spinnerParentDiv,
        classes: 'p-2'
    })

    const vars = {
        id: `wk_0`
    }

    const tr = createRow(vars)
    tr.appendChild(td)
    table.children[1].innerHTML = ''
    table.children[1].appendChild(tr)

}