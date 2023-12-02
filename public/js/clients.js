import { getClients, createClient, deleteClient } from './clientsService.js'
import { showTableLoading, createFullTd, createRow, createCell } from './tablesService.js';
import { createDialogDroDownBtn, createDialogDropDownContainer, createDialogDropDownItem, closeModal, openModal, trans } from './utils.js'
import { OPTIONS_DOTS, TRASH_ICON, EXTERNAL_LINK_ICON } from './constants.js'

const loadClients = async () => {
    try {

        const table = document.getElementById('clients-list')
        if ($.fn.DataTable.isDataTable('#clients-list')) {
            window.dataTable.clear().destroy();
        }

        showTableLoading({ table })

        const { data } = await getClients(User.id)
        table.children[1].innerHTML = ''

        if (data.length === 0) {
            const td = createFullTd({
                colSpan: table.children[0].children[0].children.length,
                innerHTML: trans({ key: 'No clients found' }),
                classes: 'p-2 text-center'
            })
            const tr = createRow({})
            tr.appendChild(td)
            table.children[1].appendChild(tr)
            return
        } else {

            data.forEach(client => {

                const { id, created_at: date, clients } = client
                const { name, email, id: clientId, image_url } = clients[0]

                const info = {
                    id: `clt_${id}`,
                    datasets: {
                        client: clientId
                    }
                }

                const tr = createRow(info)
                table.children[1].appendChild(tr)

                const nameDiv = document.createElement('div')
                nameDiv.className = 'flex items-center space-x-3'
                nameDiv.innerHTML = `
                    <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0" src="${image_url}" alt="">
                    <span>${name}</span>
                `

                const tdName = createCell({
                    text: nameDiv,
                    type: 'td',
                    html: true
                })
                tr.appendChild(tdName)

                const tdEmail = createCell({
                    text: email,
                    type: 'td'
                })
                tr.appendChild(tdEmail)

                const tdIncorp = createCell({
                    text: date,
                    type: 'td'
                })
                tr.appendChild(tdIncorp)


                const parentOptionsDiv = document.createElement('div')

                const optionsButton = createDialogDroDownBtn({ icon: OPTIONS_DOTS })
                const optionsDiv = createDialogDropDownContainer()

                const optionsList = document.createElement('ul')
                optionsList.className = 'py-1'
                optionsList.setAttribute('role', 'none')

                const optionsEdit = document.createElement('li')
                optionsEdit.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900'
                optionsEdit.setAttribute('role', 'menuitem')
                optionsEdit.setAttribute('tabindex', '-1')
                optionsEdit.setAttribute('id', 'options-menu-0')


                const optionsEditLink = document.createElement('a')
                optionsEditLink.className = 'flex items-center'
                optionsEditLink.setAttribute('href', `/statics/${clientId}`)
                optionsEditLink.innerHTML = EXTERNAL_LINK_ICON
                const optionsEditLinkText = document.createElement('span')
                optionsEditLinkText.className = 'ml-2'
                optionsEditLinkText.innerText = 'Estadísticas'
                optionsEditLink.appendChild(optionsEditLinkText)
                optionsEdit.appendChild(optionsEditLink)
                optionsList.appendChild(optionsEdit)

                const optionsDelete = createDialogDropDownItem({ icon: TRASH_ICON, text: trans({ key: 'Delete' }) })
                optionsDelete.addEventListener('click', () => {
                    document.getElementById('clientDeleteId').value = id
                    openModal('delete-client-form-modal')
                })
                optionsList.appendChild(optionsDelete)


                optionsButton.addEventListener('click', () => {
                    optionsDiv.classList.toggle('hidden')
                })

                document.addEventListener('click', (e) => {
                    if (!parentOptionsDiv.contains(e.target)) {
                        optionsDiv.classList.add('hidden')
                    }
                })

                optionsDiv.appendChild(optionsList)
                parentOptionsDiv.appendChild(optionsButton)
                parentOptionsDiv.appendChild(optionsDiv)

                const tdAcciones = createCell({
                    text: parentOptionsDiv,
                    type: 'td',
                    html: true
                })
                tr.appendChild(tdAcciones)


            })

            window.dataTable = $('#clients-list').DataTable({
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

document.getElementById('newClientForm').addEventListener('submit', async (ev) => {

    ev.preventDefault()
    const client = document.getElementById('client_selector').value

    try {
        await createClient({ trainerId: User.id, client })
    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    } finally {
        closeModal('new-client-form-modal')
        loadClients()
    }

})

document.getElementById('deleteClientButton').addEventListener('click', async () => {

    const clientTrainerId = document.getElementById('clientDeleteId').value

    try {
        await deleteClient({ clientTrainerId })
    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    } finally {
        closeModal('delete-client-form-modal')
        loadClients()
    }

});

window.addEventListener('DOMContentLoaded', async () => {

    loadClients()
    $('#client_selector').select2({
        ajax: {
            url: function (params) {
                return `/api/trainer/possible-clients/${params.term}`
            },
            dataType: 'json',
            delay: 250,
            processResults: function ({ data }) {
                return {
                    results: data.map(({ id, name }) => ({ id, text: name }))
                };
            }
        }
    });

})