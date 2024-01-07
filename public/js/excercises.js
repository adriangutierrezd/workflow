import { getExcercises, createExcercise } from './excercisesService.js'
import { createRow, createCell, createFullTd, showTableLoading } from './tablesService.js'
import { OPTIONS_DOTS, TRASH_ICON, EDIT_ICON, SPINNER, CHART_ICON } from './icons.js'
import { changeButtonStatus, closeModal, openModal, createDialogDropDownItem, createDialogDropDownContainer, createDialogDroDownBtn, trans } from './utils.js'
import { HTTP_STATUS } from './constants.js'




const loadExcercises = async () => {
    try {

        const table = document.getElementById('excercises-list')
        if ($.fn.DataTable.isDataTable('#excercises-list')) {
            window.excercisesTable.clear().destroy();
        }

        showTableLoading({ table })

        const { excercises } = await getExcercises()
        table.children[1].innerHTML = ''

        if (excercises.length === 0) {

            const noDataPh = document.createElement('p')
            noDataPh.className = 'text-center text-gray-500 dark:text-gray-400'
            noDataPh.innerText = trans({ key: 'No exercises have been recorded' })

            const td = createFullTd({
                colSpan: 3,
                innerHTML: noDataPh,
                classes: 'p-2'
            })

            const info = {
                id: `ex_0`
            }

            const tr = createRow(info)
            tr.appendChild(td)
            table.children[1].appendChild(tr)

        } else {

            excercises.forEach(excercise => {

                const { id, name, public: permission, user } = excercise

                const info = {
                    id: `ex_${id}`
                }

                const tr = createRow(info)
                table.children[1].appendChild(tr)

                const tdName = createCell({
                    text: name,
                    type: 'td'
                })
                tr.appendChild(tdName)


                const tdAuthor = createCell({
                    text: user ? user.name : `Admin`,
                    type: 'td'
                })
                tr.appendChild(tdAuthor)


                const parentOptionsDiv = document.createElement('div')

                const optionsButton = createDialogDroDownBtn({ icon: OPTIONS_DOTS })
                const optionsDiv = createDialogDropDownContainer()

                const optionsList = document.createElement('ul')
                optionsList.className = 'py-1'
                optionsList.setAttribute('role', 'none')

                const optionsStatic = document.createElement('li')
                optionsStatic.className = 'dropdown-item'
                optionsStatic.setAttribute('role', 'menuitem')
                optionsStatic.setAttribute('tabindex', '-1')
                optionsStatic.setAttribute('id', 'options-menu-0')

                const optionsStaticLink = document.createElement('a')
                optionsStaticLink.className = 'flex items-center'
                optionsStaticLink.setAttribute('href', `excercise-statics/${id}`)
                optionsStaticLink.innerHTML = CHART_ICON
                const optionsStaticLinkText = document.createElement('span')
                optionsStaticLinkText.className = 'ml-2'
                optionsStaticLinkText.innerText = trans({ key: 'Estadísticas' })
                optionsStaticLink.appendChild(optionsStaticLinkText)
                optionsStatic.appendChild(optionsStaticLink)
                optionsList.appendChild(optionsStatic)


                if (user) {
                    const optionsEdit = createDialogDropDownItem({ icon: EDIT_ICON, text: trans({ key: 'Edit' }) })
                    optionsEdit.addEventListener('click', () => {
                        document.querySelector('input[name=name]').value = name
                        openModal('edit-excercise-form-modal')
                    })
                    optionsList.appendChild(optionsEdit)

                    const optionsDelete = createDialogDropDownItem({ icon: TRASH_ICON, text: trans({ key: 'Delete' }) })
                    optionsDelete.addEventListener('click', () => {
                        openModal('<delete-excercise-form-modal>')
                        document.querySelector('input[name=deleteExcerciseId').value = id
                        openModal('delete-excercise-form-modal')
                    })
                    optionsList.appendChild(optionsDelete)
                }




                optionsDiv.appendChild(optionsList)
                parentOptionsDiv.appendChild(optionsButton)
                parentOptionsDiv.appendChild(optionsDiv)

                optionsButton.addEventListener('click', () => {
                    optionsDiv.classList.toggle('hidden')
                })

                document.addEventListener('click', (e) => {
                    if (!parentOptionsDiv.contains(e.target)) {
                        optionsDiv.classList.add('hidden')
                    }
                })


                const tdActions = createCell({
                    text: parentOptionsDiv,
                    html: true,
                    type: 'td'
                })
                tr.appendChild(tdActions)

            })

            window.excercisesTable = $('#excercises-list').DataTable({
                info: false,
                language: translations
            })

        }



    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })
    }
}

window.addEventListener('DOMContentLoaded', () => {

    loadExcercises()
    document.getElementById('new-excercise-modal')?.addEventListener('submit', async (e) => {

        e.preventDefault()

        const name = document.querySelector('input[name=name]').value

        const submitBtn = document.getElementById('btn-create-excercise')
        const submitBtnText = submitBtn.innerHTML

        try {

            changeButtonStatus({ button: submitBtn, disabled: true, inner: SPINNER })
            const { status, message } = await createExcercise({ name })

            if (status === HTTP_STATUS.CREATED) {
                document.getElementById('new-excercise-modal').reset()
                closeModal('new-excercise-form-modal')
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: trans({ key: 'Okey' })
                })
            }

        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error',
                confirmButtonText: trans({ key: 'Okey' })
            })
        } finally {
            changeButtonStatus({ button: submitBtn, disabled: false, inner: submitBtnText })
            loadExcercises()
        }


    })

})